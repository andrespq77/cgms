<?php

use App\User;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\University;
use App\Events\UniversityCreated;

class UniversityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $path = storage_path() . "/assets/Universidades.xlsx";

       Excel::load($path, function ($reader){

          foreach ($reader->toArray() as $row) {

              $this->command->getOutput()->writeln('Agregando Universidad: '.$row['nombre']);

              $university = new University();
              $user = User::find(1);
              $university->name = $row['nombre'];
              $university->email = $row['correo'];
              $university->login_user_name = $row['nombre'];
              $university->login_email = $row['correo'];
              $university->created_by = 1;
              $university->updated_by = 1;
              $university->save();
              event(new UniversityCreated($university, $university->login_email, $user));
          }

      });
//
//        $user = User::find(1);
//
//        $university = new University();
//        $university->name = 'Universidad de Cuenca';
//        $university->email = 'cuenca@test.com';
//        $university->login_user_name = 'Universidad de Cuenca';
//        $university->login_email = 'cuenca@test.com';
//        $university->created_by = 1;
//        $university->updated_by = 1;
//        $university->save();
//        event(new UniversityCreated($university, $university->login_email, $user));
//
//
//        $university = new University();
//        $university->name = 'Plataforma mecapacito';
//        $university->email = 'mecapacito@test.com';
//        $university->login_user_name = 'Plataforma mecapacito';
//        $university->login_email = 'mecapacito@test.com';
//        $university->created_by = 1;
//        $university->updated_by = 1;
//        $university->save();
//        event(new UniversityCreated($university,$university->login_email,  $user));
//
//
//        $university = new University();
//        $university->name = 'Universidad de Guayaquil';
//        $university->email = 'guayaquil@test.com';
//        $university->login_user_name = 'Universidad de Guayaquil';
//        $university->login_email = 'guayaquil@test.com';
//        $university->created_by = 1;
//        $university->updated_by = 1;
//        $university->save();
//
//        event(new UniversityCreated($university,$university->login_email, $user));

    }
}
