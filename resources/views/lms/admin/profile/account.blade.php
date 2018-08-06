@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1> <i class="fa fa-unlock"></i>Perfil</h1>

@stop

@section('content')

    <div class="row">
        <div class="col-lg-4">

            <form class="form-horizontal teacher-form" role="form" action="{{ url('admin/profile') }}"
                  method="post">
                {{ csrf_field() }}

                <div class="box box-info">

                    <div class="box-header">
                        <div class="box-title">Actualizar cuenta</div>
                    </div>
                    <div class="box-body">

                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        @if($errors->has('name'))
                            @if ($errors->any())
                                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                            @endif
                        @endif

                        <div class="control-group">
                            <label for="new_password" class="control-label">Nombre de usuario de ingreso</label>
                            <div class="controls">
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                       name="name" maxlength="100" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="" class="control-label">Email</label>
                            <div class="controls">
                                <input type="email" class="form-control"  value="{{ Auth::user()->email }}"
                                disabled/>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer text-right">
                        <button href="#" class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                        <button href="#" class="btn btn-primary" >Actualizar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">

            <form class="form-horizontal teacher-form" role="form" action="{{ url('admin/profile/email') }}"
                  method="post">
                {{ csrf_field() }}

                <div class="box box-danger">

                    <div class="box-header">
                        <div class="box-title">Cambiar Email</div>
                    </div>
                    <div class="box-body">

                        @if(session()->has('message_email'))
                            <div class="alert alert-success">
                                {{ session()->get('message_email') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                        @endif

                        <div class="control-group">
                            <label for="" class="control-label">Email</label>
                            <div class="controls">
                                <input type="email" class="form-control" name="email"  value="{{ Auth::user()->email }}"/>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer text-right">
                        <button href="#" class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                        <button href="#" class="btn btn-primary" >Cambiar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@stop
