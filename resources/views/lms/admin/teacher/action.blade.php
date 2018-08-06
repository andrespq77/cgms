<div class="btn-group btn-group-xs">
    <a href="{{ url("/admin/teachers/$teacher->id/edit") }}"
       class="btn btn-edit-teacher btn-primary" id="teacher_edit_{{ $teacher->id }}"
       data-id="{{ $teacher->id }}">
        <i class="fa fa-edit"></i> {{ __('lms.elements.button.edit') }}</a>


    <button class="btn btn-remove btn-remove-teacher btn-default"
            data-id="{{ $teacher->id }}"
            data-name="{{ $teacher->first_name }}"
            title="{{ __('lms.elements.button.remove') }}">
        <i class="fa fa-trash"></i> {{ __('lms.elements.button.remove') }}</button>
</div>