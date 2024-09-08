@extends('employee.layouts.app')
@section('content')
    <div class="appOne" style="background: #fff;">
        <div class="guarantor">
            <div class="title" style="color:#fff;background:#555;display:flex; justify-content:center;align-items:center">
                <h5> <span style="color:#75f98c;"> <i class="ri-shield-user-fill"></i>مرحبا </span>
                    {{Auth::guard('employee')->check() ? Auth::guard('employee')->user()->name : Auth::guard('doctor')->user()->name}} 
                    <form action="{{route('frontend.auth.logout.doctor.employee')}}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger">خروج</button>
                    </form>
                </h5>
            </div>
            <p> هذه الصفحة تمكنكم من متابعة <span class="fw-bold">الزائرين</span></p>
            <p> </p>
        </div>

        @livewire('employee.register-all')

    </div>
@endsection
@push('css')
    <style>
        .hover-name:hover {
            background: #75f98c;
            cursor: pointer;
        }
    </style>
@endpush
@push('js')
    <script>
        document.addEventListener('open-modal', function() {
            document.querySelectorAll('.modal-backdrop.show').forEach((modal) => {
                modal.classList.remove('show');
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
                document.querySelector('.modal-backdrop').remove();
            });


            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        });

        document.addEventListener('open-modal-group', function() {

            document.querySelectorAll('.modal-backdrop.show').forEach((modal) => {
                modal.classList.remove('show');
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
                document.querySelector('.modal-backdrop').remove();
            });


            var myModal = new bootstrap.Modal(document.getElementById('modalGroup'));
            myModal.show();
        });




        window.addEventListener("resetRegister", event => {
            Swal.fire({
                title: "سوف تقوم باسترجاع قيم الحالات",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "حفظ",
                denyButtonText: `عد الحغظ`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Livewire.dispatch("resetRegisterDone")

                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        })
    </script>
@endpush
