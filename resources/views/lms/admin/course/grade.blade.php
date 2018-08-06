
@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')

    <div class="row" id="course_grade_page">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-offset-0 col-sm-offset-0  toppad" >


            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $course->university->name }}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        {{--<div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>--}}

                        <div class=" col-md-6 col-lg-6 col-sm-12 ">
                            <table class="table table-course-information">
                                <tbody>
                                <tr>
                                    <td>{{ __('lms.page.course.form.master_course') }}</td>
                                    <td><strong>{{ $course->masterCourse->name }}</strong>

                                    <small class="text-info">({{ $course->masterCourse->subject->title }})</small></td>
                                </tr>
                                <tr>
                                    <td>{{ __('lms.page.course.form.short_name') }}</td>
                                    <td><strong class="strong"> {{ $course->short_name }}</strong></td>
                                </tr>
                                <tr>
                                    <td>{{ __('lms.page.course.form.course_id') }}:</td>
                                    <td><code>{{ $course->course_code }}</code></td>
                                </tr>

                                <tr>
                                    <td>{{ __('lms.page.course.form.course_modality') }}</td>
                                    <td>{{ $course->modality->title }}</td>
                                </tr>


                                <tr>
                                    <td>{{ __('lms.page.course.form.hours') }}</td>
                                    <td>{{ $course->hours }} hours</td>
                                </tr>

                                <tr>
                                    <td>{{ __('lms.page.course.form.quota') }}</td>
                                    <td><span class="badge">{{ $course->quota }}</span> personas</td>
                                </tr>
                                <tr>
                                    <td>{{ __('lms.page.course.form.stage') }}</td>
                                    <td>
                                        <span class="label label-{{ $course->stageTitle['class'] }}">
                                            {{ $course->stageTitle['title'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('lms.page.course.form.status') }}</td>
                                    <td>
                                        <span class="label label-{{ $course->statusTitle['class'] }}">
                                            {{ $course->statusTitle['title'] }}</span>
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class=" col-md-6 col-lg-6 col-sm-12 ">
                            <table class="table table-course-information">
                                <tbody>
                                    <tr>
                                        <td>{{ __('lms.page.course.form.comment') }}</td>
                                        <td>{{ $course->comment }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('lms.page.course.form.start_date') }}</td>
                                        <td>{{ date('d M Y', strtotime($course->start_date)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('lms.page.course.form.end_date') }}</td>
                                        <td>{{ date('d M Y', strtotime($course->end_date)) }}</td>
                                    </tr>

                                    <tr>
                                        <td>Solicitudes Totales</td>
                                        <td><code>{{ $course->requests->count() }}</code></td>
                                    </tr>

                                    <tr>
                                        <td>Registros Totales</td>
                                        <td>
                                            <span class="label label-info"> Registrados</span> <span class="badge badge-info">{{ $course->registrations->count() }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Aprovados</td>
                                        <td>
                                            <span class="label label-success">Aprovados</span> <span class="badge badge-success">{{ $course->approvedRegistrations->count() }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Nota agragada {{ __('lms.page.course.form.start_date') }}</td>
                                        <td class="text-success">{{ date('d M Y', strtotime($course->grade_upload_start_date)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nota agregada {{ __('lms.page.course.form.end_date') }}</td>
                                        <td class="text-warning">{{ date('d M Y', strtotime($course->grade_upload_end_date)) }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @can('addmark', $course)
    <div class="row" id="page_grade_upload">
        <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">Registrados</h3>
                    </div>
                    <div class="pull-right">
                        <form action="{{ url('/admin/course/'.$course->id.'/download-grade-template') }}" method="post"
                              target="_blank">
                        <div class="btn-group">
                                {{ csrf_field() }}
                            <a class="btn btn-link" href="javascript:void(0)" title="Pantilla de ingreso de Notas" data-trigger="hover"
                               data-content="Ingrese una nota numérica en la columna [grade] y agrege `1` en la columna [grade_approved] paara marcar como aprobado"
                               data-placement="top" title="Instruction" data-toggle="popover"><i class="fa fa-info"></i>
                            </a>
                            <button class="btn btn-sm btn-warning" id="btn-create-university" type="submit">
                                <i class="fa fa-cloud-download"></i> Descargar la plantilla de notas</button>

                            @if (Carbon\Carbon::now()->between(Carbon\Carbon::parse($course->grade_upload_start_date),
                                                        Carbon\Carbon::parse($course->grade_upload_end_date)))
                                <button class="btn btn-info btn-upload-grade btn-sm btn-flat" type="button"
                                    data-id="{{ $course->id }}"><i class="fa fa-cloud-upload"></i> Subir notas
                                </button>
                            @endif

                        </div>
                        </form>

                    </div>
                </div>
                <div class="box-body">

                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Instituto</th>
                                <th>Email</th>
                                <th>Nota</th>
                                <th>Estado</th>
                                <th>Certificado</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($course->registrations as $registration)
                                <tr>
                                    <td>{{ $registration->student->social_id }}</td>
                                    <td>{{ $registration->student->first_name }}</td>
                                    <td>{{ $registration->student->university_name }}</td>
                                    <td>{{ $registration->student->inst_email }}</td>
                                    @include('lms.admin.registration.parts.table.td.mark_approved')
                                    @include('lms.admin.registration.parts.table.td.diploma')

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal" id="course-add-mark-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i>
                        <span class="js-modal-title-add">Agregar Notas</span>
                    </h4>
                </div>
                <form class="form-horizontal" >

                    <div class="modal-body">

                        <div class="col-md-12 col-md-12 col-sm-12">

                            <div id="course-mark-add-uploader-manual-trigger"></div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/template" id="qq-course-mark-upload-template">
        <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here.">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="buttons">
                <div class="qq-upload-button-selector qq-upload-button">
                    <div>Seleccionar archivo</div>
                </div>
                <button type="button" id="btn-upload-course-mark-list" class="btn btn-primary">
                    <i class="icon-upload icon-white"></i> Subir
                </button>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Procesando archivos...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <div class="qq-progress-bar-container-selector">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                    <span class="qq-upload-file-selector qq-upload-file"></span>
                    <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancelar</button>
                    <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Reintentar</button>
                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Eliminar</button>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cerrar</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">No</button>
                    <button type="button" class="qq-ok-button-selector">Si</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancelar</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
        </div>
    </script>
    @endcan




<style>

    #course-inspection-form-uploader-manual-trigger .qq-upload-button{
        margin-right: 15px;
    }

    #fine-uploader-manual-trigger .buttons {
        width: 36%;
    }

    #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
        width: 60%;
    }
</style>

@stop
