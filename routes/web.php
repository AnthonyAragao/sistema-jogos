<?php

use App\Http\Controllers\FootballController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/competitions', [FootballController::class, 'getCompetitions']);
Route::get('/competitions/{competitionId}/upcoming-matches', [FootballController::class, 'getUpcomingMatches']);
Route::get('/competitions/{competitionId}/last-matches', [FootballController::class, 'getLastMatches']);
Route::get('/teams', [FootballController::class, 'getTeams']);
Route::get('/teams/{teamId}', [FootballController::class, 'getTeam']);
Route::get('/teams/{teamId}/matches', [FootballController::class, 'getTeamMatches']);
Route::get('/teams/{teamId}/last-matches', [FootballController::class, 'getTeamLastMatches']);

