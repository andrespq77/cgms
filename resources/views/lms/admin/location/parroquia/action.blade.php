<div class="btn-group btn-group-sm">
    <button class="btn btn-edit-parroquia btn-primary" id="parroquia_edit_{{ $id }}" data-id="{{ $id }}"
            @include('lms.admin.location.parroquia.data-attributes')
    ><i class="fa fa-edit"></i> {{ __('lms.elements.button.edit') }}</button>
    <button class="btn btn-remove btn-remove-parroquia btn-default" data-id="{{ $id }}" data-name="{{ $parroquia_name }}"
            title="{{ __('lms.elements.button.remove') }}"
    ><i class="fa fa-trash"></i> {{ __('lms.elements.button.remove') }}</button>
</div>