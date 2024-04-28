<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PessoasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pessoas')->delete();
        
        \DB::table('pessoas')->insert(array (
            0 => 
            array (
                'cpf' => '080.154.371-13',
                'nome' => 'Luana Lorena',
                'senha' => '$2y$10$DCOZ9sPw2wXOmSej5cTgR.AcQb2zZPG3vZXcExyDf5OKcdF40PgPC',
                'apelido' => 'Luana',
                'curso_id' => '1',
                'perfil_id' => 1,
                'telefone' => '(63)99299-0593',
                'email' => 'adm@gmail.com',
                'email_verificado_em' => NULL,
                // 'foto' => NULL,
                'remember_token' => NULL,
                'criado_por' => NULL,
                'criado_em' => '2023-07-31 20:05:46',
                'atualizado_por' => NULL,
                'atualizado_em' => '2023-07-31 20:05:46',
                'excluido_por' => NULL,
                'excluido_em' => NULL,
            ),
        ));
    }
}