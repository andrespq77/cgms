@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.page.register.index.page_header') }}</h1>
@stop

@section('content')

    <div class="row" id="page_register">

        <div class="col-lg-6 col-md-6 col-sm-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detalles del Curso</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <p class=""><strong><i class="fa fa-man margin-r-5"></i> Nombre Corto: </strong> {{ $course->short_name }}</p>

                    <p class=""><strong><i class="fa fa-map-marker margin-r-5"></i> Código del curso</strong> {{ $course->course_code }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Horas</b> <a class="pull-right">{{ $course->hours }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Fecha inicial</b> <a class="pull-right">{{ $course->start_date }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Feccha Final</b> <a class="pull-right">{{ $course->end_date }}</a>
                        </li>
                    </ul>

                </div>
                <!-- /.box-body -->
            </div>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Acerca de mi</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-man margin-r-5"></i> Nombre</strong>

                    <p class="">{{ $teacher->user->name }}</p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Cédula</strong>

                    <p class="text-muted">{{ $teacher->social_id }}</p>

                    <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i> Institución Educativa</strong>

                    <p>{{ $teacher->work_area }}, {{ $teacher->university_name }}</p>

                </div>
                <!-- /.box-body -->
            </div>

        </div>

        <div class="col-lg-12 col-md-12">

            <div class="box box-info">

                <div class="box-body">

                    <div class="" id="myWizard">
                        <div class="navbar">
                            <div class="navbar-inner">
                                <ul class="nav nav-pills">
                                    <li class="active"><a href="#step1" data-toggle="tab">1. Video</a></li>
                                    <li><a href="#step2" data-toggle="tab">2. Descripción</a></li>
                                    <li><a href="#step3" data-toggle="tab">3. Terminos & Condiciones</a></li>
                                    <li><a href="#step4" data-toggle="tab">4. Actualización de datos</a></li>
                                    <li><a href="#step5" data-toggle="tab">5. Registro</a></li>
                                    {{--<li><a href="#step6" data-toggle="tab">6. Certificado de Registro</a></li>--}}
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="step1">
                                <h3>Video</h3>
                                <div class="box-layout">

                                    <p>{{ $course->video_text }}</p>

                                    @if($course->video_type == 'youtube')
                                        @if($course->video_code !== null && $code=App\Course::parseYoutubeUrl($course->video_code))

                                            <div class="text-center">
                                                <iframe width="580" height="315"
                                                        src="https://www.youtube.com/embed/{{ App\Course::parseYoutubeUrl($course->video_code) }}">
                                                </iframe>
                                            </div>

                                        @else
                                            <div class="js-error">
                                                <h3 class="text-warning"><strong class="text-danger">Sorry</strong>! Video code is not found.</h3>
                                            </div>
                                        @endif
                                    @endif
                                    <br/><br/>
                                    <div class="next-layout">
                                        <a class="btn btn-default btn-flat next" href="javascript:void(0)">Siguiente</a>
                                    </div>
                                </div>

                                {{--<hr/>--}}
                            </div>
                            <div class="tab-pane" id="step2">
                                <h3>Descripción</h3>
                                <div class="box-layout">
                                    <p>{{ $course->description }}</p>

                                    <div class="next-layout">
                                        <a class="btn btn-default btn-flat next" href="javascript:void(0)">Siguiente</a>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="step3">
                                <h3>Terminos y Condiciones</h3>
                                <div class="box-layout">
                                    @if(isset($course->terms_conditions))
                                        <div class="well well-sm">
                                            <p class="">{{ $course->terms_conditions }}</p>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        @if($course->tc_file_path !== null)
                                            <div class="js-pdf-viewer" style="margin-bottom: 75px;">
                                                <embed src="{{ asset('storage/'.$course->tc_file_path) }}"
                                                       width="100%" height="350" alt="pdf"
                                                       pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
                                            </div>
                                        @else
                                            <div class="js-error">
                                                <h3 class="text-warning"><strong class="text-danger" >Sorry</strong>! Terms and Condition not found.</h3>
                                            </div>
                                        @endif

                                        <input type="hidden" id="teacher_id" value="{{ $teacher->user->id }}">
                                        <input type="hidden" id="course_id" value="{{ $teacher->user->id }}">

                                    </div>

                                    <div class="next-layout">
                                        <div class="row">
                                            <div class="col-lg-6 text-left">
                                                <div class="checkbox ">
                                                    <label class="">
                                                        @if($registration->accept_tc == 0)
                                                            <input type="checkbox" id="chk-accept-registration-tc"
                                                                   @if ($registration->accept_tc == 1)
                                                                   checked="checked"
                                                                    @endif
                                                            > Aceptar
                                                        @endif
                                                    </label>

                                                    @if($registration->accept_tc == 0)
                                                        &nbsp;&nbsp;
                                                        <button type="button" class="btn-accept-tc btn-primary btn btn-flat">Aceptar</button>
                                                    @endif
                                                </div>

                                                @if($registration->accept_tc == 1)
                                                    <div class="pull-left">
                                                        <i class="fa fa-check"></i> Aceptado el
                                                        {{ date('m/d/Y h:i a', strtotime($registration->tc_accept_time)) }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-lg-6">
                                                <a class="btn btn-default btn-flat next" href="javascript:void(0)">Siguiente</a>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="step4">
                                <h3>Actualización de Datos</h3>
                                <div class="box-layout">
                                    <p>{{ $course->data_update_brief }}</p>

                                    <div class="box-layout">
                                        <p>{{ $course->data_update_brief }}</p>

                                        <div class="box-body" id="register-update-data">

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label>Cédula</label>
                                                        <input class="form-control" disabled
                                                               value="{{$teacher->social_id}}" style="width: 100%;"/>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nombre</label>
                                                        <input type="text" class="form-control js-tab-user-first_name"
                                                               style="width: 100%;"
                                                               placeholder="Nombre"
                                                               value="{{ $registration->user_first_name }}"
                                                               maxlength="100"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Apellidos</label>

                                                        <input type="text" class="form-control js-tab-user-last_name"
                                                               style="width: 100%;"
                                                               placeholder="Apellido"
                                                               value="{{ $registration->user_last_name }}"
                                                               maxlength="100"/>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control js-tab-user-email"
                                                               style="width: 100%;"
                                                               placeholder="Email"
                                                               value="{{ isset($registration->email) ? $registration->email : $teacher->inst_email }}"
                                                               maxlength="100"/>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Teléfono</label>

                                                        <input type="text" class="form-control js-tab-user-phone"
                                                               style="width: 100%;"
                                                               placeholder="Phone"
                                                               value="{{ isset($registration->cell_phone) ? $registration->cell_phone : $teacher->mobile }}"
                                                               maxlength="50"/>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>T&C Aceptó</label>

                                                        <div class="js-user-data-update-tc_accept_info">
                                                            @if($registration->accept_tc == 1)
                                                                <div class="pull-left">
                                                                    <i class="fa fa-check"></i> Aceptado el &nbsp;
                                                                    &nbsp; &nbsp;
                                                                    <small>
                                                                        {{ date('d M Y h:i a', strtotime($registration->tc_accept_time)) }}
                                                                    </small>
                                                                </div>
                                                            @endif

                                                            <div class="pull-right">
                                                                <button class="btn btn-lg btn-update-user-register-data btn-info btn-sm"
                                                                        data-id="{{ $registration->id }}">
                                                                    <i class="fa fa-save"></i> Actualizar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="js-data-update-message"></div>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <div class="next-layout">
                                        <a class="btn btn-default btn-flat next" href="javascript:void(0)">Siguiente</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="step5">
                                <h3>Inspección de registro</h3>

                                <div class="box-layout">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            @if(strlen($registration->inspection_certificate) > 2)
                                                <p>File <code>{{ basename($registration->inspection_certificate)  }}</code>
                                                    uploaded at: {{ date('d M Y: h:i a', strtotime($registration->inspection_certificate_upload_time)) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <h3><i class="fa fa-download"></i> Descargar formato de registro</h3>
                                            <hr/>
                                            <p>
                                            <form method="post" target="_blank"
                                                  action="{{ url('/admin/course').'/'.$registration->course->id.'/download/lor' }}">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-link"
                                                        href="{{ url('/asset/letter_of_registration.pdf') }}"
                                                        target="_blank">{{ $teacher->social_id }}</button>
                                                <label><i class="fa fa-check-square-o"></i></label>
                                            </form>
                                            </p>

                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div id="registration_release_file_upload"></div>
                                        </div>

                                    </div>
                                    <br><br>
                                    <div class="next-layout">
                                        <a class="btn btn-default btn-flat next" href="javascript:void(0)" onclick="
                                        if (confirm('Are you sure to Finalizar you will not edit?')){
                                            toastr.success('You have successfully updated the data.', 'Message');
                                            window.setTimeout(function()
                                            {window.location.href = '/admin/upcoming-courses'}, 4000);}">Finalizar</a>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="tab-pane" id="step6">--}}
                                {{--<div class="box-layout">--}}
                                    {{--<p>Este es el paso final. Usted finalizó.</p>--}}
                                    {{--<div class="next-layout">--}}
                                        {{--<a class="btn btn-success first" href="javascript:void(0)">Volver a empezar</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                            {{--</div>--}}
                        </div>
                    </div>


                    <input type="hidden" id="registration_id" value="{{ $registration->id }}">
                    <input type="hidden" id="teacher_social_id" value="{{ $teacher->social_id }}">

                </div>
            </div>

        </div>


    </div>

    @include('lms.admin.course.registration_release_file_upload')

    <style type="text/css">

        #myWizard .navbar{
            border: 1px solid #ccc;
            border-bottom: none;
            margin-bottom: 0;
            border-radius: 0;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            min-height: 0;
        }
        #myWizard h3{
            margin-top: 10px;
        }
        #myWizard .tab-content{
            padding:10px 20px;
            border: 1px solid #CCCCCC;
            min-height: 300px;
            position: inherit;
        }

        .box-layout{
            border: 1px solid #000000;
            padding:20px;
            min-height: 220px;
            position: relative;
        }
        #myWizard .next-layout{
            position: absolute;
            bottom: 10px;
            width: 100%;
            padding-right: 30px;
            text-align: right;
        }

    </style>

@stop
