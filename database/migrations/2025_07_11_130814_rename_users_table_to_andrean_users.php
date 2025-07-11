<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::rename('users', 'andrean_users');
    }
    public function down(): void
    {
        Schema::rename('andrean_users', 'users');
    }
};
