<?php

namespace App\Http\Requests;

use App\Teacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TeacherStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->user()->can('create', Teacher::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'social_id' => 'required|unique:teachers|string|max:30|min:5',
            'cc' => 'required|string|max:50',

            'date_of_birth' => 'sometimes|nullable|date_format:d/m/Y|string|max:10|min:10',
            'gender' => 'required|string|max:1|min:1',
            'email' => 'required|email|unique:users|max:100',
            'telephone' => 'string|nullable|max:50',
            'mobile' => 'string|nullable|max:50',


            'university'    => 'required|string:max:255',
            'inst_email' => 'required|email|unique:teachers|max:100',
            'join_date' => 'sometimes|nullable|date_format:d/m/Y|string|max:10|min:10',
            'end_date' => 'sometimes|nullable|date_format:d/m/Y|string|max:10|min:10',
            'amie'  => 'sometimes|nullable|string:max:50',

            'function'  => 'sometimes|nullable|string:max:100',
            'work_area'  => 'sometimes|nullable|string:max:100',
            'category'  => 'sometimes|nullable|string:max:100',
            'reason_type'  => 'sometimes|nullable|string:max:100',
            'action_type'  => 'sometimes|nullable|string:max:100',
            'action_description'  => 'sometimes|nullable|string:max:255',
            'speciality'  => 'sometimes|nullable|string:max:100',

            'disability'  => 'sometimes|nullable|string:max:100',
            'ethnic_group'  => 'sometimes|nullable|string:max:100',

            'province'  => 'sometimes|nullable|string:max:100',
            'canton'  => 'sometimes|nullable|string:max:100',
            'parroquia'  => 'sometimes|nullable|string:max:100',
            'district'  => 'sometimes|nullable|string:max:100',
            'district_code'  => 'sometimes|nullable|string:max:10',
            'zone'  => 'sometimes|nullable|string:max:10',


        ];
    }
}
