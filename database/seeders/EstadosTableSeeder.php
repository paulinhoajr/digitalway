<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('estados')->insert([
            ['id' => 1, 'nome' => 'Acre', 'uf' => 'AC', 'regiao_id' => 1],
            ['id' => 2, 'nome' => 'Alagoas', 'uf' => 'AL', 'regiao_id' => 2],
            ['id' => 3, 'nome' => 'Amapá', 'uf' => 'AP', 'regiao_id' => 1],
            ['id' => 4, 'nome' => 'Amazonas', 'uf' => 'AM', 'regiao_id' => 1],
            ['id' => 5, 'nome' => 'Bahia', 'uf' => 'BA', 'regiao_id' => 2],
            ['id' => 6, 'nome' => 'Ceará', 'uf' => 'CE', 'regiao_id' => 2],
            ['id' => 7, 'nome' => 'Distrito Federal', 'uf' => 'DF', 'regiao_id' => 5],
            ['id' => 8, 'nome' => 'Espírito Santo', 'uf' => 'ES', 'regiao_id' => 3],
            ['id' => 9, 'nome' => 'Goiás', 'uf' => 'GO', 'regiao_id' => 5],
            ['id' => 10, 'nome' => 'Maranhão', 'uf' => 'MA', 'regiao_id' => 2],
            ['id' => 11, 'nome' => 'Mato Grosso', 'uf' => 'MT', 'regiao_id' => 5],
            ['id' => 12, 'nome' => 'Mato Grosso do Sul', 'uf' => 'MS', 'regiao_id' => 5],
            ['id' => 13, 'nome' => 'Minas Gerais', 'uf' => 'MG', 'regiao_id' => 3],
            ['id' => 14, 'nome' => 'Pará', 'uf' => 'PA', 'regiao_id' => 1],
            ['id' => 15, 'nome' => 'Paraíba', 'uf' => 'PB', 'regiao_id' => 2],
            ['id' => 16, 'nome' => 'Paraná', 'uf' => 'PR', 'regiao_id' => 4],
            ['id' => 17, 'nome' => 'Pernambuco', 'uf' => 'PE', 'regiao_id' => 2],
            ['id' => 18, 'nome' => 'Piauí', 'uf' => 'PI', 'regiao_id' => 2],
            ['id' => 19, 'nome' => 'Rio de Janeiro', 'uf' => 'RJ', 'regiao_id' => 3],
            ['id' => 20, 'nome' => 'Rio Grande do Norte', 'uf' => 'RN', 'regiao_id' => 2],
            ['id' => 21, 'nome' => 'Rio Grande do Sul', 'uf' => 'RS', 'regiao_id' => 4],
            ['id' => 22, 'nome' => 'Rondônia', 'uf' => 'RO', 'regiao_id' => 1],
            ['id' => 23, 'nome' => 'Roraima', 'uf' => 'RR', 'regiao_id' => 1],
            ['id' => 24, 'nome' => 'Santa Catarina', 'uf' => 'SC', 'regiao_id' => 4],
            ['id' => 25, 'nome' => 'São Paulo', 'uf' => 'SP', 'regiao_id' => 3],
            ['id' => 26, 'nome' => 'Sergipe', 'uf' => 'SE', 'regiao_id' => 2],
            ['id' => 27, 'nome' => 'Tocantins', 'uf' => 'TO', 'regiao_id' => 1]
        ]);
    }
}
