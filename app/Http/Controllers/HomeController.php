<?php

namespace App\Http\Controllers;


use App\Models\Certificado;

class HomeController extends Controller
{
    public function index()
    {

        return view('site.dashboard');
    }

    public function confirma($id)
    {
        $certificado = Certificado::findOrFail($id);

        return view('site.certificado_confirma', [
            'certificado' => $certificado
        ]);
    }

}
