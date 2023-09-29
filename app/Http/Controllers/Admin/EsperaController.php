<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Espera;
use Illuminate\View\View;

class EsperaController extends Controller
{
    public function index(): View
    {
        $esperas = Espera::paginate(config('app.paginate'));

        return view('admin.esperas.index', [
            'esperas' => $esperas
        ]);
    }



}
