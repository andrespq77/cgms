/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    var pageCourseLength = $('#page_course').length;
    var app_url = $('#app_url').val();

    if(pageCourseLength > 0) {

        var modal = $('#edit-course-modal');

        loadMasterCourse();
        function loadMasterCourse() {

            var masterCourseLength = $('.js-edit-course-master-course').length;

            if (masterCourseLength > 0){

                // console.log('load courses');
                var masterCourse = $('.js-select-master-course');

                masterCourse.empty();
                masterCourse.attr('disabled', 'disabled');
                masterCourse.append('<option>Loading...</option>');

                var ajaxObj = {
                    method: 'get',
                    url: app_url+'/admin/master-course/list/'
                };

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 200) {

                            masterCourse.empty();

                            $.each(response.master_course, function (key, value) {
                                masterCourse.append('<option value="'+value.id+'">'+value.name+'</option>');
                            });
                            masterCourse.attr('disabled', false);

                        }

                    }).fail(function (jqXhr, textStatus, errorThrown) {

                        alert('Error: '+errorThrown);
                        console.log('error ', jqXhr);
                        masterCourse.empty();
                        masterCourse.attr('disabled', false);

                });


                //select 2
                masterCourse.select2({
                    dropdownParent: modal,
                    width: 'resolve',
                    minimumResultsForSearch: 20,
                    minimumInputLength: 1, // only start searching when the user has input 3 or more characters
                    maximumInputLength: 20 // only allow terms up to 20 characters long
                });


            }
        }

        loadCourseTypes();
        function loadCourseTypes() {

            var courseTypeList = $('.js-edit-course-type');

            if (courseTypeList.length > 0){

                courseTypeList.empty();
                courseTypeList.attr('disabled', 'disabled');
                courseTypeList.append('<option>Loading...</option>');

                var ajaxObj = {
                    method: 'get',
                    url: app_url+'/admin/course-modality/list/'
                };

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 200) {

                            courseTypeList.empty();

                            $.each(response.courseTypes, function (key, value) {
                                courseTypeList.append('<option value="'+value.id+'">'+value.title+'</option>');
                            });
                            courseTypeList.attr('disabled', false);

                        }

                    }).fail(function (jqXhr, textStatus, errorThrown) {

                        alert('Error: '+errorThrown);
                        console.log('error ', jqXhr);
                        courseTypeList.empty();
                        courseTypeList.attr('disabled', false);

                });


                //select 2
                courseTypeList.select2({
                    dropdownParent: modal,
                    width: 'resolve',
                    minimumResultsForSearch: 20,
                    minimumInputLength: 1, // only start searching when the user has input 3 or more characters
                    maximumInputLength: 20 // only allow terms up to 20 characters long
                });


            }
        }

        loadUniversities();
        function loadUniversities() {

            var universityLength = $('.js-edit-course-university').length;

            if (universityLength > 0){

                var selectUniversity = $('.js-select-university');

                selectUniversity.empty();
                selectUniversity.attr('disabled', 'disabled');
                selectUniversity.append('<option>Loading...</option>');

                var ajaxObj = {
                    method: 'get',
                    url: app_url+'/admin/university/ajax/'
                };

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 200) {

                            selectUniversity.empty();

                            $.each(response.universities, function (key, value) {
                                selectUniversity.append('<option value="'+value.id+'">'+value.name+'</option>');
                            });
                            selectUniversity.attr('disabled', false);

                        }

                    }).fail(function (jqXhr, textStatus, errorThrown) {

                        alert('Error: '+errorThrown);
                        console.log('error ', jqXhr);
                        selectUniversity.empty();
                        selectUniversity.attr('disabled', false);

                });


                //select 2
                selectUniversity.select2({
                    dropdownParent: modal,
                    width: 'resolve',
                    minimumResultsForSearch: 20,
                    minimumInputLength: 1, // only start searching when the user has input 3 or more characters
                    maximumInputLength: 20 // only allow terms up to 20 characters long
                });


            }

        }

        /**
         * Create Course
         */
        showAddModal();
        function showAddModal() {

            $('#btn-create-course').click(function () {

                modal.find('.js-modal-title-add').removeClass('hidden');
                modal.find('.js-modal-title-edit').addClass('hidden');
                modal.find('input').val('');

                modal.find('#btn-edit-course').text('Create');
                modal.find('#btn-edit-course').attr('data-type','create');
                modal.modal('show');

            });
        }


        /**
         * Create / Update course
         */
        clickCreateUpdate();
        function clickCreateUpdate() {

            $('#btn-edit-course').click(function (e) {

                e.preventDefault();

                var data = {
                    id          : $(this).attr('data-id'),
                    course_code   : modal.find('.js-edit-course-code').val(),
                    course_type : modal.find('.js-edit-course-type option:selected').val(),

                    university_id : modal.find('.js-edit-course-university option:selected').val(),

                    short_name  : modal.find('.js-edit-course-short_name').val(),

                    start_date  : modal.find('.js-edit-course-start_date').val(),
                    end_date    : modal.find('.js-edit-course-end_date').val(),
                    year        : modal.find('.js-edit-course-year').val(),

                    hours       : parseInt(modal.find('.js-edit-course-hours').val()),
                    quota       : parseInt(modal.find('.js-edit-course-quota').val()),

                    comment                 : modal.find('.js-edit-course-comment').val(),
                    description             : modal.find('.js-edit-course-description').val(),
                    video_text              : modal.find('.js-edit-course-video').val(),
                    video_type              : 'youtube',
                    video_code              : modal.find('.js-edit-course-video_embed_code').val(),
                    terms_condition         : modal.find('.js-edit-course-terms_condition').val(),
                    data_update_text        : modal.find('.js-edit-course-data_update').val(),

                    master_course_id        : modal.find('.js-select-master-course option:selected').val(),
                    course_edition          : modal.find('.js-edit-course-edition').val(),
                    grade_entry_start_date  : modal.find('.js-edit-grade-entry-start-date').val(),
                    grade_entry_end_date    : modal.find('.js-edit-grade-entry-end-date').val(),
                    course_stage            : modal.find('.js-select-course-stage option:selected').val(),
                    course_status           : modal.find('.js-select-course-status option:selected').val(),
                    is_disclaimer           : modal.find('.js-select-disclaimer_required option:selected').val(),
                    cost                    : modal.find('.js-edit-course-cost').val(),
                    finance_type            : modal.find('.js-edit-course-finance_type').val()

                };

                if ( $(this).attr('data-type') ==='update'){
                    update(data);
                } else if ($(this).attr('data-type') === 'create'){
                    insertCourse(data);
                }

            });

        }


        /**
         * Show Edit Modal
         */
        showEditModal();
        function showEditModal() {

            $('#course-table').on('click','.btn-edit-course', function () {

                modal.find('.js-modal-title-edit').removeClass('hidden');
                modal.find('.js-modal-title-add').addClass('hidden');

                var data = {
                    id              : $(this).attr('data-id'),
                    course_code     : $(this).attr('data-course_code'),
                    short_name      : $(this).attr('data-short_name'),
                    description     : $(this).attr('data-description'),
                    comment         : $(this).attr('data-comment'),
                    hours           : $(this).attr('data-hours'),
                    quota           : $(this).attr('data-quota'),
                    start_date      : $(this).attr('data-start_date'),
                    end_date        : $(this).attr('data-end_date'),
                    year            : $(this).attr('data-year'),
                    university_id   : $(this).attr('data-university_id'),
                    video_text      : $(this).attr('data-video_text'),
                    video_type      : $(this).attr('data-video_type'),
                    video_code      : $(this).attr('data-video_code'),
                    terms_condition : $(this).attr('data-terms_condition'),
                    data_update     : $(this).attr('data-data_update'),
                    tc_file_path    : $(this).attr('data-tc_file_path'),
                    lor_file_path   : $(this).attr('data-lor_file_path'),

                    course_type     : $(this).attr('data-course_type_id'),
                    master_course_id : $(this).attr('data-master_course_id'),
                    course_edition  : $(this).attr('data-course_edition'),
                    course_stage    : $(this).attr('data-stage'),
                    course_status   : $(this).attr('data-status'),
                    is_disclaimer   : $(this).attr('data-is_disclaimer'),
                    disclaimer_file : $(this).attr('data-disclaimer_file'),
                    cost            : $(this).attr('data-cost'),
                    finance_type    : $(this).attr('data-finance_type'),
                    grade_entry_start_date : $(this).attr('data-grade_upload_start_date'),
                    grade_entry_end_date : $(this).attr('data-grade_upload_end_date'),

                };

                modal.find('.js-edit-course-code').val(data.course_code);
                modal.find('.js-edit-course-university option[value="'+data.university_id+'"]').attr('selected', true);
                modal.find('.js-edit-course-short_name').val(data.short_name);
                modal.find('.js-edit-course-description').val(data.description);
                modal.find('.js-edit-course-comment').val(data.comment);
                modal.find('.js-edit-course-hours').val(data.hours);
                modal.find('.js-edit-course-quota').val(data.quota);
                modal.find('.js-edit-course-start_date').val(data.start_date);
                modal.find('.js-edit-course-end_date').val(data.end_date);
                modal.find('.js-edit-course-year').val(data.year);
                modal.find('.js-edit-course-video').val(data.video_text);
                modal.find('.js-edit-course-video_type option[value="'+data.video_type+'"]').attr('selected', true);
                modal.find('.js-edit-course-video_embed_code').val(data.video_code);
                modal.find('.js-edit-course-terms_condition').val(data.terms_condition);
                modal.find('.js-edit-course-data_update').val(data.data_update);

                modal.find('.js-edit-course-type option[value="'+data.course_type+'"]').attr('selected', true);
                modal.find('.js-select-master-course option[value="'+data.master_course_id+'"]').attr('selected', true),
                modal.find('.js-edit-course-edition').val(data.course_edition),
                modal.find('.js-edit-grade-entry-start-date').val(data.grade_entry_start_date),
                modal.find('.js-edit-grade-entry-end-date').val(data.grade_entry_end_date),
                modal.find('.js-select-course-stage option[value="'+data.course_stage+'"]').attr('selected', true),
                modal.find('.js-select-course-status option[value="'+data.course_status+'"]').attr('selected', true),
                modal.find('.js-select-disclaimer_required option[value="'+data.is_disclaimer+'"]').attr('selected', true),
                modal.find('.js-edit-course-cost').val(data.cost),
                modal.find('.js-edit-course-finance_type').val(data.finance_type),

                modal.find('.js-course-id').val(data.id);

                modal.find('.btn-update-course-files').removeClass('hidden');
                modal.find('.btn-show-course-form').addClass('hidden');

                modal.find('#btn-edit-course').attr('data-id', data.id);
                modal.find('#btn-edit-course').text('Update');
                modal.find('#btn-edit-course').attr('data-type','update');
                modal.modal('show');

            });

        }

        modal.on('hidden.bs.modal', function () {

            modal.find('input').val('');
            modal.find('textarea').val('');
            modal.find('.js-course-id').val('');

            $('.js-course-form').removeClass('hidden');
            $('.js-course-inspection-form').addClass('hidden');

            $('.btn-update-course-files').addClass('hidden');

        });

        showUploadFile();
        function showUploadFile() {

            $('.btn-update-course-files').click(function () {


                $('.js-course-inspection-form').removeClass('hidden');
                $('.btn-show-course-form').removeClass('hidden');

                $(this).addClass('hidden');
                $('.js-course-form').addClass('hidden');
                $('#btn-edit-course').addClass('hidden');

                var isDisclaimer = $('.js-select-disclaimer_required option:selected').val();

                if (isDisclaimer === "1"){
                    $('.js-disclaimer-wrapper').removeClass('hidden');
                } else{
                    $('.js-disclaimer-wrapper').addClass('hidden');
                }


            });
        }

        showCourseForm();
        function showCourseForm() {

            $('.btn-show-course-form').click(function () {

                $(this).addClass('hidden');
                $('.js-course-inspection-form').addClass('hidden');

                $('.btn-update-course-files').removeClass('hidden');
                $('.js-course-form').removeClass('hidden');
                $('#btn-edit-course').removeClass('hidden');

            });

        }

        /**
         * Save data
         * @param data
         */
        function insertCourse(data) {

            var form = $('.js-edit-course-form');

            form.find('input, select').attr('disabled', true);
            form.find('.btn').attr('disabled', true);

            var jsErrorBlock = $('.js-error-block');
            jsErrorBlock.find('.help-block').html("");
            jsErrorBlock.removeClass('has-error');


            var ajaxObj = {
                method: 'post',
                data: data,
                url: app_url+'/admin/course/ajax'
            };

            $.ajax(ajaxObj)
            .done(function (response, textStatus, jqXhr) {

                if (jqXhr.status === 201) {

                    // after insert, hide form and show upload

                    modal.find('.js-course-id').val(response.course.id);

                    modal.find('.js-course-form').addClass('hidden');
                    modal.find('.js-course-inspection-form').removeClass('hidden');
                    modal.find('#btn-edit-course').attr('disabled', true);
                    modal.find('#btn-edit-course').addClass('hidden');
                    // form.addClass('hidden');

                    var row = '<tr class="success"><td>New Course added please refresh the page.</td></tr>';

                    toastr.info("New Course Added successfully please reload.", "Info");

                    $('#course-table tr:first').after(row);

                }

            }).fail(function (xhr, textStatus, errorThrown) {

                if (xhr.status === 422){

                    $.each(xhr.responseJSON.errors, function (key, errors) {
                        $('.js-'+key+'-block').addClass('has-error');

                        $.each(errors, function (index, error) {
                            $('.js-'+key+'-block').find('.help-block').append(error+'<br/>');
                        });
                    });

                } else{
                    toastr.danger(errorThrown, "Error");

                    // alert('Error: '+errorThrown);
                    console.log('errors ', xhr.responseJSON);
                }


            }).always(function () {

                form.find('input, select').attr('disabled', false);
                form.find('.btn').attr('disabled', false);
            });

        }

        /**
         * Update Course
         * @param data
         */
        function update(data) {

            var form = $('.js-edit-course-form');

            form.find('input, select').attr('disabled', true);
            form.find('.btn').attr('disabled', true);

            var jsErrorBlock = $('.js-error-block');
            jsErrorBlock.find('.help-block').html("");
            jsErrorBlock.removeClass('has-error');

            var ajaxObj = {
                method: 'post',
                data: data,
                url: app_url+'/admin/course/ajax/'+data.id
            };
            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 200) {

                        $('tr#course_id_'+data.id).each(function(){

                            $(this).find('td').eq(0).text(data.course_code);
                            $(this).find('td').eq(1).text(data.short_name);
                            $(this).find('td').eq(2).text(data.hours);
                            $(this).find('td').eq(3).text(data.start_date);
                            $(this).find('td').eq(4).text(data.end_date);
                            $(this).find('td').eq(5).text(data.quota);
                            $(this).find('td').eq(6).text(data.comment);

                        });

                        toastr.success("Course updated successfully.", "Message");

                        window.setTimeout(function(){location.reload()}, 4000);
                        $('tr#course_id_'+data.id).addClass('success');
                        modal.modal('hide');
                    }

                }).fail(function (xhr, textStatus, errorThrown) {

                if (xhr.status === 422){

                    $.each(xhr.responseJSON.errors, function (key, errors) {
                        $('.js-'+key+'-block').addClass('has-error');

                        $.each(errors, function (index, error) {
                            $('.js-'+key+'-block').find('.help-block').append(error+'<br/>');
                        });
                    });
                } else{
                    alert('Error: '+errorThrown);
                    console.log('errors ', xhr.responseJSON);
                }


            }).always(function () {

                form.find('input, select').attr('disabled', false);
                form.find('.btn').attr('disabled', false);
            });

        }


        var deleteModal = $('#delete-modal');

        /**
         * Show Delete modal
         */
        showDelete();
        function showDelete() {

            $('#course-table').on('click','.btn-remove', function () {

                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');

                deleteModal.find('.model-title').text('Delete Canton');
                deleteModal.find('.js-message').text('Are you sure to delete Canton ['+name+']?');
                deleteModal.find('#btn-delete-confirm').attr('data-url', app_url+'/admin/course/ajax/'+id);
                deleteModal.find('#btn-delete-confirm').attr('data-id', id);
                deleteModal.modal('show');

            });
        }


        deleteItem();
        function deleteItem() {

            $('#page_course #btn-delete-confirm').click(function () {

                var data = {
                    id: $(this).attr('data-id'),
                    url: $(this).attr('data-url')
                };

                var ajaxObj = {
                    method: 'delete',
                    url: data.url
                };

                $('tr#course_id_'+data.id).addClass('warning');

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 204) {

                            deleteModal.modal('hide');

                            (function () {
                                setTimeout(function(){
                                    $('tr#course_id_'+data.id).remove();
                                }, 1500)
                            })(this);
                        }

                    }).fail(function (jqXhr, textStatus, errorThrown) {

                        alert('Error: '+errorThrown);
                        console.log('error ', jqXhr);

                });


            });
        }


        /**
         * Course inspection form upload
         * @type {*}
         */

        /**
         * Inspection form Upload for course
         *
         * From registration page
         */
        $('#course-inspection-form-uploader-manual-trigger').fineUploader({
            template: 'qq-template-manual-trigger',
            multiple: false,
            request: {
                endpoint: app_url+'/admin/course/upload/inspection-form',
                params: {
                    course_id : function () {
                        return modal.find('.js-course-id').val();
                    }
                },
                customHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            validation: {
                itemLimit: 1,
                allowedExtensions:  ['pdf', 'doc', 'docx']
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

        $('#page_course #trigger-upload').click(function() {
            $('#course-inspection-form-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });


        /**
         * ==========================================================================
         */


        var requestListModal = $('#request-list-modal');
        /**
         * Course Request List Upload for course & teachers
         */
        $('#page_course #btn-upload-course-request').click(function () {

            requestListModal.modal('show');

        });


        $('#course-request-list-uploader-manual-trigger').fineUploader({
            template: 'qq-course-request-template-manual-trigger',
            multiple: false,
            request: {
                endpoint: app_url+'/admin/upcoming-courses/upload',
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

        $('#btn-upload-course-request-list').click(function() {
            $('#course-request-list-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });


        /**
         * Upload terms and conditions
         */
        $('#course-terms_condition-uploader-manual-trigger').fineUploader({
            template: 'qq-terms_condition_upload_template-trigger',
            multiple: false,
            request: {
                endpoint: app_url+'/admin/course/upload/file',
                params: {
                    course_id : function () {
                        return modal.find('.js-course-id').val();
                    },
                    type: 'terms_and_condition'
                },
                customHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            validation: {
                itemLimit: 1,
                allowedExtensions:  ['pdf', 'doc', 'docx'],

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

        $('#btn-trigger-terms-upload').click(function() {
            $('#course-terms_condition-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });


        /**
         * Upload Letter of Registration
         */
        $('#course-letter_of_registration-uploader-manual-trigger').fineUploader({
            template: 'letter_of_registration_template-trigger',
            multiple: false,
            request: {
                endpoint: app_url+'/admin/course/upload/file',
                params: {
                    course_id : function () {
                        return modal.find('.js-course-id').val();
                    },
                    type: 'lor'
                },
                customHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            validation: {
                itemLimit: 1,
                allowedExtensions:  ['pdf', 'doc', 'docx'],
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

        $('#btn-trigger-lor-upload').click(function() {
            $('#course-letter_of_registration-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });


        /**
         * Disclaimer File Upload
         */
        // $('#course-disclaimer-uploader-manual-trigger').fineUploader({
        //     template: 'disclaimer_upload_template-trigger',
        //     multiple: false,
        //     request: {
        //         endpoint: app_url+'/admin/course/upload/file',
        //         params: {
        //             course_id : function () {
        //                 return modal.find('.js-course-id').val();
        //             },
        //             type: 'disclaimer'
        //         },
        //         customHeaders: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     },
        //     validation: {
        //         itemLimit: 1,
        //         allowedExtensions:  ['pdf', 'doc', 'docx'],
        //     },
        //     callbacks: {
        //         onSubmit: function (id, name) {
        //
        //         },
        //         onComplete: function (id, name, response, xhr ) {
        //
        //
        //         },
        //         onStatusChange: function (id, oldStatus, newStatus) {
        //
        //         },
        //         onCancel: function (id, name) {
        //
        //         }
        //     },
        //     autoUpload: false
        // });
        //
        // $('#btn-trigger-disclaimer-upload').click(function() {
        //     $('#course-disclaimer-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        // });


        /**
         * Diploma upload
         * @type {*}
         */
        var modalUploadDiploma = $('#modal_upload_diploma');
        $('#course-table').on('click', '.btn-upload-diploma', function () {

            modalUploadDiploma.modal('show');
            var courseId = $(this).attr('data-id');
            modalUploadDiploma.find('.js-course-diploma-id').val(courseId);

        });

        $('#course-diploma-upload-placeholder').fineUploader({
            template: 'qq_course_diploma_upload_manual_template',
            multiple: false,
            request: {
                endpoint: app_url+'/admin/course/upload/file',
                params: {
                    course_id : function () {
                        // var courseId =  modalUploadDiploma.find('.js-course-diploma-id').val();
                        return modalUploadDiploma.find('.js-course-diploma-id').val();
                    },
                    type: 'diploma'
                },
                customHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            validation: {
                itemLimit: 1,
                allowedExtensions:  ['zip'],
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

        $('#btn_upload_diploma').click(function() {
            $('#course-diploma-upload-placeholder').fineUploader('uploadStoredFiles');
        });


    }//end page

});