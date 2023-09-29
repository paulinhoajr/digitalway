<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            RegioesTableSeeder::class,
            EstadosTableSeeder::class,
            CidadesTableSeeder::class,
            UsuariosTableSeeder::class,
        ]);

        \App\Models\Escola::factory(30)->create();
        \App\Models\Espera::factory(30)->create();
        \App\Models\Usuario::factory(250)->create();
        \App\Models\Treinamento::factory(20)->create();
        \App\Models\Certificado::factory(250)->create();
        \App\Models\UsuariosEscolas::factory(700)->create();

    }
}
