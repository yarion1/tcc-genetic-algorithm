<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('classes')->insert([
            [
                'id' => 1,
                'name' => '1 periodo',
                'size' => 40,
                'period' => 1
            ],
            [
                'id' => 2,
                'name' => '2 periodo',
                'size' => 40,
                'period' => 2
            ],
            [
                'id' => 3,
                'name' => '3 periodo',
                'size' => 40,
                'period' => 3
            ],
            [
                'id' => 4,
                'name' => '4 periodo',
                'size' => 40,
                'period' => 4
            ],
            [
                'id' => 5,
                'name' => '5 periodo',
                'size' => 40,
                'period' => 5
            ],
            [
                'id' => 6,
                'name' => '6 periodo',
                'size' => 40,
                'period' => 6
            ],
            [
                'id' => 7,
                'name' => '7 periodo',
                'size' => 40,
                'period' => 7
            ],
            [
                'id' => 8,
                'name' => '8 periodo',
                'size' => 40,
                'period' => 8
            ]
        ]);

        \DB::table('courses_classes')->insert([
            ['id' => 1, 'course_id' => 1, 'class_id' => 1, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 2, 'course_id' => 2, 'class_id' => 1, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 3, 'course_id' => 3, 'class_id' => 1, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 4, 'course_id' => 4, 'class_id' => 1, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 5, 'course_id' => 5, 'class_id' => 1, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 6, 'course_id' => 6, 'class_id' => 1, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 7, 'course_id' => 7, 'class_id' => 1, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 8, 'course_id' => 8, 'class_id' => 1, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 9, 'course_id' => 9, 'class_id' => 1, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 10, 'course_id' => 10, 'class_id' => 2, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 11, 'course_id' => 11, 'class_id' => 2, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 12, 'course_id' => 12, 'class_id' => 2, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 13, 'course_id' => 13, 'class_id' => 2, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 14, 'course_id' => 14, 'class_id' => 2, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 15, 'course_id' => 15, 'class_id' => 2, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 16, 'course_id' => 16, 'class_id' => 2, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 17, 'course_id' => 17, 'class_id' => 3, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 18, 'course_id' => 18, 'class_id' => 3, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 19, 'course_id' => 19, 'class_id' => 3, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 20, 'course_id' => 20, 'class_id' => 3, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 21, 'course_id' => 21, 'class_id' => 3, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 22, 'course_id' => 22, 'class_id' => 3, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 23, 'course_id' => 23, 'class_id' => 4, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 24, 'course_id' => 24, 'class_id' => 4, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 25, 'course_id' => 25, 'class_id' => 4, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 26, 'course_id' => 26, 'class_id' => 4, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 27, 'course_id' => 27, 'class_id' => 4, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 28, 'course_id' => 28, 'class_id' => 4, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 29, 'course_id' => 29, 'class_id' => 5, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 30, 'course_id' => 30, 'class_id' => 5, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 31, 'course_id' => 31, 'class_id' => 5, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 32, 'course_id' => 32, 'class_id' => 5, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 33, 'course_id' => 33, 'class_id' => 5, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 34, 'course_id' => 34, 'class_id' => 5, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 35, 'course_id' => 35, 'class_id' => 6, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 36, 'course_id' => 36, 'class_id' => 6, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 37, 'course_id' => 37, 'class_id' => 6, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 38, 'course_id' => 38, 'class_id' => 6, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 39, 'course_id' => 39, 'class_id' => 6, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 40, 'course_id' => 40, 'class_id' => 6, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 41, 'course_id' => 41, 'class_id' => 7, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 42, 'course_id' => 42, 'class_id' => 7, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 43, 'course_id' => 43, 'class_id' => 7, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 44, 'course_id' => 44, 'class_id' => 7, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 45, 'course_id' => 45, 'class_id' => 7, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 46, 'course_id' => 46, 'class_id' => 7, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 47, 'course_id' => 47, 'class_id' => 8, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 48, 'course_id' => 48, 'class_id' => 8, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 49, 'course_id' => 49, 'class_id' => 8, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 50, 'course_id' => 50, 'class_id' => 8, 'meetings' => 1, 'academic_period_id' => 1],
            ['id' => 51, 'course_id' => 51, 'class_id' => 8, 'meetings' => 1, 'academic_period_id' => 1]
        ]);
    }
}
