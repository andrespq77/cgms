<div class="form-group ">

    <div class="js-error-block js-{{ $name }}-block">


        <label for="js-edit-{{ $name }}" class="col-md-2 control-label">{{ $title }}</label>

        <div class="col-md-{{ isset($grid) ? $grid : '10' }}">
            {{ $slot }}
            <div class="help-block"></div>
        </div>
    </div>

</div>