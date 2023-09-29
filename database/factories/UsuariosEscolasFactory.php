<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UsuariosEscolasFactory extends Factory
{
    public function definition(): array
    {
        return [
            'usuario_id' => rand(3, 252),
            'escola_id' => rand(1, 30),
        ];
    }

}
