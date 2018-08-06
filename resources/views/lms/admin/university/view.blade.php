@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')

    <div class="row" id="page_university_view">

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 toppad" >

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $university->name }}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">
                            <img alt="University Logo"
                                 src="https://placeimg.com/200/200/arch"
                                 class="img-circle img-responsive">
                        </div>

                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td><i class="fa fa-envelope"></i> {{ __('lms.page.university.table.email') }}</td>
                                        <td><a href="mailto:{{ $university->email }}">{{ $university->email }}</a></td>

                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-mobile"></i> {{ __('lms.page.university.table.phone') }}</td>
                                        <td>{{ $university->phone }}</td>
                                    </tr>

                                    <tr>
                                        <td><i class="fa fa-link"></i> {{ __('lms.page.university.table.website') }}</td>
                                        <td><a href="{{ $university->website }}">{{ $university->website }}</a></td>

                                    </tr>

                                    <tr>
                                        <td><i class="fa fa-comment-o"></i> {{ __('lms.page.university.form.note') }}</td>
                                        <td>{{ $university->note }}</td>
                                    </tr>

                                    <tr>
                                        <td>Created By</td>
                                        <td>{{ $university->createdBy->name }} el {{ date('d M Y - h:i a', strtotime($university->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Actulizado por</td>
                                        <td>{{ $university->updatedBy->name }} el {{ date('d M Y - h:i a', strtotime($university->updated_at)) }}</td>

                                    </tr>

                                    <tr class="warning">
                                        <td> {{ __('lms.page.university.form.login_name') }}</td>
                                        <td>{{ $university->user->name }}</td>
                                    </tr>
                                    <tr class="warning">
                                        <td> {{ __('lms.page.university.form.login_email') }}</td>
                                        <td>{{ $university->user->email }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="box box-info">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.page.university.view.table_header') }}</h3>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-responsive" id="university-course-table">
                        <thead>
                            <tr>
                                <th>{{ __('lms.page.course.table.course_id') }}</th>
                                <th>{{ __('lms.page.course.table.short_name') }}</th>
                                <th>{{ __('lms.page.course.form.course_type') }}</th>
                                <th>{{ __('lms.page.course.form.course_modality') }}</th>
                                <th>{{ __('lms.page.course.table.hours') }}</th>
                                <th>{{ __('lms.page.course.table.start_date') }}</th>
                                <th>{{ __('lms.page.course.table.end_date') }}</th>
                                <th>{{ __('lms.page.course.table.state') }}</th>
                                <th>{{ __('lms.page.course.table.upload_rating') }}</th>

                            </tr>
                        </thead>
                    </table>

                </div>
            </div>

        </div>

    </div>

    <style>
        .user-row {
            margin-bottom: 14px;
        }

        .user-row:last-child {
            margin-bottom: 0;
        }

        .dropdown-user {
            margin: 13px 0;
            padding: 5px;
            height: 100%;
        }

        .dropdown-user:hover {
            cursor: pointer;
        }

        .table-user-information > tbody > tr {
            border-top: 1px solid rgb(221, 221, 221);
        }

        .table-user-information > tbody > tr:first-child {
            border-top: 0;
        }


        .table-user-information > tbody > tr > td {
            border-top: 0;
        }
        .toppad
        {margin-top:20px;
        }

    </style>
@stop