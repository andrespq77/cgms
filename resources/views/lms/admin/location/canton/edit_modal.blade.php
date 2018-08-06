<!-- Modal -->
<div class="modal" id="edit-canton-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-o"></i> <span class="js-modal-title">Edit Canton</span></h4>
            </div>
            <form class="form-horizontal js-edit-canton-form" >

                <div class="modal-body">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <input type="hidden" name="id" class="js-jotform-id" value=""/>

                            <div class="form-group">
                                <label for="province" class="col-md-2 control-label">Province</label>
                                <div class="col-md-4">
                                    <select id="province"  style="width: 100%"
                                            class="js-edit-canton-province js-province form-control" name="province"></select>
                                </div>

                                <label for="js-edit-canton-name" class="col-md-2 control-label">Canton Name</label>
                                <div class="col-md-4">
                                    <input id="js-edit-canton-name" type="text" class="js-edit-canton-name form-control" name="canton_name"
                                           value="" required placeholder="Canton Name" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-canton-capital" class="col-md-2 control-label">Capital</label>
                                <div class="col-md-10">
                                    <input id="js-edit-canton-capital" type="text" class="js-edit-canton-capital form-control" name="capital"
                                           value="" required placeholder="Capital" maxlength="100">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-canton-district" class="col-md-2 control-label">District</label>
                                <div class="col-md-10">
                                    <input id="js-edit-canton-district" type="text" class="js-edit-canton-district form-control" name="district"
                                           value="" required placeholder="District" maxlength="100">
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
                                    <select id="zone" class="js-edit-canton-zone form-control" name="zone">
                                        <option value="Zona 1">{{ __('lms.words.zone') }} 1</option>
                                        <option value="Zona 2">{{ __('lms.words.zone') }} 2</option>
                                        <option value="Zona 3">{{ __('lms.words.zone') }} 3</option>
                                        <option value="Zona 4">{{ __('lms.words.zone') }} 4</option>
                                        <option value="Zona 5">{{ __('lms.words.zone') }} 5</option>
                                        <option value="Zona 6">{{ __('lms.words.zone') }} 6</option>
                                        <option value="Zona 7">{{ __('lms.words.zone') }} 7</option>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-edit-canton" data-id="" class="btn btn-primary" data-type="update">
                        <i class="fa fa-plus"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>