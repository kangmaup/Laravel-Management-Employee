<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'user_id' => function() {
                return User::factory()->create()->id;
            },
            'position_id' => function(){
                return Position::factory()->create()->id;
            },
            'workplace' => function(){
                return Workplace::factory()->create()->id;
            }
        ];
    }
}
