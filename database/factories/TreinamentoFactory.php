<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TreinamentoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cidade_id' => rand(4607, 5103),
            'escola_id' => rand(1, 30),
            'nome' => fake()->name(),
            'qrcode' => fake()->url(),
            'descricao' => fake()->text(),
            'tipo' => rand(0,1),
            'situacao' => rand(0,1),
        ];
    }

}
