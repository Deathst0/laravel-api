<?php

namespace Tests\Feature;

use Tests\CreatesApplication;
use Tests\TestCase;

class FilterTest extends TestCase
{
    use CreatesApplication;

    private const TEST_GENRE_ID = 2;
    private const TEST_ACTOR_IDS = [4, 1];

    public function testFilter(): void
    {
        $response = $this->get(route('filter'), [
            'genre_id' => self::TEST_GENRE_ID,
            'actors' => self::TEST_ACTOR_IDS
        ]);

        $response->assertOk();
    }

}
