/**
 * Created by ariful.haque on 09/05/2018.
 */

$(document).ready(function () {

    var categoryPage = $('#page_category');
    var masterCourse = $('#master-course');
    var jsTitle = $('.js-title');
    var app_url = $('#app_url').val();

    function loadType() {

        jsSelectType.html(optionLoading);

        $.ajax({
            method: 'get',
            url: app_url+'/admin/categories/type/list',
        }).done(function (response, textStatus, xhr) {

            renderSelect(jsSelectType, response.types);

            $('#select-type option:first').trigger('change');


        }).fail(function (erors, textStatus, errorThrown) {

        });


    }
    function changeTypes() {

        $('#select-type').on('change', function () {

            var jsLabelsTable = $('#label-table');
            var value = $( "#select-type" ).val();

            if (jsLabelsTable.length >0){
                clearTable(jsLabelsTable);
            }

            jsSelectLabel.html('<option value="loading">Loading...</option>');

            $.ajax({
                method: 'get',
                url: app_url+'/admin/categories/label/'+value,
            }).done(function (response, textStatus, xhr) {

                if (jsTitle.text() === 'sublabel' || jsTitle.text() === 'knowledge' || jsTitle.text() === 'subject'
                    || masterCourse.length > 0){
                    // get label list and show

                    jsSelectLabel.attr('disabled', true);

                    renderSelect(jsSelectLabel, response.labels);

                    $('#select-label option:first').trigger('change');

                } else if (jsTitle.text() === 'label'){

                    renderTable(jsLabelsTable, response.labels);

                }

            }).fail(function (errors, textStatus, errorThrown) {


            }).always(function () {
                jsSelectLabel.removeAttr('disabled');
            });

        });
    }
    function changeLabels() {

        $('#select-label').on('change', function () {

            var jsLabelsTable = $('#sublabel-table');
            if (jsLabelsTable.length > 0){
                clearTable(jsLabelsTable);
            }
            var value = $( "#select-label" ).val();

            $.ajax({
                method: 'get',
                url: app_url+'/admin/categories/sublabel/'+value,
            }).done(function (response, textStatus, xhr) {

                if (jsTitle.text() === 'sublabel'){
                    // get label list and show
                    renderTable(jsLabelsTable, response.labels);

                } else if (jsTitle.text() === 'knowledge' || jsTitle.text() ==='subject' || masterCourse.length > 0){

                    renderSelect(jsSelectSubLabel, response.labels);

                    $('#select-sublabel option:first').trigger('change');

                }


            }).fail(function (errors, textStatus, errorThrown) {

            }).always(function () {

            });

        });
    }
    function changeSubLabel() {

        $('#select-sublabel').on('change', function () {

            var jsLabelsTable = $('#knowledge-table');
            if (jsLabelsTable.length > 0){
                clearTable(jsLabelsTable);
            }
            var value = $( "#select-sublabel" ).val();

            $.ajax({
                method: 'get',
                url: app_url+'/admin/categories/knowledge/'+value,
            }).done(function (response, textStatus, xhr) {

                if (jsTitle.text() === 'knowledge') {
                    // get label list and show

                    renderTable(jsLabelsTable, response.labels);

                } else if (jsTitle.text() === 'subject' || masterCourse.length > 0) {

                    renderSelect(jsKnowledgeLabel, response.labels);
                    $('#select-knowledge option:first').trigger('change');

                }

            }).fail(function (errors, textStatus, errorThrown) {


            }).always(function () {
                // jsSelectLabel.removeAttr('disabled');
            });

        });

    }
    function changeKnowledge() {

        $('#select-knowledge').on('change', function () {

            var jsLabelsTable = $('#subject-table');
            if (jsLabelsTable.length > 0) {
                clearTable(jsLabelsTable);
            }

            var value = $( "#select-knowledge" ).val();

            $.ajax({
                method: 'get',
                url: app_url+'/admin/categories/subject/'+value,
            }).done(function (response, textStatus, xhr) {

                if (jsTitle.text() === 'subject') {
                    // get label list and show
                    renderTable(jsLabelsTable, response.labels);
                } else if(masterCourse.length > 0) {

                    // alert('load subje')
                    renderSelect(jsSelectSubject, response.labels);
                }

            }).fail(function (errors, textStatus, errorThrown) {


            }).always(function () {
                // jsSelectLabel.removeAttr('disabled');
            });

        });

    }



    function renderSelect(select, data) {

        select.html('');
        $.each(data, function (key, value) {

            select.append(getOption(value));

        });

    }
    function getOption(item) {

        return '<option value="'+item.id+'">'+item.title+'</option>';
    }

    if(categoryPage.length > 0) {

        var jsSelectType = $('#select-type');
        var jsSelectLabel = $('#select-label');
        var jsSelectSubLabel = $('#select-sublabel');
        var jsKnowledgeLabel = $('#select-knowledge');

        var optionLoading = '<option value="loading">Loading...</option>';

        insertType();

        function insertType() {

            $('.btn-save-type').click(function () {

                var data = {
                    title : $('#title').val(),
                    type: 'type'
                };

                $.ajax({
                    method: 'post',
                    url : app_url+'/admin/categories/insert',
                    data: data
                }).done(function (response, textStatus, xhr) {

                    location.reload();

                }).fail(function (errors, textStatus, errorThrown) {
                    console.log(error);
                });



            });


        }


        if (jsTitle.text() !== 'type'){
            loadType();
        }

        changeTypes();

        changeLabels();

        changeSubLabel();

        changeKnowledge();

        showEditModal();

        function showEditModal() {

            categoryPage.on('click', '.btn-edit-title', function () {

                $('#modal-edit-category').modal('show');
                $('#modal-edit-category').find('#js-input-edit-category-title').val($(this).attr('data-title'));
                $('.btn-edit-category-title').attr('data-id', $(this).attr('data-id'));

            });
        }

        updateTitle();
        function updateTitle() {

            $('.btn-edit-category-title').click(function () {

                var id = $(this).attr('data-id');
                var title = $('#js-input-edit-category-title').val();

                $.ajax({
                    method: 'post',
                    data: {
                        title: title,
                    },
                    url: app_url+'/admin/categories/'+id,
                }).done(function (response, textStatus, xhr) {
                    $('#modal-edit-category').modal('hide');

                    toastr.success('Type Updated successfully.');
                    window.setTimeout(function(){location.reload()}, 4000);

                }).fail(function (errors, textStatus, errorThrown) {


                }).always(function () {

                });


            });

        }

        removeItem();
        function removeItem() {

            categoryPage.on('click', '.btn-remove-category', function (e) {

                e.preventDefault();

                var answer = confirm("Are you sure to remove?");

                if (answer === true){

                    var id = $(this).attr('data-id');
                    $('#row_type_'+id).addClass('warning');

                    $.ajax({
                        method: 'delete',
                        url: app_url+'/admin/categories/delete/'+id
                    }).done(function (response, textStatus, xhr) {

                        if (xhr.status === 204){

                            $('#row_type_'+id).remove();

                        }
                    }).fail(function (errors) {

                        });
                }


            });
        }

    }


    if (masterCourse.length > 0 || categoryPage.length > 0){

        var jsSelectType = $('#select-type');
        var jsSelectLabel = $('#select-label');
        var jsSelectSubLabel = $('#select-sublabel');
        var jsKnowledgeLabel = $('#select-knowledge');
        var jsSelectSubject = $('#select-subject');

        // loadType();
        changeTypes();
        changeLabels();
        changeSubLabel();
        changeKnowledge();

    }

    function renderTable(table, data) {

        table.html('');

        $.each(data, function (key, value) {

            var buttons = '<td class="text-right"> <div class="btn-group">'+
                '<button type="button" data-id="'+value.id+'" data-title="'+value.title+'" class="btn btn-edit-title btn-sm btn-flat btn-default">Edit</button>' +
                '<button type="button" data-id="'+value.id+'" class="btn btn-remove btn-sm btn-flat btn-default">Remove</button></div></td>';

            var row = '<tr id="row_type_'+value.id+'"><td>'+value.id+'</td><td>'+value.title+'</td><td>'+buttons+'</td></tr>';

            table.append(row);

        });

    }

    function clearTable(table) {
        table.html('');
    }

});