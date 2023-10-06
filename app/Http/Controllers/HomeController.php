<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Models\Documento;
use App\Models\UsuariosEscolas;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        return view('site.dashboard');
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
        $escolas = UsuariosEscolas::with('escolas')->where('usuario_id', Auth::user()->id)
            ->get();

        dd($escolas);

        return view('site.escolas');
    }
}
