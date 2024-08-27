<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $fillable =[
        'condition',
        'condition_description',
        'temperature',
        'feels_like',
        'city',
        'wind_speed',
        'wind_deg'
    ];
}
