<?php

namespace App\Http\Controllers;


use App\Models\Certificado;

class HomeController extends Controller
{
    public function index()
    {

        return view('site.dashboard');
    }

    public function teste()
    {

        $url = "https://rdap.registro.br/domain/epifer.net.br";

        $curl = curl_init();

        curl_setopt_array($curl, [

            CURLOPT_URL => $url
        ]);
        $resp = curl_exec($curl);

        curl_close($curl);

        dd($resp);
    }

    public function confirma($id)
    {
        $certificado = Certificado::findOrFail($id);

        return view('site.certificado_confirma', [
            'certificado' => $certificado
        ]);
    }

}
