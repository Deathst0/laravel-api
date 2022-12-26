<?php

namespace Tests\Feature;

use Tests\CreatesApplication;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use CreatesApplication;

    private const TEST_MOVIE_NAME = 'Test movie name';
    private const TEST_GENRE_ID = 3;
    private const TEST_ACTOR_IDS = [1, 3];

    /**
     * Store unit test.
     *
     * @return void
     */
    public function testStore(): void
    {
        $data = [
            'name' => self::TEST_MOVIE_NAME,
            'genre_id' => self::TEST_GENRE_ID,
            'actors' => self::TEST_ACTOR_IDS,
        ];

        $response = $this->post(route('store'), $data);

        $this->assertDatabaseHas('movies', $data);

        $response->assertCreated();
    }
}
