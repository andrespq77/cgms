<?php

namespace App\Listeners;

use App\Course;
use App\Events\DiplomaUploaded;
use App\Repository\CourseRepository;
use App\Repository\RegistrationRepository;
use Carbon\Carbon;
use Chumper\Zipper\Zipper;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Class ExtractDiplomaFile
 *
 * @package App\Listeners
 */
class ExtractDiplomaFile
//class ExtractDiplomaFile implements ShouldQueue

{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param DiplomaUploaded $diploma
     * @return void
     * @internal param object $event
     */
    public function handle(DiplomaUploaded $diploma)
    {

        // extract the file here and update registration file
        Storage::makeDirectory('app/'.$diploma->path.'/zip');

        $zip = new Zipper;
        $zip->make(storage_path('app/'.$diploma->filePath))
            ->extractTo(storage_path('app/'.$diploma->path.'/zip'));

//        @todo after updating files, add a diploma Uploaded flat in course record
        if(Storage::exists($diploma->path.'/zip')) {

            $files = Storage::allFiles($diploma->path.'/zip');

        } else {

            $files = Storage::allFiles($diploma->path);
        }

        $registrationRepo = new RegistrationRepository();

        $diploma_upload = false;

        foreach ($files as $file){

//            $socialId = pathinfo(basename(basename($file)), PATHINFO_FILENAME);;
            $socialId = pathinfo($file, PATHINFO_FILENAME);

            $fullPath = 'app/'.$file;
            $fullPathDiploma = 'app/'.$diploma->path .'/' . $socialId . '.pdf';
            Log::info('File data', ['socialId' => $socialId, 'full path: '=> $fullPath]);
            $registrationRepo->updateDiplomaFile($diploma->courseId, $socialId, $fullPath,$fullPathDiploma);

            $diploma_upload = true;

        }

        exec('rm -r ' . storage_path() . '/' . 'app/'.$diploma->path.'/zip');

        if ($diploma_upload == true){

            $courseRepo = new CourseRepository();
            $user = getAuthUser();

            $course = $courseRepo->getById($diploma->courseId);
            $course->diploma_upload_time = Carbon::now();
            $course->diploma_uploaded = true;
            $course->diploma_uploaded_by_id = $user->id;
            $course->save();
            Log::info('Course '.$course->id. ': Diploma upload data updated', ['course_id' => $diploma->courseId] );

//            @todo use a tag based cache and flash that

        } else{
            Log::warning('Course '.$diploma->courseId.' : No Diploma files was found' , ['course_id' => $diploma->courseId]);

        }




    }
}
