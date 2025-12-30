<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonPredictController;

Route::post('/predict-pokemon', [PokemonPredictController::class, 'predict']);


