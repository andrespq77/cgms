<div class="btn-group btn-group-xs">
    <button class="btn btn-edit-university btn-primary btn-edit" id="university_edit_{{ $id }}" data-id="{{ $id }}"
            @include('lms.admin.university.data-attributes')
    ><i class="fa fa-edit"></i> {{ __('lms.elements.button.edit') }}</button>
    <button class="btn btn-remove btn-remove-course btn-default" data-id="{{ $id }}"
            title="{{ __('lms.elements.button.remove') }}" data-name="{{ $name }}"
    ><i class="fa fa-trash"></i> {{ __('lms.elements.button.remove') }}</button>
</div>