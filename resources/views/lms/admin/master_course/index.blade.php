@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>Master course</h1>
    @component('lms.admin.components.bootstrap.breadcrumb')
        <li class=""><i class="fa fa-book"></i> Course</li>
        <li class="active"><i class="fa fa-list"></i> Master Course</li>
        <li class="">
            <a href="{{ url('/admin/master-course/create') }}"><i class="fa fa-plus"></i> create</a>
        </li>
    @endcomponent
@stop

@section('content')

    <div class="row" id="page_course_course">

        <div class="col-lg-12 col-md-12 col-sm-12">

            @component('lms.admin.components.bootstrap.box', [ 'box_body_class' => 'table-responsive' ])

                @slot('box_title')
                    All Master Course
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
                            <th width="100px">Code</th>
                            <th width="350px">Title</th>
                            <th width="350px">Subject</th>
                            <th width="100px">Child Courses</th>
                            <th width="100px">Updated By</th>
                            <th width="120px">Updated at</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($masterCourses as $course)

                        <tr id="row_{{ $course->id }}">
                            <td><small class="text-muted">{{ $course->id }}</small></td>
                            <td><code>{{ $course->course_code }}</code></td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->subject->title }}</td>
                            <td><span class="badge badge-success">{{ $course->courses->count() }}</span>&nbsp;courses</td>
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
