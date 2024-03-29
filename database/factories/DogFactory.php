<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\CssSelector\Parser\Token;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dog>
 */
class DogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'raca' => fake()->name(),
            'name' => fake()->name(),

        ];
    }
}