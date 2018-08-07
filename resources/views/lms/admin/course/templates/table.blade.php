<table class="table table-responsive table-borderless" id="course-table">
    <thead>
        <tr>
            <th>{{ __('lms.page.course.table.master_course') }}</th>
            <th>{{ __('lms.page.course.form.university') }}</th>
            <th>{{ __('lms.page.course.table.short_name') }}</th>
            <th>{{ __('lms.page.course.table.modality') }}</th>
            <th>{{ __('lms.page.course.form.quota') }}</th>
            <th>{{ __('lms.page.course.table.hours') }}</th>
            <th>{{ __('lms.page.course.table.start_date') }}</th>
            <th>{{ __('lms.page.course.table.end_date') }}</th>
            <th>{{ __('lms.page.course.table.quota') }}</th>
            <th>{{ __('lms.page.course.table.stage') }}</th>
            <th>{{ __('lms.page.course.table.status') }}</th>

            @if(Auth::user()->role == 'university')
                <th>{{ __('lms.words.add_grade') }}</th>
            @endif
            <th>{{ __('lms.words.last_updated') }}</th>
            <th class="text-right">{{ __('lms.page.course.table.action') }}</th>
        </tr>
    </thead>
    <tbody>

        @foreach($courses as $course)
            <tr id="course_id_{{ $course->id }}">
                <td>{{ isset($course->masterCourse->name) ? $course->masterCourse->name: '' }}<br/>
                    <small class="text-info">({{ isset($course->masterCourse->subject->title) ? $course->masterCourse->subject->title:'' }})</small>
                </td>
                <td>{{ $course->university->name }}</td>
                <td>
                    <a href="{{ url("/admin/course/$course->id/show") }}">{{ $course->short_name }} </a>&nbsp;
                    <small class="text-muted">[{{ $course->id }}]</small><br/>
                    <small><code>{{ $course->course_code }}</code></small>&nbsp;
                    <small class="text-info">{{ $course->edition }}</small>
                </td>
                <td>{{ isset($course->modality->title) ? $course->modality->title : '' }}</td>
                <td>{{ __('lms.page.course.form.quota') }} <small> <span class="badge">{{ $course->quota }}</span></small><br/>
                    {{ __('lms.page.course.form.registrations') }} <small><span class="badge">{{ $course->registrations->count() }}</span></small>
                </td>
                <td>{{ $course->hours }}</td>
                <td>{{ date('d M, Y', strtotime($course->start_date)) }}</td>
                <td>{{ date('d M, Y', strtotime($course->end_date)) }}</td>
                <td><span class="badge">{{ $course->quota }}</span></td>
                <td><span class="label label-{{ $course->stageTitle['class'] }}">
                                            {{ $course->stageTitle['title'] }}</span></td>
                <td><span class="label label-{{ $course->statusTitle['class'] }}">
                                            {{ $course->statusTitle['title'] }}</span></td>
                @if(Auth::user()->role == 'university')
                    <td>
                        @isset($course->grade_upload_start_date)
                        <span class="text-success">Start Date: {{ date('d M, Y', strtotime($course->grade_upload_start_date)) }}</span><br/>
                        @endisset
                        @isset($course->grade_upload_end_date)
                        <span class="text-danger">End Date: {{ date('d M, Y', strtotime($course->grade_upload_end_date)) }}</span>
                        @endisset
                    </td>
                @endif
                <td>{{ $course->updated_at->diffForHumans() }}<br/>
                    <small class="text-muted">{{ __('lms.words.by') }} {{ $course->updatedBy->name }}</small></td>
                <td class="text-right">
                    @include('lms.admin.course.action')
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
