<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Resources\MovieResource;
use App\Http\Requests\MovieFilterRequest;
use App\Http\Requests\MovieOrderRequest;
use App\Http\Requests\MovieStoreRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return MovieResource::collection(Movie::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MovieStoreRequest  $request
     * @return MovieResource
     */
    public function store(MovieStoreRequest $request): MovieResource
    {
        $created_movies = Movie::create($request->validated());
        $created_movies->actors()->attach($request['actors']);

        return new MovieResource($created_movies);
    }

    /**
     * Display the specified resource.
     *
     * @param Movie $movie
     * @return MovieResource
     */
    public function show(Movie $movie): MovieResource
    {
        return new MovieResource($movie);
    }

    /**
     * Display the specified listing of the resource.
     * @param MovieFilterRequest $request
     * @return AnonymousResourceCollection
     */
    public function filter(MovieFilterRequest $request): AnonymousResourceCollection
    {

        if($request->filled('actors')) {
            $movies = Movie::whereHas('actors', function ($query) use ($request) {
                $query->whereIn('id', $request->actors);
            })->get();
        }else {
            $movies = Movie::all();
        }

        if($request->filled('genre_id')) {
            $movies = $movies->where('genre_id', $request->genre_id)->all();
        }

        return MovieResource::collection($movies);
    }

    /**
     * Display the resource with order of the name
     *
     * @param MovieOrderRequest|null $dist
     * @return MovieResource
     */
    public function order(?MovieOrderRequest $request): AnonymousResourceCollection
    {
        $order = $request?->order;
        if (!$order) {
            $order = 'asc';
        }
        $orderedMovies = Movie::orderBy('name', $order)->get();

        return MovieResource::collection($orderedMovies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MovieStoreRequest $request
     * @param  Movie $movie
     * @return MovieResource
     */
    public function update(MovieStoreRequest $request, Movie $movie): MovieResource
    {
        $movie->update($request->validated());
        $movie->actors()->attach($request['actors']);

        return new MovieResource($movie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Movie $movie
     * @return Response
     */
    public function destroy(Movie $movie): Response
    {
        $movie->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
