@extends('doctor.layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2> <i class="la la-dashboard"></i> اسباب الحجوزات </h2>
        <a href="{{route('doctor.reasons.index')}}" class="btn btn-dark">للخلف</a>
    </div>
    <hr />

    <div class="card">
        <div class="card-body">
            
    <form action="{{route('doctor.reasons.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" placeholder="السبب" name="name" class="form-control">
            @error('name')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success" value="ادخال">
        </div>
    </form>
        </div>
    </div>
@endsection