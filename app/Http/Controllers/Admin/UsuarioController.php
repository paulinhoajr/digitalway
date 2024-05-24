<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentoStoreRequest;
use App\Http\Requests\Admin\UsuarioEscolaRequest;
use App\Http\Requests\Admin\UsuarioStoreRequest;
use App\Http\Requests\Admin\UsuarioUpdateRequest;
use App\Models\Certificado;
use App\Models\Documento;
use App\Models\Usuario;
use App\Models\UsuariosEscolas;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function index(): View
    {
        $usuarios = Usuario::where('role', "!=","ROLE_SUPERADMIN")
            ->latest()
            ->paginate(config('app.paginate'));

        return view('admin.usuarios.index', [
            'usuarios' => $usuarios
        ]);
    }

    public function login($id)
    {
        /*if(getRole('super-admin')){*/
        Auth::logout();
        Auth::loginUsingId($id);
        return redirect('/')->with('message', 'Voce entrou como um professor!');
        /*}else{
            abort(403, 'Area restrita');
        }*/
    }

    public function show($id): View
    {
        $usuario = Usuario::where('role', "!=","ROLE_SUPERADMIN")
            ->where('id', $id)
            ->first();

        $certificados = Certificado::where('usuario_id', $usuario->id)
            ->get();

        //dd($usuario->escolas);

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

            $usuario = Usuario::where('cpf', only_numbers($request->cpf))
                ->where('role', 'ROLE_TEMP')
                ->where('situacao', 0)
                ->first();

            if ($usuario){
                $usuario->nome = $request->nome;
                $usuario->cpf = only_numbers($request->cpf);
                $usuario->email = $request->email;
                $usuario->password = Hash::make($request->password);
                $usuario->situacao = $request->situacao;
                $usuario->role = $request->role;
                $usuario->save();
            }else{
                $usuario = new Usuario();
                $usuario->nome = $request->nome;
                $usuario->cpf = only_numbers($request->cpf);
                $usuario->email = $request->email;
                $usuario->password = Hash::make($request->password);
                $usuario->situacao = $request->situacao;
                $usuario->role = $request->role;
                $usuario->save();
            }

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
        $usuario = Usuario::where('role', "!=","ROLE_SUPERADMIN")
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

            $usuario = Usuario::where('id', $request->id)
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
        $usuario = Usuario::where('role', "!=","ROLE_SUPERADMIN")
            ->where('id', $id)
            ->first();

        return view('admin.usuarios.delete', [
            'usuario' => $usuario
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $usuario = Usuario::where('role', "!=","ROLE_SUPERADMIN")
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

    public function escola(UsuarioEscolaRequest $request): RedirectResponse
    {
        try {

            $usuarioEscola = UsuariosEscolas::where('usuario_id', $request->usuario_id)
                ->where('escola_id', $request->escola_id)
                ->first();

            if ($usuarioEscola){
                return back()->with('message_alert', 'Error: Este usuário já esta incluído nesta escola.');
            }

            DB::beginTransaction();

            $escola = new UsuariosEscolas();
            $escola->usuario_id = $request->usuario_id;
            $escola->escola_id = $request->escola_id;
            $escola->save();

            DB::commit();

            return back()->with('message', 'Inserido com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message_fail', 'Error: '. $e->getMessage());

        }

    }

    public function escola_delete($escola_id, $usuario_id): RedirectResponse
    {
        $usuarioEscola = UsuariosEscolas::where('usuario_id', $usuario_id)
            ->where('escola_id', $escola_id)
            ->first();

        if ($usuarioEscola){
            $usuarioEscola->delete();

            return back()->with('message', 'Escola removido com sucesso.');
        }

        return back()->with('message_fail', 'Escola não pode ser removida.');

    }


}
