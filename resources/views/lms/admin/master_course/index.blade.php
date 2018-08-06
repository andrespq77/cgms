@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>Cursos Maestros</h1>
    @component('lms.admin.components.bootstrap.breadcrumb')
        <li class=""><i class="fa fa-book"></i> Curso</li>
        <li class="active"><i class="fa fa-list"></i> Cursos Maestros</li>
        <li class="">
            <a href="{{ url('/admin/master-course/create') }}"><i class="fa fa-plus"></i> Crear</a>
        </li>
    @endcomponent
@stop

@section('content')

    <div class="row" id="page_course_course">

        <div class="col-lg-12 col-md-12 col-sm-12">

            @component('lms.admin.components.bootstrap.box', [ 'box_body_class' => 'table-responsive' ])

                @slot('box_title')
                    Todos los Cursos Maestros
                @endslot

                @slot('box_tools')
                    {{--<div class="input-group input-group-sm" style="width: 150px;">--}}
                        {{--<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">--}}

                        {{--<div class="input-group-btn">--}}
                        {{--<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                @endslot

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th width="20px">ID</th>
                            <th width="100px">Código</th>
                            <th width="350px">Título</th>
                            <th width="350px">Tema</th>
                            <th width="100px">Cursos hijos</th>
                            <th width="100px">Actulizado por</th>
                            <th width="120px">Actualizado hace</th>
                            <th width="150px">Acción</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($masterCourses as $course)

                        <tr id="row_{{ $course->id }}">
                            <td><small class="text-muted">{{ $course->id }}</small></td>
                            <td><code>{{ $course->course_code }}</code></td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->subject->title }}</td>
                            <td><span class="badge badge-success">{{ $course->courses->count() }}</span>&nbsp;cursos</td>
                            <td>{{ $course->updatedBy->name }}</td>
                            <td>{{ $course->updated_at->diffForHumans() }}</td>
                            <td>
                                <form action="{{ url("/admin/master-course/$course->id") }}" method="post" id="{{$course->id}}">
                                    @csrf
                                    @method('DELETE')

                                    <div class="btn-group btn-group-xs">
                                        <a href="{{ url('/admin/master-course/'.$course->id) }}"
                                           class="btn btn-flat btn-primary">
                                            <i class="fa fa-edit"></i> {{ __('lms.elements.button.edit') }}
                                        </a>

                                        @if($course->courses->count()==0)
                                            <a type="submit" class="btn btn-flat btn-warning" onclick="if (confirm('Esta seguro que quiere eliminar?')) { document.getElementById({{$course->id}}).submit(); }">

                                                <i class="fa fa-trash"></i> {{ __('lms.elements.button.delete') }}
                                            </a>
                                        @endif

                                    </div>
                                </form>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>

                </table>

                @slot('box_footer')
                        {{ $masterCourses->appends(request()->query())->links() }}
                @endslot
            @endcomponent

        </div>

    </div>

@stop
