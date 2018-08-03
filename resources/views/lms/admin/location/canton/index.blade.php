@extends('adminlte::page')

@include('lms.admin.parts.title')

@section('content_header')
    <h1>{{ __('lms.location.canton.index.page_header') }}</h1>
@stop

@section('content')

    <div class="row" id="page_canton">
        <div class="col-lg-8 col-md-10 col-sm-12 col-lg-offset-2 col-md-offset-1">

            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <h3 class="box-title">{{ __('lms.location.canton.index.table_header') }}</h3>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-sm btn-primary" id="btn-create-canton">
                            <i class="fa fa-plus"></i> {{ __('lms.elements.button.create') }}</button>
                    </div>
                </div>
                <div class="box-body">

                    <table class="table table-bordered table-responsive" id="cantons-table">
                        <thead>
                            <tr>
                                <th>{{ __('lms.location.canton.table.province_name') }}</th>
                                <th>{{ __('lms.location.canton.table.canton_name') }}</th>
                                <th>{{ __('lms.location.canton.table.canton_capital') }}</th>
                                <th>{{ __('lms.location.canton.table.district_name') }}</th>
                                <th>{{ __('lms.location.canton.table.district_code') }}</th>
                                <th>{{ __('lms.location.canton.table.zone') }}</th>
                                <th>{{ __('lms.location.canton.table.action') }}</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                    </table>

                </div>
            </div>


        </div>
    </div>

    @include('lms.admin.location.canton.edit_modal')
    @include('lms.admin.parts.modal_delete')

@stop