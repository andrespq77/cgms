/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    var pageCourseLength = $('#course-upload-modal').length;
    var app_url = $('#app_url').val();

    if(pageCourseLength > 0) {

        var requestListModal = $('#course-upload-modal');
        /**
         * Course Request List Upload for course & teachers
         */
        $('#btn-new-course-upload').click(function () {

            console.log('course upload modal');
            requestListModal.modal('show');

        });


        $('#new-course-list-uploader-manual-trigger').fineUploader({
            template: 'qq-new-course-template-manual-trigger',
            multiple: false,
            request: {
                endpoint: app_url+'/admin/course/upload/new-course',
                customHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            validation: {
                itemLimit: 1,
                allowedExtensions:  ['csv', 'xls', 'xlsx'],
            },
            callbacks: {
                onSubmit: function (id, name) {

                },
                onComplete: function (id, name, response, xhr ) {

                },
                onStatusChange: function (id, oldStatus, newStatus) {

                },
                onCancel: function (id, name) {

                }
            },
            autoUpload: false
        });

        $('#btn-upload-new-course-list').click(function() {
            $('#new-course-list-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });


    }//end page

});