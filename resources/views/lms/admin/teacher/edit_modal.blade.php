<!-- Modal -->
<div class="modal" id="edit-teacher-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-o"></i>
                    <span class="js-modal-title-edit hidden">{{ __('lms.page.teacher.form.edit_title') }}</span>
                    <span class="js-modal-title-add">{{ __('lms.page.teacher.form.add_title') }}</span>

                </h4>

            </div>
            <form class="form-horizontal js-edit-teacher-form" >

                <div class="modal-body">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="province" class="col-md-2 control-label">First Name</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="First Name" maxlength="100">
                                </div>

                                <label for="js-edit-canton-name" class="col-md-2 control-label">Last Name</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="Last" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="province" class="col-md-2 control-label">Gender</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="Gender" maxlength="100">
                                </div>

                                <label for="js-edit-canton-name" class="col-md-2 control-label">Date of Birth</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="Date of Birth" maxlength="100">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="province" class="col-md-2 control-label">Social Id</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="Social Id" maxlength="100">
                                </div>

                                <label for="js-edit-canton-name" class="col-md-2 control-label">CC</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="CC" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="province" class="col-md-2 control-label">Email</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="email" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="Email" maxlength="100">
                                </div>
                                <label for="province" class="col-md-2 control-label">Institute Email</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="email" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="Institute Email" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">

                                <label for="js-edit-canton-name" class="col-md-2 control-label">Telephone</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="Telephone" maxlength="100">
                                </div>
                                <label for="js-edit-canton-name" class="col-md-2 control-label">Mobile</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="Mobile" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">

                                <label for="js-edit-canton-name" class="col-md-2 control-label">University</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="University" maxlength="100">
                                </div>
                                <label for="js-edit-canton-name" class="col-md-2 control-label">Join Date</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="Join Date" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">

                                <label for="js-edit-canton-name" class="col-md-2 control-label">University</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="University" maxlength="100">
                                </div>
                                <label for="js-edit-canton-name" class="col-md-2 control-label">Join Date</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="Join Date" maxlength="100">
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="dist_code" class="col-md-2 control-label">Code</label>
                                <div class="col-md-4">
                                    <input id="dist_code" type="text" class="js-edit-canton-dist_code form-control" name="dist_code"
                                           value="" required placeholder="Code" maxlength="10">
                                </div>

                                <label for="zone" class="col-md-2 control-label">Zone</label>
                                <div class="col-md-4">

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
                    <button type="button" id="btn-store-teacher" data-id="" class="btn btn-primary" data-type="update">
                        <i class="fa fa-plus"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>