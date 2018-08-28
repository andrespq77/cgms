<?php

use Illuminate\Database\Seeder;
use App\Registration;

class RegistrationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::disableQueryLog();
      $files = [
        'Portafolio1.xlsx',
        'Portafolio2.xlsx',
        'Portafolio3.xlsx'
        ];

      foreach ($files as $file) {
        $path = storage_path() . "/assets/" . $file;

         Excel::load($path, function ($reader){

            $this->command->getOutput()->writeln(round(memory_get_usage() / 1048576, 2) . ' Mb');

            foreach ($reader->toArray() as $row) {
                $this->command->getOutput()->writeln('Registrando: '.$row['cedula'] . ' en ' . $row['codigo']);
                $registration = new Registration();
                $teacher = App\Teacher::where('social_id',$row['cedula'])->first();
                $course = App\Course::where('course_code',$row['codigo'])->first();
                $registration->reg_date = now();
                $registration->teacher_id = $teacher->id;
                $registration->course_id = $course->id;
                $registration->user_social_id = $teacher->social_id;
                $registration->user_first_name = $teacher->first_name;
                $registration->user_last_name = $teacher->last_name;
                $registration->email = $teacher->email;
                $registration->cell_phone = $teacher->mobile;
                $registration->mark = ($row['estado'] == 1) ? 10 : 5;
                $registration->mark_approved = ($row['estado'] == 1) ? true : false;
                $registration->mark_approved_by = 1;
                $registration->status = 3;
                $registration->save();
            }

        });
      }
    }
}
