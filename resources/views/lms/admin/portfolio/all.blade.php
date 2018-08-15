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
                            <li><a href="#all">{{ __('lms.words.all_fields') }}</a></li>
                            <li class="divider"></li>
                            <li><a href="#course_code">{{ __('lms.page.course.form.course_id') }}</a></li>
                            <li><a href="#course_name">{{ __('lms.page.course.table.course_name') }}</a></li>
                            <li><a href="#social_id">{{ __('lms.words.social_id') }}</a></li>
                            <li><a href="#teachers_name">Nombre del Docente</a></li>

                        </ul>

                    </div>

                    <input type="hidden" name="search_param" id="search_param" style="width: 100%;"
                           value="{{ app('request')->input('search_param') }}">
                    <input type="text" class="form-control" name="x" placeholder="{{ __('lms.words.search_term') }}..." value="{{ app('request')->input('x') }}">
                </div>
            </div>
            <div class="col-xs-3 col-lg-2">
                <div class="form-group" >
                    <select class="form-control" id="registration" name="registration">
                        <option disabled="">Escoja tipo de aprobación</option>
                        <option {{ app('request')->input('registration') == 1 ? 'selected' : '' }}
                                value="1">{{ __('lms.page.teacher.table.approved') }}</option>
                        <option {{ app('request')->input('registration') == 0 ? 'selected' : '' }}
                                value="0">{{ __('lms.words.not_approved') }}</option>
                        <option {{ app('request')->input('registration') == 3 ? 'selected' : '' }}
                                value="3">Todos los registros</option>
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
                            type="submit"><i class="fa fa-cloud-download"></i> {{ __('lms.words.download') }}</button>

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
                                {{--<th>Id</th>--}}
                                <th>{{ __('lms.page.teacher.table.security_id') }}</th>
                                <th width="18%">{{ __('lms.page.teacher.table.name') }}</th>
                                <th>{{ __('lms.page.teacher.table.course_type') }}</th>
                                <th>{{ __('lms.page.teacher.table.course_name') }}</th>
                                <th>{{ __('lms.words.university') }}</th>
                                <th>{{ __('lms.page.teacher.table.province') }}</th>
                                <th>{{ __('lms.page.teacher.table.edition') }}</th>
                                <th>{{ __('lms.page.course.table.modality') }}</th>
                                <th>{{ __('lms.page.course.table.hours') }}</th>
                                <th>{{ __('lms.page.teacher.table.start_date') }}</th>
                                <th>{{ __('lms.page.teacher.table.end_date') }}</th>
                                <th>{{ __('lms.page.course.table.year') }}</th>
                                <th>{{ __('lms.page.course.table.status') }}</th>
                                <th>{{ __('lms.page.teacher.table.diploma') }}</th>
                                {{--<th>{{ __('lms.words.grade') }}</th>--}}
{{--                                <th>{{ __('lms.page.registration.pending.table.record_uploaded') }}</th>--}}
                                {{--<th>{{ __('lms.page.teacher.table.certificate') }}</th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $registration)
                                @if($registration->mark != null)
                                    <tr>

                                    <td>{{ $registration->student->social_id }}</td>
                                    <td>{{ $registration->user_first_name}} &nbsp;
                                    <small>{{ $registration->user_last_name !== $registration->user_first_name ? $registration->user_last_name : '' }}</small>
                                    </td>
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
                                        @if($registration->mark_approved == REGISTRATION_IS_NOT_APPROVED)
                                            <span class="label label-warning"><i class="fa fa-remove"></i>{{ __('lms.words.not_approved') }}</span>
                                        @else
                                            <span class="label label-success"><i class="fa fa-check"></i> {{ __('lms.words.approved') }}</span>
                                        @endif
                                    </td>

                                    @include('lms.admin.registration.parts.table.td.diploma')
{{--                                    @include('lms.admin.registration.parts.table.td.mark_approved')--}}

                                    {{--@include('lms.admin.registration.parts.table.td.student_inspection_form')--}}
                                    {{--<td class="js-td-is-approved">--}}
                                        {{--@if($registration->is_approved == REGISTRATION_IS_NOT_APPROVED)--}}
                                            {{--<span class="label label-warning">{{ __('lms.words.not_approved') }}</span>--}}
                                        {{--@else--}}
                                            {{--<span class="label label-success"><i class="fa fa-check"></i> {{ __('lms.words.yes') }}</span>--}}
                                            {{--<small><i class="fa fa-clock-o"></i>--}}
                                                {{--{{ date('h:i a', strtotime($registration->approval_time)) }}<br/>--}}
                                                {{--{{ date('d M, Y', strtotime($registration->approval_time)) }}--}}
                                            {{--</small>--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                    {{--@include('lms.admin.registration.parts.table.td.certificate')--}}

                                </tr>
                                @endif
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
