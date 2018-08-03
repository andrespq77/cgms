@extends('adminlte::page')

@section('title', env('APP_TITLE'))

@section('content_header')
    <h1>{{ __('lms.location.province.index.page_header') }}</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-8 col-md-10 col-sm-12 col-lg-offset-2 col-md-offset-1">

            <div class="box">
                <div class="box-header"><h3 class="box-title">{{ __('lms.location.province.index.table_header') }}</h3></div>
                <div class="box-body">
                    <div class="alert alert-warning">
                        <p><strong>Lo siento</strong>, Aun no esta listo</p>
                    </div>

                    <table class="table table-bordered hidden" id="users-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Cantones</th>

                                <th>Acción</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>


        </div>
    </div>

@stop
