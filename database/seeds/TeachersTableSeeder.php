<?php

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Teacher;
use App\User;

class TeachersTableSeeder extends Seeder
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
        'docentes1.csv',
        'docentes2.csv',
        'docentes3.csv',
        'docentes4.csv',
        'docentes5.csv',
        'docentes6.csv',
        'docentes7.csv',
        'docentes8.csv'
        ];
      foreach ($files as $file) {

        $this->command->getOutput()->writeln(round(memory_get_usage() / 1048576, 2) . ' Mb');
        $path = storage_path() . "/assets/" . $file;

         Excel::load($path, function ($reader){

            foreach ($reader->toArray() as $row) {
                $this->command->getOutput()->writeln('Agregando Docente: '.$row['nombres'] . ' '.$row['apellidos']);

                $teacher = new Teacher();
                $user = new User();
                $teacher->first_name = $row['nombres'];
                $teacher->last_name = $row['apellidos'];
                $teacher->gender = ($row['genero'] != 'S/D') ? ucfirst($row['genero']) : NULL;
                $teacher->social_id = $row['cedula'];
                $teacher->cc = $row['cc'];
                $teacher->date_of_birth = ($row['fecha_nacimiento'] != 'S/D') ? date('Y-m-d', strtotime(substr($row['fecha_nacimiento'], -4)."/".substr($row['fecha_nacimiento'], -7,2)."/".substr($row['fecha_nacimiento'], 0, 2))) : NULL;
                $teacher->telephone = $row['telefono'];
                $teacher->mobile = $row['celular'];
                $teacher->moodle_id = '';
                $teacher->inst_email = $row['correo_electronico'];
                $teacher->email = ($row['correo_electronico'] != 'S/D') ? $row['correo_electronico'] : $row['cedula'] . '@educacion.gob.ec' ;
                $teacher->university_name = $row['institucion_educativa'];
                $teacher->function = $row['funcion'];
                $teacher->work_area = $row['regimen_laboral'];
                $teacher->category = $row['categoria'];
                $teacher->reason_type = $row['tipo_razon'];
                $teacher->action_type = $row['tipo_accion'];
                $teacher->action_description = $row['explicacion_accion'];
                $teacher->speciality = $row['especialidad'];
                $teacher->join_date = ($row['fecha_inicio'] != 'S/D') ? date('Y-m-d', strtotime(substr($row['fecha_inicio'], -4)."/".substr($row['fecha_inicio'], -7,2)."/".substr($row['fecha_inicio'], 0, 2))): null;
                $teacher->end_date = ($row['fecha_fin'] != 'S/D') ? date('Y-m-d', strtotime(substr($row['fecha_fin'], -4)."/".substr($row['fecha_fin'], -7,2)."/".substr($row['fecha_fin'], 0, 2))) : null;
                $teacher->amie = $row['amie'];
                $teacher->disability = $row['discapacidad'];
                $teacher->ethnic_group = $row['etnia'];

                $teacher->province = $row['provincia'];
                $teacher->canton = $row['canton'];
                $teacher->parroquia = $row['parroquia'];
                $teacher->district = $row['distrito'];
                $teacher->district_code = $row['cod_distrito'];
                $teacher->zone = $row['zona'];
                $teacher->created_by = 1;
                $teacher->updated_by = 1;
                $teacher->save();

                $user->name = $teacher->first_name . ' '.$teacher->last_name ;
                $user->email = $teacher->email;
                $user->password = bcrypt($teacher->email);
                $user->role = USER_ROLE_STUDENT;
                $user->status = USER_STATUS_ACTIVE;
                $user->creation_type = USER_CREATION_TYPE_IMPORT;
                $user->created_by = 1;
                $user->updated_by = 1;
                $user->save();
                $teacher->user_id = $user->id;
                $teacher->save();

                unset($teacher);
                unset($user);
            }
        });
      }
    }
}
