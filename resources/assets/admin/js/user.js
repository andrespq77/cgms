/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    var isPage = $('#page_user').length;
    var app_url = $('#app_url').val();

    if (isPage){

        console.log('user management');


        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: app_url+'/admin/users/table/ajax',
                method: 'POST'
            },
            "order": [[ 0, "desc" ]],
            columns: [
                { data: 'id', name: 'id', searchable: true },
                { data: 'name', name: 'name', searchable: true},
                { data: 'email', name: 'email', searchable: true},
                { data: 'role', name: 'role', searchable: true, render: function (item, data, meta) {
                    return '<span class="uc-first">'+item+'</span>';
                }},
                { data: 'status', name: 'status', searchable: true},
                { data: 'creation_type', name: 'creation_type', searchable: true},
                { data: 'created_at', name: 'created_at', searchable: true},
                { data :'action', searchable:false, orderable: false,}
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val()).draw();
                        });
                });
            },
        });



        var modal = $('#edit-user-modal');
        var resetPassword = $('#reset-password-user-modal');

        /**
         * Create University
         */
        showAddModal();
        function showAddModal() {

            $('#btn-create-user').click(function () {

                modal.find('.js-modal-title-add').removeClass('hidden');
                modal.find('.js-modal-title-edit').addClass('hidden');
                modal.find('input').val('');

                modal.find('#btn-edit-user').text('Create');
                modal.find('#btn-edit-user').attr('data-type','create');
                modal.find('.js-edit-user-role-group').removeClass('hidden');

                modal.modal('show');

            });
        }

        showEditModal();
        function showEditModal() {

            $('#user-table').on('click','.btn-edit-user', function () {

                modal.find('.js-modal-title-edit').removeClass('hidden');
                modal.find('.js-modal-title-add').addClass('hidden');

                var data = {
                    id          : $(this).attr('data-id'),
                    name            : $(this).attr('data-user_name'),
                    email            : $(this).attr('data-user_email'),
                    status            : $(this).attr('data-user_status')
                };

                modal.find('.js-edit-user-first-name').val(data.name);
                modal.find('.js-edit-user-email').val(data.email);
                modal.find('.js-edit-user-status option[value="'+data.status+'"]').attr('selected', true);
                modal.find('.js-edit-user-role-group').addClass('hidden');
                modal.find('#btn-edit-user').attr('data-id', data.id);
                modal.find('#btn-edit-user').text('Update');
                modal.find('#btn-edit-user').attr('data-type','update');
                modal.modal('show');


            });

        }

        showResetPassword();
        function showResetPassword() {

            $('#user-table').on('click', '.btn-change-user-password-action', function () {

                var data = {
                    id          : $(this).attr('data-id')
                };

                $('#user_id_'+data.id).addClass('warning');

                resetPassword.find('#btn-change-user-password').attr('data-id', data.id);
                resetPassword.modal('show');
            });
        }

        resetPassword.on('hidden.bs.modal', function () {
            var id = resetPassword.find('#btn-change-user-password').attr('data-id');
            $('#user_id_'+id).removeClass('warning');

        });

        changePassword();
        function changePassword(){

            $('#btn-change-user-password').click(function () {

                var id = $(this).attr('data-id');
                $('.help-block').text('');
                $('.js-error-block').removeClass('has-error');

                var data = {
                    password : resetPassword.find('#js-user-new-password').val(),
                    password_confirmation : resetPassword.find('#js-user-confirm-password').val(),

                };

                $.ajax({
                    url: app_url+'/admin/users/'+id+'/change-password',
                    method: 'POST',
                    data: data
                }).done(function (response, textStatus, xhr) {

                    if(xhr.status === 200){
                        resetPassword.modal('toggle');
                        $('#user_id_'+id).addClass('success');
                    }

                }).fail(function (errors, textStatus, errorThrown) {

                    if (errors.status === 422) {

                        $.each(errors.responseJSON.errors, function (key, errors) {
                            $('.js-' + key + '-block').addClass('has-error');

                            $.each(errors, function (index, error) {
                                $('.js-' + key + '-block').find('.help-block').append(error + '<br/>');
                            });
                        });
                    } else {
                        alert('Error: '+ errorThrown);
                    }


                }).always(function () {

                });
            });
        }


        /**
         * Send data to server
         */
        clickCreateUpdate();
        function clickCreateUpdate() {

            $('#btn-edit-user').click(function (e) {

                var data = {
                    id          : $(this).attr('data-id'),
                    name   : modal.find('.js-edit-user-first-name').val(),
                    email   : modal.find('.js-edit-user-email').val(),
                    role   : modal.find('.js-edit-user-role').val(),
                    status   : modal.find('.js-edit-user-status').val(),
                };

                if ( $(this).attr('data-type') ==='update'){
                    update(data);
                } else if ($(this).attr('data-type') === 'create'){
                    insert(data);
                }

            });

        }

        /**
         *
         * @param data
         */
        function insert(data) {

            var ajaxObj = {
                method: 'post',
                data: data,
                url: app_url+'/admin/users/ajax'
            };

            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 201) {

                        var row = '<tr class="success"><td>'+response.user.id+'</td>' +
                            '<td>'+data.name+'</td><' +
                            'td>'+response.user.email +'</td>' +
                            '<td>'+response.user.role+'</td>' +
                            '<td>'+response.user.status+'</td>' +
                            '<td>'+response.user.creation_type+'</td>' +
                            '<td>'+response.user.created_at+'</td>' +
                            '<td>Actions</td></tr>';

                        $('#user-table tr:last').after(row);

                        modal.modal('hide');
                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                    alert('Error: '+errorThrown);
                    console.log('error ', jqXhr);

            });

        }


        /**
         * Update User
         *
         * @param data
         */
        function update(data) {

            var ajaxObj = {
                method: 'post',
                data: data,
                url: app_url+'/admin/users/'+data.id+ '/ajax'
            };
            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {


                    if (jqXhr.status === 200) {

                        $('tr#user_id_'+data.id).each(function(){
                            $(this).find('td').eq(1).text(data.name);
                            $(this).find('td').eq(2).text(response.user.email);
                            $(this).find('td').eq(4).text(response.user.status);

                        });

                        $('tr#user_id_'+data.id).addClass('success');

                        modal.modal('hide');
                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                    alert('Error: '+errorThrown);
                    console.log('error ', jqXhr);

            });

        }



    }

    /**
     * Close Delete Modal
     */
    var isDeleteModal = $('#delete-modal').length;

    if (isDeleteModal){

        var deleteModal = $('#delete-modal');

        /**
         * Show Delete modal
         */
        showDelete();
        function showDelete() {

            $('#user-table').on('click','.btn-remove', function () {

                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');

                deleteModal.find('.model-title').text('Delete User');
                deleteModal.find('.js-message').text('Are you sure to delete User ['+name+']?');
                deleteModal.find('#btn-delete-confirm').attr('data-url', app_url+'/admin/users/'+id+'/ajax');
                deleteModal.find('#btn-delete-confirm').attr('data-id', id);

                $('tr#user_id_'+id).addClass('danger');

                deleteModal.modal('show');

            });
        }

        $('#delete-modal .btn-close').click(function () {
            var table = $('.table');
            $(table).find('tr').removeClass('danger')
                                .removeClass('warning');
        });

        deleteItem();
        function deleteItem() {

            $('#page_user  #btn-delete-confirm').click(function () {

                var data = {
                    id: $(this).attr('data-id'),
                    url: $(this).attr('data-url')
                };

                var ajaxObj = {
                    method: 'delete',
                    url: data.url
                };

                $('tr#user_id_'+data.id).addClass('warning');

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 204) {

                            deleteModal.modal('hide');
                            $('tr#user_id_'+data.id).find('td').eq(4).text('Removing...');

                            (function () {
                                setTimeout(function(){
                                    $('tr#user_id_'+data.id).remove();
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

});