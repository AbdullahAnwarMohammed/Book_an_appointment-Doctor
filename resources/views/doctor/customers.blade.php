@extends('employee.layouts.app')
@section('content')
    @livewire('doctor.customers')

    <!-- Modal -->
    <div class="modal modal-lg fade" id="modalCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background:#e2ffbc">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalCustomerGet">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(".modal-customer").on("click", function(e) {
            e.preventDefault(); // Prevent the default form submission
            let id = $(this).data("id");
            $.ajax({
                url: "{{ route('employee.dashboard.customer.modal') }}",
                type: 'POST',
                data: {
                    id:id
                },
                success : function(response) {
                    $("#modalCustomerGet").html(response);
                },
                error: function(xhr) {
                    // Handle errors here
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
@endpush
