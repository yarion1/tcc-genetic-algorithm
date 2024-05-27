<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TimeslotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('timeslots')->insert([
            [
                'id' => 1,
                'time' => '08:00 - 11:40',
                'rank' => 1,
                'startTime' => '08:00:00',
                'endTime' => '11:40:00',

            ],
            [
                'id' => 2,
                'time' => '14:00 - 17:40',
                'rank' => 2,
                'startTime' => '14:00:00',
                'endTime' => '17:40:00'
            ],
            [
                'id' => 3,
                'time' => '19:00 - 22:40',
                'rank' => 3,
                'startTime' => '19:00:00',
                'endTime' => '22:40:00'
            ]
        ]);
    }
}
