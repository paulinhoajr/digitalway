<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CidadeCSVRequest;
use App\Http\Requests\Admin\EscolaCSVRequest;
use App\Http\Requests\Admin\EscolaImportarCSVRequest;
use App\Http\Requests\Admin\EscolaStoreRequest;
use App\Http\Requests\Admin\EscolaUpdateRequest;
use App\Http\Requests\Admin\EsperaCSVRequest;
use App\Http\Requests\Admin\UsuarioCSVRequest;
use App\Models\Cidades;
use App\Models\Escola;
use App\Models\Espera;
use App\Models\Usuario;
use App\Models\UsuariosEscolas;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;

class EscolaController extends Controller
{
    public function cidades(): View
    {
        $escolas = Escola::groupBy('cidade_id')->get();

        return view('admin.escolas.cidades', [
            'escolas' => $escolas
        ]);
    }

    public function index($id=null)
    {
        $escolas = Escola::whereNull('deleted_at')
            ->when($id!=null, function ($query) use ($id) {
                $query->where('cidade_id', $id);
            })
            ->latest()
            ->paginate(config('app.paginate'));

        return view('admin.escolas.index', [
            'escolas' => $escolas,
            'id' => $id
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

    public function csv_usuario($id): View
    {
        $escola = Escola::where('id', $id)->first();

        return view('admin.escolas.csv_usuarios', [
            'escola' => $escola
        ]);
    }

    public function csv_cidade($id): View
    {
        $escola = Escola::where('id', $id)->first();

        return view('admin.escolas.csv_cidade', [
            'escola' => $escola
        ]);
    }

    public function gerar_usuario(UsuarioCSVRequest $request)
    {
        $escola = Escola::where('id', $request->id)->first();

        try {

            $caminho = "storage/csv/".$escola->nome."_".$request->nome.".csv";

            $writer = Writer::createFromPath($caminho, 'w');
            //$writer->insertAll($records);
            $writer->setDelimiter(';');

            $writer->insertOne(['Numero','Nome', 'CPF', 'Email', 'UID']);

            for ($i=1;$i<=$request->linhas;$i++)
            {
                $writer->insertOne([$i, '', '', '', $escola->id]);
                //$writer->insertOne([$i, fake()->name, only_numbers(fake()->unique()->phoneNumber),fake()->unique()->email, $escola->id]);
            }

            return response()->download($caminho)->deleteFileAfterSend(true);

        } catch (CannotInsertRecord $e) {
            $e->getRecord();
        }
    }

    public function gerar_cidade(CidadeCSVRequest $request)
    {
        $escolas_id = $request->get('escolas');

        $escolas = Escola::whereIn('id', $escolas_id)
            ->get();

        try {

            $caminho = "storage/csv/".$escolas->first()->cidade->nome.".csv";

            $writer = Writer::createFromPath($caminho, 'w');
            //$writer->insertAll($records);
            $writer->setDelimiter(';');

            foreach ($escolas as $escola){

                $writer->insertOne(['Escola','Professor', 'CPF', 'Email', 'UID']);

                for ($i=1;$i<=5;$i++)
                {
                    $writer->insertOne([$escola->nome, '', '', '', $escola->id]);
                    //$writer->insertOne([$i, fake()->name, only_numbers(fake()->unique()->phoneNumber),fake()->unique()->email, $escola->id]);
                }

                $writer->insertOne(['', '', '', '', '']);
            }

            return response()->download($caminho)->deleteFileAfterSend(true);

        } catch (CannotInsertRecord $e) {
            $e->getRecord();
        }
    }

    public function csv_escola(): View
    {

        return view('admin.escolas.csv', [

        ]);
    }

    public function gerar_escola(EscolaCSVRequest $request)
    {

        try {

            $cidade = Cidades::findOrFail($request->cidade_id);

            $caminho = "storage/csv/".$cidade->nome."_".$request->nome.".csv";

            $writer = Writer::createFromPath($caminho, 'w');
            //$writer->insertAll($records);
            $writer->setDelimiter(';');

            $writer->insertOne(['Numero','Escola', 'Cidade', 'UID', 'Tipo']);

            for ($i=1;$i<=$request->linhas;$i++)
            {
                $writer->insertOne([$i, '', $cidade->nome, $cidade->id, $request->tipo]);
                //$writer->insertOne([$i, fake()->name, only_numbers(fake()->unique()->phoneNumber),fake()->unique()->email, $escola->id]);
            }

            return response()->download($caminho)->deleteFileAfterSend(true);

        } catch (CannotInsertRecord $e) {
            $e->getRecord();
        }
    }

    public function importar_escola(EscolaImportarCSVRequest $request): RedirectResponse
    {
        if (!$request->hasFile('csv')) {
            return back()->with('message_alert', "Você precisa selecionar um arquivo.");
        }

        $file = $request->file('csv');
        $ext = strtolower($file->getClientOriginalExtension());

        if ($ext!="csv"){
            return back()->with('message_alert', "Arquivo inválido.");
        }

        $filename = uniqid();
        $csv_nome = $filename . '.' . $ext;

        $caminho = "csv/".$csv_nome;

        Storage::disk('public')->put($caminho, File::get($file));

        $csv = Reader::createFromPath("storage/".$caminho, 'r');

        $csv->setDelimiter(';');

        $csv->setHeaderOffset(0);

        $stmt = (new Statement())->offset(0);

        $records = $stmt->process($csv);

        try {
            DB::beginTransaction();

            foreach ($records as $record) {
                //'Numero','Escola', 'Cidade', 'UID', 'Tipo'
                if (only_numbers($record['UID'])!="" and $record['Escola']!="" and only_numbers($record['Tipo'])!=""){

                    $cidade = Cidades::where('id', only_numbers($record['UID']))->first();

                    if (!$cidade){
                        return back()->with('message_fail', "ID da cidade inexistente.");
                    }

                    $escola = Escola::where('nome', $record['Escola'])
                        ->where('cidade_id', only_numbers($record['UID']))
                        ->where('tipo', only_numbers($record['Tipo']))
                        ->first();

                    if (!$escola){
                        $escola = new Escola();
                        $escola->cidade_id = only_numbers($record['UID']);
                        $escola->nome = $record['Escola'];
                        $escola->tipo = only_numbers($record['Tipo']);
                        $escola->save();
                    }

                }
            }

            Storage::delete($caminho);

            DB::commit();

            return back()->with('message', "Arquivo importado com sucesso.");

        }catch (\Exception $e){

            DB::rollBack();
            return back()->with('message_fail', $e->getMessage());

        }



    }
}
