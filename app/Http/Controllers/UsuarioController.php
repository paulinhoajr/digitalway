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
use Barryvdh\DomPDF\Facade\Pdf;
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
        $usuario = Usuario::where('cpf', only_numbers($request->cpf))
            ->where('situacao', 1)
            ->first();

        if (!$usuario){
            return back()->with("message_alert", "CPF não encontrado.");
        }

        $total =  count($usuario->escolas);
        $i=1;
        foreach ($usuario->escolas as $escola){

            $treinamento = Treinamento::where('id', $request->id)
                ->where(function($query) use ($escola) {
                    $query->where('escola_id', $escola->id)
                        ->orWhereNull('escola_id');
                })
                ->first();

            if ($treinamento){
                break;
            }

            if( $total == $i ) {
                return back()->with("message_alert",
                    "Este treinamento não tem ligação com nenhuma escola em que você faça parte.");
            }

            $i++;
        }

        $certificado = Certificado::where('usuario_id', $usuario->id)
            ->where('treinamento_id', $request->id)
            ->first();

        if ($certificado){
            return back()->with("message_alert",
                "Você já liberou esse certificado.");
        }

        $certificado = new Certificado();
        $certificado->usuario_id = $usuario->id;
        $certificado->treinamento_id = $request->id;
        $certificado->save();

        return back()->with("message",
            "Certificado liberado com sucesso.");

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

    public function gerar($id)
    {
        $certificado = Certificado::where('id', $id)
            ->where('usuario_id', Auth::user()->id)
            ->first();

        $treinamento = Treinamento::where('id', $certificado->treinamento_id)->first();

        $topicos = [];
        foreach ($treinamento->topicos as $topico){
            $topicos[] = $topico->topico;
        }

        $instrutor = Usuario::where('id', $treinamento->usuario_id)->pluck('nome')->first();

        $link = route('site.usuarios.qrcode', ['id'=>$certificado->id]);

        $data = [
            'instrutor' => $instrutor,
            'usuario_nome' => $treinamento->usuario->nome,
            'usuario_cpf' => $treinamento->usuario->cpf,
            'treinamento_nome' => $treinamento->nome,
            'treinamento_topicos' => $topicos,
            'treinamento_descricao' => $treinamento->dscricao,
            'treinamento_carga_horaria' => $treinamento->carga_horaria,
            'treinamento_criado' => dateTimeUsParaBr($treinamento->created_at),
            'link' => $link,
        ];

        //return view('site.gerar', $data);

        $pdf =  PDF::loadView('site.gerar', $data)
            ->setOption('disable-external-links', false)
            ->setOption('enable-local-file-access', true)
            ->setPaper('a4', 'landscape')
            ->setOption('enable-internal-links' , true);

        $fileName =  "certificado_".$certificado->id .  '.pdf';

        $caminho = "downloads/" . $fileName;
        $pdf->save($caminho, 'public');

        return response()->download("storage/downloads/".$fileName)->deleteFileAfterSend(true);

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
