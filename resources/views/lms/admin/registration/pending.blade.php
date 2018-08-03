@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <div class="row">

        <div class="col-md-3">
            <h4 style="margin: 10px 0 0 0">
                <label for="search-pending-approval">
                    {{ __('lms.page.registration.pending.index.page_header') }}
                </label>
            </h4>
        </div>
    </div>
@stop

@section('content')

    <div class="div" id="page_registration_pending_approval">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h3 class="box-title">{{ __('lms.page.registration.pending.index.table_header') }}</h3>
                        </div>
                        <div class="pull-right">
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
                                    <th>{{ __('lms.page.registration.pending.table.approved_by') }}</th>
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
                                                    {{--data-id="{{ $registration->id }}">Confirmar</button>--}}
                                                {{--</div>--}}
                                            {{--@else--}}
                                                {{--<i class="fa fa-check"></i> Si <br/>--}}
                                                {{--<small><i class="fa fa-clock-o"></i>--}}
                                                    {{--{{ date('d M, Y - h:i a', strtotime($registration->approval_time)) }}</small>--}}
                                            {{--@endif--}}
                                        {{--</td>--}}
                                        <td class="js-td-approved-by">

                                            @if ($registration->is_approved == REGISTRATION_IS_APPROVED)
                                                <span>{{ $registration->approvedBy->name }}</span>
                                            @endif

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

@stop
