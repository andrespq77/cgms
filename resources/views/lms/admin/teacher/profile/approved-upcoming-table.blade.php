<table class="table table-borderless table-responsive table-hover" id="upcoming-course">
    <thead>
    <tr>
        {{--        <th>{{ __('lms.page.upcoming.table.institution') }}</th>--}}
        <th>{{ __('lms.page.upcoming.table.short_name') }}</th>
        <th>{{ __('lms.page.upcoming.table.modality') }}</th>
        {{--        <th>{{ __('lms.page.course.form.quota') }}</th>--}}
        <th>{{ __('lms.page.upcoming.table.hours') }}</th>
        <th>{{ __('lms.page.upcoming.table.start_date') }}</th>
        <th>{{ __('lms.page.upcoming.table.end_date') }}</th>
        {{--<th>{{ __('lms.page.course.table.stage') }}</th>--}}
        <th>{{ __('lms.page.course.table.status') }}</th>
        <th>{{ __('lms.page.upcoming.table.action') }}</th>
        <th>{{ __('lms.page.registration.pending.table.record_uploaded') }}</th>
        <th>{{ __('lms.page.teacher.table.approved') }}</th>
        <th>{{ __('lms.page.teacher_profile.table.certificate') }}</th>

    </tr>
    </thead>
    <tbody>

    @isset($teacher)
        @foreach($teacher->allUpcomingCourses as $course)
            @if($course->quota < $course->registrations->count() || Carbon\Carbon::now()->gt(Carbon\Carbon::parse($course->start_date)))

                <tr class="{{ $course->status == 0 ? '' : '' }}">
                {{--            <td>{{ $course->university->name }}</td>--}}
                <td><a href="{{ url("/admin/course/$course->id/show") }}">{{ $course->short_name }}</a>
                    {{--<br/><small class="text-warning">{{ $course->course_code }}</small>--}}
                </td>
                <td>{{ @$course->modality->title }}</td>
                {{--<td>{{ __('lms.page.course.form.quota') }} <small> <span class="badge">{{ $course->quota }}</span></small><br/>--}}
                {{--{{ __('lms.page.course.form.registrations') }} <small><span class="badge">{{ $course->registrations->count() }}</span></small>--}}
                {{--</td>--}}
                <td>{{ $course->hours }} hours</td>
                <td>{{ date('d M Y', strtotime($course->start_date)) }}</td>
                <td>{{ date('d M Y', strtotime($course->end_date)) }}</td>

                {{--<td><span class="label label-{{ $course->stageTitle['class'] }}">--}}
                {{--{{ $course->stageTitle['title'] }}</span></td>--}}
                <td><span class="label label-{{ $course->statusTitle['class'] }}">
                                            {{ $course->statusTitle['title'] }}</span></td>
                <td>
                    @can('register', $course)

                        @if ($course->status == '1')

                            @if($course->quota >= $course->registrations->count())

                                @if( Carbon\Carbon::now()->lt(Carbon\Carbon::parse($course->start_date)) )

                                    @if($course->has_disclaimer == 1)

                                        <form method="post" action="{{ url('/admin/course/register/'.$course->id) }}">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-link"><i class="fa fa-user-plus"></i> Register</button>
                                        </form>

                                    @else

                                        <button type="button" class="btn btn-flat btn-xs btn-info btn-proceed-to-the-course"
                                                data-course-id="{{ $course->id }}" data-teacher-id="{{ $teacher->id }}">
                                            {{ __('lms.messages.proceed_to_the_course') }}&nbsp;
                                            <i class="fa fa-caret-right"></i>
                                        </button>

                                    @endif


                                @else
                                    <span class="label label-danger">Start Date Passed</span>
                                @endif

                            @else
                                <span class="label label-danger">All positions filled</span>
                            @endif

                        @else
                            <span class="label label-default">Inactive Course</span>
                        @endif

                    @endcan
                </td>


                @foreach($course->registrations as $registration)
                    <td class="js-td-is-approved">
                        @if($registration->is_approved == REGISTRATION_IS_NOT_APPROVED)
                            <span class="label label-warning">Not approved</span>
                        @else
                            <span class="label label-success"><i class="fa fa-check"></i> Yes</span>
                            <small><i class="fa fa-clock-o"></i>
                                {{ date('h:i a', strtotime($registration->approval_time)) }}<br/>
                                {{ date('d M, Y', strtotime($registration->approval_time)) }}
                            </small>
                        @endif
                    </td>
                    @include('lms.admin.registration.parts.table.td.student_inspection_form')

                    @include('lms.admin.registration.parts.table.td.certificate')
                    @break
                @endforeach
            </tr>
            @endif
        @endforeach
    @endisset
    </tbody>
</table>
