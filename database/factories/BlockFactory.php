<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Block>
 */
class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = ['a1', 'a2','a3', 'a4', 'a5', 'b1', 'b2', 'b3', 'b4', 'b5'];
        return [
            'name' => fake()->randomElement($names),
        ];
    }
}
