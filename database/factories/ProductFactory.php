<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Condominia;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $namesType = ['Pilsen', 'Tinto', 'Vodka', 'Pilsen', 'Puro Malte'];
        return [
            'name' => fake()->name(),
            'value' => fake()->randomFloat(2, 0, 10),
            'sku' => 'IMPMAL473',
            'description' => 'Pilsen Puro malte',
            'category_id'=> Category::first()->id,
            'type'=> 'PuroMalte',
            'user_id' =>User::first()->id,
            'type' => fake()->randomElement($namesType),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
