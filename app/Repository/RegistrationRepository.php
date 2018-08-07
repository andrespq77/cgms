<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 10/06/2018
     * Time: 8:08 PM
     */

    namespace App\Repository;


    use App\Registration;
    use Illuminate\Http\File;
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Storage;

    /**
     * Class RegistrationRepository
     *
     * @package App\Repository
     */
    class RegistrationRepository
    {

        /**
         * @param $courseId
         * @param $studentSocialSecurityId
         * @param $path
         * @return null
         */
        public function updateDiplomaFile($courseId, $studentSocialSecurityId, $path){

            $registration = Registration::where('course_id', $courseId)
                            ->where('user_social_id', $studentSocialSecurityId)
                            ->first();
            if ($registration){

                $registration->diploma_path = $path;
                $registration->save();

                return $registration;
            } else{
                Log::error('No Registration found for security id '.$studentSocialSecurityId);
                return null;
            }

        }

        //        $registrations = Cache::tags(['PENDING_REGISTRATION'])->remember('pending_registrations_by_page_'.$page, $minutes, function () {
//
//                 return Registration::with(['approvedBy', 'markApprovedBy', 'student', 'student.user',
//                     'course', 'course.university'])
//                     ->orderBy('is_approved', 'asc')
//                     ->orderBy('accept_tc', 'desc')
//                     ->orderBy('id', 'desc')
//                     ->paginate(10);
//
//        });

        /**
         * Search Filter
         *
         * @param $search_in
         * @param $search_keyword
         * @param $registration
         * @param $page
         * @return mixed
         */
        public function filter($search_in, $search_keyword, $registration, $page ,$type){

            $minutes = config('adminlte.cache_time');

            $user = getAuthUser();

            $cache_key = 'portfolio_search_in_'.$search_in. '_with_'.$search_keyword .
                '_with_registration_'.$registration .
                '_in_page_'.$page.'for_user_'.$user->id;

            $registrations = Cache::tags([$type])->remember($cache_key, $minutes, function () use($search_in, $search_keyword, $registration){

                return Registration::with(['student', 'course', 'course.university', 'student.user','markApprovedBy','approvedBy'])
                    ->where(function ($query) use($search_in, $search_keyword, $registration){

                        // if not all == 3 , then search registration with id
                        if($registration !== 3){
                            if ($registration == 1 || $registration == 0){
                                $query->where('is_approved', $registration);
                            }
                        }

                        if ($search_in == 'teachers_name'){
                            // teacher name search
                            $query->whereHas('student', function ($cQuery) use ($search_keyword){
                                $cQuery->where('first_name', 'LIKE', '%' . $search_keyword . '%')
                                    ->orWhere('last_name', 'LIKE', '%'.$search_keyword.'%');
                            });

                        } elseif ($search_in == 'social_id'){
                            // teacher social_id search
                            $query->whereHas('student', function ($cQuery) use ($search_keyword){
                                $cQuery->where('social_id', $search_keyword );
                            });

                        } elseif ($search_in == 'course_name'){

                            $query->whereHas('course', function ($cQuery) use ($search_keyword){
                                $cQuery->where('short_name', 'LIKE', '%' . $search_keyword . '%');
                            });

                        } elseif ($search_in == 'course_code'){

                            $query->whereHas('course', function ($cQuery) use ($search_keyword){
                                $cQuery->where('course_code',  $search_keyword );
                            });

                        } elseif ($search_in == 'all'){

                            $query->whereHas('student', function ($cQuery) use ($search_keyword){
                                $cQuery->where('first_name', 'LIKE', '%' . $search_keyword . '%')
                                    ->orWhere('last_name', 'LIKE', '%'.$search_keyword.'%')
                                    ->orWhere('social_id', $search_keyword);
                            });

                            $query->orWhereHas('course', function ($cQuery) use ($search_keyword){

                                $cQuery->where('short_name', 'LIKE', '%' . $search_keyword . '%')
                                    ->orWhere('course_code',  $search_keyword );
                            });

                        }

                    })
                    ->orderBy('updated_at', 'desc')
                    ->paginate(10);

            });


            return $registrations;

        }


        /**
         * @param $search_in
         * @param $search_keyword
         * @param $registration
         * @return mixed
         */
        public function downloadPortfolio($search_in, $search_keyword, $registration){

            $minutes = 20;

            $cache_key = 'portfolio_search_in_'.$search_in. '_with_'.$search_keyword .
                '_with_registration_'.$registration;

            $registrations = Cache::tags(['PORTFOLIO_ADMIN'])->remember($cache_key, $minutes, function ()
            use($search_in, $search_keyword, $registration) {

                return  Registration::with(['student', 'course', 'markApprovedBy','approvedBy'])
                    ->where(function ($query) use($search_in, $search_keyword, $registration){

                        // if not all == 3 , then search registration with id
                        if($registration !== 3){
                            if ($registration == 1 || $registration == 0){
                                $query->where('is_approved', $registration);
                            }
                        }

                        if ($search_in == 'teachers_name'){
                            // teacher name search
                            $query->whereHas('student', function ($cQuery) use ($search_keyword){
                                $cQuery->where('first_name', 'LIKE', '%' . $search_keyword . '%')
                                    ->orWhere('last_name', 'LIKE', '%'.$search_keyword.'%');
                            });

                        } elseif ($search_in == 'social_id'){
                            // teacher social_id search
                            $query->whereHas('student', function ($cQuery) use ($search_keyword){
                                $cQuery->where('social_id', $search_keyword );
                            });

                        } elseif ($search_in == 'course_name'){

                            $query->whereHas('course', function ($cQuery) use ($search_keyword){
                                $cQuery->where('short_name', 'LIKE', '%' . $search_keyword . '%');
                            });

                        } elseif ($search_in == 'course_code'){

                            $query->whereHas('course', function ($cQuery) use ($search_keyword){
                                $cQuery->where('course_code',  $search_keyword );
                            });

                        } elseif ($search_in == 'all'){

                            $query->whereHas('student', function ($cQuery) use ($search_keyword){
                                $cQuery->where('first_name', 'LIKE', '%' . $search_keyword . '%')
                                    ->orWhere('last_name', 'LIKE', '%'.$search_keyword.'%')
                                    ->orWhere('social_id', $search_keyword);
                            });

                            $query->orWhereHas('course', function ($cQuery) use ($search_keyword){

                                $cQuery->where('short_name', 'LIKE', '%' . $search_keyword . '%')
                                    ->orWhere('course_code',  $search_keyword );
                            });

                        }

                    })
                    ->orderBy('id', 'desc')
                    ->get();

            });


            return $registrations;
        }


        /**
         * @param $id
         * @return mixed
         */
        public function findById($id){

            $time = config('adminlte.cache_time');

            $registration = Cache::tags(['REGISTRATION_BY_ID'])->remember('REGISTRATION_BY_ID_'.$id, $time,
                function () use($id){

                    return Registration::with(['approvedBy', 'markApprovedBy', 'student', 'student.user',
                        'course', 'course.university'])
                    ->find($id);

                });

            return $registration;

        }

        /**
         * Generate Inspection Certificate FIle
         * @todo move the folder to university/course/certificate structure
         * @param Registration $registration
         */
        public function generateInspectionCertificate(Registration $registration){


            $certificate_filename = $registration->course->course_code . '_certificate_of_'.$registration->student->social_id.'.pdf';
            $root_path = 'app/course/certificate/';

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('lms.admin.registration.pdf.certificate', ['registration' => $registration]);
            $pdf->save(storage_path($root_path . $certificate_filename));

            $registration->registry_is_generated = true;
            $registration->certificate_path = storage_path($root_path . $certificate_filename);
            $registration->save();

            $this->flushRegistrationById($registration->id);

        }

        /**
         * @param $id
         */
        public function flushRegistrationById($id){

            Cache::tags(['REGISTRATION_BY_ID'])->flush('REGISTRATION_BY_ID_'.$id);

        }

        /**
         *
         */
        public function flushPendingRegistrationCache(){

            Cache::tags(['PENDING_REGISTRATION'])->flush();
        }

        public function flushRegistrationsCache(){

//            Cache::tags(['PENDING_REGISTRATION'])->flush();

        }


        public function flushPortfolioTeacherCache(){

            Cache::tags(['PORTFOLIO_TEACHER'])->flush();
        }

        public function flushPortfolioAdmin(){

            Cache::tags(['PORTFOLIO_ADMIN'])->flush();
        }

        public function flushAllCache(){

            $this->flushPortfolioAdmin();
            $this->flushPortfolioTeacherCache();
            $this->flushPendingRegistrationCache();

        }
    }