<?php

namespace Tests\Feature;

use Tests\CreatesApplication;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use CreatesApplication;

    private const TEST_ORDER_STRING = 'asc';

    public function testOrder(): void
    {
        $response = $this->get(route('order'), [
            'order' => self::TEST_ORDER_STRING
        ]);

        $response->assertOk();
    }
}
