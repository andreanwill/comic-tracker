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
        Schema::create('andrean_comic_genres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comic_id')->constrained('andrean_comics')->onDelete('cascade');
            $table->foreignId('genre_id')->constrained('andrean_genres')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('andrean_comic_genres');
    }
};
