<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use CreatesApplication;

    /**
     * Index feature test.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/api/movies/');

        $response->assertStatus(200);
    }
    /**
     * Store unit test.
     *
     * @return void
     */
    public function testStore()
    {
        $testName = 'Test movie name';
        $testGenre = 3;
        $testActors = [1, 3];

        $response = $this->post('/api/movies/', [
            'name' => $testName,
            'genre_id' => $testGenre,
            'actors' => $testActors
        ]);

        $response->assertCreated();
    }

    public function testShow()
    {
        $testMovieId = 1;

        $response = $this->get('api/movies/' . $testMovieId);

        $response->assertOk();
    }

    public function testUpdate()
    {
        $updatingMovieId = 2;
        $testName = 'Test movie name';
        $testGenre = 3;
        $testActors = [1, 3];

        $response = $this->post('api/movies/' . $updatingMovieId, [
            '_method' => 'PUT',
            'name' => $testName,
            'genre_id' => $testGenre,
            'actors' => $testActors
        ]);

        $response->assertOk();
    }

    public function testDestroy()
    {
        $deletingMovieId = 3;

        $response = $this->post('api/movies/' . $deletingMovieId, [
            '_method' => 'DELETE'
        ]);

        $response->assertNoContent();
    }

    public function testFilter()
    {
        $testGenre = 2;
        $testActors = [4, 1];

        $response = $this->get('/api/filtered_movies', [
            'genre_id' => $testGenre,
            'actors' => $testActors
        ]);

        $response->assertOk();
    }

    public function testOrder()
    {
        $testOrder = 'asc';

        $response = $this->get('/api/ordered_movies', [
            'order' => $testOrder
        ]);

        $response->assertOk();
    }
}
