<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\Site\EsperaCreateRequest;
use App\Http\Requests\Site\UsuarioStoreRequest;
use App\Http\Requests\Site\UsuarioUpdateRequest;
use App\Models\Escola;
use App\Models\Espera;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function index()
    {

        return view('site.usuarios.index');
    }

    public function avancar()
    {

        return view('site.usuarios.avancar');
    }

    public function avancar_post(EsperaCreateRequest $request): RedirectResponse
    {
        $espera = Espera::where('cpf', only_numbers($request->cpf))->first();

        if (!$espera){
            return back()->with("message_alert", "CPF não encontrado.");
        }

        return redirect()->route('site.usuarios.create', [
            'id'=>$espera->id
        ]);
    }

    public function create($id)
    {
        $espera = Espera::where('id', $id)->first();

        return view('site.usuarios.create', [
            'espera'=>$espera
        ]);
    }

    public function store(UsuarioStoreRequest $request): RedirectResponse
    {
        $espera = Espera::where('id', $request->id)->first();

        if (!$espera){
            return redirect()->route('site.usuarios.avancar')
                ->with('message_alert', "Dados inválidos");
        }

        $usuario = new Usuario();
        $usuario->nome = $request->nome;
        $usuario->cpf = $espera->cpf;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->role = "ROLE_USUARIO";
        $usuario->situacao = 1;
        $usuario->save();

        Auth::loginUsingId($usuario->id);

        return redirect()->route('site.index')
            ->with('message', "Usuário cadastrado e ativado com sucesso.");
    }

    public function edit(): View
    {
        $usuario = Usuario::where('id', Auth::user()->id)
            ->first();

        return view('site.usuarios.edit', [
            'usuario' => $usuario,
        ]);
    }

    public function update(UsuarioUpdateRequest $request): RedirectResponse
    {
        $usuario = Usuario::where('id', Auth::user()->id)
            ->first();

        $usuario->nome = $request->nome;
        $usuario->email = $request->email;

        if ($request->password != null) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return back()->with('message', "Usuário atualizado com sucesso.");
    }

    /*public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }*/

    public function logout(): RedirectResponse
    {
        if(Auth::check())
        {
            Auth::logout();
            Session::flush();
            Session::regenerate();
        }

        return redirect()->route('login');
    }
}
