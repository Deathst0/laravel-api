<?php

namespace Tests\Feature;

use Tests\CreatesApplication;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use CreatesApplication;

    private const TEST_MOVIE_ID = 2;
    private const TEST_MOVIE_NAME = 'Test movie name';
    private const TEST_GENRE_ID = 3;
    private const TEST_ACTOR_IDS = [1, 3];

    public function testUpdate(): void
    {

        $response = $this->put(route('update/' . self::TEST_MOVIE_ID), [
            'name' => self::TEST_MOVIE_NAME,
            'genre_id' => self::TEST_GENRE_ID,
            'actors' => self::TEST_ACTOR_IDS
        ]);

        $response->assertOk();
    }

}
