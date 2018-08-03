    <div id="master-course" class="box box-info">

        <span class="js-title"></span>
        <div class="box-header with-border">
            <h3 class="box-title">Informacion del Curso Maestro</h3>
        </div>

        @if(isset($master))
            <form class="form-horizontal" method="post" action="{{ url("/admin/master-course/$master->id ") }}">
        @else
            <form class="form-horizontal" method="post" action="{{ url("/admin/master-course/") }}">
        @endif

            <div class="box-body">
                {{ csrf_field() }}

                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Tipo'])
                    <select class="form-control" id="select-type" name="type"></select>
                @endcomponent


                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Etiqueta'])
                    <select class="form-control" id="select-label" name="label">
                        <option disabled="">Seleccione Opción</option>
                    </select>
                @endcomponent

                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Sub Etiqueta'])
                    <select class="form-control" id="select-sublabel" name="sublabel">
                        <option disabled="">Seleccione Opción</option>
                    </select>
                @endcomponent


                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Conocimiento'])
                    <select class="form-control" id="select-knowledge" name="knowledge">
                        <option disabled="">Seleccione Opción</option>
                    </select>
                @endcomponent


                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Tema'])
                    <select class="form-control" id="select-subject" name="subject">
                        <option disabled="">Seleccione Opción</option>
                    </select>
                @endcomponent

                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Código del curso'])
                    <input type="text" class="form-control" id="code" maxlength="20"
                           value="{{ isset($master) ? $master->course_code : ''  }}"
                           placeholder="Course Code" name="course_code">
                @endcomponent

                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Título del curso'])
                    <input type="text" class="form-control" id="title" maxlength="250"
                           value="{{ isset($master) ? $master->name : ''  }}"
                           placeholder="Course Title" name="name">
                @endcomponent


            </div>

            <div class="box-footer">
                @isset($master)
                    <a href="{{ url("/admin/master-course/create") }}" class="btn btn-default btn-flat btn-sm">
                        <i class="fas fa-plus"></i> Agregar nuevo
                    </a>
                @endisset

                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Grabar</button>
            </div>

        </form>

    </div>
