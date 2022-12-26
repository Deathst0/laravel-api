<?php

namespace App\Actions;

use App\Http\Requests\MovieFilterRequest;
use App\Http\Resources\MovieResource;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class FilterMovieAction
{
    public function execute(MovieFilterRequest $request): AnonymousResourceCollection
    {
        $movies = collect();

        if ($request->filled('actors')) {
            $movies = $this->getFilteredMoviesByActors($request->actors)->merge($movies);
        }

        if ($request->filled('genres')) {
            $movies = $this->getFilteredMoviesByGenres($request->genres)->merge($movies);
        }

        if ($movies->count() < 1) {
            $movies = Movie::all();
        }

        return MovieResource::collection($movies);
    }

    private function getFilteredMoviesByActors(array $requestActors): Collection
    {
        $actors = collect($requestActors);
        $actorsIds = $actors->each(fn ($actorName) => (Actor::firstWhere('name', $actorName))?->id);
        $actorsIds->filter(fn($id) => $id !== null);

        return Movie::whereHas('actors', fn ($query) => $query->whereIn('id', $actorsIds))->get();
    }

    private function getFilteredMoviesByGenres(array $requestGenres): Collection
    {
        $genres = collect($requestGenres);
        $genresIds = $genres->each(fn ($genreName) => (Genre::firstWhere('name', $genreName))?->id);
        $genresIds->filter(fn($id) => $id !== null);

        return $genresIds->map(fn($genreId) => Movie::where('genre_id', $genreId)->get())->flatten();
    }
}
