<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TopicStoreRequest;
use App\Http\Requests\Admin\TopicUpdateRequest;
use App\Models\Topic;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class TopicController extends Controller
{
    public function index(): View
    {
        $topicos = Topic::all();

        return view('admin.topicos.index', [
            'topicos' => $topicos
        ]);
    }

    public function create(): View
    {

        return view('admin.topicos.create');
    }

    public function store(Request $request): RedirectResponse
    {
        try {

            DB::beginTransaction();

            $topico = new Topic();
            $topico->topico = $request->topico;
            $topico->save();

            DB::commit();

            return redirect()
                ->route('admin.topicos.edit', ['id'=>$topico->id])
                ->with('message', 'Tópico inserido com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message', 'Error: '. $e->getMessage());

        }

    }

    public function edit($id): View
    {
        $topico = Topic::where('id', $id)
            ->first();

        return view('admin.topicos.edit', [
            'topico' => $topico
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        try {

            DB::beginTransaction();

            $topico = Topic::where('id', $request->id)
                ->first();

            $topico->topico = $request->topico;
            $topico->save();

            DB::commit();

            return redirect()
                ->route('admin.topicos.edit', ['id'=>$topico->id])
                ->with('message', 'Topico alterado com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message', 'Error: '. $e->getMessage());

        }
    }

    public function delete($id): View
    {
        $topico = Topic::where('id', $id)
            ->first();

        return view('admin.topicos.delete', [
            'topico' => $topico
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $topico = Topic::where('id', $id)
            ->first();

        if ($topico){
            $topico->delete();

            return redirect()
                ->route('admin.topicos.index')
                ->with('message', 'Topico excluído com sucesso.');
        }

        return back()->with('message_fail', 'O Topico não pode ser excluído.');

    }

}
