<?php

namespace Database\Seeders;

use App\Models\TiposSalas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposSalasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    use WithoutModelEvents;
    private $tiposSalas = [
        ['nome' => 'Laboratório', 'sigla' => 'LAB', 'criado_por' => 1],
        ['nome' => 'Sala', 'sigla' => 'SALA', 'criado_por' => 1],
    ];

    private function create(string $nome, string $sigla, int $criado_por)
    {
        $tiposSalas = new TiposSalas();
        $tiposSalas->nome = $nome;
        $tiposSalas->sigla = $sigla;
        $tiposSalas->criado_por = $criado_por;
        $tiposSalas->save();
    }
    public function run(): void
    {
        foreach ($this->tiposSalas as $tipoSala){
            $this->create($tipoSala['nome'], $tipoSala['sigla'], $tipoSala['criado_por']);
        }
    }
}
