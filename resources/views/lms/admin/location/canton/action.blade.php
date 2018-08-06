<div class="btn-group btn-group-sm">
    <button class="btn btn-edit-canton btn-primary" id="canton_edit_{{ $id }}" data-id="{{ $id }}"
            @include('lms.admin.location.canton.data-attributes')
    ><i class="fa fa-edit"></i> {{ __('lms.elements.button.edit') }}</button>
    <button class="btn btn-remove btn-remove-canton btn-default" data-id="{{ $id }}" data-name="{{ $canton_name }}"
            title="{{ __('lms.elements.button.remove') }}"
    ><i class="fa fa-trash"></i> {{ __('lms.elements.button.remove') }}</button>
</div>