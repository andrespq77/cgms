<!-- Modal -->
<div class="modal" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ __('lms.form.delete_item') }}</h4>
            </div>
            <div class="modal-body">

                    <p class="js-message"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-close" data-dismiss="modal">{{ __('lms.elements.button.close') }}</button>
                <button type="button" class="btn btn-danger" data-id="" data-url=""
                        id="btn-delete-confirm"><span class="fa fa-trash-o"></span> {{ __('lms.elements.button.delete') }}</button>
            </div>
        </div>
    </div>
</div>
