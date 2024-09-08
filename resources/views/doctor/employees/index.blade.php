@extends('doctor.layout.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2> <i class="la la-group"></i> المستخدمون </h2>
    </div>
    <hr />

    @if (Session::has('Success'))
        <div class="alert alert-success">{{ Session::get('Success') }}</div>
    @endif


    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>انشاء مستخدم</h3>
                    <form action="{{ route('doctor.employees.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">الاسم</label>
                            <input type="text" value="{{old('name')}}"  name="name" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">اسم المستخدم (الهاتف)</label>
                            <input type="text" value="{{old('phone')}}" name="phone" required class="form-control">
                            @error('phone')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">كلمة المرور</label>
                            <input type="text" value="{{old('password')}}"   name="password" required class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="ادخال">
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3>عرض بيانات المستخدمون</h3>
                    <table id="table" class="table " style="width:100%">
                        <thead>
                            <tr>
                                <th>م</th>
                                <th>الاسم</th>
                                <th>رقم الهاتف</th>
                                <th>الاجراءت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($Employees as $item)
                            <tr>
                                <td >{{$i++}}</td>
                                <td class="update-link" data-route='{{route("doctor.employees.edit",$item->id)}}'>{{$item->name}}</td>
                                <td>{{$item->phone}}</td>
                                <td>
                                    <form onclick="return confirm('سوف تقوم بعملية الحذف')" action="{{route('doctor.employees.destroy',$item->id)}}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submti" class="btn btn-danger btn-sm">حذف</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
