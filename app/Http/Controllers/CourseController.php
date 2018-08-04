<?php

namespace App\Http\Controllers;

use App\Course;
use App\Events\DiplomaUploaded;
use App\Http\Requests\CourseInsertRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Registration;
use App\Repository\CourseRepository;
use App\Repository\MasterCourseRepository;
use App\Repository\RegistrationRepository;
use App\Repository\UniversityRepository;
use DateTime;
use Dompdf\Image\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

use App\Canton;
use ZipArchive;

/**
 * Class CourseController
 *
 * @package App\Http\Controllers
 */
class CourseController extends Controller
{

    private  $repo;
    private  $masterCourseRepo;

    /**
     * CourseController constructor.
     */
    public function __construct()
    {
        $this->repo = new CourseRepository();
        $this->masterCourseRepo = new MasterCourseRepository();
    }

    /**
     * @todo add authorization check
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){

	
        $user = Auth::user();

        if ($user->can('browse', Course::class)){

            $posts = $request->all();

            $page = isset($posts['page']) ? $posts['page'] : 1;


            if ($user->role == 'admin'){

                $courses = $this->repo->paginate($page);


            } elseif ($user->role == 'university'){

                $courses = $this->repo->coursesByUniversity($page, $user->university->id);

            }


            $title = 'Course Management - '.env('APP_NAME') ;

            return view('lms.admin.course.index', ['title'=> $title, 'courses' => $courses]);

        } else {
            return response()->redirectTo(url('/admin/unauthorized'));

        }


    }


    public function create(){

        $title = 'Create Course';

        return view('lms.admin.course.create', ['title'=> $title]);

    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     * @deprecated
     */
    public function getTableData()
    {

        $user = Auth::user();

        if ($user->role == 'admin'){

            $course = Course::get();

        } elseif ($user->role == 'university'){

            $course = Course::where('university_id', $user->university->id)
                            ->get();
        }

        return Datatables::of($course)
            ->editColumn('action', 'lms.admin.course.action')
            ->setRowId(function ($course){
                return 'course_id_'.$course->id;
            })
            ->make(true);

    }


    /**
     * Insert new course from web request
     *
     * @param CourseInsertRequest|Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CourseInsertRequest $request){

        // @todo add authorization check

        $course = new Course();

        $post = $request->all();

        $course['master_course_id']             = $post['master_course_id'];
        $course['university_id']                = $post['university_id'];
        $course['course_type_id']               = $post['course_type'];
        $course['course_code']                  = $post['course_code'];
        $course['short_name']                   = $post['short_name'];
        $course['edition']                      = $post['course_edition'];

        if (isset($post['start_date'])) {
            $startDate = DateTime::createFromFormat('d/m/Y', $post['start_date']);
            $course['start_date'] = $startDate->format('Y-m-d');
        } else{
            $course['start_date'] =  null;
        }

        if (isset($post['end_date'])) {
            $startDate = DateTime::createFromFormat('d/m/Y', $post['end_date']);
            $course['end_date'] = $startDate->format('Y-m-d');
        } else{
            $course['end_date'] =  null;
        }

        if (isset($post['grade_entry_start_date'])) {
            $startDate = DateTime::createFromFormat('d/m/Y', $post['grade_entry_start_date']);
            $course['grade_upload_start_date'] = $startDate->format('Y-m-d');
        } else{
            $course['grade_upload_start_date'] =  null;
        }

        if (isset($post['grade_entry_end_date'])) {
            $startDate = DateTime::createFromFormat('d/m/Y', $post['grade_entry_end_date']);
            $course['grade_upload_end_date'] = $startDate->format('Y-m-d');
        } else{
            $course['grade_upload_end_date'] =  null;
        }

        $course['cost']                         = $post['cost'];
        $course['finance_type']                 = $post['finance_type'];
        $course['is_disclaimer']                = $post['is_disclaimer'];


        $course['hours']                        = $post['hours'];
        $course['quota']                        = $post['quota'];

        $course['stage']                        = $post['course_stage'];
        $course['status']                       = $post['course_status'];

        $course['comment']                      = $post['comment'];
        $course['description']                  = $post['description'];

        $course['video_text']                   = $post['video_text'];
        $course['video_type']                   = $post['video_type'];
        $course['video_code']                   = $post['video_code'];
        $course['data_update_brief']            = $post['data_update_text'];
        $course['terms_conditions']             = $post['terms_condition'];

        $course['inspection_form_generated']    = false;

        $newCourse = $this->repo->insert($course);

        return response()->json(['course' => $newCourse])->setStatusCode(201);
    }

    /**
     * @param CourseUpdateRequest|Request $request
     * @param                             $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CourseUpdateRequest $request, $id){

        $course = $this->repo->getById($id);

        if ($course){

            $post = $request->all();

            $course->master_course_id               = $post['master_course_id'];
            $course->university_id                  = $post['university_id'];
            $course->course_type_id                 = $post['course_type'];
            $course->short_name                     = $post['short_name'];
            $course->edition                        = $post['course_edition'];

            if (isset($post['start_date'])) {
                $startDate = DateTime::createFromFormat('d/m/Y', $post['start_date']);
                $course->start_date = $startDate->format('Y-m-d');
            } else{
                $course->start_date =  null;
            }

            if (isset($post['end_date'])) {
                $startDate = DateTime::createFromFormat('d/m/Y', $post['end_date']);
                $course->end_date = $startDate->format('Y-m-d');
            } else{
                $course->end_date =  null;
            }

            if (isset($post['grade_entry_start_date'])) {
                $startDate = DateTime::createFromFormat('d/m/Y', $post['grade_entry_start_date']);
                $course->grade_upload_start_date = $startDate->format('Y-m-d');
            } else{
                $course->grade_upload_start_date =  null;
            }

            if (isset($post['grade_entry_end_date'])) {
                $endDate = DateTime::createFromFormat('d/m/Y', $post['grade_entry_end_date']);
                $course->grade_upload_end_date = $endDate->format('Y-m-d');
            } else{
                $course->grade_upload_end_date =  null;
            }

            $course->has_disclaimer                 = $post['is_disclaimer'];
            $course->cost                           = $post['cost'];
            $course->finance_type                   = $post['finance_type'];

            $course->hours                          = $post['hours'];
            $course->quota                          = $post['quota'];

            $course->stage                          = $post['course_stage'];
            $course->status                         = $post['course_status'];

            $course->comment                        = $post['comment'];
            $course->description                    = $post['description'];

            $course->comment                        = $post['comment'];
            $course->video_text                     = $post['video_text'];
            $course->video_type                     = $post['video_type'];
            $course->video_code                     = $post['video_code'];
            $course->data_update_brief              = $post['data_update_text'];
            $course->terms_conditions               = $post['terms_condition'];

            $course->updated_by                     = Auth::user()->id;
            $course->save();

            $this->repo->flushById($id);
            $this->repo->flushCache();

            return response()->json(['course' => $course])->setStatusCode(200);

        } else{

            return response()->json(['error' => 'Not found'])->setStatusCode(404);
        }


    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){

//        @todo add authorization check
        $course = Course::find($id);
        $course->delete();

        $this->repo->flushById($id);
        $this->repo->flushCache();

        return response()->json()->setStatusCode(204);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadCourseList(Request $request){

        $cloud = Storage::disk();
        $path = $cloud->putFile('course/new_course_list', $request->file('qqfile'));

        $path = storage_path('app/'.$path);

        $uniRepo = new UniversityRepository();

        $courseRepository = $this->repo;

        try {
            $rows = [];

            Excel::load($path, function ($reader) use(&$rows, $courseRepository, $uniRepo){

                foreach ($reader->toArray() as $row) {


                    $master_course = $this->masterCourseRepo->findbyCode($row['master_course_code']);

                    $course['master_course_id']             = $master_course->id;

                    $course['university_id']                = $row['university_id'];
                    $course['course_code']                  = $row['course_code'];
                    $course['course_type_id']               = $row['modality_id'];
                    $course['short_name']                   = $row['short_name'];
                    $course['edition']                      = isset($row['course_edition']) ? $row['course_edition']: '';

                    $course['start_date']                   = isset($row['start_date']) ? $row['start_date']: null;
                    $course['end_date']                     = isset($row['end_date']) ? $row['end_date'] : null;
                    $course['grade_upload_start_date']      = isset($row['grade_add_start_date']) ? $row['grade_add_start_date']: null;
                    $course['grade_upload_end_date']        = isset($row['grade_add_end_date']) ? $row['grade_add_end_date']: null;

                    $course['cost']                         = isset($row['cost']) ? : '0';
                    $course['finance_type']                 = isset($row['finance_type']) ? $row['finance_type']: '0';
                    $course['is_disclaimer']                = $row['disclaimer_required'] == 'yes' ? '1' : '0';

                    $course['hours']                        = isset($row['hours']) ? : '0';
                    $course['quota']                        = isset($row['quota']) ? : '0';

                    $course['stage']                        = $row['stage'] == 'published' ? '1' : '0';
                    $course['status']                       = $row['status'] == 'active' ? '1' : '0';

                    $course['comment']                      = isset($row['comment']) ? $row['comment']: '';
                    $course['description']                  = isset($row['description']) ? $row['description']: '';

                    $course['video_text']                   = isset($row['video_information']) ? $row['video_information']: '';
                    $course['video_type']                   = 'youtube';
                    $course['video_code']                   = isset($row['embed_code']) ? $row['embed_code'] : '';
                    $course['data_update_text']             = isset($row['data_update']) ? $row['data_update'] : '';
                    $course['terms_conditions']             = isset($row['terms_and_conditions']) ? $row['terms_and_conditions'] : '';


                    array_push($rows, $course);

                    $courseRepository->insert($course);

                }

            });

            $this->repo->flushCache();

            return response()->json(['rows' => $rows, 'success' => true] );

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage(), 'file' => $path]);
        }

    }

    /**
     *
     * @param Request $request
     * @return array
     */
    public function uploadInspection(Request $request) {


        $cloud = Storage::disk();

        $filename = "course_".$request->input('course_id').'_inspection_form.'.$request->file('qqfile')->extension();
        $path = $cloud->putFileAs('course/inspection', $request->file('qqfile'), $filename);

        $path = storage_path('app/'.$path);

        $course = $this->repo->getById($request->input('course_id'));

        $course->inspection_form_generated  = true;
        $course->save();

        return response()->json(['path'=> $path, 'success' => true]);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(Request $request) {


        $course = $this->repo->getById($request->input('course_id'));

        $root_path = 'course/university_'.$course->university->id.'/course_'.$request->input('course_id');
        $path = '';

        $type = $request->input('type');

        if ($type == 'terms_and_condition'){

            $path = $root_path.'/terms_and_condition';
            $filename = "course_".$request->input('course_id').'_tnc.'.$request->file('qqfile')->extension();

            $cloud = Storage::disk('public');
            $path = $cloud->putFileAs($path, $request->file('qqfile'), $filename);

            $course->tc_file_path  = $path;
            $course->save();


        } elseif ($type == 'lor'){

            $path = $root_path.'/lor';
            $filename = "course_".$request->input('course_id').'_lor.'.$request->file('qqfile')->extension();

            $cloud = Storage::disk();
            $path = $cloud->putFileAs($path, $request->file('qqfile'), $filename);

            $course->lor_file_path  = storage_path('app/'.$path);
            $course->save();

        } elseif ($type == 'diploma'){

            $path = $root_path.'/diploma';
            $filename = "course_".$request->input('course_id').'_diploma.'.$request->file('qqfile')->extension();

            $cloud = Storage::disk();
            $pathFile = $cloud->putFileAs($path, $request->file('qqfile'), $filename);

            if ($request->file('qqfile')->extension() == 'zip'){
                
                // extract the file in the event
                event(new DiplomaUploaded($path, $pathFile, $course->id));

                return response()->json(['path'=> $path, 'success' => true]);
            }

        } elseif ($type == 'disclaimer'){

            $path = $root_path.'/disclaimer';
            $filename = "course_".$request->input('course_id').'_disclaimer.'.$request->file('qqfile')->extension();

            $cloud = Storage::disk();
            $path = $cloud->putFileAs($path, $request->file('qqfile'), $filename);

            $course->disclaimer_file  = storage_path('app/'.$path);
            $course->save();

        }

        $this->repo->flushById($request->input('course_id'));

        return response()->json(['path'=> $path, 'success' => true]);


    }



    /**
     * @param         $course_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister($course_id){

        $title = 'Register - '.env('APP_NAME') ;

        $authUser = Auth::user();
        $teacher = $authUser->teacher;

        /**
         * find registration with course_id and teacher id
         *
         * if found( return registration
         * if not found, create registration and return code
         */

        $registration = Registration::where('teacher_id', $teacher->id)
            ->where('course_id', $course_id)
            ->first();


        if ($registration == null){

            $registration = new Registration();
            $registration->course_id = $course_id;
            $registration->teacher_id = $teacher->id;
            $registration->user_social_id = $teacher->social_id;
            $registration->user_first_name = $teacher->user->name;
            $registration->inspection_certificate = '';
            $registration->inspection_certificate_signed = false;
            $registration->reg_date     = null;
            $registration->accept_tc     = REGISTRATION_ACCEPT_TERMS_AND_CONDITION_FALSE;
            $registration->registry_is_generated = REGISTRATION_REGISTRY_IS_NOT_GENERATED;
            $registration->registry_is_generated = REGISTRATION_REGISTRY_IS_NOT_GENERATED;

            $registration->status = REGISTRATION_STATUS_STARTED;
            $registration->is_approved = REGISTRATION_IS_NOT_APPROVED;
            $registration->is_approved = REGISTRATION_IS_NOT_APPROVED;

            $registration->save();
        }


        return view('lms.admin.course.register', ['title'=> $title,
            'teacher' => $teacher,
            'registration' => $registration,
            'course' => $teacher->getRequestedCourse($course_id)->first()]);

    }

    /**
     * @param Request $request
     * @return array
     */
    public function getSearch(Request $request){

        return ['request'=> $request->all()];
    }


    /**
     * @param $courseId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddMarkPage($courseId){

        $course = $this->repo->getById($courseId);

        $title = 'Course Grade Upload - '.env('APP_NAME') ;
        return view('lms.admin.course.grade', ['title' => $title, 'course' => $course]);

    }

    /**
     * @param Request $request
     * @param         $course_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAddMark(Request $request, $course_id){

        $user = getAuthUser();
        $course = $this->repo->getById($course_id);

        if ($user->can('addmark', $course)){

            $cloud = Storage::disk();

            $filename = 'grade_of_'.$course->course_code.'_'.date('Ymdhi', strtotime('now'));
            $path = $cloud->putFileAs('course/university_'.$course->university->id.'/grade',
                        $request->file('qqfile'), $filename.'.'.$request->file('qqfile')->extension());

            $path = storage_path('app/'.$path);

            try {
                $rows = [];

                Excel::load($path, function ($reader) use(&$rows, $user){

                    foreach ($reader->toArray() as $row) {

                        $courseId = (string)$row['system_id'];
                        $getCourse = $this->repo->findById($courseId);


                        // if the course id received from the file has permission for this user to update mark
                        if ($user->can('update_grade', $getCourse)){

                            // if grade is valid
                            if (is_numeric($row['grade'])){
                                $newRegistration = $this->repo->updateGrade(
                                    trim($getCourse->id),
                                    trim($row['teacher_cedula']),
                                    $row['grade'],
                                    (string)$row['grade_approved'],
                                    $user);

                                array_push($rows, $newRegistration);
                            }
                        }

                    }

                });

                $this->repo->flushById($course_id);
                $registrationRepo = new RegistrationRepository();
                $registrationRepo->flushAllCache();

                return response()->json(['rows' => $rows, 'success' => true] );

            } catch (\Exception $e) {

                return response()->json(['error' => $e->getMessage(),'rows' => $rows, 'file' => $path])->setStatusCode(422);
            }

        }
        else {
            //send 403 json response
            return response()->json(['error'=> 'Unauthorized'])->setStatusCode(403);
        }

    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function downloadLor($id){

        if(Auth::check()) {

            $course = $this->repo->getById($id);

            if ($course) {

                return response()->file($course->lor_file_path);

            } else {
                return response()->redirectTo(url('/admin/unauthorized'));

            }

        }

    }

    /**
     * Download Course Template
     *
     * @param $courseId
     */
    public function downloadGradeTemplate($courseId){

        $course = $this->repo->findById($courseId);

        $headers = [
            'System id',
            'Registration id',
            'Registration date',
            'Course Code',
            'Course Name',
            'Teacher Cedula',
            'Teacher Name',
            'Terms Accepted',
            'Inspection Form Upload',
            'Registration Approval time',
            'Approved By',
            'grade',
            'grade approved'
        ];

        $rows = [];

        array_push($rows, $headers);

        foreach ($course->registrations->sortByDesc('approval_time') as $registration){

            $row = [
                $registration->course_id,
                $registration->id,
                $registration->reg_date,
                $registration->course->course_code,
                $registration->course->short_name,
                $registration->student->social_id,
                $registration->student->first_name,
                isset($registration->tc_accept_time) ? $registration->tc_accept_time : 'not accepted',
                isset($registration->inspection_certificate_upload_time) ? $registration->inspection_certificate_upload_time : 'not uploaded',
                isset($registration->approval_time) ? $registration->approval_time : 'not approved',
                isset($registration->approved_by) ? $registration->approvedBy->name : '',
                '0',
                1
            ];

            array_push($rows, $row);
        }


        Excel::create("course_".$course->course_code."_grade_template", function($excel) use ($rows, $course) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Grade Insert Template for '.$course->short_name);
            $excel->setCreator('CGMS')->setCompany('AppioLab.com');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($rows) {
                $sheet->fromArray($rows, null, 'A1', false, false);
            });

        })->download('xlsx');


    }


}
