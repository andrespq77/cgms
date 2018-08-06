<!-- Modal -->
<div class="modal" id="create-moodal-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-o"></i> <span class="js-modal-title">Create Modal User</span></h4>
            </div>
            <form class="form-horizontal js-edit-canton-form" >

                <div class="modal-body">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">


                            <div class="form-group">
                                <label for="province" class="col-md-4 control-label">Birth Date</label>
                                <div class="col-md-48">
                                    <input id="js-date-of-birth" type="text" class="js-edit-canton-district form-control" name="district"
                                           value="" required  maxlength="50">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-canton-name" class="col-md-4 control-label">Cédula</label>
                                <div class="col-md-8">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="Canton Name" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-canton-capital" class="col-md-4 control-label">AMIE</label>
                                <div class="col-md-8">
                                    <input id="js-edit-canton-capital" type="text" class="js-edit-canton-capital form-control" name="capital"
                                           value="" required placeholder="AMIE" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-canton-district" class="col-md-4 control-label">Canton</label>
                                <div class="col-md-8">
                                    <input id="js-edit-canton-district" type="text" class="js-edit-canton-district form-control" name="district"
                                           value="" required placeholder="Canton" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-workarea" class="col-md-4 control-label">Work area</label>
                                <div class="col-md-8">
                                    <input id="js-workarea" type="text" class="js-edit-canton-dist_code form-control" name="dist_code"
                                           value="" required placeholder="Work Area" maxlength="10">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="zone" class="col-md-4 control-label">Score</label>
                                <div class="col-md-4">

                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <label for="js-teacher-email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-8">
                                    <input id="js-teacher-email" type="text" class="js-edit-canton-dist_code form-control" name="dist_code"
                                           value="" required placeholder="Email" maxlength="10">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="js-teacher-password" class="col-md-4 control-label">Contraseña</label>
                                <div class="col-md-8">
                                    <input id="js-teacher-password" type="password" class="js-edit-canton-dist_code form-control" name="dist_code"
                                           value="" required placeholder="Password" maxlength="10">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirm" class="col-md-4 control-label">Confirmar Contraseña</label>
                                <div class="col-md-8">
                                    <input id="js-teacher-password_confirm" type="password" class="js-edit-canton-dist_code form-control" name="dist_code"
                                           value="" required placeholder="Confirm Password" maxlength="10">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 js-errors">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btn-edit-canton" data-id="" class="btn btn-primary" data-type="update">
                        <i class="fa fa-upload"></i> Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>