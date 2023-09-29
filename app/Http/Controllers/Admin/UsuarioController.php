<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificado;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function index(): View
    {
        $usuarios = Usuario::where('role', "ROLE_USUARIO")
            ->orWhere('role', "ROLE_ADMIN")
            ->paginate(config('app.paginate'));

        return view('admin.usuarios.index', [
            'usuarios' => $usuarios
        ]);
    }

    public function show($id): View
    {
        $usuario = Usuario::where('role', "ROLE_USUARIO")
            ->orWhere('role', "ROLE_ADMIN")
            ->where('id', $id)
            ->first();

        $certificados = Certificado::where('usuario_id', $usuario->id)
            ->get();

        return view('admin.usuarios.show', [
            'usuario' => $usuario,
            'certificados' => $certificados,
        ]);
    }

    public function create(): View
    {

        return view('admin.usuarios.create');
    }

    public function store(Request $request): RedirectResponse
    {

        $usuario = [];

        return redirect()
            ->route('admin.usuarios.edit', ['id'=>$usuario->id])
            ->with('message', 'Usuário inserido com sucesso.');
    }

    public function edit($id): View
    {
        $usuario = Usuario::where('role', "ROLE_USUARIO")
            ->orWhere('role', "ROLE_ADMIN")
            ->where('id', $id)
            ->first();

        return view('admin.usuarios.edit', [
            'usuario' => $usuario
        ]);
    }

    public function update(Request $request): RedirectResponse
    {

        $usuario = [];

        return redirect()
            ->route('admin.usuarios.edit', ['id'=>$usuario->id])
            ->with('message', 'Usuário inserido com sucesso.');
    }

    public function delete($id): View
    {
        $usuario = Usuario::where('role', "ROLE_USUARIO")
            ->orWhere('role', "ROLE_ADMIN")
            ->where('id', $id)
            ->first();

        return view('admin.usuarios.delete', [
            'usuario' => $usuario
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $usuario = Usuario::where('role', "ROLE_USUARIO")
            ->orWhere('role', "ROLE_ADMIN")
            ->where('id', $id)
            ->first();

        if ($usuario){
            $usuario->delete();

            return redirect()
                ->route('admin.usuarios.index')
                ->with('message', 'Usuário excluído com sucesso.');
        }

        $usuario->delete();

        return back()->with('message_fail', 'O Usuário não pode ser excluído.');

    }



}
