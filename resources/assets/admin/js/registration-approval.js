/**
 * Created by ariful.haque on 09/05/2018.
 */
$(document).ready(function () {


    var $selectAll = $('#check_all'); // main checkbox inside table t head
    var $table = $('#pending-table'); // table selector
    var $tdCheckbox = $table.find('tbody input:checkbox'); // checboxes inside table body
    var $tdCheckboxChecked = []; // checked checbox arr

    //Select or deselect all checkboxes on main checkbox change
    $selectAll.on('click', function () {
        $tdCheckbox.prop('checked', this.checked);
    });

    //Switch main checkbox state to checked when all checkboxes inside tbody tag is checked
    $tdCheckbox.on('change', function(){
        $tdCheckboxChecked = $table.find('tbody input:checkbox:checked');//Collect all checked checkboxes from tbody tag
        //if length of already checked checkboxes inside tbody tag is the same as all tbody checkboxes length, then set property of main checkbox to "true", else set to "false"
        $selectAll.prop('checked', ($tdCheckboxChecked.length == $tdCheckbox.length));
    });


    $('#approve-all').on('click', function(e) {

        var registrations_ids_arr = [];

        $(".checkbox:checked").each(function() {
            registrations_ids_arr.push($(this).attr('data-id'));
        });

        if(registrations_ids_arr.length <=0)
        {
            toastr.error("Please select atleast one record to Approve.");
        }  else {

            if(confirm('Are you sure, you want to Approve '+registrations_ids_arr.length+' selected Requests?')){

                var registrations_ids_string = registrations_ids_arr.join(",");

                $.ajax({
                    url: "/admin/registration/approve-multiple",
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'ids='+registrations_ids_string,
                    success: function (data) {
                        if (data['status']==true) {
                            toastr.message(data['message']);

                        } else {
                            toastr.warning('Whoops Something went wrong!!');
                        }
                        window.setTimeout(function () {
                            location.reload();
                        }, 40000);
                    },
                    error: function (data) {
                        toastr.error('Whoops Something went wrong!!');
                    }
                });

            }
        }
    });


    console.log($tdCheckboxChecked);

    var app_url = $('#app_url').val();

    searchCourses();
    function searchCourses() {

       var search_pending_approval_length = $('#pending-table').length;

       if(search_pending_approval_length > 0) {

           $('#pending-table .btn-approve-confirm').click(function () {

               var id = $(this).attr('data-id');

               if ($('.js-approve-check-'+id).is(':checked') === false){

                   $('#row-'+id).find('.js-td-is-approved').find('.checked').addClass('text-red');

                   toastr.warning('Please Check Box to Approve.');

                   return 0;
               }

               var table = $('#pending-table');

               $.ajax({
                  url: app_url+'/admin/registration/'+id+'/update/approve',
                   method:'post',
                   data: {
                      is_approved: true
                   }
               }).done(function (response, textStatus, jqxhr) {

                   if (jqxhr.status === 200){

                       var isApproved = '<i class="fa fa-check"></i> Yes <br/>'
                       +'<small><i class="fa fa-clock-o"></i> '+response.registration.approval_time+'</small>';
                       table.find('#row-'+id).find('.js-td-is-approved').html(isApproved);
                       table.find('#row-'+id).find('.js-td-approved-by').html(response.adminUser);
                   }


               }).fail(function (jqXhr, textStatus, errorThrown) {

                   toastr.error('Update Approval failed!');
                   console.log('jqxhr', jqXhr);

               });
           });


           var searchPendingApproval = $('#search-pending-approval');

           //select 2
           searchPendingApproval.select2({
               // dropdownParent: modal,
               ajax: {
                   url: app_url+'/admin/course/search/ajax',
                   dataType: 'json',
                   delay: 250,
                   data: function (params) {
                       var query = {
                           search: params.term,
                           type: 'public'
                       };

                       // Query parameters will be ?search=[term]&type=public
                       return query;
                   },
                   processResults: function (data) {
                       // Tranforms the top-level key of the response object from 'items' to 'results'
                       console.log('data process ', data);
                       return {
                           results: data.items
                       };
                   }
                   // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
               },
               width: 'resolve',
               minimumResultsForSearch: 20,
               minimumInputLength: 1, // only start searching when the user has input 3 or more characters
               maximumInputLength: 20 // only allow terms up to 20 characters long
           });

       }
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