@extends('adminlte::page')

@include('lms.admin.parts.title')


@section('content_header')
    <h1>{{ $title }} <small>Crear nueva modalidad </small></h1>
    @component('lms.admin.components.bootstrap.breadcrumb')
        <li class=""><i class="fa fa-book"></i> Curso</li>

        <li class="">
            <a href="{{ url('/admin/course-type') }}"><i class="fa fa-plus"></i> Modalidad</a>
        </li>
        @if(isset($type))
        <li class="active"><i class="fa fa-pencil"></i> Editar</li>
        @else
            <li class="active"><i class="fa fa-plus"></i> Crear</li>
        @endif
    @endcomponent
@stop

@section('content')

    <div class="row" id="page_product_create">
        <div class="col-lg-6 col-md-8 col-sm-12">

            @include('lms.admin.master_course.create_form')

        </div>

    </div>

@stop
