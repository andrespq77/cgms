@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.page.teacher.index.page_header') }}</h1>
@stop

@section('content')

    @if(Auth::user()->role == 'admin')
    <div class="row">
        <form class="form-inline" method="get" action="{{ url('/admin/portfolio') }}">
            <div class="col-xs-6 col-lg-5">
                <div class="input-group" style="width: 100%;">
                    <div class="input-group-btn search-panel" style="text-align: right;width: 20%">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            <span id="search_concept">{{  ucfirst(str_replace('_', ' ', app('request')->input('search_param')))   }}</span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#all">All Fields</a></li>
                            <li class="divider"></li>
                            <li><a href="#course_code">Course Code</a></li>
                            <li><a href="#course_name">Course Name</a></li>
                            <li><a href="#social_id">Social Id</a></li>
                            <li><a href="#teachers_name">Teachers Name</a></li>

                        </ul>

                    </div>

                    <input type="hidden" name="search_param" id="search_param" style="width: 100%;"
                           value="{{ app('request')->input('search_param') }}">
                    <input type="text" class="form-control" name="x" placeholder="Search term..." value="{{ app('request')->input('x') }}">
                </div>
            </div>
            <div class="col-xs-3 col-lg-2">
                <div class="form-group" >
                    <select class="form-control" id="registration" name="registration">
                        <option disabled="">Select Approved Type</option>
                        <option {{ app('request')->input('registration') == 1 ? 'selected' : '' }}
                                value="1">Approved</option>
                        <option {{ app('request')->input('registration') == 0 ? 'selected' : '' }}
                                value="0">Not Approved</option>
                        <option {{ app('request')->input('registration') == 3 ? 'selected' : '' }}
                                value="3">All Registrations</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-3 col-lg-3">

                <div class="btn-group-sm">
                    <button class="btn btn-primary btn-search btn-flat"
                            formaction="{{ url("/admin/portfolio") }}"
                            type="submit"><i class="fa fa-search"></i> Filtrar</button>
                    <button class="btn btn-success btn-download btn-flat"
                            formaction="{{ url("/admin/portfolio/download") }}" formtarget="_blank"
                            type="submit"><i class="fa fa-cloud-download"></i> Download</button>

                </div>
            </div>
        </form>
    </div>
    <br/>
    @endif

    <div class="row" id="portfolio">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.page.teacher.index.table_header') }}</h3>
                    </div>
                    <div class="pull-right">
                    </div>
                </div>
                <div class="box-body">

                    <table class="table table-bordered table-responsive" id="teacher-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>{{ __('lms.page.teacher.table.security_id') }}</th>
                                <th width="18%">{{ __('lms.page.teacher.table.name') }}</th>
                                <th>{{ __('lms.page.teacher.table.course_type') }}</th>
                                <th>{{ __('lms.page.teacher.table.course_name') }}</th>
                                <th>Grade</th>
                                <th>Grade Approved</th>
                                <th>{{ __('lms.page.teacher.table.university') }}</th>
                                <th>{{ __('lms.page.teacher.table.start_date') }}</th>
                                <th>{{ __('lms.page.teacher.table.end_date') }}</th>
                                <th>{{ __('lms.page.registration.pending.table.record_uploaded') }}</th>
                                <th>{{ __('lms.page.teacher.table.approved') }}</th>
                                <th>{{ __('lms.page.teacher.table.certificate') }}</th>
                                <th>{{ __('lms.page.teacher.table.diploma') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $registration)
                                <tr>
                                    <td>{{ $registration->id }}</td>
                                    <td>{{ $registration->student->social_id }}</td>
                                    <td>{{ $registration->user_first_name}} &nbsp;
                                    <small>{{ $registration->user_last_name !== $registration->user_first_name ? $registration->user_last_name : '' }}</small>
                                    </td>
                                    <td>{{ $registration->course->course_type }}</td>
                                    <td>{{ $registration->course->short_name }}<br/>
                                        <small class="text-warning">{{ $registration->course->course_code }}</small></td>
                                    @include('lms.admin.registration.parts.table.td.mark_approved')
                                    <td>{{ $registration->course->university->name }}</td>
                                    <td>{{ date('d M Y', strtotime($registration->course->start_date)) }}</td>
                                    <td>{{ date('d M Y', strtotime($registration->course->end_date)) }}</td>
                                    @include('lms.admin.registration.parts.table.td.student_inspection_form')
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
                                    @include('lms.admin.registration.parts.table.td.certificate')
                                    @include('lms.admin.registration.parts.table.td.diploma')
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot></tfoot>
                    </table>

                </div>
                <div class="box-footer text-center">
                    {{ $registrations->appends(request()->query())->links() }}
                </div>
            </div>


        </div>
    </div>

@stop
