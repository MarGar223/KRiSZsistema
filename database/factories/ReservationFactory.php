<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'zone_id' => ,
            'role' => 'Tester',
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '123', // password
            'level' => 'Personal',
            'remember_token' => Str::random(10),
        ];
    }
}
