<div class="form-group">
    <label for="id_{{ $name }}" class="col-sm-2 control-label">{{ ucfirst($name) }}</label>
    <div class="col-sm-{{isset($grid) ? $grid : '10'  }}">
        {{ $slot }}
    </div>
</div>