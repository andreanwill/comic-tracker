<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Comic;
use App\Models\Genre;

class JikanComicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch top manga from Jikan API
        $response = Http::get('https://api.jikan.moe/v4/top/manga?limit=10');
        $mangaList = $response->json('data') ?? [];

        foreach ($mangaList as $manga) {
            $title = $manga['title'] ?? null;
            $description = $manga['synopsis'] ?? null;
            $cover = $manga['images']['jpg']['large_image_url'] ?? null;
            $genres = $manga['genres'] ?? [];

            if (!$title || !$cover) continue;

            // Insert comic
            $comic = Comic::create([
                'title' => $title,
                'description' => $description,
                'cover_image' => $cover,
            ]);

            // Attach genres
            $genreIds = [];
            foreach ($genres as $genreData) {
                $genre = Genre::firstOrCreate([
                    'name' => $genreData['name']
                ]);
                $genreIds[] = $genre->id;
            }
            if ($genreIds) {
                $comic->genres()->attach($genreIds);
            }
        }
    }
} 