var grade_page = $('#course_grade_page').length;
var app_url = $('#app_url').val();


if (grade_page > 0){


    var addMark = $('#course-add-mark-modal');
    var courseId = null;

    showAddMark();

    function showAddMark() {

        $('.btn-upload-grade').click(function () {

            courseId = $(this).attr('data-id');
            addMark.modal('show');
            $('#btn-upload-course-mark-list').attr('data-id', courseId);
        });
    }


    $('#course-mark-add-uploader-manual-trigger').fineUploader({
        template: 'qq-course-mark-upload-template',
        multiple: false,
        request: {
            endpoint: app_url+'/admin/course/'+$('.btn-upload-grade').attr('data-id')+'/add-grade',
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

                if(response.success){
                    toastr.success("Grade updated successfully.", "Info");
                    window.setTimeout(function(){location.reload()}, 3000);
                }
                else{
                    toastr.error(response.error, "Error");
                }

            },
            onStatusChange: function (id, oldStatus, newStatus) {

            },
            onCancel: function (id, name) {

            }
        },
        autoUpload: false
    });

    $('#btn-upload-course-mark-list').click(function() {
        $('#course-mark-add-uploader-manual-trigger').fineUploader('uploadStoredFiles');
    });


}