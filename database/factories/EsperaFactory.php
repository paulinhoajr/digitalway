<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EsperaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'escola_id' => rand(1, 30),
            'nome' => fake()->name(),
            'email' => fake()->email(),
            'cpf' => fake()->unique()->imei(),
        ];
    }
}
