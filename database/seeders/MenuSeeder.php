<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'label' => 'Horários',
                'raiz' => null,
                'icon' => '',
                'to' =>  '',
                'ativo' => 1
            ],
            [
                'label' => 'Cadastro Horários',
                'raiz' => 1,
                'icon' => 'bi bi-calendar-event',
                'to' => '/horarios/cadastro-horarios',
                'ativo' => 1
            ],
            [
                'label' => 'Restrições',
                'raiz' => 1,
                'icon' => 'bi bi-calendar-event',
                'to' => '/horarios/restricoes',
                'ativo' => 1
            ],
            [
                'label' => 'Dados Cadastrais',
                'raiz' => null,
                'icon' => '',
                'to' => '',
                'ativo' => 1
            ],
            [
                'label' => 'Disciplinas',
                'raiz' => 4,
                'icon' => 'bi bi-journal-plus',
                'to' => '/dados-cadastrais/disciplinas',
                'ativo' => 1
            ],
            [
                'label' => 'Salas',
                'raiz' => 4,
                'icon' => 'bi bi-person-video3',
                'to' => '/dados-cadastrais/salas',
                'ativo' => 1
            ],
            [
                'label' => 'Tipos Salas',
                'raiz' => 4,
                'icon' => 'bi bi-person-video',
                'to' => '/dados-cadastrais/tipos-salas',
                'ativo' => 1
            ],
            [
                'label' => 'Professores',
                'raiz' => 4,
                'icon' => 'bi bi-people-fill',
                'to' => '/dados-cadastrais/professores',
                'ativo' => 1
            ],
        ];

        foreach ($menus as $menu) {
            DB::table('menus')->insert($menu);
        }
    }
}
