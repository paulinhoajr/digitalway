<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Treinamento;
use Illuminate\View\View;

class TreinamentoController extends Controller
{
    public function index(): View
    {
        $treinamentos = Treinamento::paginate(config('app.paginate'));

        return view('admin.treinamentos.index', [
            'treinamentos' => $treinamentos
        ]);
    }



}
