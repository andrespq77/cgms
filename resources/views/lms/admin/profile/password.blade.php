@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1> <i class="fa fa-unlock"></i>Change Password</h1>

@stop

@section('content')

    <div class="row">
        <div class="col-lg-4">

            <form class="form-horizontal teacher-form" role="form" action="{{ url('admin/profile/change-password') }}"
                  method="post">
                {{ csrf_field() }}

                <div class="box box-info">

                    <div class="box-header">
                        <div class="box-title"> Change Password</div>
                    </div>
                    <div class="box-body">

                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                        @endif

                        <div class="control-group">
                            <label for="new_password" class="control-label">New Password</label>
                            <div class="controls">
                                <input type="password" class="form-control"  name="password" maxlength="30">
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="confirm_password" class="control-label">Confirm Password</label>
                            <div class="controls">
                                <input type="password" class="form-control" name="password_confirmation" maxlength="30">
                            </div>
                        </div>

                    </div>
                    <div class="box-footer text-right">
                        <button href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button href="#" class="btn btn-primary" id="password_modal_save">Change Password</button>
                    </div>
                </div>

            </form>
        </div>
    </div>



@stop