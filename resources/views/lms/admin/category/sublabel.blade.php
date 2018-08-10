<form class="form-horizontal"  action="{{ url('/admin/categories/sublabel') }}" method="post">

    <div class="box-body">
        {{ csrf_field() }}

        @component('lms.admin.components.bootstrap.form-group', ['name' => __('lms.form.title')])
            <input type="text" class="form-control" id="title"
                   value="" placeholder="{{ __('lms.form.title') }}" name="title">
        @endcomponent

        @component('lms.admin.components.bootstrap.form-group', ['name' => __('lms.page.category.titles.type') ])
            <select class="form-control" id="select-type" name="type">
            </select>
        @endcomponent


        @component('lms.admin.components.bootstrap.form-group', ['name' => __('lms.page.category.titles.label') ])
            <select class="form-control" id="select-label" name="label">
                <option disabled="">Select Option</option>
            </select>
        @endcomponent

        @component('lms.admin.components.bootstrap.form-group', ['name' => ''])
            <button type="submit" class="btn btn-info btn-save-type pull-right"><i class="fa fa-save"></i> {{ __('lms.elements.button.save') }}</button>
        @endcomponent

    </div>

</form>
@include('lms.admin.category.table')
