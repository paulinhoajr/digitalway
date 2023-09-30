<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeralController extends Controller
{
    public function autocomplete(Request $request)
    {
        $keyword = $request->get('busca');

        if( ! $keyword){
            return response()->json(['results' => []]);
        }

        $results = DB::table('cidades')
            ->select([
                'cidades.id as city_id','cidades.cep','cidades.nome as cidade',
                'estados.id as estado_id','estados.uf as uf',
            ])
            ->where('cidades.nome', 'LIKE', "%{$keyword}%")
            ->join('estados', 'cidades.estado_id', '=', 'estados.id')
            ->orderBy('cidades.nome', 'asc')
            ->limit(20)
            ->get();

        $skillData = array();

        if($results){
            foreach ($results as $result){
                $data['id'] = $result->city_id;
                $data['cep'] = $result->cep;
                $data['estado_id'] = $result->estado_id;
                $data['value'] = $result->cidade.' - '.$result->uf;
                array_push($skillData, $data);
            }
        }

        echo json_encode($skillData);
    }

    public function autocompleteEscola(Request $request)
    {
        $keyword = $request->get('escola');

        if( ! $keyword){
            return response()->json(['results' => []]);
        }

        $results = Escola::take(20)->get();

        $skillData = array();

        if($results){
            foreach ($results as $result){
                $data['id'] = $result->id;
                $data['value'] = $result->nome;
                array_push($skillData, $data);
            }
        }

        echo json_encode($skillData);
    }

}
