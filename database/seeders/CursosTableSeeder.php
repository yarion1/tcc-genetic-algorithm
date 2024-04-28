<?php

namespace Database\Seeders;

use App\Models\ModelFront\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursosTableSeeder extends Seeder
{

    use WithoutModelEvents;
    
    private $curso = [
        ['nome' => 'Ciência da Computação', 'sigla' => 'CCOMP'],
    ];

    public function create( string $nome, string $sigla)
    {
        $curso = new Curso();
        $curso->nome = $nome;
        $curso->sigla = $sigla;
        $curso->save();
    }

    public function run(): void
    {
        foreach ($this->curso as $curs){
            $this->create($curs['nome'], $curs['sigla']);
        }
    }
}
