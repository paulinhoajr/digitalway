<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EsperaCSVRequest;
use App\Models\Espera;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use League\Csv\Reader;
use League\Csv\Statement;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EsperaController extends Controller
{
    public function index(): View
    {
        $esperas = Espera::latest()->paginate(config('app.paginate'));

        return view('admin.esperas.index', [
            'esperas' => $esperas
        ]);
    }

    public function importar(): View
    {
        $esperas = Espera::latest()->paginate(config('app.paginate'));

        return view('admin.esperas.importar', [
            'esperas' => $esperas
        ]);
    }

    public function store(EsperaCSVRequest $request): RedirectResponse
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
                $espera = new Espera();
                $espera->escola_id = $record['UID'];
                $espera->nome = $record['Nome'];
                $espera->cpf = $record['CPF'];
                $espera->email = $record['Email'];
                $espera->save();
            }

            Storage::delete("storage/".$caminho);

            DB::commit();

            return redirect()->route('admin.esperas.index')->with('message', "Arquivo importado com sucesso.");

        }catch (\Exception $e){

            return back()->with('message_fail', $e->getMessage());

        }



    }

}
