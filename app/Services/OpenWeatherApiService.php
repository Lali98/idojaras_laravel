<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenWeatherApiService
{
    protected mixed $baseUrl;
    protected mixed $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.api.open_weather.base_url');
        $this->apiKey = config('services.api.open_weather.api_key');
    }

    /**
     * Retrieves the latitude and longitude of a given city using the OpenWeather API.
     *
     * @param string $city The name of the city to search for.
     * @param int|null $limit The maximum number of results to return. Default is 1.
     *
     * @return array|null An associative array containing the latitude and longitude if successful, or null if no results found.
     * The array will contain the following keys:
     * - 'lat': The latitude of the city.
     * - 'lon': The longitude of the city.
     */
    public function getLatAndLon(string $city, ?int $limit = 1): array|null
    {
        $response = Http::get("$this->baseUrl/geo/1.0/direct?q=$city&limit=$limit&appid=$this->apiKey");
        return $response[0]['lat'] && $response[0]['lon'] ? ['lat' => $response[0]['lat'], 'lon' => $response[0]['lon']] : null;
    }

    /**
     * Retrieves the current weather information for a given city using the OpenWeather API.
     *
     * @param string $city The name of the city to search for.
     * @param string|null $units The unit system to use for temperature values. Default is 'metric'.
     *
     * @return array|null An associative array containing the current weather information if successful, or null if no results found.
     * The array will contain the following keys:
     * - 'current_condition': The main weather condition (e.g., Clear, Clouds, Rain).
     * - 'current_condition_description': A detailed description of the weather condition.
     * - 'current_temperature': The current temperature.
     * - 'current_feels_like': The current temperature felt by humans.
     */
    public function getCurrentWeather(string $city, ?string $units = 'metric'): array|null
    {
        $latLon = $this->getLatAndLon($city);
        if ($latLon !== null) {
//            $response = Http::get("$this->baseUrl/data/2.5/weather?lat=$latLon->lat&lon=$latLon->lon&appid=$this->apiKey&units=$units");
            $response = Http::get("$this->baseUrl/data/2.5/weather", ['lat' => $latLon['lat'], 'lon' => $latLon['lon'], 'appid' => $this->apiKey, 'units' => $units]);
            if ($response != []) {
                return [
                    'current_condition' => $response['weather'][0]['main'],
                    'current_condition_description' => $response['weather'][0]['description'],
                    'current_temperature' => $response['main']['temp'],
                    'current_feels_like' => $response['main']['feels_like']
                ];
            }
            return null;
        }
        return null;
    }
}
