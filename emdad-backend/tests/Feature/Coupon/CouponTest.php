<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use withFaker;
    /**
     *@test
     *
     */
    public function test_generate_coupon()
    {
        $this->withExceptionHandling();

        $this->call('post', '/api/v1_0/coupon/create', [
            'allowed' => 2,
            'stratDate' => now(),
            'endDate' => "2023-3-9 15:12:43",
            'value' => random_int(1, 10),
            'isPercentage' => random_int(0, 1),
            'code' => random_int(100000, 999999),
        ]);

        $this
            ->assertDatabaseCount('coupons', 4);
        // ->assertStatus(200);

    }
}
