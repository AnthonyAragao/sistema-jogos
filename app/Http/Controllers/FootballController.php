<?php

namespace App\Http\Controllers;

use App\Http\Adapters\HttpClientInterface;
use Illuminate\Http\Request;

class FootballController extends Controller
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    // Lista todas as competições
    public function getCompetitions()
    {
        $response = $this->httpClient->get('competitions');
        dd($response);
    }

    // Lista os próximos jogos de uma competição
    public function getUpcomingMatches($competitionId)
    {
        $response = $this->httpClient->get("competitions/{$competitionId}/matches", [
            'status' => 'SCHEDULED',
        ]);

        if (empty($response['matches'])) {
            return response()->json(['error' => 'Nenhuma partida encontrada.'], 404);
        }

        $matches = $response['matches'];
        $formattedMatches = [];

        foreach ($matches as $match) {
            $formattedMatches[] = [
                'homeTeam' => $match['homeTeam']['name'],
                'awayTeam' => $match['awayTeam']['name'],
                'date' => $match['utcDate'],
                'stadium' => $match['venue'] ?? 'N/A'
            ];
        }

        $perPage = 50;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;
        $paginatedMatches = array_slice($formattedMatches, $offset, $perPage);

        return response()->json([
            'data' => $paginatedMatches,
            'total' => count($formattedMatches),
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil(count($formattedMatches) / $perPage),
        ]);
    }

    // Lista os últimos resultados de uma competição
    public function getLastMatches($competitionId)
    {
        $response = $this->httpClient->get("competitions/{$competitionId}/matches", [
            'status' => 'FINISHED',
        ]);

        if (empty($response['matches'])) {
            return response()->json(['error' => 'Nenhum resultado encontrado.'], 404);
        }

        $matches = $response['matches'];
        $formattedResults = [];

        foreach ($matches as $match) {
            $score = $match['score'];

            $formattedResults[] = [
                'homeTeam' => $match['homeTeam']['name'],
                'awayTeam' => $match['awayTeam']['name'],
                'date' => $match['utcDate'],
                'score' => "{$score['fullTime']['home']}x{$score['fullTime']['away']}"
            ];
        }

        return response()->json($formattedResults);
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
