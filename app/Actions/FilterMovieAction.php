<?php

namespace App\Actions;

use App\Http\Requests\MovieFilterRequest;
use App\Http\Resources\MovieResource;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FilterMovieAction
{
    public function execute(MovieFilterRequest $request): AnonymousResourceCollection
    {
        $movies = Movie::all();

        if ($request->filled('actors')) {
            $actors = collect($request->actors);
            $actorsIds = $actors->each(fn ($actorName) => (Actor::firstWhere('name', $actorName))->id);

            $movies = Movie::whereHas('actors', fn ($query) => $query->whereIn('id', $actorsIds))->get();
        }

        if ($request->filled('genres')) {
            $genres = collect($request->genres);
            $genresIds = $genres->each(fn ($genreName) => (Genre::firstWhere('name', $genreName))->id);

            $movies = Movie::whereHas('genres', fn ($query) => $query->whereIn('id', $genresIds))->get();
        }

        return MovieResource::collection($movies);
    }
}
