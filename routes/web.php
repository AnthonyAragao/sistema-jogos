<?php

use App\Http\Controllers\{FootballController, TeamController};
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});


Route::get('/competitions', [FootballController::class, 'getCompetitions']);
Route::get('/competitions/{competitionId}/upcoming-matches', [FootballController::class, 'getUpcomingMatches']);
Route::get('/competitions/{competitionId}/last-matches', [FootballController::class, 'getLastMatches']);
Route::get('/teams', [TeamController::class, 'getTeams']);
Route::get('/teams/{teamId}', [TeamController::class, 'getTeam']);
Route::get('/teams/{teamId}/matches', [TeamController::class, 'getTeamMatches']);
Route::get('/teams/{teamId}/last-matches', [TeamController::class, 'getTeamLastMatches']);

