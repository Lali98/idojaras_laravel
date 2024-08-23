<?php

namespace App\Console\Commands;

use App\Models\Weather;
use App\Services\OpenWeatherApiService;
use Illuminate\Console\Command;

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

    protected OpenWeatherApiService $openWeather;

    public function __construct(OpenWeatherApiService $openWeather)
    {
        parent::__construct();
        $this->openWeather = $openWeather;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $city = $this->argument('city');
        $weatherData = $this->openWeather->getCurrentWeather($city);
        Weather::create([
            'condition' => $weatherData['current_condition'],
            'condition_description' => $weatherData['current_condition_description'],
            'temperature' => $weatherData['current_temperature'],
            'feels_like' => $weatherData['current_feels_like']
        ]);
        $this->info('Current weather data for ' . $city . ' has been added to the database.');
    }
}
