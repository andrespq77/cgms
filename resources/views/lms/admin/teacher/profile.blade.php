@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ $teacher->user->name }}</h1>
@stop

@section('content')

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
                            <th>{{ __('lms.page.teacher.table.course_type') }}</th>
                            <th>{{ __('lms.page.teacher.table.course_name') }}</th>
                            <th>{{ __('lms.page.teacher.table.university') }}</th>
                            <th>{{ __('lms.page.teacher.table.province') }}</th>
                            <th>{{ __('lms.page.teacher.table.edition') }}</th>
                            <th>{{ __('lms.page.course.table.modality') }}</th>
                            <th>{{ __('lms.page.course.table.hours') }}</th>
                            <th>{{ __('lms.page.teacher.table.start_date') }}</th>
                            <th>{{ __('lms.page.teacher.table.end_date') }}</th>
                            <th>{{ __('lms.page.course.table.year') }}</th>
                            <th>{{ __('lms.page.teacher.table.approved') }}</th>
                            <th>{{ __('lms.page.teacher.table.diploma') }}</th>

                        </tr>
                        </thead>

                        <tbody>
                        @foreach($teacher->registrations->sortByDesc('approval_time') as $registration)

                            <tr class="{{ $registration->course->status == 0 ? 'disabled' : '' }}">
                                <td>{{ @$registration->course->masterCourse->type->title }}</td>

                                <td>{{ $registration->course->short_name }}<br/>
                                    <small class="text-warning">{{ $registration->course->course_code }}</small></td>
                                <td>{{ $registration->course->university->name }}</td>
                                <td>{{ $registration->student->province }}</td>
                                <td>{{ $registration->course->edition}}</td>
                                <td>{{ isset($registration->course->modality->title) ? $registration->course->modality->title : '' }}</td>

                                <td>{{ $registration->course->hours}}</td>
                                <td>{{ date('d M Y', strtotime($registration->course->start_date)) }}</td>
                                <td>{{ date('d M Y', strtotime($registration->course->end_date)) }}</td>
                                <td>{{ $registration->course->year}}</td>

                                <td class="js-td-is-approved">
                                    @if($registration->is_approved == REGISTRATION_IS_NOT_APPROVED)
                                        <span class="label label-warning">Pending</span>
                                    @else
                                        <span class="label label-success"><i class="fa fa-check"></i> Yes</span>
                                        <small><i class="fa fa-clock-o"></i>
                                            {{ date('h:i a', strtotime($registration->approval_time)) }}<br/>
                                            {{ date('d M, Y', strtotime($registration->approval_time)) }}
                                        </small>
                                    @endif
                                </td>

                                @include('lms.admin.registration.parts.table.td.diploma')
                            </tr>

                        @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>

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
                                    <i class="fa fa-id-card"></i> <b>Socail ID</b> <span class="pull-right">{{ $teacher->social_id}}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-qrcode"></i>&nbsp;<b>AMIE</b> <span class="pull-right">{{ $teacher->amie}}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-phone"></i>&nbsp;<b>Telephone</b> <span class="pull-right">{{ $teacher->telephone}}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-mobile"></i>&nbsp;<b>Cell</b> <span class="pull-right">{{ $teacher->mobile}}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-envelope-o"></i>&nbsp;<b>Institute Email</b> <span class="pull-right">{{ $teacher->inst_email }}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa {{ $teacher->gender == 'F' ? 'fa-female' : 'fa-male' }}"></i>&nbsp;
                                    <b> Gender</b> <span class="pull-right">{{ $teacher->gender == 'F' ? "Female" : "Male" }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Date of Birth</b> <span class="pull-right">&nbsp;{{ date('jS M, Y', strtotime($teacher->date_of_birth)) }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Disability</b> <sapn class="pull-right">&nbsp;{{ $teacher->disability }}</sapn>
                                </li>
                                <li class="list-group-item">
                                    <b>Ethnic Group</b> <span class="pull-right">{{ $teacher->ethnic_group }}</span>
                                </li>
                                <li class="list-group-item">
                                    <i class="fa fa-envelope-o"></i>&nbsp<b>Note</b> <span class="pull-right">
                                        User was imported by {{ $teacher->createdBy->name }} here at {{ $teacher->created_at }}</span>
                                </li>
                                {{--<li class="list-group-item auxilary">--}}
                                    {{--<i class="fa fa-mobile"></i>&nbsp;<b>Cell 2</b> <span class="pull-right"></span>--}}
                                {{--</li>--}}
                                {{--<li class="list-group-item auxilary">--}}
                                    {{--<i class="fa fa-envelope"></i>&nbsp;<b>Email 2</b> <span class="pull-right">{{ $teacher->email2}}</span>--}}
                                {{--</li>--}}

                                <form class="form-horizontal" role="form" action="{{ url('admin/profile') }}" method="post">

                                    {{ csrf_field() }}

                                    <div class="box-body">

                                        @if(session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif

                                        @if($errors->has('name'))
                                            @if ($errors->any())
                                                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                                            @endif
                                        @endif

                                        <div class="form-group">
                                            <div class="row">
                                            <label  for="inputEmail3" class="col-sm-3">
                                                <i class="fa fa-mobile"></i>&nbsp;<b>Cell 2</b></label>

                                            <div class="col-sm-9">
                                                <div class="controls">
                                                    <input type="text" class="form-control" value="{{ $teacher->phone2}}" name="phone2" maxlength="100" />
                                                </div>

                                            </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                            <label for="inputEmail3" class="col-sm-3"><i class="fa fa-envelope"></i>&nbsp;<b>Email 2</b></label>

                                            <div class="col-sm-9">
                                                <div class="controls">
                                                    <input type="email" class="form-control"  value="{{ $teacher->email2 }}" name="email2" maxlength="100"/>
                                                </div>

                                            </div>
                                        </div>
                                        </div>
                                            <button href="#" class="btn btn-primary pull-right" >Actualizar</button>
                                    </div>

                                </form>


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
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-building margin-r-5"></i> Institute</strong>

                    <p class="text-muted">{{ $teacher->university_name }}<br/>
                    Work Area: {{ $teacher->work_area }}<br/>
                    Category: {{ $teacher->category }}<br/>
                    Start Date: {{ $teacher->join_date }}<br/>
                    End Date: {{ $teacher->end_date }}<br/>
                    </p>

                    <hr>
                    <strong><i class="fa fa-bolt margin-r-5"></i> Reason</strong>
                    <p class="text-muted">Reason Type: {{ $teacher->reason_type }}<br/>
                        Action: {{ $teacher->action_type }}<br/>
                        Description: {{ $teacher->action_description }}<br/>
                        Speciality: {{ $teacher->speciality }}<br/>
                    </p>
                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                    <p class="text-muted">{{ $teacher->parroquia }}, {{ $teacher->canton }}, {{ $teacher->province }}</p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> District</strong>

                    <p class="text-muted">{{ $teacher->district }} [{{ $teacher->district_code }}]. Zone: {{ $teacher->zone }}</p>

                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>

    {{--@include('lms.admin.teacher.profile.upcoming')--}}

@stop
