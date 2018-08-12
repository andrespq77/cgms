    <div id="master-course" class="box box-info">

        <span class="js-title"></span>
        <div class="box-header with-border">
            <h3 class="box-title">{{ __('lms.page.master_course.index.master_course_info') }}</h3>
        </div>

        @if(isset($master))
            <form class="form-horizontal" method="post" action="{{ url("/admin/master-course/$master->id ") }}">
        @else
            <form class="form-horizontal" method="post" action="{{ url("/admin/master-course/") }}">
        @endif

            <div class="box-body">
                {{ csrf_field() }}

                @component('lms.admin.components.bootstrap.form-group', ['name' => __('lms.page.category.titles.type') ])
                    <select class="form-control" id="select-type" name="type">
                    @foreach($category['type'] as $type)
                        <option value="{{$type->id}}" {{@$master->type_id==$type->id ? 'selected' : ''}}>{{$type->title}}</option>
                    @endforeach
                    </select>
                @endcomponent


                @component('lms.admin.components.bootstrap.form-group', ['name' => __('lms.page.category.titles.label') ])
                    <select class="form-control" id="select-label" name="label">
                        <option disabled="">{{ __('lms.form.select_option') }}</option>
                        @foreach($category['labels'] as $label)
                            <option value="{{$label->id}}" {{@$master->label_id==$label->id ? 'selected' : ''}}> {{$label->title}} </option>
                        @endforeach
                    </select>
                @endcomponent

                @component('lms.admin.components.bootstrap.form-group', ['name' => __('lms.page.category.titles.sublabel') ])
                    <select class="form-control" id="select-sublabel" name="sublabel">
                        <option disabled="">{{ __('lms.form.select_option') }}</option>
                        @foreach($category['sub_labels'] as $sublabel)
                            <option value="{{$sublabel->id}}" {{@$master->sub_label_id==$sublabel->id ? 'selected' : ''}}> {{$sublabel->title}} </option>
                        @endforeach
                    </select>
                @endcomponent


                @component('lms.admin.components.bootstrap.form-group', ['name' => __('lms.page.category.titles.knowledge') ])
                    <select class="form-control" id="select-knowledge" name="knowledge">
                        <option disabled="">{{ __('lms.form.select_option') }}</option>
                        @foreach($category['knowledge'] as $knowledge)
                            <option value="{{$knowledge->id}}" {{@$master->knowledge_id==$knowledge->id ? 'selected' : ''}}>{{$knowledge->title}}</option>
                        @endforeach
                    </select>
                @endcomponent


                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Subject'])
                    <select class="form-control" id="select-subject" name="subject">
                        <option disabled="">{{ __('lms.form.select_option') }}</option>
                        @foreach($category['subject'] as $subject)
                            <option value="{{$subject->id}}" {{@$master->subject_id==$subject->id ? 'selected' : ''}}>{{$subject->title}}</option>
                        @endforeach
                    </select>
                @endcomponent

                @component('lms.admin.components.bootstrap.form-group', ['name' => __('lms.page.master_course.table.course_code')])
                    <input type="text" class="form-control" id="code" maxlength="20"
                           value="{{ isset($master) ? @$master->course_code : ''  }}"
                           placeholder="{{ __('lms.page.master_course.table.course_code') }}" name="course_code">
                @endcomponent

                @component('lms.admin.components.bootstrap.form-group', ['name' => __('lms.page.master_course.table.course_title')])
                    <input type="text" class="form-control" id="title" maxlength="250"
                           value="{{ isset($master) ? @$master->name : ''  }}"
                           placeholder="{{ __('lms.page.master_course.table.course_title') }}" name="name">
                @endcomponent


            </div>

            <div class="box-footer">
                @isset($master)
                    <a href="{{ url("/admin/master-course/create") }}" class="btn btn-default btn-flat btn-sm">
                        <i class="fas fa-plus"></i> {{ __('lms.elements.button.add_new') }}
                    </a>
                @endisset

                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> {{ __('lms.elements.button.save') }}</button>
            </div>

        </form>

    </div>
