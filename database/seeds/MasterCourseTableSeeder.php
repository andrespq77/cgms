<?php

use Illuminate\Database\Seeder;
use App\MasterCourse;
use App\Category;

class MasterCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $path = storage_path() . "/assets/Cursos_padre.xlsx";

       Excel::load($path, function ($reader){

          foreach ($reader->toArray() as $row) {

              $this->command->getOutput()->writeln('Agregando Curso Maestro: '.$row['titulo']);

              $MasterCourse = new MasterCourse();
              $MasterCourse->name = $row['titulo'];
              $MasterCourse->course_code = $row['codigo'];
              $type = Category::where('type',true)->where('title',$row['tipo_programa'])->first();
              $MasterCourse->type_id = $type->id;
              $label = Category::where('parent_id',$type->id)->where('title',$row['nivel'])->first();
              $MasterCourse->label_id = $label->id;
              $sub_label = Category::where('parent_id',$label->id)->where('title',$row['subnivel'])->first();
              $MasterCourse->sub_label_id = $sub_label->id;
              $knowledge = Category::where('parent_id',$sub_label->id)->where('title',$row['conocimiento'])->first();
              $MasterCourse->knowledge_id = $knowledge->id;
              $subject = Category::where('parent_id',$knowledge->id)->where('title',$row['asignatura'])->first();
              $MasterCourse->subject_id = $subject->id;
              $MasterCourse->created_by = 1;
              $MasterCourse->updated_by = 1;
              $MasterCourse->save();
          }

      });
    }
}
