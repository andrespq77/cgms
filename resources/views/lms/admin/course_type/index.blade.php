@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>Course Modality</h1>
    @component('lms.admin.components.bootstrap.breadcrumb')
        <li class=""><i class="fa fa-book"></i> {{ __('lms.words.course') }}</li>
        <li class="active"><i class="fa fa-list"></i> {{ __('lms.words.course_modality') }}</li>
        <li class="">
            <a href="{{ url('/admin/course-modality/create') }}"><i class="fa fa-plus"></i> {{ __('lms.elements.button.create') }}</a>
        </li>
    @endcomponent
@stop

@section('content')

    <div class="row" id="page_course_type">

        <div class="col-lg-12 col-md-12 col-sm-12">

            @component('lms.admin.components.bootstrap.box', [ 'box_body_class' => 'table-responsive' ])

                @slot('box_title')
                    Todas las Modalidades
                @endslot

                @slot('box_tools')

                @endslot

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th width="20px">ID</th>
                            <th width="30px">Conteo</th>
                            <th width="350px">Título</th>
                            {{--<th width="350px">Modalidad</th>--}}
                            <th width="100px">Estado</th>
                            <th width="100px">Actualizado por</th>
                            <th width="120px">Actualizado el</th>
                            <th width="150px">Acción</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($courseTypes as $type)

                        <tr id="row_{{ $type->id }}">
                            <td><small class="text-muted">{{ $type->id }}</small></td>
                            <td>{{ $type->sort }}</td>
                            <td>{{ $type->title }}</td>
                            <td>
                                @if($type->is_active == 1)
                                    <span class="label label-success">Activo</span>
                                    @else
                                    <span class="label label-default">Inactivo</span>
                                @endif

                            </td>
                            <td>{{ $type->updatedBy->name }}</td>
                            <td>{{ $type->updated_at->diffForHumans() }}</td>
                            <td>
                                <form action="{{ url("/admin/course-modality/$type->id") }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">

                                    <div class="btn-group btn-group-xs">
                                        <a href="{{ url('/admin/course-modality/'.$type->id) }}"
                                           class="btn btn-flat btn-primary"><i class="fa fa-edit"></i> Editar</a>
                                        <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i> Eliminar</button>
                                    </div>
                                </form>
                            </td>
                        </tr>

                    @endforeach


                    </tbody>

                </table>

                @slot('box_footer')
                        {{ $courseTypes->appends(request()->query())->links() }}
                @endslot
            @endcomponent

        </div>

    </div>

@stop
