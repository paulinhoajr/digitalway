<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificado;
use App\Models\Usuario;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function index(): View
    {
        $usuarios = Usuario::where('role', "ROLE_USUARIO")
            ->paginate(config('app.paginate'));

        return view('admin.usuarios.index', [
            'usuarios' => $usuarios
        ]);
    }

    public function show($id): View
    {
        $usuario = Usuario::where('role', "ROLE_USUARIO")
            ->where('id', $id)
            ->first();

        $certificados = Certificado::where('usuario_id', $usuario->id)
            ->get();

        return view('admin.usuarios.show', [
            'usuario' => $usuario,
            'certificados' => $certificados,
        ]);
    }

    public function edit($id): View
    {
        $usuario = Usuario::where('role', "ROLE_USUARIO")
            ->where('id', $id)
            ->first();

        return view('admin.usuarios.edit', [
            'usuario' => $usuario
        ]);
    }

    public function delete($id): View
    {
        $usuario = Usuario::where('role', "ROLE_USUARIO")
            ->where('id', $id)
            ->first();

        return view('admin.usuarios.delete', [
            'usuario' => $usuario
        ]);
    }



}
