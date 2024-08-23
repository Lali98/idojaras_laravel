<?php

use App\Console\Commands\AddDBData;
use Illuminate\Support\Facades\Schedule;

//Artisan::command('inspire', function () {
//    $this->comment(Inspiring::quote());
//})->purpose('Display an inspiring quote')->hourly();

Schedule::command(AddDBData::class, ['Csökmő'])
    ->hourly()
    ->withoutOverlapping();
