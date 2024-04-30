<?php

namespace Database\Seeders;

use App\Models\RestricaoClassificacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestricaoClassificacaoSeeder extends Seeder
{
    use WithoutModelEvents;
    
    private $classificacao = [
        ['nome' => 'Hard', 'peso' =>  1, 'cor_destaque' => '#e9aeae'],
        ['nome' => 'Soft', 'peso' =>  2, 'cor_destaque' => '#f9be88'],
        ['nome' => 'Really Soft', 'peso' =>  3, 'cor_destaque' => '#ced4db'],
    ];

    public function create( string $nome, int $peso, string $cor_destaque)
    {
        $classificacao = new RestricaoClassificacao();
        $classificacao->nome = $nome;
        $classificacao->peso = $peso;
        $classificacao->cor_destaque = $cor_destaque;
        $classificacao->save();
    }

    public function run(): void
    {
        foreach ($this->classificacao as $classf){
            $this->create($classf['nome'], $classf['peso'], $classf['cor_destaque']);
        }
    }
}
