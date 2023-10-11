<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EscolaStoreRequest;
use App\Http\Requests\Admin\EscolaUpdateRequest;
use App\Http\Requests\Admin\TreinamentoStoreRequest;
use App\Http\Requests\Admin\TreinamentoUpdateRequest;
use App\Models\Certificado;
use App\Models\Escola;
use App\Models\Topico;
use App\Models\Treinamento;
use App\Models\Usuario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class TreinamentoController extends Controller
{
    public function index(): View
    {
        $treinamentos = Treinamento::latest()->paginate(config('app.paginate'));

        return view('admin.treinamentos.index', [
            'treinamentos' => $treinamentos
        ]);
    }

    public function create(): View
    {
        $usuarios = Usuario::where('role', "!=","ROLE_SUPERADMIN")
            ->orderBy('nome')
            ->get();

        return view('admin.treinamentos.create', [
            'usuarios' => $usuarios
        ]);
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
            $treinamento->situacao = $request->situacao;
            $treinamento->save();

            if (isset($request->topicos)){

                foreach ($request->topicos as $key => $item){
                    $topico = new Topico();
                    $topico->treinamento_id = $treinamento->id;
                    $topico->topico = $item['topico'];
                    $topico->save();
                }

            }

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

        $usuarios = Usuario::where('role', "!=","ROLE_SUPERADMIN")
            ->orderBy('nome')
            ->get();

        return view('admin.treinamentos.edit', [
            'treinamento' => $treinamento,
            'usuarios' => $usuarios
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
            $treinamento->situacao = $request->situacao;
            $treinamento->save();

            if (isset($request->topicos)){

                foreach ($request->topicos as $key => $item){
                    $topico = new Topico();
                    $topico->treinamento_id = $treinamento->id;
                    $topico->topico = $item['topico'];
                    $topico->save();
                }

            }

            DB::commit();

            return redirect()
                ->route('admin.treinamentos.edit', ['id'=>$treinamento->id])
                ->with('message', 'Treinamento alterado com sucesso.');

        }catch (QueryException|\Exception $e){

            DB::rollBack();

            return back()->with('message', 'Error: '. $e->getMessage());

        }
    }

    public function topico_delete($id): RedirectResponse
    {
        $topico = Topico::where('id', $id)
            ->first();

        if ($topico->delete()){
            return back()->with("message", "Tópico removido.");
        }

        return back()->with("message_fail", "Houve um erro.");
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

    public function qrcode($id)
    {
        $treinamento = Treinamento::where('id', $id)
            ->first();

        $link = route('site.usuarios.qrcode', ['id'=>$treinamento->id]);

        $data = [
            'nome' => $treinamento->nome,
            'link' => $link,
        ];

        $pdf =  PDF::loadView('admin.treinamentos.qrcode', $data)
            ->setOption('disable-external-links', false)
            ->setOption('enable-local-file-access', true)
            ->setOption('enable-internal-links' , true);

        $fileName =  "treinamento_".$treinamento->id .  '.pdf';

        $caminho = "downloads/" . $fileName;
        $pdf->save($caminho, 'public');

        return response()->download("storage/downloads/".$fileName)->deleteFileAfterSend(true);
    }

}
