@extends('doctor.layout.app')
@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2> <i class="la la-dashboard"></i> اسباب الحجوزات </h2>
        <a href="{{ route('doctor.reasons.create') }}" class="btn btn-primary">اضافة</a>
    </div>
    <hr />
    @if (Session::has('Success'))
        <div class="alert alert-success">{{ Session::get('Success') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            <table id="table" class="table " style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>الاجراءت</th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                @foreach ($Reasons as $item)
                    <tr data-id="{{ $item->id }}">
                        <td>{{ $i++ }}</td>
                        <td class="update-link" data-route="{{route('doctor.reasons.edit',$item->id)}}">{{ $item->name }}</td>
                        <td>
                            <form onsubmit="return confirm('سوف تقوم بالحذف')" method="POST" action="{{route('doctor.reasons.destroy',$item->id)}}" id="delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $("#table tbody").sortable({
            update: function(event, ui) {
                var sortedIDs = $(this).sortable("toArray", {
                    attribute: "data-id"
                });

                $.ajax({
                    url: "{{ route('doctor.reasons.updateOrder') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        order: sortedIDs
                    },
                    success: function(response) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "تم التعديل بنجاح",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                });
            }
        }).disableSelection();
    </script>
@endpush
