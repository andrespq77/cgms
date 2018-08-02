@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop
@section('body')
    <div class="row">
        <div class="col-md-12" class="text-center">
            Logged successfully with student user!
        </div>
    </div>
@stop
