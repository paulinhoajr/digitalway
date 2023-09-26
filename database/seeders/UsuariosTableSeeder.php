<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosTableSeeder extends Seeder
{
    public function run(): void
    {
        $usuario = new Usuario();
        $usuario->nome = "Paulo Rodrigues";
        $usuario->email = "paulo@voope.com.br";
        $usuario->password = Hash::make('p4p4l3gu45');
        $usuario->role = "ROLE_ADMIN";
        $usuario->situacao = 1;
        $usuario->save();
    }
}
