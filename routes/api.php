<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonPredictController;
use App\Http\Controllers\InputController;

Route::post('/inputs', [InputController::class, 'store']);
Route::post('/predict-pokemon', [PokemonPredictController::class, 'storeResult']);