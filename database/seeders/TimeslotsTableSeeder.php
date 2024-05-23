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
                'time' => '08:00 - 11:30',
                'rank' => 1,
                'startTime' => '08:00:00',
                'endTime' => '11:30:00',

            ],
            [
                'id' => 2,
                'time' => '14:00 - 17:30',
                'rank' => 2,
                'startTime' => '14:00:00',
                'endTime' => '17:30:00'
            ],
            [
                'id' => 3,
                'time' => '19:00 - 22:30',
                'rank' => 3,
                'startTime' => '19:00:00',
                'endTime' => '22:30:00'
            ]
        ]);
    }
}
