<?php

namespace App\Console\Commands;

use App\Models\Weather;
use App\Services\OpenWeatherApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AddDBData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:setCurrentWeather {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected OpenWeatherApiService $openWeatherApi;

    public function __construct(OpenWeatherApiService $openWeatherApi)
    {
        parent::__construct();
        $this->openWeatherApi = $openWeatherApi;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Adding current weather data for the provided city to the database...');
        Log::info('Adding current weather data for the provided city to the database...');

        $city = $this->argument('city');
        $weatherData = $this->openWeatherApi->getCurrentWeather($city);

        if ($weatherData === null) {
            $this->error('City not found or API request failed.');
            Log::error('City not found or API request failed.');
            return;
        }

        Weather::create([
            'condition' => $weatherData['current_condition'],
            'condition_description' => $weatherData['current_condition_description'],
            'temperature' => $weatherData['current_temperature'],
            'feels_like' => $weatherData['current_feels_like'],
            'city' => $weatherData['current_city'],
            'wind_speed' => $weatherData['current_wind_speed'],
            'wind_deg' => $weatherData['current_wind_deg'],
        ]);

        $this->info('Current weather data for ' . $city . ' has been added to the database.');
        Log::info('Current weather data for ' . $city . ' has been added to the database.');
    }
}
