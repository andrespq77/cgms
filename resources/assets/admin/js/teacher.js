/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    var pageLength = $('#page_teacher').length;
    var app_url = $('#app_url').val();

    if(pageLength > 0) {

        var modal = $('#edit-teacher-modal');

        showAddModal();
        function showAddModal() {

            $('#btn-create-teacher').click(function () {

                modal.find('.js-modal-title-add').removeClass('hidden');
                modal.find('.js-modal-title-edit').addClass('hidden');
                modal.find('.js-login-section').removeClass('hidden');

                modal.find('input').val('');

                modal.find('#btn-store-teacher').text('Create');
                modal.find('#btn-store-teacher').attr('data-type','create');
                modal.modal('show');

            });
        }


        var importModal = $('#upload-teacher-modal');

        /**
         * Show Delete modal
         */
        showImport();
        function showImport() {

            $('#btn-import-teachers').click(function () {

                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                importModal.modal('show');

            });
        }


        //qq upload

        $('#fine-uploader-manual-trigger').fineUploader({
            template: 'qq-template-manual-trigger',
            request: {
                endpoint: app_url+'/admin/teachers/upload/teachers-list',
                customHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            validation: {
                itemLimit: 1,
                allowedExtensions:  ['xlsx', 'xls', 'csv'],
            },
            callbacks: {
                onSubmit: function (id, name) {

                },
                onComplete: function (id, name, response, xhr ) {

                    $('.js-message').empty();

                    if(response.error === undefined){
                        $('.js-message').removeClass('hidden')
                        .append('<div class="alert alert-success" role="alert">Total <strong>'+response.rows.length+'</strong> records added.</div>');
                    } else {
                        console.log('error ', response.error);
                        $('.js-message').removeClass('hidden')
                            .append('<div class="alert alert-danger" role="alert">'+response.error+'. We think non compliant file was uploaded.</div>');
                    }

                },
                onStatusChange: function (id, oldStatus, newStatus) {

                },
                onCancel: function (id, name) {

                }
            },
            autoUpload: false
        });

        //@todo should be #page_teacher #triger-upload to be specific button selector
        $('#trigger-upload').click(function() {
            $('#fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
        });


        var createMoodleUser = $('#create-moodal-modal');

        showCreateModalModal();
        function showCreateModalModal() {

            $('#teacher-table').on('click','.btn-create-modal-user', function () {

                createMoodleUser.modal('show');

            });

        }


        /**
         * Delete
         */

        var deleteModal = $('#delete-modal');

        showDeleteModalModal();
        function showDeleteModalModal() {

            $('#teacher-table').on('click','.btn-remove-teacher', function () {

                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');

                deleteModal.find('.model-title').text('Delete Teacher');
                deleteModal.find('.js-message').text('Are you sure to delete Teacher ['+name+']?');
                deleteModal.find('#btn-delete-confirm').attr('data-url', app_url+'/admin/teachers/'+id);
                deleteModal.find('#btn-delete-confirm').attr('data-id', id);
                deleteModal.modal('show');

            });

        }


        deleteItem();
        function deleteItem() {

            $('#page_teacher #btn-delete-confirm').click(function () {

                var data = {
                    id: $(this).attr('data-id'),
                    url: $(this).attr('data-url')
                };

                var ajaxObj = {
                    method: 'delete',
                    url: data.url
                };

                $('tr#teacher_id_'+data.id).addClass('warning');

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 204) {

                            deleteModal.modal('hide');
                            $('tr#teacher_id_'+data.id).find('td').eq(8).text('Removing...');

                            (function () {
                                setTimeout(function(){
                                    $('tr#teacher_id_'+data.id).remove();
                                }, 1500)
                            })(this);
                        }

                    }).fail(function (jqXhr, textStatus, errorThrown) {
                        alert('Error: '+errorThrown);
                        console.log('error ', jqXhr);
                });


            });
        }


    }


    var isTeacherForm = $('.teacher-form').length;

    if (isTeacherForm > 0 ){



        insertTeacher();
        function insertTeacher() {

            var btnSubmit = $('.btn-submit-teacher');

            btnSubmit.click(function () {

                var jsErrorBlock = $('.js-error-block');

                jsErrorBlock.find('.help-block').html("");
                jsErrorBlock.removeClass('has-error');


                var type = btnSubmit.attr('data-type');

                var form = $('.teacher-form');

                form.find('input, select').attr('disabled', true);
                $(this).attr('disabled', true);

                var data = {

                    first_name  : form.find('input[name=first_name]').val(),
                    last_name   : form.find('input[name=last_name]').val(),
                    social_id   : form.find('input[name=social_id]').val(),
                    cc          : form.find('input[name=cc]').val(),
                    email       : form.find('input[name=email]').val(),
                    telephone   : form.find('input[name=telephone]').val(),
                    mobile      : form.find('input[name=mobile]').val(),
                    gender      : form.find('input[name=gender]').val(),
                    date_of_birth: form.find('input[name=date_of_birth]').val(),

                    university  : form.find('input[name=university]').val(),
                    join_date   : form.find('input[name=join_date]').val(),
                    end_date    : form.find('input[name=end_date]').val(),
                    amie        : form.find('input[name=amie]').val(),

                    inst_email          : form.find('input[name=inst_email]').val(),
                    work_area           : form.find('input[name=work_area]').val(),
                    work_hours          : form.find('input[name=work_hours]').val(),
                    teacher_function    : form.find('input[name=teacher_function]').val(),
                    category            : form.find('input[name=category]').val(),

                    province            : form.find('.js-province').select2('data')[0].text,
                    canton              : form.find('.js-canton').select2('data')[0].text,
                    parroquia           : form.find('input[name=parroquia]').val(),
                    zone                : form.find('.js-zone option:selected').val(),
                    district            : form.find('input[name=district]').val(),
                    dist_code           : form.find('input[name=dist_code]').val(),

                    reason_type         : form.find('input[name=reason_type]').val(),
                    speciality          : form.find('input[name=speciality]').val(),
                    action_type         : form.find('input[name=action_type]').val(),
                    action_description  : form.find('input[name=action_description]').val(),
                    disability          : form.find('input[name=disability]').val(),
                    ethnic_group        : form.find('input[name=ethnic_group]').val(),

                };

                var url = app_url+'/admin/teachers';
                if (type === 'update'){
                    var id = btnSubmit.attr('data-id');
                    url = app_url+'/admin/teachers/'+id;
                }

                var ajaxObj = {
                    url: url,
                    method: 'post',
                    data: data
                };

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, xhr) {

                        if (xhr.status === 201){
                            redirect(app_url+'/admin/teachers');
                        } else if (xhr.status === 200){
                            var alert = '<div class="alert alert-success alert-dismissible">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                            'Record updated successfully</div>';
                            form.find('.js-message').html(alert);
                        }

                    }).fail(function (xhr, textStatus, errorThrown) {


                        if (xhr.status === 422){

                            $.each(xhr.responseJSON.errors, function (key, errors) {
                                $('.js-'+key+'-block').addClass('has-error');

                                $.each(errors, function (index, error) {
                                    $('.js-'+key+'-block').find('.help-block').append(error+'<br/>');
                                });
                            });
                        }

                }).always(function () {

                    form.find('input, select').attr('disabled', false);
                    btnSubmit.attr('disabled', false);

                    if(type === 'update'){

                        form.find('#teacher-inst-email').attr('disabled', true);
                        form.find('#teacher-social-id').attr('disabled', true);

                    }

                });



            });

        }

        loadProvinces();
        function loadProvinces() {

            var provinceLength = $('.js-province').length;

            if (provinceLength > 0){

                var province = $('.js-province');

                province.empty();
                province.attr('disabled', 'disabled');
                province.append('<option>Loading...</option>');

                var ajaxObj = {
                    method: 'post',
                    url: app_url+'/admin/location/province/ajax/all'
                };

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 200) {

                            province.empty();

                            var editProvince = $('.js-edit-province').val();

                            var paramData = {
                                id: response.provinces[0].id,
                                name: response.provinces[0].name
                            };

                            $.each(response.provinces, function (key, value) {
                                province.append('<option value="'+value.id+'">'+value.name+'</option>');
                            });

                            // select first province manually
                            province.trigger({
                                type: 'select2:select',
                                params: {data: paramData}
                            });

                            province.attr('disabled', false);

                        }

                    }).fail(function (jqXhr, textStatus, errorThrown) {

                        alert('Error: '+errorThrown);
                        console.log('error ', jqXhr);
                        province.empty();
                        province.attr('disabled', false);

                });


                //select 2
                province.select2({
                    // dropdownParent: modal,
                    width: 'resolve',
                    minimumResultsForSearch: 20,
                    maximumInputLength: 20 // only allow terms up to 20 characters long
                });

            }

        }

        // on select 2 select, load canton
        $('.js-province').on('select2:select', function (e) {

            var data = e.params.data;
            loadCantons(data.id);

        });

        function loadCantons(provinceId) {


            var canton = $('.js-canton');

            canton.empty();
            canton.attr('disabled', 'disabled');
            canton.append('<option>Loading...</option>');

            var ajaxObj = {
                method: 'get',
                url: app_url+'/admin/location/canton/ajax/'+provinceId
            };

            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 200) {

                        canton.empty();

                        $.each(response.cantons, function (key, value) {
                            canton.append('<option value="'+value.id+'">'+value.name+'</option>');
                        });

                        canton.attr('disabled', false);

                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                    alert('Error: '+errorThrown);
                    console.log('error ', jqXhr);
                    canton.empty();
                    canton.attr('disabled', false);

            });


            //select 2
            canton.select2({
                // dropdownParent: modal,
                width: 'resolve',
                minimumResultsForSearch: 20,
                // minimumInputLength: 0, // only start searching when the user has input 3 or more characters
                maximumInputLength: 20 // only allow terms up to 20 characters long
            });




        }// end function


        /**
         * @todo onCantonChange select parrouia list
         */
        $('.js-canton').on('select2:select', function (e) {
        //     var data = e.params.data;
        //     console.log('canton ', data);
        //     loadCantons(data.id);
        })
    }


    function redirect (url) {
        var ua        = navigator.userAgent.toLowerCase(),
            isIE      = ua.indexOf('msie') !== -1,
            version   = parseInt(ua.substr(4, 2), 10);

        // Internet Explorer 8 and lower
        if (isIE && version < 9) {
            var link = document.createElement('a');
            link.href = url;
            document.body.appendChild(link);
            link.click();
        }

        // All other browsers can use the standard window.location.href (they don't lose HTTP_REFERER like Internet Explorer 8 & lower does)
        else {
            window.location.href = url;
        }
    }

});