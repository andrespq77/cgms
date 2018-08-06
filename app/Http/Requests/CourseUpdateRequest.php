<?php

namespace App\Http\Requests;

use App\Course;
use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', Course::class);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $courseId = $this->route('id');
        return [

            'course_code'           => 'required|string|max:50|unique:courses,course_code,' . $courseId.',id',
            'course_type'           => 'required|integer|exists:course_types,id',
            'short_name'            => 'required|string|max:255',

            'start_date'            => 'sometimes|nullable|date_format:d/m/Y|string|max:10|min:10',
            'end_date'              => 'sometimes|nullable|date_format:d/m/Y|string|max:10|min:10',
            'grade_entry_start_date'=> 'sometimes|nullable|date_format:d/m/Y|string|max:10|min:10',
            'grade_entry_end_date'  => 'sometimes|nullable|date_format:d/m/Y|string|max:10|min:10',

            'master_course_id'      => 'required|integer|exists:master_courses,id',
            'university_id'         => 'sometimes|nullable|integer|exists:universities,id',

            'hours'                 => 'required|numeric|max:999999|min:1',
            'quota'                 => 'required|integer|max:999999|min:1',
            'course_stage'          => 'required|integer|between:0,1',
            'course_status'         => 'required|integer|between:0,1',


            'comment'               => 'sometimes|string|nullable|max:255',
            'description'           => 'sometimes|string|nullable|max:5000',
            'video_text'            => 'sometimes|string|nullable|max:5000',
            'video_type'            => 'sometimes|string:nullable|max:255',
            'video_code'            => 'sometimes|string|nullable|max:1000',

            'data_update_brief'     => 'sometimes|nullable|string:max:100',

        ];

    }
}
