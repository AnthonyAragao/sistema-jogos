<?php

namespace App\Http\Controllers;

use App\Http\Adapters\HttpClientInterface;
use App\Http\Services\FootballService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FootballController extends Controller
{
    private HttpClientInterface $httpClient;

    public function __construct(
        private FootballService $footballService,
        HttpClientInterface $httpClient
    ){
        $this->httpClient = $httpClient;
    }

    public function getCompetitions()
    {
        return Inertia::render('Competitions/CompetitionsList', [
            'competitions' => $this->footballService->getCompetitions()
        ]);
    }

    public function getUpcomingMatches($competitionId)
    {
        $matches = $this->footballService->getMatchesByStatus($competitionId, 'SCHEDULED');

        if (empty($matches)) {
            return response()->json(['error' => 'Nenhuma partida encontrada.'], 404);
        }

        return Inertia::render('Competitions/UpcomingMatches', [
            'competition' => $this->footballService->extractCompetitionInfo($matches),
            'matches' =>  $this->footballService->paginate($this->footballService->formatMatches($matches))
        ]);
    }


    public function getLastMatches($competitionId)
    {
        $matches = $this->footballService->getMatchesByStatus($competitionId, 'FINISHED');

        if (empty($matches)) {
            return response()->json(['error' => 'Nenhum resultado encontrado.'], 404);
        }

        return Inertia::render('Competitions/LastMatches', [
            'competition' => $this->footballService->extractCompetitionInfo($matches),
            'matches' => $this->footballService->paginate($this->footballService->formatMatchResults($matches))
        ]);
    }


    public function getTeams(Request $request)
    {
        $limit = $request->get('limit', 50);
        $offset = $request->get('offset', 0);

        $response = $this->httpClient->get('teams', [
            'limit' => $limit,
            'offset' => $offset
        ]);

        if (empty($response['teams'])) {
            return response()->json(['error' => 'Nenhum time encontrado.'], 404);
        }

        return response()->json($response['teams']);
    }

    public function getTeam($teamId)
    {
        $response = $this->httpClient->get("teams/{$teamId}");

        if (empty($response['name'])) {
            return response()->json(['error' => 'Time não encontrado.'], 404);
        }

        return $response;
    }

    public function getTeamMatches($teamId)
    {
        $response = $this->httpClient->get("teams/{$teamId}/matches", [
            'status' => 'SCHEDULED',
        ]);
        $matches = $response['matches'];

        if (empty($matches)) {
            return response()->json(['error' => 'Nenhuma partida encontrada.'], 404);
        }

        $formattedMatches = [];

        foreach ($matches as $match) {
            $formattedMatches[] = [
                'homeTeam' => $match['homeTeam']['name'],
                'awayTeam' => $match['awayTeam']['name'],
                'date' => $match['utcDate'],
            ];
        }

        return $formattedMatches;
    }


    public function getTeamLastMatches($teamId)
    {
        $response = $this->httpClient->get("teams/{$teamId}/matches", [
            'status' => 'FINISHED',
        ]);

        $matches = $response['matches'];

        if (empty($matches)) {
            return response()->json(['error' => 'Nenhuma partida encontrada.'], 404);
        }

        $formattedMatches = [];

        foreach ($matches as $match) {
            $formattedMatches[] = [
                'homeTeam' => $match['homeTeam']['name'],
                'awayTeam' => $match['awayTeam']['name'],
                'date' => $match['utcDate'],
                'score' => "{$match['score']['fullTime']['home']}x{$match['score']['fullTime']['away']}"
            ];
        }

        return $formattedMatches;
    }
}
