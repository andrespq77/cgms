/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    var pageCourseLength = $('#page_register').length;
    var app_url = $('#app_url').val();


    if(pageCourseLength > 0) {


        var registrationId = $('#registration_id').val();


        $('#page_register .btn-accept-tc').click(function () {

            var data = {
                accept_tc : $('#chk-accept-registration-tc').is(':checked'),
            };

            updateRegistration(registrationId, data, 'accept');

        });


        function updateRegistration(registrationId, data, part) {

            var obj = {
                url: app_url+'/admin/registration/'+registrationId+'/update/'+part,
                method: 'POST',
                data: data
            };
            $.ajax(obj)
            .done(function (response, textStatus, jqXhr) {

                var acceptedHtml = '<div class="pull-left"> <i class="fa fa-check"></i> Accepted at<br/> <small>'+response.registration.tc_accept_time+'</small></div>';

                $('.js-accept-time')
                    .removeClass('hidden')
                    .html(acceptedHtml);

                $('.js-user-data-update-tc_accept_info').html(acceptedHtml);

                $('.btn-accept-tc').remove();

            }).fail(function (jqXhr, textStatus, errorThrown) {

                console.log(' fail registration ' , jqXhr);
                alert('Error : '+errorThrown);

            });

        }



        $('.next').click(function(){

            var nextId = $(this).parents('.tab-pane').next().attr("id");

            // $('#'+nextId).tab('show');
            $('a[href="#'+nextId+'"]').tab('show');

        });

        $('.first').click(function(){

            $('#myWizard a:first').tab('show');

        });


        // upload signed registration file
        $('#registration_release_file_upload').fineUploader({
            template: 'qq-registration-release-file-template-manual-trigger',
            multiple: false,
            request: {
                endpoint: app_url+'/admin/registration/'+registrationId+'/upload/inspection',
                params: {
                    teacher_id : function () {
                        return $('#teacher_social_id').val();
                    }
                },
                customHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            validation: {
                itemLimit: 1,
                allowedExtensions:  ['doc', 'docx', 'pdf'],
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

        $('#btn-upload-registration-release-file').click(function() {
            $('#registration_release_file_upload').fineUploader('uploadStoredFiles');
        });



        $('.btn-update-user-register-data').click(function () {

            var id = $(this).attr('data-id');


            var button = $('.btn-update-user-register-data');
            var form = $('#register-update-data');
            var data = {
                first_name: form.find('.js-tab-user-first_name').val(),
                last_name: form.find('.js-tab-user-last_name').val(),
                email: form.find('.js-tab-user-email').val(),
                phone: form.find('.js-tab-user-phone').val(),
            };

            form.find('input').attr('disabled', true);
            $(this).attr('disabled', true);

            $.ajax({
                url: app_url+'/admin/registration/'+id+'/update/user-data',
                method: 'post',
                data: data
            }).done(function (response, textStatus, xhr) {

                if(xhr.status === 200){
                    $('.js-data-update-message').html('<div class="alert alert-success">Data updated successfully</div>')
                        .addClass('text-success');
                }


            }).fail(function (errors, textStatus, errorThrown) {

            }).always(function () {
                form.find('input').attr('disabled', false);
                button.removeAttr('disabled');
            });


        });

    }//end page

    var upcoming = $('#upcoming-course');

    if (upcoming.length > 0){

        handleProceedToTheCourse();
        function handleProceedToTheCourse(){

            $('.btn-proceed-to-the-course').click(function () {

                $(this).attr('disabled', 'true');
                var course_id = $(this).attr('data-course-id');
                var teacher_id = $(this).attr('data-teacher-id');

                $.ajax({
                    url: app_url+'/admin/registration/proceed-to-the-course',
                    method: 'post',
                    data: { 'course_id': course_id, 'teacher_id': teacher_id}
                }).done(function (response, textStatus, xhr) {

                    if(xhr.status === 200){

                        // open new window with url
                        // window.open('https://mecapacito.educacion.gob.ec/', '_blank');

                        $(this).removeClass('btn-info');
                        $(this).addClass('btn-success');
                        $(this).text('registrado');

                    }


                }).fail(function (errors, textStatus, errorThrown) {

                    alert('Error: '+errorThrown);
                    console.log('Error: ', errors);
                    $(this).removeAttr('disabled');

                });

            });

        }

    }

});