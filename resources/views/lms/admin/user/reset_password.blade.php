<!-- Modal -->
<div class="modal" id="reset-password-user-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-o"></i>
                        <span class="">Reset Password</span>
                    </h4>
            </div>
            <form class="form-horizontal js-reset-user-password" >

                <div class="modal-body">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <input type="hidden" name="id" class="js-user-id" value=""/>

                            <div class="form-group js-error-block js-password-block">
                                <label for="js-user-new-password"
                                       class="col-md-3 col-lg-3 control-label">New Password</label>
                                <div class="col-md-9 col-lg-9">
                                    <input type="password" id="js-user-new-password" name="new-password"
                                           class="js-user-new-password form-control"  required placeholder=""
                                           maxlength="100">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group js-error-block js-password_confirmation-block">
                                <label for="js-user-confirm-password"
                                       class="col-md-3 col-lg-3 control-label">Confirm</label>
                                <div class="col-md-9 col-lg-9">
                                    <input type="password" id="js-user-confirm-password" name="password_confirmation"
                                           class="js-user-confirm-password form-control"  required placeholder=""
                                           maxlength="100">
                                    <div class="help-block"></div>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-change-user-password" data-id="" class="btn btn-primary" data-type="update">
                        <i class="fa fa-plus"></i> Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>