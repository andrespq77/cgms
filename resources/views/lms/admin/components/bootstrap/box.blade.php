<div class="box">
    <div class="box-header">
        <h3 class="box-title">{{ $box_title }}</h3>

        <div class="box-tools">
            {{ $box_tools }}
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding {{ $box_body_class }}">

        {{ $slot }}

    </div>
    <div class="box-footer">
        {{ $box_footer }}
    </div>
</div>