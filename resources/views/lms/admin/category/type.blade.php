<form method="POST" class="form-horizontal"  action="/admin/categories/insert">

    {{ csrf_field() }}
    <div class="box-body">

<<<<<<< HEAD
        @component('lms.admin.components.bootstrap.form-group', ['name' => 'Título'])
            <input type="text" class="form-control" id="title"
=======
        @component('lms.admin.components.bootstrap.form-group', ['name' => 'title'])
            <input type="text" class="form-control" id="title" style="width: 50%"
>>>>>>> origin/dev
                   value=""
                   placeholder="title" name="title">
        @endcomponent

        @component('lms.admin.components.bootstrap.form-group', ['name' => ''])
<<<<<<< HEAD
            <button type="button" class="btn btn-info btn-save-type pull-right"><i class="fa fa-save"></i> Grabar</button>
=======
            <button type="button" class="btn btn-info btn-save-type pull-left"><i class="fa fa-save"></i> Save</button>
>>>>>>> origin/dev
        @endcomponent

    </div>

</form>
<table class="table table-responsive table-sm" id="table-modalities">

    <thead>
        <tr>
            <th>Id</th>
            <th>Título</th>
            <th width="200px" class="text-right">Acción</th>
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
<<<<<<< HEAD
                            class="btn btn-edit-type btn-sm btn-flat btn-default">Editar</button>
=======
                            class="btn btn-edit-title btn-sm btn-flat btn-default">Edit</button>
>>>>>>> origin/dev
                    <button type="button" data-id="{{ $type->id }}"
                            class="btn btn-remove-category btn-sm btn-flat btn-default">Borrar</button>
                </div>
            </td>
        </tr>

    @endforeach

    </tbody>

</table>
