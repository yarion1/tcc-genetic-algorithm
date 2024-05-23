<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('rooms')->insert([
            [
                'name' => 'Bloco lll, laboratorio 104',
                'capacity' => 40,
                'tipo_sala_id' => '',
                'nome_abreviado' => ''
            ],
            [
                'name' => 'Bloco J, sala 111',
                'capacity' => 40,
                'tipo_sala_id' => '',
                'nome_abreviado' => ''
            ],
            [
                'name' => 'Bloco lll, laboratorio 110',
                'capacity' => 40,
                'tipo_sala_id' => '',
                'nome_abreviado' => ''
            ],
            [
                'name' => 'Bloco lll, sala 207',
                'capacity' => 40,
                'tipo_sala_id' => '',
                'nome_abreviado' => ''
            ],
            [
                'name' => 'Bloco lll, laboratorio 109',
                'capacity' => 40,
                'tipo_sala_id' => '',
                'nome_abreviado' => ''
            ],
            [
                'name' => 'Bloco G, laboratório 04',
                'capacity' => 40,
                'tipo_sala_id' => '',
                'nome_abreviado' => ''
            ],
            [
                'name' => 'Bloco lll, Sala 208',
                'capacity' => 40,
                'tipo_sala_id' => '',
                'nome_abreviado' => ''
            ],
            [
                'name' => 'Bloco lll, laboratorio 106',
                'capacity' => 40,
                'tipo_sala_id' => '',
                'nome_abreviado' => ''
            ],
            [
                'name' => 'Bloco G, laboratório 107',
                'capacity' => 40,
                'tipo_sala_id' => '',
                'nome_abreviado' => ''
            ]
        ]);
    }
}
