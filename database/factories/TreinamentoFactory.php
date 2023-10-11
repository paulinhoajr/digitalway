<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TreinamentoFactory extends Factory
{
    public function definition(): array
    {
        $var = rand(4607, 5103);
        if ($var > 5050) $var = null;
        $rand = rand(null, 30);

        return [
            'cidade_id' => $var,
            'escola_id' => $rand==0?null:$rand,
            'usuario_id' => rand(3, 252),
            'nome' => fake()->name(),
            'descricao' => fake()->text(),
            'carga_horaria' => rand(1, 6),
            'situacao' => rand(0, 1),
        ];
    }

}
