
$(document).ready(function () {

    /**
     * Set csrf token to all ajax call
     */

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });


    $('table').on('hover', '.btn-remove', function () {
        $(this).removeClass('btn-default');
        $(this).addClass('btn-danger');
    },function () {
        console.log('hover in');
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-default');
    });

    //enable tooltip
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();


});