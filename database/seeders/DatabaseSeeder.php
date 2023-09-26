<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Usuario::factory(10)->create();

        // \App\Models\Usuario::factory()->create([
        //     'name' => 'Test Usuario',
        //     'email' => 'test@example.com',
        // ]);

        $usuario = new Usuario();
        $usuario->nome = "Paulo Rodrigues";
        $usuario->email = "paulo@voope.com.br";
        $usuario->password = Hash::make('p4p4l3gu45');
        $usuario->role = "ROLE_ADMIN";
        $usuario->situacao = 1;
        $usuario->save();
    }
}
