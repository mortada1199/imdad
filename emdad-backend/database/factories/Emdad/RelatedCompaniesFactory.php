<?php

namespace Database\Factories\Emdad;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RelatedCompaniesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'cr_number' => $this->faker->numberBetween(1, 10),
            "cr_name" => $this->faker->unique()->name(),
            "business_type" => $this->faker->text(10),
            "relation" => $this->faker->text(10),
            "identity" => $this->faker->randomNumber(5, true),
            "identity_type" => "nid"
        ];
    }
}
