<div class="box box-default">
    <div class="box-header">
        <h3 class="box-title">
            All Modalities
        </h3>
    </div>
    <div class="box-body">
        <table class="table table-responsive table-sm" id="table-modalities">

            <thead>
            <tr>
                <th>Sort</th>
                <th>{{ __('lms.form.title') }}</th>
                <th width="200px" class="text-right">{{ __('lms.form.action') }}</th>
            </tr>
            </thead>
            <tbody id="modality-body">
            @foreach($type->modalities->sortBy('sort') as $modality)
                <tr id="modality_{{ $modality->id }}">
                    <td>
                        {{ $modality->sort }}
                    </td>
                    <td>
                        {{ $modality->title }}
                    </td>

                    <td class="text-right">
                        <div class="btn-group bt-xs">
                            <button class="btn btn-default btn-edit btn-xs btn-flat" data-id="{{ $modality->id }}"
                                    data-title="{{ $modality->title }}" data-sort="{{ $modality->sort }}"
                            >{{ __('lms.elements.button.edit') }}</button>
                            <button class="btn btn-default btn-xs btn-remove btn-flat" data-id="{{ $modality->id }}"> {{ __('lms.elements.button.remove') }}</button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</div>
<style>
    .tag {
        font-size: 0.85em;
        font-weight: normal;
        padding: .3em .4em .4em;
        margin: 0 .1em;
    }
    .tag a {
        color: #bbb;
        cursor: pointer;
        opacity: 0.6;
    }
    .tag a:hover {
        opacity: 1.0
    }
    .tag .remove {
        vertical-align: bottom;
        top: 0;
    }
    .tag a {
        margin: 0 0 0 .3em;
    }
    .tag a .glyphicon-white {
        color: #fff;
        margin-bottom: 2px;
    }
</style>