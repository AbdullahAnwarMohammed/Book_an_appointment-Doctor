@extends('doctor.layout.app')

@section('content')
<h3>تعديل البيانات الاساسية</h3>
<hr />
@if (Session::has('Success'))
    <div class="alert alert-success">{{Session::get('Success')}}</div>
@endif
<form action="{{route('doctor.profile')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="">الاسم</label>
        <input type="text" name="name" required value="{{auth()->guard('doctor')->user()->name}}" class="form-control">
    </div>
    <div class="form-group">
        <label for="">اسم المستخدم</label>
        <input type="text" name="email" required value="{{auth()->guard('doctor')->user()->email}}" class="form-control">
    </div>
    <div class="form-group">
        <label for="">كلمة المرور الجديدة</label>
        <input type="text" value="{{auth()->guard('doctor')->user()->show_password}}" name="password" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" value="تعديل" class="btn btn-success">
    </div>
    
</form>
@endsection