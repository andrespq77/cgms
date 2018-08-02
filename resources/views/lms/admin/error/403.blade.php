@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>Error Notice</h1>
@stop

@section('content')

    <div class="row" id="error_unauthorized">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <h2>Sorry, you are not authorized to see that page.</h2>

        </div>
    </div>

@stop