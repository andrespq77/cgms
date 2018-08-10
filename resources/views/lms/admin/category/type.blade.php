<form method="POST" class="form-horizontal"  action="/admin/categories/insert">

    {{ csrf_field() }}
    <div class="box-body">

        @component('lms.admin.components.bootstrap.form-group', ['name' => __('lms.form.title')])
            <input type="text" class="form-control" id="title" style="width: 50%"
                   value=""
                   placeholder="{{ __('lms.form.title') }}" name="title">
        @endcomponent

        @component('lms.admin.components.bootstrap.form-group', ['name' => ''])
            <button type="button" class="btn btn-info btn-save-type pull-left"><i class="fa fa-save"></i> {{ __('lms.elements.button.save') }}</button>
        @endcomponent

    </div>

</form>
<table class="table table-responsive table-sm" id="table-modalities">

    <thead>
        <tr>
            <th>Id</th>
            <th>{{ __('lms.form.title') }}</th>
            <th width="200px" class="text-right">{{ __('lms.form.action') }}</th>
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
                            class="btn btn-edit-title btn-sm btn-flat btn-default">{{ __('lms.elements.button.edit') }}</button>
                    <button type="button" data-id="{{ $type->id }}"
                            class="btn btn-remove-category btn-sm btn-flat btn-default"> {{ __('lms.elements.button.remove') }}</button>
                </div>
            </td>
        </tr>

    @endforeach

    </tbody>

</table>
