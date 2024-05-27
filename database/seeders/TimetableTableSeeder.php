<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TimetableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('timetables')
            ->insert([['id'=> 1, 'user_id'=> 1,'academic_period_id' => '1', 'status' =>'IN PROGRESS', 'name'=>'base', 'horario_id'=>1]]);
    }
}