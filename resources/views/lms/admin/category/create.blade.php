@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')

    <div class="row" id="page_category">
        <div class="col-lg-12 col-md-12 col-sm-12">

            @component('lms.admin.components.bootstrap.box', [ 'box_body_class' => '' ])

                @slot('box_title')
                    <span class="js-title">{{ str_replace('admin/categories/', '', Request::path() ) }}</span>
                @endslot

                @slot('box_tools')@endslot

                    @include('lms.admin.category.'.str_replace('admin/categories/', '', Request::path() ))

                @slot('box_footer')@endslot

            @endcomponent

        </div>
    </div>

    @component('lms.admin.components.bootstrap.modal.modal',
        [
            'modal_id' => 'modal-edit-category',
            'modal_title' => 'Edit Category Title',

        ])

        @slot('modal_body')

            @component('lms.admin.components.bootstrap.form-group', ['name' => 'Title'])
                <input required type="text" class="form-control" id="js-input-edit-category-title"
                       value="" placeholder="title" name="title">
            @endcomponent


        @endslot

        @slot('footer_action_button')
            <button type="button" class="btn btn-primary btn-edit-category-title"
            data-id="">Save</button>
        @endslot

    @endcomponent

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

@stop