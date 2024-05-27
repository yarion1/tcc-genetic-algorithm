<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuPerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            [
                "id" => 1,
                "perfil_id" => 1,
                "menu_id" => 1,
                "ativo" => 1
            ],
            [
                "id" => 2,
                "perfil_id" => 1,
                "menu_id" => 2,
                "ativo" => 1
            ],
            [
                "id" => 3,
                "perfil_id" => 1,
                "menu_id" => 3,
                "ativo" => 1
            ],
            [
                "id" => 4,
                "perfil_id" => 1,
                "menu_id" => 4,
                "ativo" => 1
            ],
            [
                "id" => 5,
                "perfil_id" => 1,
                "menu_id" => 5,
                "ativo" => 1
            ],
            [
                "id" => 6,
                "perfil_id" => 1,
                "menu_id" => 6,
                "ativo" => 1
            ],
            [
                "id" => 7,
                "perfil_id" => 1,
                "menu_id" => 7,
                "ativo" => 1
            ],
            [
                "id" => 8,
                "perfil_id" => 1,
                "menu_id" => 8,
                "ativo" => 1
            ],
            [
                "id" => 9,
                "perfil_id" => 2,
                "menu_id" => 1,
                "ativo" => 1
            ],
            [
                "id" => 10,
                "perfil_id" => 2,
                "menu_id" => 2,
                "ativo" => 1
            ]
        ];

        DB::table('menu_perfis')->insert($data);
    }
}
