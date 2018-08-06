<!-- Modal -->

<div class="modal" id="upload-teacher-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-upload"></i>
                    <span class="js-modal-title">Subir Archivo</span>
                </h4>
            </div>
            <form class="form-horizontal js-upload-teachers-list" action="{{ url('/admin/teachers/upload') }}"
                  method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <div id="fine-uploader-manual-trigger"></div>
                            <i class="fa fa-info-circle text-danger"></i>
                            <a class="text-danger" href="{{ url('/sample/usuarios_lista_sample.xlsx') }}" target="_blank">
                                {{ __('lms.messages.download_sample_file') }}</a>&nbsp
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 js-message hidden">
                        </div>
                        <div class="col-lg-12 js-errors">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('lms.admin.teacher.template')
