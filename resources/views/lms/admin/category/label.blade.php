<form class="form-horizontal"  action="{{ url('/admin/categories/label') }}" method="post">

    <div class="box-body">
        {{ csrf_field() }}

        @component('lms.admin.components.bootstrap.form-group', ['name' => 'Title'])
            <input type="text" class="form-control" id="title"
                   value="" placeholder="title" name="title">
        @endcomponent

        @component('lms.admin.components.bootstrap.form-group', ['name' => 'Type'])
            <select class="form-control" id="select-type" name="type">
            </select>
        @endcomponent

        @component('lms.admin.components.bootstrap.form-group', ['name' => ''])
            <button type="submit" class="btn btn-info btn-save-type pull-right"><i class="fa fa-save"></i> Save</button>
        @endcomponent

    </div>

</form>
@include('lms.admin.category.table')