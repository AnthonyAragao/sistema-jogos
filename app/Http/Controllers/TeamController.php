<?php

namespace App\Http\Controllers;

use App\Http\Services\FootballService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeamController extends Controller
{
    public function __construct(
        private FootballService $footballService
    ){}


    public function getTeams(Request $request)
    {
        return Inertia::render('Teams/TeamsList', [
            'teams' => $this->footballService->getTeams()
        ]);
    }

    public function getTeam($teamId)
    {
        return Inertia::render('Teams/TeamDetails', [
            'team' => $this->footballService->getTeam($teamId)
        ]);
    }

    public function	getTeamMatches($teamId)
    {
        $matches = $this->footballService->getTeamMatches($teamId, 'SCHEDULED');

        return Inertia::render('Teams/TeamMatches', [
            'team' => $this->footballService->getTeam($teamId),
            'matches' => $this->footballService->paginate($this->footballService->formatMatches($matches))
        ]);
    }

    public function	getTeamLastMatches($teamId)
    {
        $matches = $this->footballService->getTeamMatches($teamId, 'FINISHED');

        return Inertia::render('Teams/TeamLastMatches', [
            'team' => $this->footballService->getTeam($teamId),
            'matches' => $this->footballService->paginate($this->footballService->formatMatchResults($matches))
        ]);
    }
}
