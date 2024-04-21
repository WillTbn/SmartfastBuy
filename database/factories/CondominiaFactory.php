<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Condominia>
 */
class CondominiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $names = ['Vivendas Curicica', 'Vivendas Teste', 'Rio 2', 'Barra Squad'];
        return [
            'name' => fake()->company(),
            'address_condominias_id' => null,
            'contract_condominias_id' => null,
        ];
    }
}
