<?php

namespace Database\Factories;

use App\Enums\RoleEnum;
use App\Models\Ability;
use App\Models\Role;
use App\Models\RoleAbility;
use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
            // 'role_id' => RoleEnum::Master
        ];
    }
    /**
     * Define the model's relationships.
     *
     * @return array
     */
    public function relationships()
    {
        return [
            'role_id' => function () {
                $role = Role::factory()
                    ->has(RoleAbility::factory())
                ->create(['name'=> RoleEnum::Master->name]);
                return $role;
            },
        ];
    }
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    public function configure(): static
    {
        return $this->afterMaking(function (User $user) {
            // ...
            if(!$user->role_id){
                $user->role_id = RoleEnum::Master;
            }
            // dd($user->role_id);
            // AbilityFactory::factory()->create();
        })->afterCreating(function (User $user) {

            // $role = fake(Role::class)->create(['name'=> RoleEnum::Master->name]);

        });
    }
}
