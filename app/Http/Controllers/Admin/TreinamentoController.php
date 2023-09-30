<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EscolaStoreRequest;
use App\Http\Requests\Admin\EscolaUpdateRequest;
use App\Http\Requests\Admin\TreinamentoStoreRequest;
use App\Http\Requests\Admin\TreinamentoUpdateRequest;
use App\Models\Certificado;
use App\Models\Escola;
use App\Models\Treinamento;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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

    public function create(): View
    {

        return view('admin.treinamentos.create');
    }

    public function store(TreinamentoStoreRequest $request): RedirectResponse
    {
        try {

            DB::beginTransaction();

            $treinamento = new Treinamento();
            $treinamento->nome = $request->nome;
            $treinamento->cidade_id = $request->cidade_id ?? null;
            $treinamento->escola_id = $request->escola_id ?? null;
            $treinamento->descricao = $request->descricao;
            $treinamento->save();

            DB::commit();

            return redirect()
                ->route('admin.treinamentos.edit', ['id'=>$treinamento->id])
                ->with('message', 'Treinamento inserido com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message', 'Error: '. $e->getMessage());

        }

    }

    public function edit($id): View
    {
        $treinamento = Treinamento::where('id', $id)
            ->first();

        return view('admin.treinamentos.edit', [
            'treinamento' => $treinamento
        ]);
    }

    public function update(TreinamentoUpdateRequest $request): RedirectResponse
    {
        try {

            DB::beginTransaction();

            $treinamento = Treinamento::where('id', $request->id)
                ->first();

            $treinamento->nome = $request->nome;
            $treinamento->cidade_id = $request->cidade_id ?? null;
            $treinamento->escola_id = $request->escola_id ?? null;
            $treinamento->descricao = $request->descricao;
            $treinamento->save();

            DB::commit();

            return redirect()
                ->route('admin.treinamentos.edit', ['id'=>$treinamento->id])
                ->with('message', 'Treinamento alterado com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message', 'Error: '. $e->getMessage());

        }
    }

    public function delete($id): View
    {
        $treinamento = Treinamento::where('id', $id)
            ->first();

        $certificado = Certificado::where('treinamento_id', $treinamento->id)
            ->first();

        if ($certificado){
            Session::now('message_alert', 'O Treinamento não pode ser excluído pois tem certificados ligados.');
        }

        return view('admin.treinamentos.delete', [
            'treinamento' => $treinamento
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $treinamento = Treinamento::where('id', $id)
            ->first();

        $certificado = Certificado::where('treinamento_id', $treinamento->id)
            ->first();

        if ($certificado){
            return back()->with('message_alerta', 'O Treinamento não pode ser excluído pois tem certificados ligados.');
        }

        if ($treinamento){
            $treinamento->delete();

            return redirect()
                ->route('admin.treinamentos.index')
                ->with('message', 'Treinamento excluído com sucesso.');
        }

        return back()->with('message_fail', 'O Treinamento não pode ser excluído.');

    }

}
