<table class="table table-responsive table-sm">

    <thead>
    <tr>
        <th>Id</th>
        <th>Título</th>
        <th width="200px" class="text-right">Acción</th>
    </tr>
    </thead>
    <tbody id="{{ str_replace('admin/categories/', '', Request::path() ) }}-table">
    </tbody>

</table>
