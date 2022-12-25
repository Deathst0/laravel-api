<?php

namespace App\Actions;

use App\Http\Requests\MovieStoreRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;

class StoreMovieAction
{
    public function execute(MovieStoreRequest $request): MovieResource
    {
        $created_movie = Movie::create($request->validated());

        if ($request->filled('actors')) {
            $created_movie->actors()->attach($request->actors);
        }

        return new MovieResource($created_movie);
    }
}
