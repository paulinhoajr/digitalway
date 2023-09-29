<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use Illuminate\View\View;

class DocumentoController extends Controller
{
    public function index(): View
    {
        $documentos = Documento::paginate(config('app.paginate'));

        return view('admin.documentos.index', [
            'documentos' => $documentos
        ]);
    }



}
