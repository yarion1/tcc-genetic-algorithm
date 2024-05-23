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
                'name' => 'Monday',
                'short_name' => 'Mon',
                'daysOfWeek' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Tuesday',
                'short_name' => 'Tue',
                'daysOfWeek' => 2,
            ],
            [
                'id' => 3,
                'name' => 'Wednesday',
                'short_name' => 'Wed',
                'daysOfWeek' => 3,
            ],
            [
                'id' => 4,
                'name' => 'Thursday',
                'short_name' => 'Thur',
                'daysOfWeek' => 4,
            ],
            [
                'id' => 5,
                'name' => 'Friday',
                'short_name' => 'Fri',
                'daysOfWeek' => 5,
            ],
            [
                'id' => 6,
                'name' => 'Saturday',
                'short_name' => 'Sat',
                'daysOfWeek' => 6,
            ],
            [
                'id' => 7,
                'name' => 'Sunday',
                'short_name' => 'Sun',
                'daysOfWeek' => 8,
            ]
        ];

        foreach ($days as $day) {
            $existing = \DB::table('days')->where('name', $day['name'])->first();

            if (!$existing) {
                \DB::table('days')->insert($day);
            }
        }
    }
}
