@extends('doctor.layout.app')
@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h2> <i class="la la-dashboard"></i> تعديل : {{$reason->name}} </h2>
    <a href="{{route('doctor.reasons.index')}}" class="btn btn-dark">للخلف</a>
</div>
<hr />

<form action="{{route('doctor.reasons.update',$reason->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <input type="text" name="name" class="form-control" value="{{$reason->name}}">
    </div>

    <input type="submit"  class="btn btn-success" value="حفظ">
</form>
@endsection