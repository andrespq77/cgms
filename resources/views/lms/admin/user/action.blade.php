<div class="btn-group btn-group-xs">
    <button class="btn btn-change-user-password-action btn-default"  data-id="{{ $id }}">
        <i class="fa fa-exchange"></i> Reset Contraseña</button>
    <button class="btn btn-edit-user btn-primary btn-edit" id="user_edit_{{ $id }}" data-id="{{ $id }}"
            @include('lms.admin.user.data-attributes')
    ><i class="fa fa-edit"></i> {{ __('lms.elements.button.edit') }}</button>
    <button class="btn btn-remove btn-remove-user btn-default" data-id="{{ $id }}"
            title="{{ __('lms.elements.button.remove') }}" data-name="{{ $name }}"
    ><i class="fa fa-trash"></i> {{ __('lms.elements.button.remove') }}</button>
</div>
