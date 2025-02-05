<?php

use App\Http\Controllers\FootballController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/football', [FootballController::class, 'teste']);
