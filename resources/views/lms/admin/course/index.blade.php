@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <div class="row">
        <div class="col-lg-6">
            <h2 class="no-padding no-margin">{{ __('lms.page.course.index.page_header') }}</h2>
        </div>
        <div class="col-lg-6">
            @if(Auth::user()->role == 'admin')
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-sm btn-info" id="btn-upload-course-request">
                        <i class="fa fa-upload"></i> {{ __('lms.elements.button.upload_course_request') }}</button>
                    <button class="btn btn-sm btn-success" id="btn-new-course-upload">
                        <i class="fa fa-cloud-upload"></i> {{ __('lms.elements.button.new_course_upload') }}</button>
                    <button class="btn btn-sm btn-primary" id="btn-create-course">
                        <i class="fa fa-plus"></i> {{ __('lms.elements.button.create') }}</button>
                </div>
            </div>
            @endif
        </div>
    </div>

@stop

@section('content')

    <div class="row" id="page_course">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.page.course.index.table_header') }}</h3>
                    </div>
                    <div class="box-tools">
                        <form method="get" action="{{ url('/admin/course/search') }}">

                            <div class="input-group input-group-sm" style="width: 550px;">
                                <input value="{{ app('request')->input('search') }}" type="text" name="search" class="form-control pull-right"
                                       placeholder="Buscar por el código del curso, nombre corto, descripción, horas"/>

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="box-body no-padding">
                    @include('lms.admin.course.templates.table')
                </div>

                <div class="box-footer no-padding">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            {{  $courses->links() }}

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 text-right" style="margin-top: 20px;padding-right: 25px;">
                            <small><i class="fa fa-info-circle"></i>&nbsp;
                                <span class="text-muted">{{ __('lms.messages.diploma_upload_message') }}</span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        @include('lms.admin.course.edit_modal')
        @include('lms.admin.course.request_list_modal')
        @include('lms.admin.course.course_upload_modal')

        @if(Auth::user()->role == 'admin')
            @include('lms.admin.parts.modal_delete')
        @endif

        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'university')

            @component('lms.admin.components.bootstrap.modal.modal', [
                        'modal_id' => 'modal_upload_diploma',
                        'form_id' =>'form_upload_diploma' , 'form_class' => 'js-upload-diploma-zip'])

                @slot('modal_title')
                    {{ __('lms.messages.upload_diploma_zip_file') }}
                @endslot

                @slot('modal_body')

                    <input type="hidden" class="js-course-diploma-id"/>
                        <div id="course-diploma-upload-placeholder"></div>
                        @component('lms.admin.components.fineuploader',[
                                   'template_name' => 'qq_course_diploma_upload_manual_template',
                                    'upload_button_id' => 'btn_upload_diploma']);
                        @endcomponent

                @endslot

                @slot('footer_action_button')
                @endslot

            @endcomponent

        @endif
    </div>

@stop
