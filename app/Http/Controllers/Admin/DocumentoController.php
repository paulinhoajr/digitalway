<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentoStoreRequest;
use App\Http\Requests\Admin\DocumentoUpdateRequest;
use App\Models\Documento;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DocumentoController extends Controller
{
    public function index(): View
    {
        $documentos = Documento::latest()->paginate(config('app.paginate'));

        return view('admin.documentos.index', [
            'documentos' => $documentos
        ]);
    }

    public function create(): View
    {

        return view('admin.documentos.create');
    }

    public function store(DocumentoStoreRequest $request): RedirectResponse
    {
        try {

            DB::beginTransaction();

            $documento = new Documento();
            $documento->nome = $request->nome;
            $documento->cidade_id = $request->cidade_id;
            $documento->escola_id = $request->escola_id ?? null;
            $documento->descricao = $request->descricao;
            $documento->situacao = $request->situacao;

            $logo_nome = null;
            if ($request->hasFile('pdf')) {
                $file = $request->file('pdf');
                $ext = strtolower($file->getClientOriginalExtension());
                $filename = uniqid();
                $logo_nome = $filename . '.' . $ext;
                $file_name = "/$logo_nome";
                Storage::disk('public')->put("documentos/".$file_name, File::get($file));
            }

            $documento->pdf = $logo_nome;

            $documento->save();

            DB::commit();

            return redirect()
                ->route('admin.documentos.edit', ['id'=>$documento->id])
                ->with('message', 'Documento inserido com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message', 'Error: '. $e->getMessage());

        }

    }

    public function edit($id): View
    {
        $documento = Documento::where('id', $id)
            ->first();

        return view('admin.documentos.edit', [
            'documento' => $documento
        ]);
    }

    public function update(DocumentoUpdateRequest $request): RedirectResponse
    {
        try {

            DB::beginTransaction();

            $documento = Documento::where('id', $request->id)
                ->first();

            $documento->nome = $request->nome;
            $documento->cidade_id = $request->cidade_id;
            $documento->escola_id = $request->escola_id ?? null;
            $documento->descricao = $request->descricao;
            $documento->situacao = $request->situacao;

            $logo_nome = $documento->pdf;

            if ($request->hasFile('pdf')) {
                $file = $request->file('pdf');
                $ext = strtolower($file->getClientOriginalExtension());
                $filename = uniqid();
                $logo_nome = $filename . '.' . $ext;
                $file_name = "/$logo_nome";
                Storage::disk('public')->put("documentos/".$file_name, File::get($file));

                if (Storage::disk('public')->exists("documentos/" . $documento->pdf)) {
                    Storage::disk('public')->delete("documentos/" . $documento->pdf);
                }
            }

            $documento->pdf = $logo_nome;

            $documento->save();

            DB::commit();

            return redirect()
                ->route('admin.documentos.edit', ['id'=>$documento->id])
                ->with('message', 'Documento alterado com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message', 'Error: '. $e->getMessage());

        }
    }

    public function delete($id): View
    {
        $documento = Documento::where('id', $id)
            ->first();

        return view('admin.documentos.delete', [
            'documento' => $documento
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $documento = Documento::where('id', $id)
            ->first();

        if ($documento){

            if (Storage::disk('public')->exists("documentos/" . $documento->pdf)) {
                Storage::disk('public')->delete("documentos/" . $documento->pdf);
            }

            $documento->delete();

            return redirect()
                ->route('admin.documentos.index')
                ->with('message', 'Documento excluído com sucesso.');
        }

        return back()->with('message_fail', 'O Documento não pode ser excluído.');

    }


}
