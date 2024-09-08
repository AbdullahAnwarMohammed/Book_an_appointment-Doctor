@extends('doctor.layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2> <i class="la la-group"></i> تعديل بيانات مستخدم </h2>
        <a href="{{ route('doctor.employees.index') }}" class="btn btn-dark">للخلف</a>
    </div>
    <hr />

    @if (Session::has('Success'))
        <div class="alert alert-success">{{ Session::get('Success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">

            <form action="{{ route('doctor.employees.update',$Employee->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">الاسم</label>
                    <input type="text" value="{{ $Employee->name }}" name="name" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="">اسم المستخدم (الهاتف)</label>
                    <input type="number" value="{{ $Employee->phone }}" name="phone" required class="form-control">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">كلمة المرور</label>
                    <input type="text" value="{{$Employee->show_password}}" name="password"  class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-danger" value="حفظ">
                </div>
            </form>


        </div>
    </div>
@endsection
