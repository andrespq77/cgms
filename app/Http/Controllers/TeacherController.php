<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherStoreRequest;
use App\Http\Requests\TeacherUpdateRequest;
use App\Repository\TeacherRepository;
use App\Teacher;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Canton;

/**
 * Class TeacherController
 *
 * @package App\Http\Controllers
 */
class TeacherController extends Controller
{
    private $repo = null;

    public function __construct()
    {
        $this->repo = new TeacherRepository();
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){

        $user = Auth::user();

        if ($user->can('browse', Teacher::class)) {

            $title = 'Teacher Management - '.env('APP_NAME') ;

            $posts = $request->all();

            $page = isset($posts['page']) ? $posts['page'] : 1;

            $teachers = $this->repo->paginate($page);

            return view('lms.admin.teacher.index', ['title'=> $title, 'teachers' => $teachers]);

        } else{
            return response()->redirectTo(url('/admin/unauthorized'));
        }

    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSearch(Request $request)
    {

        $user = Auth::user();

        if ($user->can('browse', Teacher::class)) {

            $posts = $request->query();
            $page = isset($posts['page']) ? $posts['page'] : 1;

            $title = 'Teacher Search Result for ['.$posts['search'].'] - '.env('APP_NAME') ;

            $teachers = $this->repo->search($page, $posts['search']);

            return view('lms.admin.teacher.index', ['title'=> $title, 'teachers' => $teachers]);

        } else{

            echo  'unauthorized';

        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getNew(){

        $user = getAuthUser();

        if ($user->can('create', Teacher::class)) {

            $title = 'Create New Teacher - ' . env('APP_NAME');

            return view('lms.admin.teacher.form', ['title' => $title]);

        } else{
            echo  'unauthorized';
        }

    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id){

        $user = getAuthUser();

        if ($user->can('edit', Teacher::class)) {

            $title = 'Edit Teacher - ' . env('APP_NAME');

            $teacher = $this->repo->findById($id);
            $portfolio = $this->repo->getPortfolioById($id);

            return view('lms.admin.teacher.form', ['title' => $title, 'teacher' => $teacher,
                'portfolios' => $portfolio]);

        } else{
            echo  'unauthorized';
        }

    }

    /**
     * @todo add validation rule
     * @param TeacherStoreRequest|Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TeacherStoreRequest $request){


            $post = $request->all();

            $teacher['first_name'] = $post['first_name'];
            $teacher['last_name'] = $post['last_name'];

            $teacher['social_id'] = $post['social_id'];
            $teacher['cc'] = $post['cc'];
            $teacher['date_of_birth'] = isset($post['date_of_birth']) ? date('Y-m-d', strtotime($post['date_of_birth'])) : null;

            $teacher['email'] = $post['email'];
            $teacher['gender'] = ucfirst($post['gender']);
            $teacher['telephone'] = $post['telephone'];
            $teacher['mobile'] = $post['mobile'];

            $teacher['inst_email'] = $post['inst_email'];
            $teacher['university_name'] = $post['university'];
            $teacher['function'] = $post['teacher_function'];
            $teacher['work_area'] = $post['work_area'];
            $teacher['work_hours'] = $post['work_hours'];
            $teacher['category'] = $post['category'];

            $teacher['reason_type'] = $post['reason_type'];
            $teacher['action_type'] = $post['action_type'];
            $teacher['action_description'] = $post['action_description'];
            $teacher['speciality'] = $post['speciality'];
            $teacher['join_date'] = isset($post['join_date']) ? date('Y-m-d', strtotime($post['join_date'])) : null;
            $teacher['end_date'] = isset($post['end_date']) ? date('Y-m-d', strtotime($post['end_date'])) : null;
            $teacher['amie'] = $post['amie'];
            $teacher['disability'] = $post['disability'];
            $teacher['ethnic_group'] = $post['ethnic_group'];


            $teacher['province'] = $post['province'];
            $teacher['canton'] = $post['canton'];
            $teacher['parroquia'] = $post['parroquia'];
            $teacher['district'] = $post['district'];
            $teacher['dist_code'] = $post['dist_code'];
            $teacher['zone'] = $post['zone'];


            $teacher_repo = new TeacherRepository();

            $new_teacher = $teacher_repo->insert($teacher, USER_CREATION_TYPE_CMS);

            $this->repo->registrationRepo->flushAllCache();



        return response()->json(['teacher' => $new_teacher])->setStatusCode(201);

    }

    /**
     * @param TeacherUpdateRequest|Request $request
     * @param                              $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TeacherUpdateRequest $request, $id){

        $post = $request->all();

        $teacher['first_name'] = $post['first_name'];
        $teacher['last_name'] = $post['last_name'];

        $teacher['social_id'] = $post['social_id'];
        $teacher['cc'] = $post['cc'];

        if (isset($post['date_of_birth'])){
            $dob = DateTime::createFromFormat('d/m/Y', $post['date_of_birth']);
            $teacher['date_of_birth'] = $dob->format('Y-m-d');
        } else {
            $teacher['date_of_birth'] = null;
        }


        $teacher['gender'] = ucfirst($post['gender']);
        $teacher['telephone'] = $post['telephone'];
        $teacher['mobile'] = $post['mobile'];

        $teacher['inst_email'] = $post['inst_email'];
        $teacher['university_name'] = $post['university'];
        $teacher['function'] = $post['teacher_function'];
        $teacher['work_area'] = $post['work_area'];
        $teacher['work_hours'] = $post['work_hours'];
        $teacher['category'] = $post['category'];

        $teacher['reason_type'] = $post['reason_type'];
        $teacher['action_type'] = $post['action_type'];
        $teacher['action_description'] = $post['action_description'];
        $teacher['speciality'] = $post['speciality'];

        if (isset($post['join_date'])) {
            $joinDate = DateTime::createFromFormat('d/m/Y', $post['join_date']);
            $teacher['join_date'] = $joinDate->format('Y-m-d');
        } else{
            $teacher['join_date'] =  null;
        }

        if (isset($post['end_date'])) {
            $endDate = DateTime::createFromFormat('d/m/Y', $post['end_date']);
            $teacher['end_date'] = $endDate->format('Y-m-d');
        }{
            $teacher['end_date'] = null;
        }

        $teacher['amie'] = $post['amie'];
        $teacher['disability'] = $post['disability'];
        $teacher['ethnic_group'] = $post['ethnic_group'];

        $teacher['province'] = $post['province'];
        $teacher['canton'] = $post['canton'];
        $teacher['parroquia'] = $post['parroquia'];
        $teacher['district'] = $post['district'];
        $teacher['dist_code'] = $post['dist_code'];
        $teacher['zone'] = $post['zone'];


        $teacher_repo = new TeacherRepository();
        $new_teacher = $teacher_repo->update($teacher, $id);


        $this->repo->flushCache();
        $this->repo->flushCacheById($id);
        $this->repo->registrationRepo->flushAllCache();


        return response()->json(['teacher' => $new_teacher])->setStatusCode(200);


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function upload(Request $request){


        $cloud = Storage::disk();
        $path = $cloud->putFile('teacher', $request->file('qqfile'));

        $path = storage_path('app/'.$path);

        $teacherRepo = $this->repo;

        try {

            $rows = [];

             Excel::load($path, function ($reader) use(&$rows, $teacherRepo){


                foreach ($reader->toArray() as $row) {


                    $teacher['first_name'] = $row['nombres'];
                    $teacher['last_name'] = "";
                    $teacher['gender'] = ucfirst($row['genero']);
                    $teacher['social_id'] = $row['cedula'];

                    $teacher['cc'] = $row['c_c'];

                    $teacher['date_of_birth'] = date('Y-m-d', strtotime($row['fecha_nacimiento']));
                    $teacher['telephone'] = $row['telefono'];
                    $teacher['mobile'] = $row['celular'];
                    $teacher['moodle_id'] = '';
                    $teacher['inst_email'] = $row['correo_electronico'];
                    $teacher['email'] = $row['correo_electronico'];
                    $teacher['university_name'] = $row['institucion_educativa'];
                    $teacher['function'] = $row['funcion'];
                    $teacher['work_area'] = $row['regimen_laboral'];
                    $teacher['category'] = $row['categoria'];
                    $teacher['reason_type'] = $row['tipo_razon'];
                    $teacher['action_type'] = $row['tipo_accion'];
                    $teacher['action_description'] = $row['explicacion_accion'];
                    $teacher['speciality'] = $row['especialidad'];
                    $teacher['join_date'] = date('Y-m-d', strtotime($row['fecha_inicio']));
                    $teacher['end_date'] = isset($row['fecha_fin']) ? date('Y-m-d', strtotime($row['fecha_fin'])) : null;
                    $teacher['amie'] = $row['amie'];
                    $teacher['disability'] = $row['discapacidad'];
                    $teacher['ethnic_group'] = $row['etnia'];

                    $teacher['province'] = $row['provincia'];
                    $teacher['canton'] = $row['canton'];
                    $teacher['parroquia'] = $row['parroquia'];
                    $teacher['district'] = $row['distrito'];
                    $teacher['dist_code'] = $row['cod_distrito'];
                    $teacher['zone'] = $row['zona'];
                    $teacher['work_hours'] = '';

                    /**
                     * if social_id + inst_email found in teacher table
                     * -> update the data
                     * else
                     * -> create a user with the name, inst_email + add teacher data
                     */

                    $is_teacher_exist = $teacherRepo->isTeacherExist($row['cedula'] ,$row['correo_electronico']);

                    if ($is_teacher_exist==false){

                        $teacherRepo->insert($teacher, USER_CREATION_TYPE_IMPORT);
                        array_push($rows, $teacher);

                    }
                    else
                    {

                        $find_teacher = Teacher::where('social_id', $row['cedula'])->first();
                        $teacherRepo->update($teacher, $find_teacher->id);
                        array_push($rows, $teacher);

                    }

                    $this->repo->flushCache();

                }

            });

            return response()->json(['rows' => $rows, 'success' => true] );

        }
        catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage(), 'file' => $path]);
        }

    }

    public function showProfile($id){

        if ($id !== null){

            $teacher = $this->repo->findById($id);
            $title = $teacher->user->name . ' - ' . env('APP_NAME');

            return view('lms.admin.teacher.profile', ['teacher'=> $teacher, 'title' =>  $title]);
        } else {
            return response()->redirectTo(url('/admin/unauthorized'));

        }


    }


    /**
     * @TODO user canton repository and use cache
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByProvinceId($id){

        $cantons = Canton::where('province_id', $id)->get();

        return response()->json(['cantons'=> $cantons])->setStatusCode(200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){

        $teacher = Teacher::find($id);

        $result = $teacher->delete();

        return response()->json()->setStatusCode(204);

    }

}
