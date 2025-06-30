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
        $action = Genre::where('name', 'Action')->first();
        $fantasy = Genre::where('name', 'Fantasy')->first();
        $adventure = Genre::where('name', 'Adventure')->first();
        $comedy = Genre::where('name', 'Comedy')->first();
        $drama = Genre::where('name', 'Drama')->first();

        $comics = [
            [
                'title' => 'One Piece',
                'description' => 'Petualangan Luffy mencari harta karun One Piece.',
                'genres' => [$action, $adventure]
            ],
            [
                'title' => 'Attack on Titan',
                'description' => 'Pertarungan manusia melawan para Titan.',
                'genres' => [$action, $drama]
            ],
            [
                'title' => 'Naruto',
                'description' => 'Perjalanan ninja muda bernama Naruto Uzumaki.',
                'genres' => [$action, $adventure]
            ],
            [
                'title' => 'Doraemon',
                'description' => 'Robot kucing dari masa depan membantu Nobita.',
                'genres' => [$comedy, $fantasy]
            ],
            [
                'title' => 'Dragon Ball',
                'description' => 'Petualangan Goku mencari bola naga.',
                'genres' => [$action, $adventure]
            ],
            [
                'title' => 'Detective Conan',
                'description' => 'Detektif cilik memecahkan berbagai kasus misteri.',
                'genres' => [$drama, $comedy]
            ],
            [
                'title' => 'My Hero Academia',
                'description' => 'Dunia di mana semua orang memiliki kekuatan super.',
                'genres' => [$action, $fantasy]
            ],
            [
                'title' => 'Fairy Tail',
                'description' => 'Petualangan guild penyihir Fairy Tail.',
                'genres' => [$fantasy, $adventure]
            ],
            [
                'title' => 'Haikyuu!!',
                'description' => 'Perjuangan tim voli SMA Karasuno.',
                'genres' => [$drama]
            ],
            [
                'title' => 'One Punch Man',
                'description' => 'Pahlawan super yang bisa mengalahkan musuh dengan satu pukulan.',
                'genres' => [$action, $comedy]
            ],
        ];

        foreach ($comics as $comicData) {
            $comic = \App\Models\Comic::create([
                'title' => $comicData['title'],
                'description' => $comicData['description'],
                'cover_image' => null
            ]);
            $genreIds = collect($comicData['genres'])->filter()->pluck('id')->toArray();
            if ($genreIds) {
                $comic->genres()->attach($genreIds);
            }
        }
    }
}
