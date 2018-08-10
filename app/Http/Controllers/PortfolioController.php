<?php

namespace App\Http\Controllers;

use App\Registration;
use App\Repository\RegistrationRepository;
use App\Repository\TeacherRepository;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class PortfolioController
 *
 * @package App\Http\Controllers
 */
class PortfolioController extends Controller
{

    private $repo;

    public function __construct()
    {
        $this->repo = new RegistrationRepository();
    }



    /**
     * @todo add guard policy
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function teachers(Request $request){

        $user = Auth::user();

        $page = $request->input('page') == null ? 1: $request->input('page');

        if ($user->role == 'admin'){

            $title = 'Teacher Portfolio - '.env('APP_NAME') ;

            $search_in      = $request->input('search_param');
            $search_keyword = $request->input('x');
            $registration   = $request->input('registration') == null ? 3 : $request->input('registration');

            $this->repo->flushPortfolioAdmin();

            $registrations = $this->repo->filter($search_in, $search_keyword, $registration, $page,'PORTFOLIO_ADMIN');

            return view('lms.admin.portfolio.all', ['title'=> $title,
                                                    'registrations' => $registrations]);

        } elseif ($user->role == 'teacher'){

            $title = 'My Portfolio - '.env('APP_NAME') ;

            $this->repo->flushPortfolioTeacherCache();

            $teacherRepo = new TeacherRepository();
            $teacherRepo->flushCache();
            $teacher = $teacherRepo->findById($user->teacher->id);

            return view('lms.admin.teacher.profile', ['teacher'=> $teacher, 'title' =>  $title]);

        }

    }

    /**
     * @param Request $request
     */
    public function download(Request $request){

        $search_in      = $request->input('search_param');
        $search_keyword = $request->input('x');
        $registration   = $request->input('registration') == null ? 3 : $request->input('registration');


//        $teacher_repo = new TeacherRepository();
        $registrations = $this->repo->downloadPortfolio($search_in, $search_keyword, $registration);

        $header = [
            'Id',
            'Social Id',
            'Name',
            'Course Type',
            'Course Name',
            'University',
            'Start Date',
            'End Date',
            'Form Uploaded',
            'Approve',
            'Approve By',
            'Grade',
            'Grade Approved At',
            'Grade Approved By',
            'Diploma Downloaded At',
        ];

        $rows = [];

        array_push($rows, $header);

        foreach($registrations as $registration){

            $row = [
                $registration->id,
                $registration->student->social_id,
                $registration->student->first_name,
                $registration->course->course_type,
                $registration->course->short_name,
                $registration->course->university->name,
                date('d/m/Y', strtotime($registration->course->start_date)),
                date('d/m/Y', strtotime($registration->course->end_date)),
                $registration->inspection_certificate == REGISTRATION_INSPECTION_CERTIFICATE_SIGNED ? $registration->inspection_certificate_upload_time: '',
                $registration->is_approved == REGISTRATION_IS_APPROVED ? 'YES': 'NO',
                $registration->approvedBy !== null ? $registration->approvedBy->name : '',
                $registration->mark !== null ? $registration->mark.'/100' : '',
                $registration->mark_upload_time !== null ? date('d/m/Y', strtotime($registration->mark_upload_time))  : '',
                $registration->markApprovedBy !== null ? $registration->markApprovedBy->name : '',
                $registration->diploma_download_time !== null ? date('d/m/Y h:ia', strtotime($registration->diploma_download_time)) : ''
            ];

            array_push($rows, $row);

        }

        Excel::create('teacher_portfolio', function($excel) use($rows) {

            $excel->sheet('Sheet 1', function($sheet) use($rows) {

                $sheet->fromArray($rows);

                $sheet->setOrientation('landscape');

            });

            $excel->setTitle('Teacher Portfolio - CGMS');

            // Chain the setters
            $excel->setCreator('Ariful Haque <arifulhb@gmail.com>')
                ->setCompany('AppioLab');

        })->export('xls');


    }


}
