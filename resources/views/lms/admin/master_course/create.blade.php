@extends('adminlte::page')

@include('lms.admin.parts.title')


@section('content_header')
    <h1>{{ $title }} <small> {{ __('lms.page.master_course.index.create_new_course_type') }}</small></h1>

@stop

@section('content')

    <div class="row" id="page_product_create">
        <div class="col-lg-6 col-md-8 col-sm-12">

            @include('lms.admin.master_course.create_form')

        </div>

    </div>

@stop
