<?php

namespace App\Http\Controllers;

use App\Actions\FilterMovieAction;
use App\Actions\OrderMovieAction;
use App\Actions\StoreMovieAction;
use App\Actions\UpdateMovieAction;
use App\Models\Movie;
use App\Http\Resources\MovieResource;
use App\Http\Requests\MovieFilterRequest;
use App\Http\Requests\MovieOrderRequest;
use App\Http\Requests\MovieStoreRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MovieController extends Controller
{
    private StoreMovieAction $storeAction;
    private UpdateMovieAction $updateAction;
    private FilterMovieAction $filterAction;
    private OrderMovieAction $orderAction;

    public function __construct(StoreMovieAction $storeAction, UpdateMovieAction $updateAction, FilterMovieAction $filterAction, OrderMovieAction $orderAction)
    {
        $this->storeAction = $storeAction;
        $this->updateAction = $updateAction;
        $this->filterAction = $filterAction;
        $this->orderAction = $orderAction;
    }

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
     * @param MovieStoreRequest $request
     * @return MovieResource
     */
    public function store(MovieStoreRequest $request): MovieResource
    {
        return $this->storeAction->execute($request);
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
     * Update the specified resource in storage.
     *
     * @param MovieStoreRequest $request
     * @param Movie $movie
     * @return MovieResource
     */
    public function update(MovieStoreRequest $request, Movie $movie): MovieResource
    {
        return $this->updateAction->execute($request, $movie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Movie $movie
     * @return Response
     */
    public function destroy(Movie $movie): Response
    {
        $movie->delete();

        return response('deleted succeeded', Response::HTTP_NO_CONTENT);
    }

    /**
     * Display the specified listing of the resource.
     * @param MovieFilterRequest $request
     * @return AnonymousResourceCollection
     */
    public function filter(MovieFilterRequest $request): AnonymousResourceCollection
    {
        return $this->filterAction->execute($request);
    }

    /**
     * Display the resource with order of the name
     *
     * @param MovieOrderRequest $request
     * @return AnonymousResourceCollection
     */
    public function order(MovieOrderRequest $request): AnonymousResourceCollection
    {
        return $this->orderAction->execute($request);
    }
}
