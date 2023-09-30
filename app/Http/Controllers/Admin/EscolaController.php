<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EscolaStoreRequest;
use App\Http\Requests\Admin\EscolaUpdateRequest;
use App\Models\Escola;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function create(): View
    {

        return view('admin.escolas.create');
    }

    public function store(EscolaStoreRequest $request): RedirectResponse
    {
        try {

            DB::beginTransaction();

            $escola = new Escola();
            $escola->nome = $request->nome;
            $escola->cidade_id = $request->cidade_id;
            $escola->tipo = $request->tipo;
            $escola->save();

            DB::commit();

            return redirect()
                ->route('admin.escolas.edit', ['id'=>$escola->id])
                ->with('message', 'Escola inserida com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message', 'Error: '. $e->getMessage());

        }

    }

    public function edit($id): View
    {
        $escola = Escola::where('id', $id)
            ->first();

        return view('admin.escolas.edit', [
            'escola' => $escola
        ]);
    }

    public function update(EscolaUpdateRequest $request): RedirectResponse
    {
        try {

            DB::beginTransaction();

            $escola = Escola::where('id', $request->id)
                ->first();

            $escola->nome = $request->nome;
            $escola->cidade_id = $request->cidade_id;
            $escola->tipo = $request->tipo;
            $escola->save();

            DB::commit();

            return redirect()
                ->route('admin.escolas.edit', ['id'=>$escola->id])
                ->with('message', 'Escola alterada com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message', 'Error: '. $e->getMessage());

        }
    }

    public function delete($id): View
    {
        $escola = Escola::where('id', $id)
            ->first();

        return view('admin.escolas.delete', [
            'escola' => $escola
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $escola = Escola::where('id', $id)
            ->first();

        if ($escola){
            $escola->delete();

            return redirect()
                ->route('admin.escolas.index')
                ->with('message', 'Escola excluída com sucesso.');
        }

        return back()->with('message_fail', 'A Escola não pode ser excluída.');

    }


}
