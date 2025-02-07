<?php

namespace App\Http\Controllers;

use App\Http\Services\FootballService;
use Inertia\Inertia;

class FootballController extends Controller
{
    public function __construct(
        private FootballService $footballService,
    ){}

    public function getCompetitions()
    {
        return Inertia::render('Competitions/CompetitionsList', [
            'competitions' => $this->footballService->getCompetitions()
        ]);
    }

    public function getUpcomingMatches($competitionId)
    {
        $matches = $this->footballService->getMatchesByStatus($competitionId, 'SCHEDULED');

        return Inertia::render('Competitions/Matches', [
            'competition' => $this->footballService->extractCompetitionInfo($matches),
            'matches' =>  $this->footballService->paginate($this->footballService->formatMatches($matches))
        ]);
    }

    public function getLastMatches($competitionId)
    {
        $matches = $this->footballService->getMatchesByStatus($competitionId, 'FINISHED');

        return Inertia::render('Competitions/Matches', [
            'competition' => $this->footballService->extractCompetitionInfo($matches),
            'matches' => $this->footballService->paginate($this->footballService->formatMatchResults($matches)),
            'lastMatches' => true
        ]);
    }
}
