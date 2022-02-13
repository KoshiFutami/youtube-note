@if ($toastr = session('toastr'))
<script>
    document.querySelector('script[src="{{ asset("js/app.js") }}"]').onload = function() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "10000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
       toastr.{{ $toastr['type'] }}('{{ $toastr["text"] }}');
   }
</script>
@endif