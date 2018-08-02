<form class="form-horizontal"  action="#">

    <div class="box-body">
        {{ csrf_field() }}

        @component('lms.admin.components.bootstrap.form-group', ['name' => 'title'])
            <input type="text" class="form-control" id="title"
                   value=""
                   placeholder="title" name="title">
        @endcomponent

        @component('lms.admin.components.bootstrap.form-group', ['name' => ''])
            <button type="button" class="btn btn-info btn-save-type pull-right"><i class="fa fa-save"></i> Save</button>
        @endcomponent

    </div>

</form>
<table class="table table-responsive table-sm" id="table-modalities">

    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th width="200px" class="text-right">Action</th>
        </tr>
    </thead>
    <tbody id="type-table">

    @foreach($category['type'] as $type)
        <tr id="row_type_{{ $type->id }}">
            <td>{{ $type->id }}</td>
            <td>{{ $type->title }}</td>
            <td class="text-right">
                <div class="btn-group">
                    <button type="button" data-id="{{ $type->id }}" data-title="{{ $type->title }}"
                            class="btn btn-edit-type btn-sm btn-flat btn-default">Edit</button>
                    <button type="button" data-id="{{ $type->id }}"
                            class="btn btn-remove-category btn-sm btn-flat btn-default">Remove</button>
                </div>
            </td>
        </tr>
    @endforeach

    </tbody>

</table>