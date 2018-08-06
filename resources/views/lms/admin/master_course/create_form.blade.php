    <div id="master-course" class="box box-info">

        <span class="js-title"></span>
        <div class="box-header with-border">
            <h3 class="box-title">Master Course Info</h3>
        </div>

        @if(isset($master))
            <form class="form-horizontal" method="post" action="{{ url("/admin/master-course/$master->id ") }}">
        @else
            <form class="form-horizontal" method="post" action="{{ url("/admin/master-course/") }}">
        @endif

            <div class="box-body">
                {{ csrf_field() }}

                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Type'])
                    <select class="form-control" id="select-type" name="type"></select>
                @endcomponent


                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Label'])
                    <select class="form-control" id="select-label" name="label">
                        <option disabled="">Select Option</option>
                    </select>
                @endcomponent

                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Sub Label'])
                    <select class="form-control" id="select-sublabel" name="sublabel">
                        <option disabled="">Select Option</option>
                    </select>
                @endcomponent


                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Knowledge'])
                    <select class="form-control" id="select-knowledge" name="knowledge">
                        <option disabled="">Select Option</option>
                    </select>
                @endcomponent


                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Subject'])
                    <select class="form-control" id="select-subject" name="subject">
                        <option disabled="">Select Option</option>
                    </select>
                @endcomponent

                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Course Code'])
                    <input type="text" class="form-control" id="code" maxlength="20"
                           value="{{ isset($master) ? $master->course_code : ''  }}"
                           placeholder="Course Code" name="course_code">
                @endcomponent

                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Course Title'])
                    <input type="text" class="form-control" id="title" maxlength="250"
                           value="{{ isset($master) ? $master->name : ''  }}"
                           placeholder="Course Title" name="name">
                @endcomponent


            </div>

            <div class="box-footer">
                @isset($master)
                    <a href="{{ url("/admin/master-course/create") }}" class="btn btn-default btn-flat btn-sm">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                @endisset

                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Save</button>
            </div>

        </form>

    </div>
