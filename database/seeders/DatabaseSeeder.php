<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
         //\App\Models\Usuario::factory(10)->create();

        $this->call([
            RegioesTableSeeder::class,
            EstadosTableSeeder::class,
            CidadesTableSeeder::class,
            UsuariosTableSeeder::class,
        ]);

    }
}
