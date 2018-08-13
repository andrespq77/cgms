@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.page.upcoming.index.page_header') }}</h1>
@stop

@section('content')

    <div class="row" id="page_upcoming_course">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.page.upcoming.index.table_header') }}</h3>
                    </div>
                    <div class="pull-right">
                    </div>
                </div>
                <div class="box-body">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Acerca de mi</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <strong><i class="fa fa-man margin-r-5"></i> Nombre</strong>

                            <p class="">{{ Auth::user()->name }}</p>

                            <hr>

                            <strong><i class="fa fa-map-marker margin-r-5"></i> {{ __('lms.words.social_id') }}</strong>

                            <p class="">{{ @$teacher->social_id}}</p>


                        </div>
                        <!-- /.box-body -->
                    </div>
{{--                    @include('lms.admin.teacher.profile.upcoming-table')--}}
                    @include('lms.admin.teacher.profile.upcoming')

                </div>
            </div>

        </div>

    </div>

@stop
