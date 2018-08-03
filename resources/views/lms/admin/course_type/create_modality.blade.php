    <div class="box box-default">

        <div class="box-header with-border">
            <h3 class="box-title">Agragar Modalidad</h3>
        </div>

        <form class="form-horizontal"  action="#">

            <div class="box-body">
                <input type="hidden" id="type_id" value="{{ $type->id }}"/>
                {{ csrf_field() }}

                @component('lms.admin.components.bootstrap.form-group', ['name' => 'title'])
                    <input type="text" class="form-control" id="modality_title"
                           placeholder="Modality Title" name="">
                @endcomponent

                @component('lms.admin.components.bootstrap.form-group', ['name' => 'Sort'])
                    <input type="number" class="form-control" id="modality_sort"
                           placeholder="Sort Rank" name="">
                @endcomponent

            </div>

            <div class="box-footer">
                {{--@isset($type)--}}
                <a href="javascript:void(0)" class="btn btn-default btn-new-modality btn-flat btn-xs"><i class="fa fa-plus"></i> Nuevo</a>
                {{--@endisset--}}

                <button type="button" class="btn btn-default btn-add-modality pull-right" data-type="insert"
                ><i class="fa fa-plus"></i> Agregar</button>
            </div>

        </form>

    </div>
