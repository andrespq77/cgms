<?php

use Illuminate\Database\Seeder;

class CoursetypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = ['Presencial' , 'Virtual' , 'Semipresencial'];

        for($i = 0; $i < 3 ; $i++){
            $course_type = new \App\CourseType();
            $course_type->title = $title[$i];
            $course_type->sort = $i;
            $course_type->is_active = 1;
            $course_type->created_by = 1;
            $course_type->updated_by = 1;
            $course_type->save();

        }

    }
}
