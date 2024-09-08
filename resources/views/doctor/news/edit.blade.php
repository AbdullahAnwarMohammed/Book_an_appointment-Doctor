@extends('doctor.layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="la la-newspaper-o"></i> تعديل : {{ $News->text }} </h2>
        <a href="{{ route('doctor.news.index') }}" class="btn btn-dark">للخلف</a>
    </div>
    <hr />
    @if (Session::has('Success'))
        <div class="alert alert-success">{{ Session::get('Success') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('doctor.news.update', $News->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="text" value="{{ $News->text }}" name="text" placeholder="الخبر"
                        class="form-control">
                    @error('text')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="1" @selected($News->status == 1)>يعمل</option>
                        <option value="0" @selected($News->status == 0)>متوقف</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="ادخال">
                </div>

            </form>
        </div>
    </div>
@endsection
