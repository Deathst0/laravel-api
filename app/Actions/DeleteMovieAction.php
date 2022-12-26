<?php

namespace App\Actions;

use App\Models\Movie;

class DeleteMovieAction
{
    public function execute(Movie $movie): void
    {
        $movie->actors()->detach();
        $movie->delete();
    }
}
