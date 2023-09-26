<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegioesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('regioes')->insert([
            ['id' => 1, 'nome' => 'Norte'],
            ['id' => 2, 'nome' => 'Nordeste'],
            ['id' => 3, 'nome' => 'Sudeste'],
            ['id' => 4, 'nome' => 'Sul'],
            ['id' => 5, 'nome' => 'Centro-Oeste']
        ]);
    }
}
