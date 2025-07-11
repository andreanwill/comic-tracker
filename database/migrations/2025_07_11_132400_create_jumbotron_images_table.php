<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jumbotron_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->unsignedTinyInteger('order')->default(1);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('jumbotron_images');
    }
};
