<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'created_by'=>'',
            'name_ar'=>fake()->name(),
            'name_en'=>fake()->name(),
            'swift'=>fake()->swiftBicNumber(),
            'iban'=>fake()->iban(),
            'type'=>fake()->randomElement(['Buyer','Supplier']),
            'bank'=>fake()->name(),
            'vat_number'=>15,
            'cr_number'=>fake()->cr,
            'cr_expire_data'=>fake()->dateTime('2030-1-1'),
            'subs_id',
            'subscription_details',
            'active'=>true,
        ];
    }
}
