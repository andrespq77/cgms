<!-- Modal -->
<div class="modal" id="edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-o"></i>
                        <span class="js-modal-title-edit hidden">{{ __('lms.page.user.form.edit_title') }}</span>
                        <span class="js-modal-title-add">{{ __('lms.page.user.form.add_title') }}</span>
                    </h4>
            </div>
            <form class="form-horizontal js-edit-course-form" >

                <div class="modal-body">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <input type="hidden" name="id" class="js-user-id" value=""/>

                            <div class="form-group">
                                <label for="js-edit-user-first-name"
                                       class="col-md-3 col-lg-3 control-label">{{ __('lms.page.user.table.first_name') }}</label>
                                <div class="col-md-9 col-lg-9">
                                    <input type="text" id="js-edit-user-first-name"
                                           class="js-edit-user-first-name form-control"
                                           value="" required placeholder="{{ __('lms.page.user.table.first_name') }}"
                                           maxlength="100">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="js-edit-user-email"
                                       class="col-md-3 col-lg-3 control-label">{{ __('lms.page.user.table.email') }}</label>
                                <div class="col-md-9 col-lg-9">
                                    <input type="email" id="js-edit-user-email"
                                           class="js-edit-user-email form-control"
                                           value="" required placeholder="{{ __('lms.page.user.table.email') }}"
                                           maxlength="100">
                                </div>
                            </div>

                            <div class="form-group js-edit-user-role-group">
                                <label for="js-edit-user-role"
                                       class="col-md-3 col-lg-3 control-label">{{ __('lms.page.user.table.role') }}</label>
                                <div class="col-md-9 col-lg-9">
                                    <select id="js-edit-user-role" class="js-edit-user-role form-control" placeholder="{{ __('lms.page.user.table.role') }}" >
                                        <option value="admin">Admin</option>
                                        <option value="void">Void</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="js-edit-user-status"
                                       class="col-md-3 col-lg-3 control-label">{{ __('lms.page.user.table.status') }}</label>
                                <div class="col-md-9 col-lg-9">
                                    <select id="js-edit-user-status" class="js-edit-user-status form-control" placeholder="{{ __('lms.page.user.table.status') }}" >
                                        <option value="active">{{ __('lms.form.active') }}</option>
                                        <option value="inactive">{{ __('lms.form.inactive') }}</option>
                                    </select>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('lms.elements.button.close') }}</button>
                    <button type="button" id="btn-edit-user" data-id="" class="btn btn-primary" data-type="update">
                        <i class="fa fa-plus"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>