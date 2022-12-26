<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorTableSeeder extends Seeder
{
    private const ACTORS_AMOUNT = 5;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actor = Actor::factory()
            ->count(self::ACTORS_AMOUNT)
            ->create();
    }
}
