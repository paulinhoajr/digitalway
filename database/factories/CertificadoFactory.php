<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CertificadoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'usuario_id' => rand(3, 252),
            'treinamento_id' => rand(1, 30),
        ];
    }

}
