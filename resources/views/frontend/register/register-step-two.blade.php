@extends('frontend.layout.app')
@push('css')
    <style>
        .position-relative {
    position: relative;
}

.placeholder {
    position: absolute;
    top: 50%;
    right: 61px;
    transform: translateY(-50%);
    pointer-events: none;
    color: #6c757d;
    font-size: 14px;
    transition: 0.2s;
}

input:focus ~ .placeholder,
input:not(:placeholder-shown) ~ .placeholder {
    opacity: 1;
}
    </style>
@endpush
@section('content')
    @livewire('frontend.step-two-form')
@endsection
@push('js')
    <script>
        

        window.addEventListener("error_date", function(event) {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-left",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.error('خطا فى التاريخ')

        });

        window.addEventListener("day_is_break", function(event) {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-left",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.error('يوم اجازة')

        });
    </script>
@endpush
