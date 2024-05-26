<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProfessorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('professors')->insert([
            ['id' => 1, 'name' => 'Dr Rafael Lima', 'created_at' => NULL, 'updated_at' => '2024-02-25 16:56:22', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 2, 'name' => 'Dr Claudomiro', 'created_at' => NULL, 'updated_at' => '2024-01-25 01:23:54', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 3, 'name' => 'Dr Patrick', 'created_at' => NULL, 'updated_at' => '2024-01-25 01:21:28', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 4, 'name' => 'Dr Anna Paula', 'created_at' => NULL, 'updated_at' => '2024-01-25 01:22:55', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 5, 'name' => 'Dr Juliana', 'created_at' => NULL, 'updated_at' => '2024-02-25 15:56:02', 'email' => 'yariongranham@gmail.com', 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 6, 'name' => 'Dr Andreas Kneip', 'created_at' => NULL, 'updated_at' => '2024-01-25 01:22:11', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 7, 'name' => 'Dr Prof Alimentos', 'created_at' => NULL, 'updated_at' => '2024-01-25 01:23:30', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 8, 'name' => 'Dr George', 'created_at' => NULL, 'updated_at' => '2024-01-25 01:21:46', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 9, 'name' => 'Wosley', 'created_at' => NULL, 'updated_at' => '2024-01-25 01:25:03', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 10, 'name' => 'Eduardo', 'created_at' => NULL, 'updated_at' => '2024-01-25 01:24:49', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 11, 'name' => 'Marcelo Ribeiro', 'created_at' => NULL, 'updated_at' => '2024-01-25 01:25:24', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 12, 'name' => 'Hellena <3', 'created_at' => '2024-01-25 01:25:54', 'updated_at' => '2024-01-25 01:25:54', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 13, 'name' => 'Eder Ahmad', 'created_at' => '2024-01-25 01:26:07', 'updated_at' => '2024-01-25 01:26:07', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 14, 'name' => 'Substituto 1', 'created_at' => '2024-01-25 01:26:22', 'updated_at' => '2024-01-25 01:26:22', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 15, 'name' => 'Rogério', 'created_at' => '2024-01-25 01:26:37', 'updated_at' => '2024-01-25 01:26:37', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 16, 'name' => 'Alexandre', 'created_at' => '2024-01-25 01:26:44', 'updated_at' => '2024-01-25 01:26:44', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 17, 'name' => 'Tanilson', 'created_at' => '2024-01-25 01:26:55', 'updated_at' => '2024-01-25 01:26:55', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 18, 'name' => 'Edeilson', 'created_at' => '2024-01-25 01:27:00', 'updated_at' => '2024-02-25 15:57:22', 'email' => 'williamedevip-15@hotmail.com', 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 19, 'name' => 'Gentil', 'created_at' => '2024-01-25 01:27:24', 'updated_at' => '2024-01-25 01:27:24', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 20, 'name' => 'Thiago Magalhaes', 'created_at' => '2024-01-25 01:27:36', 'updated_at' => '2024-01-25 01:27:36', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 21, 'name' => 'Warley', 'created_at' => '2024-01-25 01:27:58', 'updated_at' => '2024-01-25 01:27:58', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 22, 'name' => 'Glenda', 'created_at' => '2024-01-25 01:28:07', 'updated_at' => '2024-01-25 01:28:07', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL],
            ['id' => 23, 'name' => 'David', 'created_at' => '2024-01-25 01:28:26', 'updated_at' => '2024-01-25 01:28:26', 'email' => NULL, 'pessoa_id' => NULL, 'substitute' => 0, 'carga_horaria' => NULL]
        ]);

        \DB::table('courses_professors')->insert([
            ['id' => 1, 'course_id' => 1, 'professor_id' => 3],
            ['id' => 2, 'course_id' => 2, 'professor_id' => 8],
            ['id' => 3, 'course_id' => 3, 'professor_id' => 6],
            ['id' => 4, 'course_id' => 4, 'professor_id' => 5],
            ['id' => 5, 'course_id' => 5, 'professor_id' => 3],
            ['id' => 6, 'course_id' => 6, 'professor_id' => 4],
            ['id' => 7, 'course_id' => 7, 'professor_id' => 7],
            ['id' => 8, 'course_id' => 8, 'professor_id' => 2],
            ['id' => 9, 'course_id' => 9, 'professor_id' => 1],
            ['id' => 10, 'course_id' => 10, 'professor_id' => 10],
            ['id' => 11, 'course_id' => 11, 'professor_id' => 13],
            ['id' => 12, 'course_id' => 12, 'professor_id' => 9],
            ['id' => 13, 'course_id' => 13, 'professor_id' => 12],
            ['id' => 14, 'course_id' => 14, 'professor_id' => 11],
            ['id' => 15, 'course_id' => 15, 'professor_id' => 14],
            ['id' => 16, 'course_id' => 16, 'professor_id' => 1],
            ['id' => 17, 'course_id' => 17, 'professor_id' => 11],
            ['id' => 18, 'course_id' => 18, 'professor_id' => 10],
            ['id' => 19, 'course_id' => 19, 'professor_id' => 15],
            ['id' => 20, 'course_id' => 20, 'professor_id' => 16],
            ['id' => 21, 'course_id' => 21, 'professor_id' => 17],
            ['id' => 22, 'course_id' => 22, 'professor_id' => 18],
            ['id' => 23, 'course_id' => 23, 'professor_id' => 8],
            ['id' => 24, 'course_id' => 24, 'professor_id' => 12],
            ['id' => 25, 'course_id' => 25, 'professor_id' => 15],
            ['id' => 26, 'course_id' => 26, 'professor_id' => 17],
            ['id' => 27, 'course_id' => 27, 'professor_id' => 19],
            ['id' => 28, 'course_id' => 28, 'professor_id' => 18],
            ['id' => 29, 'course_id' => 29, 'professor_id' => 16],
            ['id' => 30, 'course_id' => 30, 'professor_id' => 20],
            ['id' => 31, 'course_id' => 31, 'professor_id' => 10],
            ['id' => 32, 'course_id' => 32, 'professor_id' => 14],
            ['id' => 33, 'course_id' => 33, 'professor_id' => 21],
            ['id' => 34, 'course_id' => 34, 'professor_id' => 22],
            ['id' => 35, 'course_id' => 35, 'professor_id' => 4],
            ['id' => 36, 'course_id' => 36, 'professor_id' => 18],
            ['id' => 37, 'course_id' => 37, 'professor_id' => 17],
            ['id' => 38, 'course_id' => 38, 'professor_id' => 21],
            ['id' => 39, 'course_id' => 39, 'professor_id' => 19],
            ['id' => 40, 'course_id' => 40, 'professor_id' => 23],
            ['id' => 41, 'course_id' => 41, 'professor_id' => 4],
            ['id' => 42, 'course_id' => 42, 'professor_id' => 22],
            ['id' => 43, 'course_id' => 43, 'professor_id' => 20],
            ['id' => 44, 'course_id' => 44, 'professor_id' => 14],
            ['id' => 45, 'course_id' => 45, 'professor_id' => 23],
            ['id' => 46, 'course_id' => 46, 'professor_id' => 16],
            ['id' => 47, 'course_id' => 47, 'professor_id' => 9],
            ['id' => 48, 'course_id' => 48, 'professor_id' => 9],
            ['id' => 49, 'course_id' => 49, 'professor_id' => 4]
        ]);
    }
}
