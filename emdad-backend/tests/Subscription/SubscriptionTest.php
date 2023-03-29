<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    /**
     * @test
     */
    public function test_subscribtion_paymnet_added()
    {
        $response = $this->call('get', '/api/v1_0/subscriptions/subscriptionPayment', [
            "subscription_id" => 1,
            "type" => 'Monthly',
        ]);
       
        $response->assertStatus(200);
    }

}
