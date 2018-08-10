@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <div class="row">
        <div class="col-lg-6">
            <h1 class="no-padding no-margin">{{ __('lms.page.teacher.index.page_header') }}</h1>
        </div>
        <div class="col-lg-6">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-sm btn-success" id="btn-import-teachers" type="submit">
                        <i class="fa fa-upload"></i> {{ __('lms.elements.button.upload') }}</button>
                    <a href="{{ url("/admin/teachers/new") }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> {{ __('lms.elements.button.create') }}</a>
                </div>
            </div>
        </div>
    </div>

@stop

@section('content')

    <div class="row" id="page_teacher">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.page.teacher.index.table_header') }}</h3>
                    </div>
                    <div class="box-tools">
                        <form method="get" action="{{ url('/admin/teachers/search') }}">

                        <div class="input-group input-group-sm" style="width: 550px;">
                                <input type="text" name="search" class="form-control pull-right"
                                       placeholder="{{ __('lms.messages.search_teacher') }}"/>

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                        </div>
                        </form>

                    </div>
                </div>
                <div class="box-body no-padding">

                    @include('lms.admin.teacher.profile.table')

                </div>

                <div class="box-footer no-padding">
                    {{  $teachers->appends($_GET)->links() }}
                </div>
            </div>


        </div>
        @include('lms.admin.parts.modal_delete')

    </div>

    {{--@include('lms.admin.teacher.edit_modal')--}}
    @include('lms.admin.teacher.moodal_modal')
    @include('lms.admin.teacher.upload_form')

@stop
