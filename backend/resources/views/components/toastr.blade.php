@if ($toastr = session('toastr'))
<script>
    document.querySelector('script[src="{{ asset("js/app.js") }}"]').onload = function() {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "750",
            "hideDuration": "7500",
            "timeOut": "4000",
            "showEasing": "linear",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
       toastr.{{ $toastr['type'] }}('{{ $toastr["text"] }}');
   }
</script>
@endif