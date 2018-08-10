<div class="modal" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    {{ $modal_title }}
                </h4>
            </div>

            <form class="form-horizontal {{ isset($form_class) ? $form_class: '' }}" >

                <div class="modal-body">

                    {{ $modal_body }}

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('lms.elements.button.close') }}</button>

                    {{ $footer_action_button }}
                </div>
            </form>

        </div>
    </div>
</div>