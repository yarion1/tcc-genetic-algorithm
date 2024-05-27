<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('courses')->insert([
            ['id' => 1, 'course_code' => 'IPE', 'name' => 'Introdução a prática extensionista', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:17:58', 'quantidade_alunos' => 40, 'college_class_id' => 1],
            ['id' => 2, 'course_code' => 'EMP', 'name' => 'Empreendorismo e inovação', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:17:50', 'quantidade_alunos' => 40, 'college_class_id' => 1],
            ['id' => 3, 'course_code' => 'LPA', 'name' => 'Logica de programação (turma A) - 120H', 'created_at' => NULL, 'updated_at' => '2024-05-18 21:35:06', 'quantidade_alunos' => 40, 'college_class_id' => 1],
            ['id' => 4, 'course_code' => 'LPB', 'name' => 'Logica de programação (turma B) - 120H', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:18:08', 'quantidade_alunos' => 40, 'college_class_id' => 1],
            ['id' => 5, 'course_code' => 'LPA2', 'name' => 'Logica de programação (turma A) - 120H', 'created_at' => NULL, 'updated_at' => '2024-05-18 21:35:06', 'quantidade_alunos' => 40, 'college_class_id' => 1],
            ['id' => 6, 'course_code' => 'LPB2', 'name' => 'Logica de programação (turma B) - 120H', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:18:08', 'quantidade_alunos' => 40, 'college_class_id' => 1],
            ['id' => 7, 'course_code' => 'LM', 'name' => 'Logica Matemática', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:18:19', 'quantidade_alunos' => 40, 'college_class_id' => 1],
            ['id' => 8, 'course_code' => 'ICCA', 'name' => 'Introdução a ciência da computação (turma A)', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:18:28', 'quantidade_alunos' => 40, 'college_class_id' => 1],
            ['id' => 9, 'course_code' => 'IPAL', 'name' => 'Introdução a programação', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:18:52', 'quantidade_alunos' => 40, 'college_class_id' => 1],
            ['id' => 10, 'course_code' => 'PBE', 'name' => 'Probabilidade e estatística', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:19:34', 'quantidade_alunos' => 30, 'college_class_id' => 2],
            ['id' => 11, 'course_code' => 'ED1', 'name' => 'Estrutura de dados I', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:19:42', 'quantidade_alunos' => 30, 'college_class_id' => 2],
            ['id' => 12, 'course_code' => 'PE1', 'name' => 'Praticas extensionistas', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:19:52', 'quantidade_alunos' => 30, 'college_class_id' => 2],
            ['id' => 13, 'course_code' => 'MLC', 'name' => 'Metodologia cientifica', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:20:07', 'quantidade_alunos' => 30, 'college_class_id' => 2],
            ['id' => 14, 'course_code' => 'POO', 'name' => 'Programação orientada a objetos', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:20:17', 'quantidade_alunos' => 30, 'college_class_id' => 2],
            ['id' => 15, 'course_code' => 'CAL', 'name' => 'Cálculo 1', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:20:24', 'quantidade_alunos' => 30, 'college_class_id' => 2],
            ['id' => 16, 'course_code' => 'ED1B', 'name' => 'Estrutura de dados I (turma B)', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:20:40', 'quantidade_alunos' => 30, 'college_class_id' => 2],
            ['id' => 17, 'course_code' => 'BD', 'name' => 'Banco de dados', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:20:59', 'quantidade_alunos' => 30, 'college_class_id' => 3],
            ['id' => 18, 'course_code' => 'ED2', 'name' => 'Estrutura de dados 2', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:21:53', 'quantidade_alunos' => 30, 'college_class_id' => 3],
            ['id' => 19, 'course_code' => 'MD', 'name' => 'Matemática discreta', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:21:46', 'quantidade_alunos' => 30, 'college_class_id' => 3],
            ['id' => 20, 'course_code' => 'IHC', 'name' => 'Interface homem computador', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:21:34', 'quantidade_alunos' => 30, 'college_class_id' => 3],
            ['id' => 21, 'course_code' => 'CAL2', 'name' => 'Cálculo 2', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:21:26', 'quantidade_alunos' => 30, 'college_class_id' => 3],
            ['id' => 22, 'course_code' => 'PE2', 'name' => 'Práticas extensionistas 2', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:21:19', 'quantidade_alunos' => 30, 'college_class_id' => 3],
            ['id' => 23, 'course_code' => 'PE3', 'name' => 'Práticas extensionistas 3', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:22:59', 'quantidade_alunos' => 30, 'college_class_id' => 4],
            ['id' => 24, 'course_code' => 'ENGS', 'name' => 'Engenharia de software', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:22:49', 'quantidade_alunos' => 30, 'college_class_id' => 4],
            ['id' => 25, 'course_code' => 'SD', 'name' => 'Sistemas digitais', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:22:41', 'quantidade_alunos' => 32, 'college_class_id' => 4],
            ['id' => 26, 'course_code' => 'AL', 'name' => 'Álgebra linear', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:22:33', 'quantidade_alunos' => 35, 'college_class_id' => 4],
            ['id' => 27, 'course_code' => 'CN', 'name' => 'Cálculo numérico', 'created_at' => NULL, 'updated_at' => '2024-05-19 21:22:26', 'quantidade_alunos' => 35, 'college_class_id' => 4],
            ['id' => 28, 'course_code' => 'TG', 'name' => 'Teoria dos grafos', 'created_at' => '2024-01-25 01:51:41', 'updated_at' => '2024-05-19 21:22:18', 'quantidade_alunos' => 30, 'college_class_id' => 4],
            ['id' => 29, 'course_code' => 'RC', 'name' => 'Redes de computadores', 'created_at' => '2024-01-25 01:52:16', 'updated_at' => '2024-05-19 21:24:18', 'quantidade_alunos' => 30, 'college_class_id' => 5],
            ['id' => 30, 'course_code' => 'PS', 'name' => 'Projeto de sistemas', 'created_at' => '2024-01-25 01:52:35', 'updated_at' => '2024-05-19 21:24:07', 'quantidade_alunos' => 32, 'college_class_id' => 5],
            ['id' => 31, 'course_code' => 'LFA', 'name' => 'Linguagens formais e autômatos', 'created_at' => '2024-01-25 01:53:04', 'updated_at' => '2024-05-19 21:23:55', 'quantidade_alunos' => 32, 'college_class_id' => 5],
            ['id' => 32, 'course_code' => 'WEBM', 'name' => 'Webmobile', 'created_at' => '2024-01-25 01:53:28', 'updated_at' => '2024-05-19 21:23:48', 'quantidade_alunos' => 30, 'college_class_id' => 5],
            ['id' => 33, 'course_code' => 'CG', 'name' => 'Computação gráfica', 'created_at' => '2024-01-25 01:53:53', 'updated_at' => '2024-05-19 21:23:39', 'quantidade_alunos' => 32, 'college_class_id' => 5],
            ['id' => 34, 'course_code' => 'OC', 'name' => 'Organização de computadores', 'created_at' => '2024-01-25 01:54:20', 'updated_at' => '2024-05-19 21:23:29', 'quantidade_alunos' => 30, 'college_class_id' => 5],
            ['id' => 35, 'course_code' => 'PO', 'name' => 'Pesquisa operacional', 'created_at' => '2024-01-25 01:55:20', 'updated_at' => '2024-05-19 21:24:41', 'quantidade_alunos' => 30, 'college_class_id' => 6],
            ['id' => 36, 'course_code' => 'PI', 'name' => 'Processamento de imagens', 'created_at' => '2024-01-25 01:55:40', 'updated_at' => '2024-05-19 21:25:32', 'quantidade_alunos' => 32, 'college_class_id' => 6],
            ['id' => 37, 'course_code' => 'IA', 'name' => 'Inteligência artificial', 'created_at' => '2024-01-25 01:55:58', 'updated_at' => '2024-05-19 21:25:24', 'quantidade_alunos' => 30, 'college_class_id' => 6],
            ['id' => 38, 'course_code' => 'ES', 'name' => 'Estágio supervisionando', 'created_at' => '2024-01-25 01:56:30', 'updated_at' => '2024-05-19 21:24:54', 'quantidade_alunos' => 30, 'college_class_id' => 6],
            ['id' => 39, 'course_code' => 'TC', 'name' => 'Teoria da computação', 'created_at' => '2024-01-25 01:57:08', 'updated_at' => '2024-05-19 21:25:17', 'quantidade_alunos' => 35, 'college_class_id' => 6],
            ['id' => 40, 'course_code' => 'PAA', 'name' => 'Projeto e análise de algoritmos', 'created_at' => '2024-01-25 01:58:02', 'updated_at' => '2024-05-19 21:25:09', 'quantidade_alunos' => 30, 'college_class_id' => 6],
            ['id' => 41, 'course_code' => 'RD', 'name' => '(OPT:1) Redes complexas', 'created_at' => '2024-01-25 01:58:40', 'updated_at' => '2024-05-19 21:25:59', 'quantidade_alunos' => 38, 'college_class_id' => 7],
            ['id' => 42, 'course_code' => 'SDIST', 'name' => 'Sistemas distribuídos', 'created_at' => '2024-01-25 01:59:16', 'updated_at' => '2024-05-19 21:26:48', 'quantidade_alunos' => 32, 'college_class_id' => 7],
            ['id' => 43, 'course_code' => 'COMP', 'name' => 'Compiladores', 'created_at' => '2024-01-25 01:59:42', 'updated_at' => '2024-05-19 21:26:41', 'quantidade_alunos' => 28, 'college_class_id' => 7],
            ['id' => 44, 'course_code' => 'PG1', 'name' => 'Projeto de graduação I', 'created_at' => '2024-01-25 02:00:15', 'updated_at' => '2024-05-19 21:26:33', 'quantidade_alunos' => 20, 'college_class_id' => 7],
            ['id' => 45, 'course_code' => 'SAS', 'name' => 'Segurança e auditoria de sistemas', 'created_at' => '2024-01-25 02:00:42', 'updated_at' => '2024-05-19 21:26:25', 'quantidade_alunos' => 38, 'college_class_id' => 7],
            ['id' => 46, 'course_code' => 'SO', 'name' => 'Sistemas operacionais', 'created_at' => '2024-01-25 02:01:05', 'updated_at' => '2024-05-19 21:26:16', 'quantidade_alunos' => 30, 'college_class_id' => 7],
            ['id' => 47, 'course_code' => 'MDD', 'name' => '(OPT:2) Mineração de dados', 'created_at' => '2024-01-25 02:01:48', 'updated_at' => '2024-05-19 21:27:30', 'quantidade_alunos' => 28, 'college_class_id' => 8],
            ['id' => 48, 'course_code' => 'MAMF', 'name' => '(OPT:4) Mercado financeiro', 'created_at' => '2024-01-25 02:02:39', 'updated_at' => '2024-05-19 21:27:22', 'quantidade_alunos' => 30, 'college_class_id' => 8],
            ['id' => 49, 'course_code' => 'GPS', 'name' => 'Gestão de projetos', 'created_at' => '2024-01-25 02:03:03', 'updated_at' => '2024-05-19 21:27:14', 'quantidade_alunos' => 32, 'college_class_id' => 8],
            ['id' => 50, 'course_code' => 'BIOINF', 'name' => '(OPT:5) Bioinformática', 'created_at' => '2024-01-25 02:03:41', 'updated_at' => '2024-05-19 21:27:06', 'quantidade_alunos' => 35, 'college_class_id' => 8],
            ['id' => 51, 'course_code' => 'PG2', 'name' => 'Projeto de graduação 2', 'created_at' => '2024-01-25 02:04:00', 'updated_at' => '2024-05-19 21:15:22', 'quantidade_alunos' => 20, 'college_class_id' => 8]
        ]);
    }
}
