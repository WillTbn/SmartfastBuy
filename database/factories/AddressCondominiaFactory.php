<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AddressCondominia>
 */
class AddressCondominiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'road' => fake()->streetName(),
            'number' => fake()->buildingNumber(),
            'state' => fake()->state(),
            'district' => fake()->address(),
            'zip_code' => fake()->postcode(),
            'city' => fake()->city(),
        ];
    }
}
