<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UsuarioStoreRequest;
use App\Http\Requests\Admin\UsuarioUpdateRequest;
use App\Models\Certificado;
use App\Models\Usuario;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function store(UsuarioStoreRequest $request): RedirectResponse
    {
        try {

            DB::beginTransaction();

            $usuario = new Usuario();
            $usuario->nome = $request->nome;
            $usuario->cpf = only_numbers($request->cpf);
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->situacao = $request->situacao;
            $usuario->role = $request->role;
            $usuario->save();

            DB::commit();

            return redirect()
                ->route('admin.usuarios.edit', ['id'=>$usuario->id])
                ->with('message', 'Usuário inserido com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message', 'Error: '. $e->getMessage());

        }

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

    public function update(UsuarioUpdateRequest $request): RedirectResponse
    {

        try {

            DB::beginTransaction();

            $usuario = Usuario::where('role', "ROLE_USUARIO")
                ->orWhere('role', "ROLE_ADMIN")
                ->where('id', $request->id)
                ->first();

            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            if ($request->password != null) {
                $usuario->password = Hash::make($request->password);
            }
            $usuario->situacao = $request->situacao;
            $usuario->role = $request->role;
            $usuario->save();

            DB::commit();

            return redirect()
                ->route('admin.usuarios.edit', ['id'=>$usuario->id])
                ->with('message', 'Usuário alterado com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message', 'Error: '. $e->getMessage());

        }
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

        return back()->with('message_fail', 'O Usuário não pode ser excluído.');

    }



}
