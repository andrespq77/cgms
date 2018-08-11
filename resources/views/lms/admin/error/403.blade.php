@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.messages.error_title') }}</h1>
@stop

@section('content')

    <div class="row" id="error_unauthorized">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <h2>{{ __('lms.messages.error_body') }}</h2>

        </div>
    </div>

@stop
