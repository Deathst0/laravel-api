<?php

namespace App\Actions;

use App\Http\Requests\MovieStoreRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;

class UpdateMovieAction
{
    public function execute(MovieStoreRequest $request, Movie $movie): MovieResource
    {
        $movie->update($request->validated());

        if ($request->filled('actors')) {
            $movie->actors()->attach($request->actors);
        }

        return new MovieResource($movie);
    }
}
