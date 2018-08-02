$(document).ready(function () {


    var page = $('#page_canton').length;
    var app_url = $('#app_url').val();

    if (page > 0){


        console.log('canton ready');

        $('#cantons-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: app_url+'/admin/location/canton/ajax/table',
                method: 'POST'
            },
            columns: [
                { data: 'province_name', name: 'provinces.name', searchable: true },
                { data: 'canton_name', name: 'cantons.name', searchable: true},
                { data: 'canton_capital', name: 'cantons.capital', searchable: true},
                { data: 'canton_dist_name', name: 'cantons.dist_name', searchable: true},
                { data: 'canton_dist_code', name: 'cantons.dist_code', searchable: true},
                { data: 'canton_zone', name: 'cantons.zone', searchable: true},
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


        var cantonModal = $('#edit-canton-modal');

        cantonShowEditModal();
        function cantonShowEditModal() {

            $('#cantons-table').on('click', '.btn-edit-canton', function () {

                cantonModal.find('.js-modal-title').text('Edit Canton');

                var data = {
                    id : $(this).attr('data-id'),
                    province_id : $(this).attr('data-province_id'),
                    name : $(this).attr('data-canton_name'),
                    capital : $(this).attr('data-canton_capital'),
                    dist_name : $(this).attr('data-canton_dist_name'),
                    dist_code : $(this).attr('data-canton_dist_code'),
                    zone : $(this).attr('data-canton_zone'),
                };


                cantonModal.find('.js-edit-canton-province option[value="'+data.province_id+'"]').attr('selected', true);
                cantonModal.find('.js-edit-canton-name').val(data.name);
                cantonModal.find('.js-edit-canton-capital').val(data.capital);
                cantonModal.find('.js-edit-canton-district').val(data.dist_name);
                cantonModal.find('.js-edit-canton-dist_code').val(data.dist_code);
                cantonModal.find('.js-edit-canton-zone option[value="'+data.zone+'"]').attr('selected', true);
                cantonModal.find('#btn-edit-canton').attr('data-id', data.id);

                cantonModal.find('#btn-edit-canton').text('Update');
                cantonModal.find('#btn-edit-canton').attr('data-type','update');
                cantonModal.modal('show');
            });
        }

        clickCreateUpdate();
        function clickCreateUpdate() {

            $('#btn-edit-canton').click(function (e) {

                e.preventDefault();

                var data = {
                    id : $(this).attr('data-id'),
                    province_name : cantonModal.find('.js-edit-canton-province option:selected').text(),
                    province_id : cantonModal.find('.js-edit-canton-province option:selected').val(),
                    name : cantonModal.find('.js-edit-canton-name').val(),
                    capital : cantonModal.find('.js-edit-canton-capital').val(),
                    dist_name : cantonModal.find('.js-edit-canton-district').val(),
                    dist_code : cantonModal.find('.js-edit-canton-dist_code').val(),
                    zone : cantonModal.find('.js-edit-canton-zone option:selected').val()
                };

                if ( $(this).attr('data-type') ==='update'){
                    update(data);
                } else if ($(this).attr('data-type') === 'create'){
                    insertCanton(data);
                }

            });

        }


        /**
         *
         */
        showAddCantonModal();
        function showAddCantonModal() {

            $('#btn-create-canton').click(function () {

                cantonModal.find('.js-modal-title').text('Add New Canton');
                cantonModal.find('input').val('');

                cantonModal.find('#btn-edit-canton').text('Create');
                cantonModal.find('#btn-edit-canton').attr('data-type','create');
                cantonModal.modal('show');

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
                url: app_url+'/admin/location/canton/'+ data.id+'/ajax'
            };

            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 200) {

                        $('tr#canton_id_'+data.id).each(function(){

                            $(this).find('td').eq(1).text(data.name);
                            $(this).find('td').eq(2).text(data.capital);
                            $(this).find('td').eq(3).text(data.dist_name);
                            $(this).find('td').eq(4).text(data.dist_code);
                            $(this).find('td').eq(5).text(data.zone);

                        });

                        $('tr#canton_id_'+data.id).addClass('success');

                        cantonModal.modal('hide');

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
        function insertCanton(data) {

            var ajaxObj = {
                method: 'post',
                data: data,
                url: app_url+'/admin/location/canton/ajax'
            };

            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 201) {

                        var row = '<tr class="success"><td>'+data.province_name+'</td><td>'+data.name+'</td><td>'+data.capital
                            +'</td><td>'+data.dist_name+'</td><td>'+data.dist_code+'</td><td>'+data.zone+'</td><td>Actions</td></tr>';

                        $('#cantons-table tr:last').after(row);

                        cantonModal.modal('hide');
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

            $('#cantons-table').on('click','.btn-remove', function () {

                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');

                    deleteModal.find('.model-title').text('Delete Canton');
                    deleteModal.find('.js-message').text('Are you sure to delete Canton ['+name+']?');
                    deleteModal.find('#btn-delete-confirm').attr('data-url', app_url+'/admin/location/canton/'+id+'/ajax');
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

                $('tr#canton_id_'+data.id).addClass('warning');

                $.ajax(ajaxObj)
                    .done(function (response, textStatus, jqXhr) {

                        if (jqXhr.status === 204) {

                            deleteModal.modal('hide');

                            (function () {
                                setTimeout(function(){
                                    console.log('remove now');
                                    $('tr#canton_id_'+data.id).remove();
                                }, 1500)
                            })(this);
                        }

                    }).fail(function (jqXhr, textStatus, errorThrown) {

                        alert('Error: '+errorThrown);
                        console.log('error ', jqXhr);

                });


            });
        }

        loadProvinces();
        function loadProvinces() {

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

                        $.each(response.provinces, function (key, value) {
                            province.append('<option value="'+value.id+'">'+value.name+'</option>');
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
                // dropdownParent: cantonModal,
                // width: 'resolve',
                minimumResultsForSearch: 20,
                // minimumInputLength: 1, // only start searching when the user has input 3 or more characters
                maximumInputLength: 20 // only allow terms up to 20 characters long
            });




        }

    }// page
});