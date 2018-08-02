<?php

namespace App\Http\Controllers;

use App\Events\RegistrationApproved;
use App\Registration;
use App\Repository\RegistrationRepository;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Province;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Canton;

/**
 * Class UniversityController
 *
 * @package App\Http\Controllers
 */
class RegistrationController extends Controller
{
    private  $repo;

    public function __construct()
    {
        $this->repo = new RegistrationRepository();
    }


    public function index(){

        $title = 'Registration Management - '.env('APP_NAME') ;

        return view('lms.admin.university.index',
                ['title'=> $title]);

    }


    /**
     * @TODO move to a repository and clear cache accordingly
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPending(Request $request){

        $title = 'Pending Registration Management - '.env('APP_NAME') ;

        $posts = $request->all();
        $minutes = config('adminlte.cache_time');
        $page = isset( $posts['page'] ) ? $posts['page'] : 1 ;

        $registrations = Cache::tags(['PENDING_REGISTRATION'])->remember('pending_registrations_by_page_'.$page, $minutes, function () {

                 return Registration::with(['approvedBy', 'markApprovedBy', 'student', 'student.user',
                     'course', 'course.university'])
                     ->orderBy('is_approved', 'asc')
                     ->orderBy('accept_tc', 'desc')
                     ->orderBy('id', 'desc')
                     ->paginate(10);

        });

        return view('lms.admin.registration.pending',
            ['title'=> $title, 'registrations' => $registrations]);

    }

    /**
     * Proceed to the course action
     * for those course which no need any disclaimer
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postProceedToTheCourse(Request $request){

        $posts = $request->all();
        $authUser = Auth::user();
        $teacher = $authUser->teacher;


        /**
         * find registration with course_id and teacher id
         *
         * if found( return registration
         * if not found, create registration and return code
         */

        $registration = Registration::where('teacher_id', $posts['teacher_id'])
            ->where('course_id', $posts['course_id'])
            ->first();


        if ($registration == null){

            $registration = new Registration();
            $registration->course_id = $posts['course_id'];
            $registration->teacher_id = $teacher->id;
            $registration->user_social_id = $teacher->social_id;
            $registration->user_first_name = $teacher->user->name;
            $registration->inspection_certificate = '';
            $registration->inspection_certificate_signed = false;
            $registration->reg_date     = Carbon::today();
            $registration->accept_tc     = REGISTRATION_ACCEPT_TERMS_AND_CONDITION_TRUE;
            $registration->tc_accept_time   = Carbon::now();
            $registration->registry_is_generated = REGISTRATION_REGISTRY_IS_NOT_GENERATED;
            $registration->registry_is_generated = REGISTRATION_REGISTRY_IS_NOT_GENERATED;

            $registration->status = REGISTRATION_STATUS_STARTED;
            $registration->is_approved = REGISTRATION_IS_NOT_APPROVED;
            $registration->is_approved = REGISTRATION_IS_NOT_APPROVED;

            $registration->save();

        }

        $result = DB::table('course_requests')
            ->where('course_id', $posts['course_id'])
            ->where('teacher_id', $posts['teacher_id'])
            ->update(['status' => COURSE_REQUEST_ACCEPTED]);

        $this->repo->flushAllCache();


        return response()->json(['registration' => $registration, 'course_request' => $result]);
    }

    /**
     * @param Request $request
     * @param         $registrationId
     * @param         $part
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRegistration(Request $request, $registrationId, $part)
    {

        $post = $request->all();

        $registration = $this->repo->findById($registrationId);;

        $current_time = Carbon::now()->toDateTimeString();

        if ($part == 'accept'){

            $registration->accept_tc = $post['accept_tc'] == true ? REGISTRATION_ACCEPT_TERMS_AND_CONDITION : REGISTRATION_ACCEPT_TERMS_AND_CONDITION_FALSE;

            $registration->reg_date = date('Y-m-d', strtotime('now'));
            $registration->tc_accept_time = $current_time;
            $registration->status = REGISTRATION_STATUS_ACCEPT;
            $registration->save();

        } elseif( $part == 'approve'){

            $registration->is_approved= REGISTRATION_IS_APPROVED;
            $registration->approval_time= $current_time;
            $registration->approved_by= Auth::user()->id;
            $registration->status = REGISTRATION_STATUS_COMPLETE;

            $registration->save();

            event(new RegistrationApproved($registration));

        } elseif($part == 'user-data'){

            $registration->user_first_name = $post['first_name'];
            $registration->user_last_name = $post['last_name'];
            $registration->email= $post['email'];
            $registration->cell_phone = $post['phone'];

            $this->repo->flushRegistrationById($registrationId);

            $registration->save();
        }

        $this->repo->flushRegistrationById($registrationId);
        $this->repo->flushAllCache();


        return response()->json(['registration' => $registration,
            'adminUser' => Auth::user()->name]);
    }


    /**
     * @param Request $request
     * @param         $registrationId
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadStudentInspection(Request $request, $registrationId){

        $cloud = Storage::disk();

        $filename = "course_".$registrationId.'_teacher_'.$request->input('teacher_id').'_inspection_signed_certificate.'.$request->file('qqfile')->extension();
        $path = $cloud->putFileAs('course/signed_certificates', $request->file('qqfile'), $filename);

        $path = storage_path('app/'.$path);


        $registration = $this->repo->findById($registrationId);

        $current_time = Carbon::now()->toDateTimeString();
        $registration->inspection_certificate = $path;
        $registration->inspection_certificate_signed = REGISTRATION_INSPECTION_CERTIFICATE_SIGNED;
        $registration->inspection_certificate_upload_time = $current_time;
        $registration->status = REGISTRATION_STATUS_SIGNED;
        $registration->save();

        $this->repo->flushRegistrationById($registrationId);


        /**
         * Update the course request status
         */
        DB::table('course_requests')
            ->where('course_id', $registration->course_id)
            ->where('teacher_id', $registration->teacher_id)
            ->update(['status' => COURSE_REQUEST_ACCEPTED]);

        return response()->json(['path'=> $path, 'success' => true]);

    }


    /**
     * @todo add registration policy
     *
     * @param $registrationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function downloadStudentInspectionCertificate($registrationId){


        $registration  = $this->repo->findById($registrationId);


        if ($registration){

            return response()->file($registration->inspection_certificate);

        } else {
            return response()->redirectTo(url('/admin/unauthorized'));

        }

    }

    /**
     * @todo add registration policy
     *
     * @param $registrationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function downloadStudentCertificate($registrationId){

        $registration  = $this->repo->findById($registrationId);

        if ($registration){

            if (file_exists($registration->certificate_path)) {
                return response()->file($registration->certificate_path);
            } else {
                $this->repo->generateInspectionCertificate($registration);
                return response()->file($registration->certificate_path);
            }

        } else {
            return response()->redirectTo(url('/admin/unauthorized'));

        }

    }

    /**
     * @param $registrationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function downloadStudentDiploma($registrationId){

        $minutes = config('adminlte.cache_time');

        $registration = Cache::tags(['REGISTRATION_BY_ID'])->remember('REGISTRATION_BY_ID_'.$registrationId, $minutes,
            function () use($registrationId){

                return Registration::find($registrationId);

            });

        if ($registration){

            // if user  = teacher update download time
            $user = Auth::user();

            if ($user->role == 'teacher'){
                $registration->diploma_download_time = now();
                $registration->save();
            }

            $this->repo->flushRegistrationById($registrationId);
            $this->repo->flushAllCache();


            return response()->file($registration->diploma_path);

        } else {
            return response()->redirectTo(url('/admin/unauthorized'));

        }

    }

}
