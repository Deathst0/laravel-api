<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\CreatesApplication;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use CreatesApplication;

    /**
     * Index feature test.
     *
     * @return void
     */
    public function testIndex(): void
    {
        $response = $this->get(route('movies'));

        $response->assertStatus(Response::HTTP_OK);
    }
}
