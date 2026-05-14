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
        Schema::create('track_mods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('distance', 6, 1)->nullable();
            $table->unsignedInteger('number_of_pits')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_mods');
    }
};
