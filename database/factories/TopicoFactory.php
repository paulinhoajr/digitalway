<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TopicoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'treinamento_id' => rand(1, 30),
            'topico' => fake()->address
        ];
    }

}
