<?php
namespace Database\Seeders;

use App\Models\ModelFront\Perfil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilTableSeeder extends Seeder
{
    use WithoutModelEvents;
    private $perfil = [
        ['nome' => 'Coordernador'],
        ['nome' => 'Professor'],
    ];

    private function create(string $nome)
    {
        $perfil = new Perfil();
        $perfil->nome = $nome;
        $perfil->save();
    }
    public function run(): void
    {
        foreach ($this->perfil as $perf){
            $this->create($perf['nome']);
        }
    }
}
