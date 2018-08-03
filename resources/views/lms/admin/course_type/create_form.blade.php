    <div class="box box-info">

        <div class="box-header with-border">
            <h3 class="box-title">Informacion de la modalidad del curso</h3>
        </div>

        @if(isset($type))
        <form class="form-horizontal" method="post" action="{{ url("/admin/course-modality/$type->id") }}">
        @else
        <form class="form-horizontal" method="post" action="{{ url("/admin/course-modality/") }}">
        @endif

            <div class="box-body">
                {{ csrf_field() }}

                @component('lms.admin.components.bootstrap.form-group', ['name' => 'title'])
                    <input type="text" class="form-control" id="title"
                           value="{{ isset($type) ? $type->title : ''  }}"
                           placeholder="title" name="title">
                @endcomponent


                @component('lms.admin.components.bootstrap.form-group', ['name' => 'sort'])
                    <input type="number" class="form-control" id="sort"
                           value="{{ isset($type) ? $type->sort : '0'  }}"
                           placeholder="sort" name="sort">
                @endcomponent


                @component('lms.admin.components.bootstrap.form-group', ['name' => 'is_active'])
                    {{--{{ $question->is_active }}--}}

                    <div class="checkbox">
                        <label><input name="is_active" value="1"
                            type="checkbox" {{ isset($type) ? $type->is_active == 1 ?  'CHECKED' : ''  : '' }}>&nbsp;Está activo</label>
                    </div>
                @endcomponent

            </div>

            <div class="box-footer">
                @isset($type)
                <a href="{{ url("/admin/course-modality/create") }}" class="btn btn-default btn-flat btn-sm">
                    <i class="fas fa-plus"></i> Agregar Nuevo</a>
                @endisset

                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Grabar</button>
            </div>

        </form>

    </div>
