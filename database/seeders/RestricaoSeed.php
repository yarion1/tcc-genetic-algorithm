<?php

namespace Database\Seeders;

use App\Models\RestricaoGrupo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestricaoSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica se a tabela está vazia
        if (DB::table('restricoes')->count() === 0) {
            DB::table('restricoes')->insert([
                'id' => 1,
            ]);
            for ($i = 1; $i <= 8; $i++) {
                RestricaoGrupo::create([
                    'periodo' => $i,
                    'restricao_id' => 1,
                ]);
            }
        }
    }
}
