@extends('doctor.layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2> <i class="la la-dashboard"></i> اضافة خبر </h2>
        <a href="{{route('doctor.news.index')}}" class="btn btn-dark">للخلف</a>
    </div>
    <hr />

    <div class="card">
        <div class="card-body">
            <form action="{{route('doctor.news.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="text" placeholder="الخبر" class="form-control">
                    @error('text')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
        
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="1">يعمل</option>
                        <option value="0">متوقف</option>
                    </select>
                </div>
        
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="ادخال">
                </div>
            </form>
        </div>
    </div>
@endsection