<!-- Modal -->
<div class="modal" id="edit-universe-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-o"></i>
                        <span class="js-modal-title-edit hidden">{{ __('lms.page.university.form.edit_title') }}</span>
                        <span class="js-modal-title-add">{{ __('lms.page.university.form.add_title') }}</span>
                    </h4>
            </div>
            <form class="form-horizontal js-edit-course-form" >

                <div class="modal-body">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <input type="hidden" name="id" class="js-university-id" value=""/>

                            <div class="form-group">
                                <label for="js-edit-university-name"
                                       class="col-md-3 col-lg-3 control-label">{{ __('lms.page.university.form.name') }}</label>
                                <div class="col-md-9 col-lg-9">
                                    <input id="js-edit-university-name" type="text" maxlength="100"
                                           class="js-edit-university-name form-control" name="course_id"
                                           required placeholder="{{ __('lms.page.university.form.name') }}"   >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-university-email"
                                       class="col-md-3 col-lg-3 control-label">{{ __('lms.page.university.form.email') }}</label>
                                <div class="col-md-9 col-lg-9">
                                    <input id="js-edit-university-email" type="email" maxlength="100"
                                           class="js-edit-university-email form-control"
                                           required placeholder="{{ __('lms.page.university.form.email') }}"  >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-university-website"
                                       class="col-md-3 col-lg-3 control-label">{{ __('lms.page.university.form.website') }}</label>
                                <div class="col-md-9 col-lg-9">
                                    <input id="js-edit-university-website" type="url" maxlength="100"
                                           class="js-edit-university-website form-control"
                                           placeholder="{{ __('lms.page.university.form.website') }}"  >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-university-phone"
                                       class="col-md-3 col-lg-3 control-label">{{ __('lms.page.university.form.phone') }}</label>
                                <div class="col-md-9 col-lg-9">
                                    <input id="js-edit-university-phone" type="text" maxlength="20"
                                           class="js-edit-university-phone form-control"
                                           placeholder="{{ __('lms.page.university.form.phone') }}"  >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="js-edit-university-note"
                                       class="col-md-3 col-lg-3 control-label">{{ __('lms.page.university.form.note') }}</label>
                                <div class="col-md-9 col-lg-9">
                                    <input id="js-edit-university-note" type="text" maxlength="255"
                                           class="js-edit-university-note form-control"
                                           placeholder="{{ __('lms.page.university.form.note') }}"  >
                                </div>
                            </div>
                            <div class="js-login-section">
                            <hr/>
                                <div class="form-group">
                                    <label class="col-md-3 col-lg-3 control-label"><i class="fa fa-info-circle"></i>&nbsp;Note</label>
                                    <code class="col-md-9 col-lg-9"
                                            >{{ __('lms.page.university.form.login_message') }}</code>
                                </div>
                            <div class="form-group">
                                <label for="js-edit-university-login_name"
                                       class="col-md-3 col-lg-3 control-label">{{ __('lms.page.university.form.login_name') }}</label>
                                <div class="col-md-9 col-lg-9">
                                    <input id="js-edit-university-login_name" type="text" maxlength="100"
                                           class="js-edit-university-login_name form-control"
                                           placeholder="{{ __('lms.page.university.form.login_name') }}"  >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="js-edit-university-login_email"
                                       class="col-md-3 col-lg-3 control-label">{{ __('lms.page.university.form.login_email') }}</label>
                                <div class="col-md-9 col-lg-9">
                                    <input id="js-edit-university-login_email" type="email" maxlength="100"
                                           class="js-edit-university-login_email form-control"
                                           placeholder="{{ __('lms.page.university.form.login_email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="js-edit-university-login_password"
                                       class="col-md-3 col-lg-3 control-label">Contraseña</label>
                                <div class="col-md-9 col-lg-9">
                                    <input id="js-edit-university-login_password" type="password" maxlength="100"
                                           class="js-edit-university-login_password form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="js-edit-university-login_confirm_password"
                                       class="col-md-3 col-lg-3 control-label">{{ __('lms.messages.confirm_pword') }}</label>
                                <div class="col-md-9 col-lg-9">
                                    <input id="js-edit-university-login_confirm_password" type="password" maxlength="100"
                                           class="js-edit-university-login_confirm_password form-control" placeholder="">
                                </div>
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
                    <button type="button" id="btn-edit-university" data-id="" class="btn btn-primary" data-type="update">
                        <i class="fa fa-plus"></i>{{ __('lms.elements.button.update') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
