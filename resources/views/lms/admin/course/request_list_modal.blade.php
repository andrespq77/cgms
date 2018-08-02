<!-- Modal -->
<div class="modal" id="request-list-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-o"></i>
                        &nbsp;<span class="js-modal-title-add">{{ __('lms.messages.course_request_list_modal') }}</span>
                    </h4>
            </div>
            <form class="form-horizontal js-edit-course-form" >

                <div class="modal-body">

                    <div class="row js-course-request-form">

                        <div class="col-md-12 col-md-12 col-sm-12">
                            <div id="course-request-list-uploader-manual-trigger"></div>
                            <i class="fa fa-info-circle text-danger"></i>
                            <a class="text-danger" href="{{ url('/sample/course_request_list.xlsx') }}" target="_blank">
                                {{ __('lms.messages.download_sample_file') }}</a>&nbsp
                            {{--<code>.csv, .xls, .xlsx are supported.</code>--}}
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 js-errors">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('lms.admin.course.course_request_upload_template')
