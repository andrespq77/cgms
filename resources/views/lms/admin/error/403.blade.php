@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>Notificación de Error</h1>
@stop

@section('content')

    <div class="row" id="error_unauthorized">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <h2>Lo siento, no estas autorizado a ver esta página.</h2>

        </div>
    </div>

@stop
