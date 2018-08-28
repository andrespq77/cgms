<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\University;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $path = storage_path() . "/assets/Cursos_hijo.csv";

       Excel::load($path, function ($reader){

          foreach ($reader->toArray() as $row) {

              $this->command->getOutput()->writeln('Agregando Curso Hijo: '.
                  $row['nombre'] . ', inicio el '. $row['fecha_inicio']);

              $Course = new Course();
              $Course->short_name = $row['nombre'];
              $Course->course_code = $row['codigo'];
              $Course->course_type_id = $row['tipo_curso'];
              $Course->edition = $row['edition'];
              $Course->hours = $row['horas'];
              $Course->year = $row['anio'];
              $Course->comment = $row['comentario'];
              $Course->quota = $row['cuota'];
              $Course->cost = $row['costo'];
              $Course->finance_type = $row['financiamiento'];
              $Course->inspection_form_generated = false;
              $university = University::where('email',$row['universidad'])->first();
              $Course->university_id = $university->id;
              $mastercourse = App\MasterCourse::where('course_code',$row['codigo_padre'])->first();
              $Course->master_course_id = $mastercourse->id;
              $Course->start_date = ($row['fecha_inicio'] != 'S/D') ? date('Y-m-d', strtotime(substr($row['fecha_inicio'], -4)."/".substr($row['fecha_inicio'], -7,2)."/".substr($row['fecha_inicio'], 0, 2))): null;
              $Course->end_date = ($row['fecha_fin'] != 'S/D') ? date('Y-m-d', strtotime(substr($row['fecha_fin'], -4)."/".substr($row['fecha_fin'], -7,2)."/".substr($row['fecha_fin'], 0, 2))) : null;
              $Course->created_by = 1;
              $Course->updated_by = 1;
              $Course->save();
          }

      });
    }
}
