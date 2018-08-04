<script type="text/javascript">

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "swing",
        "showMethod": "slideDown",
        "hideMethod": "fadeOut"
    };

    @if (Session::has('app_info'))
        toastr.info("{{ Session::get('app_info') }}", "Message");
    @endif

    @if (Session::has('app_message'))
        toastr.success("{{ Session::get('app_message') }}", "Message");
    @endif

    @if (Session::has('app_warning'))
        toastr.warning("{{ Session::get('app_warning') }}", "Message");
    @endif

    @if (Session::has('app_error'))
        toastr.error("{{ Session::get('app_error') }}", "Message");
    @endif

</script>