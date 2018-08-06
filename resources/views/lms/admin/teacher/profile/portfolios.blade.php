<div class="row">
    <div class="col-lg-12">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Portafolio</h3>

                <div class="box-tools">
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">

                <table class="table table-responsive">

                    <tbody>
                        <tr>
                            <th>{{ __('lms.page.upcoming.table.institution') }}</th>
                            <th>{{ __('lms.page.upcoming.table.short_name') }}</th>
                            <th>{{ __('lms.page.upcoming.table.modality') }}</th>
                            <th>{{ __('lms.page.upcoming.table.hours') }}</th>
                            <th>{{ __('lms.page.upcoming.table.start_date') }}</th>
                            <th>{{ __('lms.page.upcoming.table.end_date') }}</th>
                            <th>{{ __('lms.page.teacher_profile.status') }}</th>
                            <th>{{ __('lms.words.grade') }}</th>
                            <th>Estado</th>
                            <th>{{ __('lms.page.teacher_profile.certificate') }}</th>
                            <th>{{ __('lms.words.diploma') }}</th>


                            <th>{{ __('lms.page.course.table.stage') }}</th>
                            <th>{{ __('lms.page.course.table.status') }}</th>

                        </tr>

                        @isset($portfolios)
                        @foreach($portfolios as $registration)
                            <tr class="{{ $registration->course->status == 0 ? 'disabled' : '' }}">
                                <td>{{ $registration->course->university->name }}</td>
                                <td><a href="{{ url("/admin/course/".$registration->course->id."/show") }}">
                                        {{ $registration->course->short_name }}</a><br/>
                                    <small class="text-warning">{{ $registration->course->course_code }}</small>
                                </td>
                                <td>{{ $registration->course->modality->title }}</td>
                                <td>{{ $registration->course->hours }}</td>
                                <td>{{ date('d M Y', strtotime($registration->course->start_date)) }}</td>
                                <td>{{ date('d M Y', strtotime($registration->course->end_date)) }}</td>
                                <td>
                                    @if($registration->is_approved == REGISTRATION_IS_APPROVED)
                                        <i class="fa fa-check-square-o"></i> Aprobado<br/>
                                        <small>by {{ $registration->approvedBy->name }} el <br/>
                                            {{ date('d m Y - h:i a', strtotime($registration->approval_time)) }}</small>
                                    @else
                                     <i class="fa fa-times"></i> Reprobado

                                    @endif
                                </td>
                                @include('lms.admin.registration.parts.table.td.mark_approved')
                                @include('lms.admin.registration.parts.table.td.certificate')
                                @include('lms.admin.registration.parts.table.td.diploma')
                                <td><span class="label label-{{ $registration->course->stageTitle['class'] }}">
                                            {{ $registration->course->stageTitle['title'] }}</span></td>
                                <td><span class="label label-{{ $registration->course->statusTitle['class'] }}">
                                            {{ $registration->course->statusTitle['title'] }}</span></td>
                            </tr>
                        @endforeach
                        @endisset
                    </tbody>

                </table>

            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
