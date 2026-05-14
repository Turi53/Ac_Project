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
        Schema::create('mods', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('download_link');
            $table->boolean('is_premium')->default(false);
            $table->unsignedInteger('download_count')->default(0);
            $table->enum('link_status', ['active', 'broken', 'unchecked'])->default('unchecked');
            $table->enum('status', ['published', 'unpublished', 'draft'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('author_id')->constrained();
            $table->morphs('modable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mods');
    }
};
