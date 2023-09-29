<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Escola;
use Illuminate\View\View;

class EscolaController extends Controller
{
    public function index(): View
    {
        $escolas = Escola::paginate(config('app.paginate'));

        return view('admin.escolas.index', [
            'escolas' => $escolas
        ]);
    }



}
