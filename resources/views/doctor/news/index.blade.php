@extends('doctor.layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2> <i class="la la-newspaper-o"></i> شريط الاخبار </h2>
        <a href="{{ route('doctor.news.create') }}" class="btn btn-primary">اضافة</a>
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
                    @foreach ($News as $item)
                        <tr data-id="{{ $item->id }}">
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->text }}</td>
                            <td>
                                <form onsubmit="return confirm('سوف تقوم بالحذف')" method="POST" action="{{route('doctor.news.destroy',$item->id)}}" id="delete">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{route('doctor.news.edit',$item->id)}}" class="btn-success btn btn-sm ">تعديل</a>
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
                    url: "{{ route('doctor.news.updateOrder') }}",
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

