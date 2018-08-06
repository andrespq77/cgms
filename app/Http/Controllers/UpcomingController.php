<?php

namespace App\Http\Controllers;

use App\Course;
use App\Repository\CourseRepository;
use App\Repository\MasterCourseRepository;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

use App\Canton;

/**
 * Class UpcomingController
 *
 * @package App\Http\Controllers
 */
class UpcomingController extends Controller
{
    private $courseRepo;

    public function __construct()
    {
        $this->courseRepo = new CourseRepository();
    }

    /**
     * @todo add authorization check
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $user = Auth::user();

        if ($user->can('upcoming', Course::class)){

            $title = 'Upcoming Course List - '.env('APP_NAME') ;


            return view('lms.admin.teacher.upcoming', ['title'=> $title,
                'teacher' => $user->teacher]);
        } else {

            return response()->redirectTo(url('/admin/unauthorized'));
        }

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function uploadCourseRequest(Request $request) {

        $cloud = Storage::disk();
        $path = $cloud->putFile('course/request', $request->file('qqfile'));

        $path = storage_path('app/'.$path);

        try {
            $rows = [];

            Excel::load($path, function ($reader) use(&$rows){

                foreach ($reader->toArray() as $row) {

                    if (strlen($row['teacher_social_id']) > 0 && strlen($row['course_code']) >0){

                        $teacher['course_id']       = $this->getCourseId($row['course_code']);
                        $teacher['course_code']     = $row['course_code'];
                        $teacher['teacher_id']      = $this->getTeacherId($row['teacher_social_id']);
                        $teacher['teacher_social_id'] = $row['teacher_social_id'];
                        $teacher['created_by']      = Auth::user()->id;
                        $teacher['status']          = $row['status'];


                        array_push($rows, $teacher);
                    }

                }

            });

            // batch insert
            DB::table('course_requests')->insert($rows);

            // @todo after adding all items into an array, add the array to database in batch
            return response()->json(['rows' => $rows, 'success' => true] );

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage(), 'file' => $path,
                'user' => Auth::user()->id]);
        }

    }


    /**
     * @param $social_id
     * @return mixed
     */
    private function getTeacherId($social_id) {


        $teacher = Teacher::where('social_id', $social_id)->first();

        return $teacher->id;

    }

    /**
     * @param $course_code
     * @return mixed
     */
    private function getCourseId($course_code) {

        $course = $this->courseRepo->findByCourseCode($course_code);

        return $course->id;

    }



}
