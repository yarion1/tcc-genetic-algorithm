<?php

namespace Database\Seeders;

use App\Models\TipoRestricao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoRestricaoSeeder extends Seeder
{
    use WithoutModelEvents;
    private $restricao = [
        ['nome' => 'Alocação de salas de acordo com a capacidade máxima'],
        ['nome' => 'Alocação dos Professores de acordo com sua preferência'],
        ['nome' => 'Alocação dos Professores de acordo com sua disponibilidade'],
        ['nome' => 'Períodos pares com aula pela manhã'],
        ['nome' => 'Períodos ímpares com aulas pela tarde'],
        ['nome' => 'Disciplinas a noite só exceções'],
        ['nome' => 'Alocação dos substitutos'],
    ];

    public function create( string $nome)
    {
        $restricao = new TipoRestricao();
        $restricao->nome = $nome;
        $restricao->save();
    }

    public function run(): void
    {
        foreach ($this->restricao as $rest){
            $this->create($rest['nome']);
        }
    }
}
