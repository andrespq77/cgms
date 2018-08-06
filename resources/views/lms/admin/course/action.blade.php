<div class="btn-group btn-group-sm">

    @if(Auth::user()->role == 'admin')

        <button class="btn btn-edit-course btn-primary" id="course_edit_{{ $course->id }}"
                data-id="{{ $course->id }}"@include('lms.admin.course.data-attributes')>
                <i class="fa fa-edit"></i> {{ __('lms.elements.button.edit') }}
        </button>

        <button class="btn btn-remove btn-remove-course btn-default" data-id="{{ $course->id }}"
                title="{{ __('lms.elements.button.remove') }}" data-name="{{ $course->short_name }}"
                data-course_id="{{ $course->id }}"><i class="fa fa-trash"></i> {{ __('lms.elements.button.remove') }}
        </button>

    @elseif(Auth::user()->role == 'university')

        @if (Carbon\Carbon::now()->between(Carbon\Carbon::parse($course->grade_upload_start_date),
                                    Carbon\Carbon::parse($course->grade_upload_end_date)))
            <a href="{{ url("/admin/course/$course->id/show") }}"
               class="btn btn-success" data-id="{{ $course->id }}">
                <i class="fa fa-plus"></i> {{ __('lms.words.add_grade') }}</a>
        @endif


    @endif

    @if( Carbon\Carbon::now()->gt(Carbon\Carbon::parse($course->grade_upload_start_date)))
        <button class="btn btn-upload-diploma btn-info" data-id="{{ $course->id }}"
                title="{{ __('lms.elements.button.upload_diploma') }}"
                data-name="{{ $course->short_name }}" data-course_id="{{ $course->id }}">
            <i class="fa fa-cloud-upload"></i> {{ __('lms.elements.button.upload_diploma') }}
        </button>
    @endif

</div>