<?php

namespace App\Http\Controllers;

use App\Http\Adapters\HttpClientInterface;

class FootballController extends Controller
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function teste()
    {
        $response = $this->httpClient->get('competitions/2016/matches?status=SCHEDULED');
        dd($response['matches']);
    }

    public function getUpcomingMatches($competitionId)
    {
        $response = $this->httpClient->get("competitions/{$competitionId}/matches?status=SCHEDULED");
        return $response['matches'];
    }

    public function getRecentResults($competitionId)
    {
        $response = $this->httpClient->get("competitions/{$competitionId}/matches?status=FINISHED");
        return $response['matches'];
    }

    public function searchTeamMatches($teamId)
    {
        $response = $this->httpClient->get("teams/{$teamId}/matches");
        return $response['matches'];
    }

    public function getCompetitions()
    {
        $response = $this->httpClient->get('competitions');
        return $response['competitions'];
    }

    public function getScheduledMatches($competitionId)
    {
        $response = $this->httpClient->get("competitions/{$competitionId}/matches?status=SCHEDULED");
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

        return $formattedMatches;
    }

    public function getLastResults($competitionId)
    {
        $response = $this->httpClient->get("competitions/{$competitionId}/matches?status=FINISHED");
        $matches = $response['matches'];
        $formattedResults = [];

        foreach ($matches as $match) {
            $formattedResults[] = [
                'homeTeam' => $match['homeTeam']['name'],
                'awayTeam' => $match['awayTeam']['name'],
                'score' => "{$match['score']['fullTime']['homeTeam']}x{$match['score']['fullTime']['awayTeam']}"
            ];
        }

        return $formattedResults;
    }

    public function searchTeam($teamName)
    {
        $response = $this->httpClient->get("teams?name={$teamName}");
        return $response['teams'];
    }

    public function getTeamMatches($teamId)
    {
        $response = $this->httpClient->get("teams/{$teamId}/matches");
        $matches = $response['matches'];
        $formattedMatches = [];

        foreach ($matches as $match) {
            $formattedMatches[] = [
                'homeTeam' => $match['homeTeam']['name'],
                'awayTeam' => $match['awayTeam']['name'],
                'date' => $match['utcDate'],
                'score' => "{$match['score']['fullTime']['homeTeam']}x{$match['score']['fullTime']['awayTeam']}"
            ];
        }

        return $formattedMatches;
    }
}
