<label for="id_{{ $name }}" class="col-sm-2 control-label">
    {{ isset($label) ? $label : '' }}

    {{ ucfirst($title) }}
</label>
<div class="col-sm-{{ $grid }}">
    {{ $slot }}
</div>
