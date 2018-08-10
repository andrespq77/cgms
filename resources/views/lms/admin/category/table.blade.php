<table class="table table-responsive table-sm">

    <thead>
    <tr>
        <th>Id</th>
        <th>{{ __('lms.form.title') }}</th>
        <th width="200px" class="text-right">{{ __('lms.form.action') }}</th>
    </tr>
    </thead>
    <tbody id="{{ str_replace('admin/categories/', '', Request::path() ) }}-table">
    </tbody>

</table>
