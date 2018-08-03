$(document).ready(function () {

    var tableAnswers = $('#table-modalities');
    var app_url = $('#app_url').val();

    if(tableAnswers.length > 0){

        addModality();
        function addModality() {

            $('.btn-add-modality').click(function () {

                var data = {
                    title: $('#modality_title').val(),
                    type_id: $('#type_id').val(),
                    sort: $('#modality_sort').val(),
                };

                var type = $(this).attr('data-type');

                var url = app_url+'/admin/course-modality/';

                if (type === 'update'){
                    var id = $(this).attr('data-id');

                    url = url + id;

                    $('tr#modality_'+id).addClass('warning');

                }

                $.ajax({
                    data: data,
                    method: 'post',
                    url: url
                }).done(function (response, textStatus, xhr) {

                    var sort = '<td>'+response.modality.sort+'</td>';
                    var title = '<td>'+response.modality.title+'</td>';
                    var row = '<tr class="success">'+sort+title+'<td>...</td></tr>';
                    $('#modality-body').append(row);

                    if (type === 'update'){
                        $('tr#modality_'+response.modality.id).remove();
                    }

                    clear();

                }).fail(function (error, textStatus, errorThrown) {

                });

            });
        }

        function clear() {

            $('#modality_title').val('');
            $('#modality_sort').val('');

            $('.btn-add-modality').text('Insert');
            $('.btn-add-modality').attr('data-id', '');
            $('.btn-add-modality').attr('data-type', 'insert');

        }


        tableAnswers.on('click', '.btn-edit', function () {

            var id = $(this).attr('data-id');

            $('#modality_title').val($(this).attr('data-title'));
            $('#modality_sort').val($(this).attr('data-sort'));
            $('.btn-add-modality').text('Update');
            $('.btn-add-modality').attr('data-id', id);
            $('.btn-add-modality').attr('data-type', 'update');

        });


        tableAnswers.on('click', '.btn-remove', function () {

            var id = $(this).attr('data-id');

            $('tr#modality_'+id).addClass('warning');

            $.ajax({
                url: app_url+'/admin/course-modality/'+id,
                method: 'delete',
            }).done(function (response, textStatus, xhr) {


                if (xhr.status === 204){
                    $('tr#modality_'+id).remove();
                }

            }).fail(function (xhr, textStatus, errorThrown) {

                console.log('sync error: ', xhr);
                alert('Sync Error: '+errorThrown);

            });

        });

        tableAnswers.on('click', '.btn-add-label', function () {

            var id = $(this).attr('data-id');

            $('tr').removeClass('warning');
            $('tr#modality_'+id).addClass('warning');
            $('#js-modality-title').html($(this).attr('data-title'));



        })

    }

});