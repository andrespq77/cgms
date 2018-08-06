@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ $teacher->user->name }}</h1>
@stop

@section('content')

    <div class="row" id="page_teacher_profile">

        <div class="col-lg-7 col-md-7 col-sm-12">

            <div class="box box-primary">

                <div class="box-body box-profile">

                    <div class="row">

                        <div class="col-lg-3">
                            <img class="img-responsive img-thumbnail"
                                 src="{{ url($teacher->gender=='M'? '/images/user_male.jpg' : '/images/user_female.jpg') }}">
                                <h3 class="profile-username text-center">{{ $teacher->user->name }}</h3>
                                <p class="text-muted text-center">{{ $teacher->function }}</p>

                        </div>
                        <div class="col-lg-9">

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <i class="fa fa-id-card"></i> <b>Cédula</b> <span class="pull-right">{{ $teacher->social_id}}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-qrcode"></i>&nbsp;<b>AMIE</b> <span class="pull-right">{{ $teacher->amie}}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-phone"></i>&nbsp;<b>Teléfono</b> <span class="pull-right">{{ $teacher->telephone}}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-mobile"></i>&nbsp;<b>Celular</b> <span class="pull-right">{{ $teacher->mobile}}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-envelope-o"></i>&nbsp;<b>Email Institucional</b> <span class="pull-right">{{ $teacher->inst_email }}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa {{ $teacher->gender == 'F' ? 'fa-female' : 'fa-male' }}"></i>&nbsp;
                                    <b> Género</b> <span class="pull-right">{{ $teacher->gender == 'F' ? "Female" : "Male" }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Fecha de Nacimiento</b> <span class="pull-right">&nbsp;{{ date('jS M, Y', strtotime($teacher->date_of_birth)) }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Discapacidad</b> <sapn class="pull-right">&nbsp;{{ $teacher->disability }}</sapn>
                                </li>
                                <li class="list-group-item">
                                    <b>Grupo Étnico</b> <span class="pull-right">{{ $teacher->ethnic_group }}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-envelope-o"></i>&nbsp<b>Note</b> <span class="pull-right">
                                        Usuario fue importado por {{ $teacher->createdBy->name }} aqui el {{ $teacher->created_at }}</span>
                                </li>
                                <li class="list-group-item auxilary">
                                    <i class="fa fa-mobile"></i>&nbsp;<b>Celular 2</b> <span class="pull-right">{{ $teacher->phone2}}</span>
                                </li>
                                <li class="list-group-item auxilary">
                                    <i class="fa fa-envelope"></i>&nbsp;<b>Email 2</b> <span class="pull-right">{{ $teacher->email2}}</span>
                                </li>
                            </ul>

                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>

        </div>

        <div class="col-lg-5 col-md-5 col-sm-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Acerca de mi</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-building margin-r-5"></i> Institución Educativa</strong>

                    <p class="text-muted">{{ $teacher->university_name }}<br/>
                    Regimen Laboral: {{ $teacher->work_area }}<br/>
                    Categoría: {{ $teacher->category }}<br/>
                    Fecha de inicio: {{ $teacher->join_date }}<br/>
                    Fecha de fin: {{ $teacher->end_date }}<br/>
                    </p>

                    <hr>
                    <strong><i class="fa fa-bolt margin-r-5"></i> Reason</strong>
                    <p class="text-muted">
                        Descripción: {{ $teacher->action_description }}<br/>
                        Especialidad: {{ $teacher->speciality }}<br/>
                    </p>
                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación</strong>

                    <p class="text-muted">{{ $teacher->parroquia }}, {{ $teacher->canton }}, {{ $teacher->province }}</p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Distrito</strong>

                    <p class="text-muted">{{ $teacher->district }} [{{ $teacher->district_code }}]. Zona: {{ $teacher->zone }}</p>

                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>

      @include('lms.admin.teacher.profile.upcoming')

    <div class="row">
        <div class="col-ls-12 col-md-12 col-sm-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.page.teacher_profile.index.table_header') }}</h3>
                    </div>
                </div>
                <div class="box-body  no-padding">

                    <table class="table table-borderless table-responsive table-hover" id="teacher-table">
                        <thead>
                            <tr>
                                <th>{{ __('lms.page.teacher_profile.table.institute') }}</th>
                                <th>{{ __('lms.page.teacher_profile.table.course_name') }}</th>
                                <th>{{ __('lms.words.grade') }}</th>
                                <th>{{ __('lms.messages.grade_approved_by') }}</th>
                                <th>{{ __('lms.page.teacher_profile.table.hours') }}</th>
                                <th>{{ __('lms.page.teacher_profile.table.start_date') }}</th>
                                <th>{{ __('lms.page.teacher_profile.table.end_date') }}</th>
                                <th>{{ __('lms.page.registration.pending.table.record_uploaded') }}</th>
                                <th>{{ __('lms.page.teacher.table.approved') }}</th>
                                <th>{{ __('lms.page.teacher_profile.table.certificate') }}</th>
                                <th>{{ __('lms.words.diploma') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teacher->registrations->sortByDesc('approval_time') as $registration)
                                <tr class="{{ $registration->course->status == 0 ? 'disabled' : '' }}">
                                    <td>{{ $registration->course->university->name }}</td>
                                    <td><a href="{{ url("/admin/course/".$registration->course->id."/show") }}">
                                        {{ $registration->course->short_name }}</a>

                                    </td>

                                    @include('lms.admin.registration.parts.table.td.mark_approved')
                                    <td>{{ $registration->course->hours }}</td>
                                    <td>{{ date('d M Y', strtotime($registration->course->start_date)) }}</td>
                                    <td>{{ date('d M Y', strtotime($registration->course->end_date)) }}</td>
                                    @include('lms.admin.registration.parts.table.td.student_inspection_form')
                                    <td class="js-td-is-approved">
                                        @if($registration->is_approved == REGISTRATION_IS_NOT_APPROVED)
                                            <span class="label label-warning">Reprobado</span>
                                        @else
                                            <span class="label label-success"><i class="fa fa-check"></i> Yes</span>
                                            <small><i class="fa fa-clock-o"></i>
                                                {{ date('h:i a', strtotime($registration->approval_time)) }}<br/>
                                                {{ date('d M, Y', strtotime($registration->approval_time)) }}
                                            </small>
                                        @endif
                                    </td>
                                    @include('lms.admin.registration.parts.table.td.certificate')
                                    @include('lms.admin.registration.parts.table.td.diploma')
                                    <td></td>
                                </tr>

                            @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>




@stop
