<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            [
                'id' => 1,
                'name' => 'Segunda',
                'short_name' => 'Mon',
                'daysOfWeek' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Terça',
                'short_name' => 'Tue',
                'daysOfWeek' => 2,
            ],
            [
                'id' => 3,
                'name' => 'Quarta',
                'short_name' => 'Wed',
                'daysOfWeek' => 3,
            ],
            [
                'id' => 4,
                'name' => 'Quinta',
                'short_name' => 'Thur',
                'daysOfWeek' => 4,
            ],
            [
                'id' => 5,
                'name' => 'Sexta',
                'short_name' => 'Fri',
                'daysOfWeek' => 5,
            ],
            [
                'id' => 6,
                'name' => 'Sábado',
                'short_name' => 'Sat',
                'daysOfWeek' => 6,
            ],
        ];

        foreach ($days as $day) {
            $existing = \DB::table('days')->where('name', $day['name'])->first();

            if (!$existing) {
                \DB::table('days')->insert($day);
            }
        }
    }
}
