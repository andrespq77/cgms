/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    var pageLength = $('#page_university').length;
    var app_url = $('#app_url').val();


    if(pageLength > 0) {

        console.log('University');
        console.log(app_url);
        /**
         * Datepicker
         */
        $('#university-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: app_url+'/admin/university/ajax/table',
                method: 'POST'
            },
            columns: [
                { data: 'id', name: 'universities.id', searchable: true },
                { data: 'name', name: 'name', searchable: true, render: function (item, type, data) {
                    return '<a href="'+app_url+'/admin/university/'+data.id+'">'+item+'</a>';
                }},
                { data: 'email', name: 'email', searchable: true},
                { data: 'phone', name: 'phone', searchable: true},
                { data: 'website', name: 'website', searchable: true},
                { data: 'login_user_name', name: 'login_user_name', searchable: true},
                { data: 'login_email', name: 'login_email', searchable: true},
                { data: 'created_by_name', name: 'users.created_by_name', searchable: true},
                { data: 'created_at', name: 'universities.created_by', searchable: true},
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


        var modal = $('#edit-universe-modal');

        /**
         * Create University
         */
        showAddModal();
        function showAddModal() {

            $('#btn-create-university').click(function () {

                modal.find('.js-modal-title-add').removeClass('hidden');
                modal.find('.js-modal-title-edit').addClass('hidden');
                modal.find('.js-login-section').removeClass('hidden');

                modal.find('input').val('');

                modal.find('#btn-edit-university').text('Create');
                modal.find('#btn-edit-university').attr('data-type','create');
                modal.modal('show');

            });
        }

        showEditModal();
        function showEditModal() {

            $('#university-table').on('click','.btn-edit-university', function () {

                modal.find('.js-modal-title-edit').removeClass('hidden');
                modal.find('.js-modal-title-add').addClass('hidden');
                modal.find('.js-login-section').addClass('hidden');

                var data = {
                    id          : $(this).attr('data-id'),
                    name        : $(this).attr('data-university_name'),
                    email        : $(this).attr('data-university_email'),
                    website        : $(this).attr('data-university_website'),
                    phone        : $(this).attr('data-university_phone'),
                    note        : $(this).attr('data-university_note'),
                };

                modal.find('.js-edit-university-name').val(data.name);
                modal.find('.js-edit-university-email').val(data.email);
                modal.find('.js-edit-university-website').val(data.website);
                modal.find('.js-edit-university-phone').val(data.phone);
                modal.find('.js-edit-university-note').val(data.note);


                modal.find('#btn-edit-university').attr('data-id', data.id);
                modal.find('#btn-edit-university').text('Update');
                modal.find('#btn-edit-university').attr('data-type','update');
                modal.modal('show');


            });

        }


        /**
         * Send data to server
         */
        clickCreateUpdate();
        function clickCreateUpdate() {

            $('#btn-edit-university').click(function (e) {

                var data = {
                    id          : $(this).attr('data-id'),
                    name   : modal.find('.js-edit-university-name').val(),
                    email   : modal.find('.js-edit-university-email').val(),
                    phone   : modal.find('.js-edit-university-phone').val(),
                    website   : modal.find('.js-edit-university-website').val(),
                    login_name   : modal.find('.js-edit-university-login_name').val(),
                    login_email   : modal.find('.js-edit-university-login_email').val(),
                    login_password   : modal.find('.js-edit-university-login_password').val(),
                    login_confirm_password   : modal.find('.js-edit-university-login_confirm_password').val(),
                    note   : modal.find('.js-edit-university-note').val()
                };

                if ( $(this).attr('data-type') ==='update'){
                    update(data);
                } else if ($(this).attr('data-type') === 'create'){
                    insertUniversity(data);
                }

            });

        }

        /**
         *
         * @param data
         */
        function insertUniversity(data) {

            var ajaxObj = {
                method: 'post',
                data: data,
                url: app_url+'/admin/university/ajax'
            };

            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 201) {

                        var row = '<tr class="success"><td>'+response.university.id+'</td>' +
                            '<td>'+data.name+'</td><' +
                            '<td>'+data.email+'</td><' +
                            '<td>'+data.phone+'</td><' +
                            '<td>'+data.website+'</td><' +
                            '<td>'+data.login_name+'</td><' +
                            '<td>'+data.login_email+'</td><' +
                            'td>refresh to view</td>' +
                            '<td>'+response.university.created_at+'</td>' +
                            '<td>Actions</td></tr>';

                        $('#university-table tr:last').after(row);

                        modal.modal('hide');
                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                    alert('Error: '+errorThrown);
                    console.log('error ', jqXhr);

            });

        }

        /**
         * Update University
         *
         * @param data
         */
        function update(data) {

            var ajaxObj = {
                method: 'post',
                data: data,
                url: app_url+'/admin/university/ajax/'+data.id
            };
            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 200) {

                        $('tr#university_id_'+data.id).each(function(){

                            $(this).find('td').eq(0).text(data.id);
                            $(this).find('td').eq(1).text(data.name);
                            $(this).find('td').eq(2).text(response.university.created_by_name);
                            $(this).find('td').eq(3).text(response.university.created_at);

                        });

                        $('tr#university_id_'+data.id).addClass('success');

                        modal.modal('hide');
                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                    alert('Error: '+errorThrown);
                    console.log('error ', jqXhr);

            });

        }



        var deleteModal = $('#delete-modal');

        /**
         * Show Delete modal
         */
        showDelete();
        function showDelete() {

            $('#university-table').on('click','.btn-remove', function () {

                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');

                deleteModal.find('.model-title').text('Delete University');
                deleteModal.find('.js-message').text('Are you sure to delete University ['+name+']?');
                deleteModal.find('#btn-delete-confirm').attr('data-url', app_url+'/admin/university/ajax/'+id);
                deleteModal.find('#btn-delete-confirm').attr('data-id', id);

                $('tr#university_id_'+id).addClass('danger');

                deleteModal.modal('show');

            });
        }


        deleteItem();
        function deleteItem() {

            $('#page_university  #btn-delete-confirm').click(function () {

                var data = {
                    id: $(this).attr('data-id'),
                    url: $(this).attr('data-url')
                };

                var ajaxObj = {
                    method: 'delete',
                    url: data.url
                };

                $('tr#university_id_'+data.id).addClass('warning');

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 204) {

                            deleteModal.modal('hide');
                            $('tr#university_id_'+data.id).find('td').eq(4).text('Removing...');

                            (function () {
                                setTimeout(function(){
                                    $('tr#university_id_'+data.id).remove();
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