@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.page.course.index.page_header') }}</h1>
@stop

@section('content')

    <div class="row" id="page_course">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.page.course.index.table_header') }}</h3>
                    </div>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-info" id="btn-upload-course-request">
                                <i class="fa fa-upload"></i> {{ __('lms.elements.button.upload_course_request') }}</button>
                            <button class="btn btn-sm btn-primary" id="btn-create-course">
                                <i class="fa fa-plus"></i> {{ __('lms.elements.button.create') }}</button>
                        </div>
                    </div>
                </div>
                <div class="box-body">

                    <table class="table table-bordered table-responsive" id="course-table">
                        <thead>
                            <tr>
                                <th>{{ __('lms.page.course.table.course_id') }}</th>
                                <th>{{ __('lms.page.course.table.short_name') }}</th>
                                <th>{{ __('lms.page.course.table.hours') }}</th>
                                <th>{{ __('lms.page.course.table.start_date') }}</th>
                                <th>{{ __('lms.page.course.table.end_date') }}</th>
                                <th>{{ __('lms.page.course.table.quota') }}</th>
                                <th>{{ __('lms.page.course.table.comment') }}</th>
                                <th>{{ __('lms.page.course.table.action') }}</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                    </table>

                </div>
            </div>


        </div>

        @include('lms.admin.course.edit_modal')
        @include('lms.admin.course.request_list_modal')
        @include('lms.admin.parts.modal_delete')

    </div>

@stop