<!-- Modal -->
<div class="modal" id="edit-parroquia-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <i class="fa fa-file-o"></i>
                    <span class="js-modal-title">Edit Parroquia</span></h4>
            </div>
            <form class="form-horizontal js-edit-parroquia-form" >

                <div class="modal-body">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <input type="hidden" name="id" class="js-jotform-id" value=""/>

                            <div class="form-group">
                                <label for="province" class="col-md-2 control-label">Province</label>
                                <div class="col-md-4">
                                    <select id="province" class="js-edit-canton-province js-select-province form-control" name="province">
                                    </select>
                                </div>

                                <label for="js-edit-canton" class="col-md-2 control-label">Canton</label>
                                <div class="col-md-4">
                                    <select id="js-edit-canton" class="js-edit-canton js-select-canton form-control" name="canton">
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="js-edit-parroquia-name" class="col-md-2 control-label">Parroquia Name</label>
                                <div class="col-md-10">
                                    <input id="js-edit-parroquia-name" type="text" class="js-edit-parroquia-name form-control" name="parroquia"
                                           value="" required placeholder="Capital" maxlength="100">
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
                    <button type="button" id="btn-edit-parroquia" data-id="" class="btn btn-primary" data-type="update">
                        <i class="fa fa-plus"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>