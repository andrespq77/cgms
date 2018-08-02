@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.page.university.index.page_header') }}</h1>
@stop

@section('content')

    <div class="row" id="page_university">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.page.university.index.table_header') }}</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm btn-primary" id="btn-create-university">
                            <i class="fa fa-plus"></i> {{ __('lms.elements.button.create') }}</button>
                    </div>
                </div>
                <div class="box-body">

                    <table class="table table-bordered table-responsive" id="university-table">
                        <thead>
                            <tr>
                                <th>{{ __('lms.page.university.table.id') }}</th>
                                <th>{{ __('lms.page.university.table.name') }}</th>
                                <th>{{ __('lms.page.university.table.email') }}</th>
                                <th>{{ __('lms.page.university.table.phone') }}</th>
                                <th>{{ __('lms.page.university.table.website') }}</th>
                                <th>{{ __('lms.page.university.table.login_name') }}</th>
                                <th>{{ __('lms.page.university.table.login_email') }}</th>
                                <th>{{ __('lms.page.university.table.created_by') }}</th>
                                <th>{{ __('lms.page.university.table.created_at') }}</th>
                                <th width="200">{{ __('lms.page.university.table.action') }}</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>

        </div>

        @include('lms.admin.university.edit_modal')
        @include('lms.admin.parts.modal_delete')

    </div>

@stop