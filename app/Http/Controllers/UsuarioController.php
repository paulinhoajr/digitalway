<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\Site\EsperaCreateRequest;
use App\Http\Requests\Site\QRCODERequest;
use App\Http\Requests\Site\UsuarioStoreRequest;
use App\Http\Requests\Site\UsuarioUpdateRequest;
use App\Models\Certificado;
use App\Models\Documento;
use App\Models\Escola;
use App\Models\Espera;
use App\Models\Treinamento;
use App\Models\Usuario;
use App\Models\UsuariosEscolas;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function qrcode($id)
    {
        $treinamento = Treinamento::where('id', $id)->first();

        if (!$treinamento){
            abort(404);
        }

        return view('site.qrcode',[
            'treinamento' => $treinamento
        ]);
    }

    public function qrcode_post(QRCODERequest $request): RedirectResponse
    {

        $usuario = Usuario::where('cpf', only_numbers($request->cpf))->first();
        if (!$usuario){
            return back()->with("message_alert", "CPF não encontrado.");
        }

        $total =  count($usuario->escolas);
        $i=1;
        foreach ($usuario->escolas as $escola){

            echo $escola->nome."<br>";

            $treinamento = Treinamento::where('id', $request->id)
                ->where('escola_id', $escola->id)
                ->first();

            if ($treinamento){
                echo " - " .$treinamento->nome."<br>";
                continue;
            }

            if( $total == $i ) {
                dd('não encontrado.');
            }

            $i++;
        }

        dd('treinamento para escola encontrado.');

        /*return redirect()->route('site.usuarios.create', [
            'id'=>$espera->id
        ]);*/
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

        try {
            DB::beginTransaction();

            $usuario = new Usuario();
            $usuario->nome = $request->nome;
            $usuario->cpf = $espera->cpf;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->role = "ROLE_USUARIO";
            $usuario->situacao = 1;
            $usuario->save();

            $escola = new UsuariosEscolas();
            $escola->usuario_id = $usuario->id;
            $escola->escola_id = $espera->escola_id;
            $escola->save();

            $espera->delete();

            DB::commit();

            Auth::loginUsingId($usuario->id);

            return redirect()->route('site.index')
                ->with('message', "Usuário cadastrado e ativado com sucesso.");

        }catch (\Exception $e){
            DB::rollBack();

            return redirect()->route('site.usuarios.avancar')
                ->with('message_fail', "Houve um erro.");
        }

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

    public function certificados()
    {
        $certificados = Certificado::where('usuario_id', Auth::user()->id)
            ->paginate(20);

        return view('site.certificados', [
            'certificados' => $certificados
        ]);
    }

    public function escolas()
    {
        $usuario = Usuario::where('id', Auth::user()->id)
            ->first();

        return view('site.escolas', [
            'escolas' => $usuario->escolas
        ]);
    }

    public function videos()
    {
        $videos = Video::whereNull('cidade_id')
            ->whereNull('escola_id')
            ->paginate(20);

        return view('site.videos', [
            'videos' => $videos
        ]);
    }

    public function documentos()
    {
        $documentos = Documento::whereNull('cidade_id')
            ->whereNull('escola_id')
            ->paginate(20);

        return view('site.documentos', [
            'documentos' => $documentos
        ]);
    }
}
