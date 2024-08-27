<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherController extends Controller
{

    /**
     * This function retrieves a paginated list of weather data.
     *
     * @return JsonResponse A JSON response containing the paginated weather data.
     */
    public function index(): JsonResponse
    {
        $weather = Weather::simplePaginate(30);
        return response()->json($weather);
    }
}
