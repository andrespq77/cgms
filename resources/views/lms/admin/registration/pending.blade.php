@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.page.registration.pending.index.table_header') }}</h1>
@stop

@section('content')

    @if(Auth::user()->role == 'admin')
        <div class="row">
            <form class="form-inline" method="get" action="{{ url('/admin/registration/pending') }}">
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
                                formaction="{{ url("/admin/registration/pending") }}"
                                type="submit"><i class="fa fa-search"></i> Filtrar</button>
                        {{--<button class="btn btn-success btn-download btn-flat"--}}
                                {{--formaction="{{ url("/admin/portfolio/download") }}" formtarget="_blank"--}}
                                {{--type="submit"><i class="fa fa-cloud-download"></i> Download</button>--}}

                    </div>
                </div>
            </form>
        </div>
        <br/>
    @endif

    <div class="div" id="page_registration_pending_approval">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h3 class="box-title">{{ __('lms.page.registration.pending.index.table_header') }}</h3>
                        </div>

                        <div class="pull-right">
                            @if(Auth::user()->role == 'admin')
                                <div class="">
                                    <div class="btn-group-sm">
                                        <img style="display:none; padding-left:30px" src="https://media1.tenor.com/images/8ac12962c05648c55ca85771f4a69b2d/tenor.gif?itemid=9212724" height="50px" id="reg_loading_img">

                                        <a class="inline btn btn-success btn-flat " id="approve-all"><i class="fa fa-check"></i> Approve Selected</a>
                                    </div>

                                </div>
                                <br/>
                            @endif
                        </div>
                    </div>
                    <div class="box-body">

                        <table class="table table-bordered table-responsive" id="pending-table">
                            <thead>
                                <tr>
                                    <th>{{ __('lms.page.registration.pending.table.course_code') }}</th>
                                    <th>{{ __('lms.page.registration.pending.table.short_name') }}</th>
                                    <th>{{ __('lms.page.registration.pending.table.institute') }}</th>
                                    <th>{{ __('lms.page.registration.pending.table.start_date') }}</th>
                                    <th>{{ __('lms.page.registration.pending.table.end_date') }}</th>
                                    <th>{{ __('lms.page.registration.pending.table.security_id') }}</th>
                                    <th>{{ __('lms.page.registration.pending.table.name') }}</th>
                                    <th>{{ __('lms.page.registration.pending.table.email') }}</th>
                                    <th>{{ __('lms.page.registration.pending.table.terms_condition') }}</th>
                                    <th>{{ __('lms.page.registration.pending.table.record_uploaded') }}</th>
                                    <th>{{ __('lms.page.registration.pending.table.is_approved') }}</th>
                                    <th>{{ __('lms.page.registration.pending.table.by') }}</th>
                                    <th bgcolor="#95a5a6">
                                        <div class="checkbox" >
                                        <label>
                                            <input type="checkbox" id="check_all">
                                        </label>
                                       </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registrations as $registration)
                                    <tr id="row-{{ $registration->id }}">
                                        @include('lms.admin.registration.parts.table.td.course_code')
                                        <td>{{ $registration->course->short_name }}</td>
                                        <td>{{ $registration->course->university->name }}</td>
                                        <td>{{ $registration->course->start_date }}</td>
                                        <td>{{ $registration->course->end_date }}</td>
                                        <td>{{ $registration->student->social_id }}</td>
                                        <td>{{ $registration->student->user->name }}</td>
                                        <td>{{ $registration->student->user->email }}</td>
                                        @include('lms.admin.registration.parts.table.td.terms_condition')
                                        @include('lms.admin.registration.parts.table.td.student_inspection_form')
                                        @include('lms.admin.registration.parts.table.td.is_approved')
<<<<<<< HEAD
                                        {{--<td class="js-td-is-approved">--}}
                                            {{--@if($registration->is_approved == REGISTRATION_IS_NOT_APPROVED)--}}
                                                {{--<div class="form-group">--}}
                                                    {{--<div class="checked">--}}
                                                        {{--<label>--}}
                                                            {{--<input type="checkbox"--}}
                                                                   {{--class="js-approve-check-{{ $registration->id }}" /> Aprobar--}}
                                                        {{--</label>--}}
                                                    {{--</div>--}}
                                                    {{--<button class="btn btn-xs btn-primary btn-flat btn-approve-confirm"--}}
                                                    {{--data-id="{{ $registration->id }}">Confirmar</button>--}}
                                                {{--</div>--}}
                                            {{--@else--}}
                                                {{--<i class="fa fa-check"></i> Yes <br/>--}}
                                                {{--<small><i class="fa fa-clock-o"></i>--}}
                                                    {{--{{ date('d M, Y - h:i a', strtotime($registration->approval_time)) }}</small>--}}
                                            {{--@endif--}}
                                        {{--</td>--}}
=======
                                            {{--<td class="js-td-is-approved">--}}
                                                {{--@if($registration->is_approved == REGISTRATION_IS_NOT_APPROVED)--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<div class="checked">--}}
                                                            {{--<label>--}}
                                                                {{--<input type="checkbox"--}}
                                                                       {{--class="js-approve-check-{{ $registration->id }}" /> Approve--}}
                                                            {{--</label>--}}
                                                        {{--</div>--}}
                                                        {{--<button class="btn btn-xs btn-primary btn-flat btn-approve-confirm"--}}
                                                        {{--data-id="{{ $registration->id }}">Confirm</button>--}}
                                                    {{--</div>--}}
                                                {{--@else--}}
                                                    {{--<i class="fa fa-check"></i> Yes <br/>--}}
                                                    {{--<small><i class="fa fa-clock-o"></i>--}}
                                                        {{--{{ date('d M, Y - h:i a', strtotime($registration->approval_time)) }}</small>--}}
                                                {{--@endif--}}
                                            {{--</td>--}}
>>>>>>> origin/dev
                                        <td class="js-td-approved-by">

                                            @if ($registration->is_approved == REGISTRATION_IS_APPROVED)
                                                <span>{{ $registration->approvedBy->name }}</span>
                                            @endif

                                        </td>
                                        <td class="new_checkbox">
                                            <div class="checkbox">
                                                <label>
                                                    <input class="checkbox" type="checkbox"  data-id="{{$registration->id}}" id="tr-checkbox-{{$registration->id}}">
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot></tfoot>
                        </table>

                    </div>
                    <div class="box-footer text-center">
                        {{ $registrations->links() }}
                    </div>
                </div>


            </div>
        </div>

    </div>
<<<<<<< HEAD

=======
>>>>>>> origin/dev
@stop
