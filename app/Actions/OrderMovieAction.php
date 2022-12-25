<?php

namespace App\Actions;
use App\Http\Requests\MovieOrderRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderMovieAction
{
    public function execute(MovieOrderRequest $request): AnonymousResourceCollection
    {
        $order = $request->order ?? 'asc';

        $orderedMovies = Movie::orderBy('name', $order)->get();

        return MovieResource::collection($orderedMovies);
    }
}
