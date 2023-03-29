<?php

namespace Tests\Feature;

use App\Models\Accounts\Truck;
use App\Models\Accounts\Driver;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DriverControllerTest extends TestCase
{
    use WithFaker;

    public function test_createDriver () {
        $user = User::find(3);
        $response = $this->actingAs($user)->post('/drivers', [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'truck_id' => Truck::all()->random()->id,
            'driving_license' => \Illuminate\Http\UploadedFile::fake()->image('avatar.jpg')
        ]);
        $response->assertRedirect();
    }
    public function test_showDriver () {
        $user = User::find(3);
        $response = $this->actingAs($user)->get('/drivers', [
            'id' => $this->faker->id
        ]);
        $response->assertRedirect();
    }
    public function test_updateDriver () {
        $user = User::find(3);
        $id = Truck::all()->random()->id;
        $response = $this->actingAs($user)->put('/drivers/{id}', [

            'name_ar' => $this->faker->name_ar,
            'name_ar' => $this->faker->name_en,
            'age' => $this->faker->age,
            'nationality' => $this->faker->nationality,
            'phone' => $this->faker->phone,

        ]);
        $response->assertRedirect();
    }
    public function test_deleteDriver () {
        $user = User::find(3);
        $id = Truck::all()->random()->id;
        $response = $this->actingAs($user)->delete('/drivers/{id}', [
        ]);
        $response->assertRedirect();
    }
}

