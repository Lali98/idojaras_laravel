<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// http://idojaras.test/api/v1/{...}

Route::get('/hello', function () {
    return response()->json(['message' => 'Hello, World!']);
});
