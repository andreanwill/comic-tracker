<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comic;
use App\Models\Genre;

class ComicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comic1 = Comic::create([
            'title' => 'One Piece',
            'description' => 'Petualangan Luffy mencari harta karun One Piece.',
            'cover_image' => null
        ]);

        $comic2 = Comic::create([
            'title' => 'Attack on Titan',
            'description' => 'Pertarungan manusia melawan para Titan.',
            'cover_image' => null
        ]);

        // Genre ID asumsi sudah dibuat dari GenreSeeder
        $action = Genre::where('name', 'Action')->first();
        $fantasy = Genre::where('name', 'Fantasy')->first();

        $comic1->genres()->attach([$action->id, $fantasy->id]);
        $comic2->genres()->attach([$action->id]);
    }
}
