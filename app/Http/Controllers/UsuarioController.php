<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\Site\EsperaCreateRequest;
use App\Models\Espera;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'usuario' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
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
    }

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
