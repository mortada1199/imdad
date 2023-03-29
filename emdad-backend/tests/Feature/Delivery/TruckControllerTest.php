<?php

namespace Tests\Feature;

use App\Models\Accounts\Driver;
use App\Models\Accounts\Truck;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TruckControllerTest extends TestCase
{
    use WithFaker;

    public function test_createTruck () {
        $user = User::factory()->create();
        // $user->createToken('authtoken');
        // dd($user);
        // $response = $this->actingAs($user)->withHeaders(['Authorization' => "Bearer $token"])->post('/trucks', [

        $response = $this->actingAs($user)->post('/trucks', [
            'name' => $this->faker->name,
            'type' => $this->faker->type,
            'class' => $this->faker->class,
            'color' => $this->faker->color,
            'model' => $this->faker->model,
            'size' => $this->faker->size,
            'brand' => $this->faker->brand,
            'truck_id' => Truck::all()->random()->id,
            'image' => \Illuminate\Http\UploadedFile::fake()->image('avatar.jpg')
        ]);
        $response->assertRedirect();
    }
    public function test_showTruck () {
        $user = User::find(3);
        $response = $this->actingAs($user)->get('/trucks', [
            'id' => $this->faker->id
        ]);
        $response->assertRedirect();
    }
    public function test_updateTruck () {
        $user = User::find(3);
        $id = Truck::all()->random()->id;
        $response = $this->actingAs($user)->put('/trucks/{id}', [

            'name' => $this->faker->name,
            'type' => $this->faker->type,
            'class' => $this->faker->type,
            'color' => $this->faker->type,
            'model' => $this->faker->type,
            'size' => $this->faker->type,
            'brand' => $this->faker->type,
            'image' => \Illuminate\Http\UploadedFile::fake()->image('avatar.jpg')
        ]);
        $response->assertRedirect();
    }
    public function test_deleteTruck () {
        $user = User::find(3);
        $id = Truck::all()->random()->id;
        $response = $this->actingAs($user)->delete('/trucks/{id}', [
        ]);
        $response->assertRedirect();
    }
}

