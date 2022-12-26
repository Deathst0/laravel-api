<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieTableSeeder extends Seeder
{
    private const ACTOR_AMOUNT = 4;
    private const MOVIE_AMOUNT = 6;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movie = Movie::factory()
            ->count(self::MOVIE_AMOUNT)
            ->hasActors(self::ACTOR_AMOUNT)
            ->hasGenre()
            ->create();
    }
}
