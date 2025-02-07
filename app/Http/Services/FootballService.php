<?php

namespace App\Http\Services;

use App\Http\Adapters\HttpClientInterface;

class FootballService
{
    private HttpClientInterface $httpClient;
    private int $perPage = 20;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }


    public function getCompetitions()
    {
        return $this->httpClient->get('competitions')['competitions'] ?? [];
    }


    public function getMatchesByStatus(string $competitionId, string $status)
    {
        $response = $this->httpClient->get("competitions/{$competitionId}/matches", [
            'status' => $status,
        ]);

        return $response['matches'] ?? [];
    }


    public function extractCompetitionInfo(array $matches)
    {
        return [
            'id' => $matches[0]['competition']['id'] ?? null,
            'name' => $matches[0]['competition']['name'] ?? 'Competição desconhecida',
            'emblem' => $matches[0]['competition']['emblem'] ?? null,
        ];
    }

    public function formatMatches(array $matches)
    {
        return array_map(fn($match) => [
            'homeTeam' => [
                'name' => $match['homeTeam']['name'],
                'emblem' => $match['homeTeam']['crest']
            ],
            'awayTeam' => [
                'name' => $match['awayTeam']['name'],
                'emblem' => $match['awayTeam']['crest']
            ],
            'info' => [
                'venue' => $match['venue'] ?? 'Local não informado',
                'status' => $match['status'],
                'date' => $match['utcDate'],
            ],
        ], $matches);
    }

    public function formatMatchResults(array $matches)
    {
        return array_map(fn($match) => [
            'homeTeam' => [
                'name' => $match['homeTeam']['name'],
                'emblem' => $match['homeTeam']['crest'],
                'goals' => $match['score']['fullTime']['home'] ?? 0,
            ],
            'awayTeam' => [
                'name' => $match['awayTeam']['name'],
                'emblem' => $match['awayTeam']['crest'],
                'goals' => $match['score']['fullTime']['away'] ?? 0,
            ],
            'info' => [
                'venue' => $match['venue'] ?? 'Local não informado',
                'status' => $match['status'],
                'date' => $match['utcDate'],
            ],
        ], $matches);
    }

    public function paginate(array $items)
    {
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $this->perPage;
        $data = array_slice($items, $offset, $this->perPage);

        return [
            'data' => $data,
            'total' => count($items),
            'per_page' => $this->perPage,
            'current_page' => $page,
            'last_page' => ceil(count($items) / $this->perPage),
        ];
    }
}
