<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreTableSeeder extends Seeder
{
    private const GENRE_AMOUNT = 7;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genre = Genre::factory()
            ->count(self::GENRE_AMOUNT)
            ->create();
    }
}
