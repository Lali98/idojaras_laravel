<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// http://idojaras.test/api/v1/{...}

Route::get('/', [WeatherController::class, 'index']);

Route::get('/hello', function () {
    return response()->json(['message' => 'Hello, World!']);
});
