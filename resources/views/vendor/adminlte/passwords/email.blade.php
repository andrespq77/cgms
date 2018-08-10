@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')

    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>

        <div class="register-box-body">

            <p class="login-box-msg">Reset Password</p>

            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post" class="form-horizontal">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('social_id') ? 'has-error' : '' }}">
                    <label for="js-edit-social-id" class="col-sm-3 control-label">{{ __('lms.words.social_id') }}</label>
                    <div class="col-sm-9">
                        <input id="js-edit-social-id" type="text" class="form-control" name="social_id"
                               required placeholder="{{ __('lms.words.social_id') }}" maxlength="100" value="{{ old('social_id') }}">
                        <span class="fa fa-id-badge form-control-feedback"></span>
                        @if ($errors->has('social_id'))
                            <span class="help-block">
                            <strong>{{ $errors->first('social_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group has-feedback {{ $errors->has('amie') ? 'has-error' : '' }}">
                    <label for="js-edit-amie" class="col-sm-3 control-label">AMIE</label>
                    <div class="col-sm-9">
                        <input id="js-edit-amie" type="text" class="js-edit-canton-capital form-control" name="amie"
                               value="{{ old('amie') }}" required placeholder="AMIE" maxlength="100">
                        <span class="fa fa-id-card form-control-feedback"></span>
                        @if ($errors->has('amie'))
                            <span class="help-block">
                            <strong>{{ $errors->first('amie') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group has-feedback {{ $errors->has('canton') ? 'has-error' : '' }}">
                    <label for="js-edit-canton-district" class="col-sm-3 control-label">Canton</label>
                    <div class="col-sm-9">
                        <input id="js-edit-canton-district" type="text" class="js-edit-canton-district form-control" name="canton"
                               value="{{ old('canton') }}" required placeholder="Canton" maxlength="100">
                        <span class="fa fa-map form-control-feedback"></span>
                        @if ($errors->has('canton'))
                            <span class="help-block">
                            <strong>{{ $errors->first('canton') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group has-feedback {{ $errors->has('work_area') ? 'has-error' : '' }}">
                    <label for="js-workarea" class="col-sm-3 control-label">Work area</label>
                    <div class="col-sm-9">
                        <input id="js-workarea" type="text" class="form-control" name="work_area"
                               value="{{ old('work_area') }}" required placeholder="Work Area" maxlength="50">
                        <span class="fa fa-keyboard-o form-control-feedback"></span>

                        @if ($errors->has('work_area'))
                            <span class="help-block">
                            <strong>{{ $errors->first('work_area') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ old('email') }}" required placeholder="Email" maxlength="30">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" class="col-md-3 control-label">Password</label>
                    <div class="col-md-9">
                        <input id="password" type="password" class="form-control" name="password"
                               value="" required placeholder="Password" maxlength="10">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label for="password_confirm" class="col-md-3 control-label">Confirm Password</label>
                    <div class="col-md-9">
                        <input id="password_confirm" type="password"
                               class="form-control" name="password_confirmation"
                               value="" required placeholder="Confirm Password" maxlength="20">
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat"
                    >Change Password</button>
            </form>
            <div class="auth-links">
                <a href="{{ url(config('adminlte.login_url', 'login')) }}"
                   class="text-center">{{ __('adminlte::adminlte.i_already_have_a_membership') }}</a>
            </div>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

@stop

@section('adminlte_js')
    @yield('js')
@stop
