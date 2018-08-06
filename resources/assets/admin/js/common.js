/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {

    var app_url = $('#app_url').val();

    $(document).ready(function(e){
        $('.search-panel .dropdown-menu').find('a').click(function(e) {
            e.preventDefault();
            var param = $(this).attr("href").replace("#","");
            var concept = $(this).text();
            $('.search-panel span#search_concept').text(concept);
            $('.input-group #search_param').val(param);
        });
    });

    $('.js-datepicker').datepicker({
        format: 'dd/mm/yyyy',
    });

    $("[rel=tooltip]").tooltip({ placement: 'top'});


    var selectProvinceLength = $('.js-select-province').length;

    if(selectProvinceLength > 0) {

        var selectProvince = $('.js-select-province');

        selectProvince.change(function () {

            var selectCanton = $('.js-select-canton');

            selectCanton.empty();
            selectCanton.attr('disabled', 'disabled');
            selectCanton.append('<option>Loading...</option>');

            var provinceId = $(selectProvince).find('option:selected').val();


            var ajaxObj = {
                method: 'get',
                url: app_url+'/admin/location/canton/ajax/'+provinceId
            };

            $.ajax(ajaxObj)
                .done(function (response, textStatus, jqXhr) {

                    if (jqXhr.status === 200) {

                        selectCanton.empty();

                        $.each(response.cantons, function (key, value) {
                            selectCanton.append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        selectCanton.attr('disabled', false);

                    }

                }).fail(function (jqXhr, textStatus, errorThrown) {

                    alert('Error: '+errorThrown);
                    console.log('error ', jqXhr);
                    selectCanton.empty();
                    selectCanton.attr('disabled', false);

            });


        });
    }


    /**
     * Close Delete Modal
     */
    var deleteModal = $('#delete-modal').length;

    if (deleteModal){

        $('#delete-modal .btn-close').click(function () {
            var table = $('.table');
            $(table).find('tr').removeClass('danger')
                                .removeClass('warning');
        });
    }

});