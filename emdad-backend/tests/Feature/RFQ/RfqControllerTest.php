<?php

namespace Tests\Feature\RFQ;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RfqControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateNewRfq()
    {
        
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
