<?php

namespace Tests\Feature;

use Tests\CreatesApplication;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use CreatesApplication;

    public function testDestroy(): void
    {
        $deletingMovieId = 3;

        $response = $this->delete(route('delete' . $deletingMovieId));

        $this->assertDatabaseMissing('movies', ['id' => $deletingMovieId]);
        $response->assertNoContent();
    }

}
