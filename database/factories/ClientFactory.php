<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            /*             'name' => $this->faker->words($this->faker->numberBetween(1, 4), true),
            'identificacion' => $this->faker->numberBetween(100000, 9999999999),
            'email' => fake()->unique()->safeEmail(),
            'telefono' => '3' . $this->faker->randomElement(['0', '1']) . '00000000' + $this->faker->randomNumber(6, true),
            'empresa' => $this->faker->words(2, true),
            'nit' => $this->faker->numerify('############'), // Genera un NIT colombiano de 10 dígitos */

        ];
    }
}
