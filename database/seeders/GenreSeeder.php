<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'Action', 'description' => 'Genre dengan banyak aksi dan pertarungan.'],
            ['name' => 'Fantasy', 'description' => 'Genre dengan dunia imajinasi dan sihir.'],
            ['name' => 'Romance', 'description' => 'Genre yang berfokus pada kisah cinta.'],
            ['name' => 'Comedy', 'description' => 'Genre yang mengutamakan humor dan kelucuan.'],
            ['name' => 'Horror', 'description' => 'Genre yang menegangkan dan menakutkan.'],
            ['name' => 'Adventure', 'description' => 'Genre dengan petualangan seru dan menantang.'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
