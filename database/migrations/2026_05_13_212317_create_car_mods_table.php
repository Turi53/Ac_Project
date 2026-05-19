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
        Schema::create('car_mods', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('slug')->unique()->nullable();
            $table->unsignedInteger('year_of_manufacture');
            $table->unsignedInteger('power');
            $table->unsignedInteger('torque');
            $table->decimal('zero_to_100', 4, 1);
            $table->unsignedInteger('weight');
            $table->unsignedInteger('top_speed');
            $table->foreignId('make_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_mods');
    }
};
