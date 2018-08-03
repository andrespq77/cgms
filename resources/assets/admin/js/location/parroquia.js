$(document).ready(function () {


    var page = $('#page_parroquia').length;
    var app_url = $('#app_url').val();

    if (page > 0){

        $('#parroquia-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: app_url+'/admin/location/parroquia/ajax/table',
                method: 'POST'
            },
            columns: [
                { data: 'province_name', name: 'provinces.name', searchable: true },
                { data: 'canton_name', name: 'cantons.name', searchable: true},
                { data: 'parroquia_name', name: 'parroquia.name', searchable: true},
                { data :'action', searchable:false, orderable: false}
            ],
            initComplete: function () {
                console.log('init complete ');
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val()).draw();
                        });
                });
            },
        })
;

        var modal = $('#edit-parroquia-modal');

        parroquiaShowEditModal();
        function parroquiaShowEditModal() {

            $('#parroquia-table').on('click', '.btn-edit-parroquia', function () {

                modal.find('.js-modal-title').text('Edit Parroquia');

                var data = {
                    id : $(this).attr('data-id'),
                    province_id : $(this).attr('data-province_id'),
                    canton_id : $(this).attr('data-canton_id'),
                    canton_name : $(this).attr('data-canton_name'),
                    name : $(this).attr('data-parroquia_name')
                };

                modal.find('.js-edit-canton-province option[value="'+data.province_id+'"]').attr('selected', true);
                modal.find('.js-edit-canton').empty();
                modal.find('.js-edit-canton').append('<option value="'+data.canton_id+'">'+data.canton_name+'</option>');
                modal.find('.js-edit-parroquia-name').val(data.name);
                modal.find('#btn-edit-parroquia').attr('data-id', data.id);

                modal.find('#btn-edit-parroquia').text('Update');
                modal.find('#btn-edit-parroquia').attr('data-type','update');
                modal.modal('show');
            });
        }

        clickCreateUpdate();
        function clickCreateUpdate() {

            $('#btn-edit-parroquia').click(function (e) {

                e.preventDefault();

                var data = {
                    id : $(this).attr('data-id'),
                    province_name : modal.find('.js-edit-canton-province option:selected').text(),
                    province_id : modal.find('.js-edit-canton-province option:selected').val(),
                    canton_name : modal.find('.js-edit-canton option:selected').text(),
                    canton_id : modal.find('.js-edit-canton option:selected').val(),
                    name : modal.find('.js-edit-parroquia-name').val(),
                };

                if ( $(this).attr('data-type') ==='update'){
                    update(data);
                } else if ($(this).attr('data-type') === 'create'){
                    insertParroquia(data);
                }

            });

        }


        /**
         *
         */
        showAddModal();
        function showAddModal() {

            $('#btn-create-parroquia').click(function () {

                modal.find('.js-modal-title').text('Add New Parroquia');
                modal.find('input').val('');

                modal.find('#btn-edit-parroquia').text('Create');
                modal.find('#btn-edit-parroquia').attr('data-type','create');
                modal.modal('show');

            });
        }

        /**
         * Update data
         * @param data
         */

        function update(data) {

            var ajaxObj = {
                method: 'post',
                data: data,
                url: app_url+'/admin/location/parroquia/'+ data.id+'/ajax'
            };

            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 200) {

                        $('tr#parroquia_id_'+data.id).each(function(){

                            $(this).find('td').eq(0).text(data.province_name);
                            $(this).find('td').eq(1).text(data.canton_name);
                            $(this).find('td').eq(2).text(data.name);
                        });

                        $('tr#parroquia_id_'+data.id).addClass('success');

                        modal.modal('hide');

                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                    alert('Error: '+errorThrown);
                    console.log('error ', jqXhr);

            });
        }

        /**
         * Save data
         * @param data
         */
        function insertParroquia(data) {

            var ajaxObj = {
                method: 'post',
                data: data,
                url: app_url+'/admin/location/parroquia/ajax'
            };

            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 201) {

                        var row = '<tr class="success"><td>'+data.province_name+'</td><td>'+data.canton_name+'</td><td>'
                            +data.name +'</td><td>Actions</td></tr>';

                        $('#parroquia-table tr:last').after(row);

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

            $('#parroquia-table').on('click','.btn-remove', function () {

                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');

                    deleteModal.find('.model-title').text('Delete Parroquia');
                    deleteModal.find('.js-message').text('Are you sure to delete Parroquia ['+name+']?');
                    deleteModal.find('#btn-delete-confirm').attr('data-url', app_url+'/admin/location/parroquia/'+id+'/ajax');
                    deleteModal.find('#btn-delete-confirm').attr('data-id', id);
                    deleteModal.modal('show');

                });
        }
        
        
        deleteItem();
        function deleteItem() {

            $('#btn-delete-confirm').click(function () {


                var data = {
                    id: $(this).attr('data-id'),
                    url: $(this).attr('data-url')
                };

                var ajaxObj = {
                    method: 'delete',
                    url: data.url
                };

                $('tr#parroquia_id_'+data.id).addClass('warning');

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 204) {
                            deleteModal.modal('hide');
                            (function () {
                                setTimeout(function(){
                                    $('tr#parroquia_id_'+data.id).remove();
                                }, 1500)
                            })(this);
                        }

                    }).fail(function (jqXhr, textStatus, errorThrown) {

                        alert('Error: '+errorThrown);
                        console.log('error ', jqXhr);

                });


            });
        }

    }// page
});