<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificado;
use Illuminate\View\View;

class CertificadoController extends Controller
{
    public function index(): View
    {
        $certificados = Certificado::latest()->paginate(config('app.paginate'));

        return view('admin.certificados.index', [
            'certificados' => $certificados
        ]);
    }



}
