<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('weather', function (Blueprint $table) {
            $table->string('city')->default('Csökmő');
            $table->decimal('wind_speed')->default(0.00);
            $table->decimal('wind_deg')->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weather', function (Blueprint $table) {
            $table->dropColumn(['city', 'wind_speed', 'wind_deg']);
        });
    }
};
