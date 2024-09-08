@extends('doctor.layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2> <i class="la la-dashboard"></i> رفع الصور </h2>
    </div>
    <hr />

    <form action="{{route('doctor.upload.image.post')}}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- $table->string("front_banner_image")->nullable();
        $table->string("front_image_one")->nullable();
        $table->string("front_image_two")->nullable();
        $table->string("employee_image_lg")->nullable();
        $table->string("employee_image_sm")->nullable(); --}}
            <div class="card">
                <div class="card-body">
                <h3>الصفحة الرئيسية</h3>
                <div class="row">
                    <div class="col">
                        <label for="">صورة البانر الرئيسية</label>
                        <input type="file" name="front_banner_image" class="form-control">
                        <img width="250" src="{{ !empty(Images()['front_banner_image']) ? asset('storage/' . Images()['front_banner_image']) : '' }}" alt="">
                       @if (!empty(Images()['front_banner_image']))
                       <a class="btn btn-danger btn-sm" href="{{route('doctor.image.destory','front_banner_image')}}"  onclick="return confirm('سوف تقوم بحذف الصورة')">حذف</a>

                       @endif
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col">
                            <label for="">الصورة 1</label>
                            <input type="file" name="front_image_one" class="form-control">
                            <img width="250" src="{{ !empty(Images()['front_image_one']) ? asset('storage/' . Images()['front_image_one']) : '' }}" alt="">
                            @if (!empty(Images()['front_image_one']))
                            <a class="btn btn-danger btn-sm" href="{{route('doctor.image.destory','front_image_one')}}"  onclick="return confirm('سوف تقوم بحذف الصورة')">حذف</a>

                        @endif
                        </div>
                    <div class="col">
                        <label for="">الصورة 2</label>
                        <input type="file" name="front_image_two" class="form-control">
                        <img width="250" src="{{ !empty(Images()['front_image_two']) ? asset('storage/' . Images()['front_image_two']) : '' }}" alt="">
                        @if (!empty(Images()['front_image_two']))
                        <a class="btn btn-danger btn-sm" href="{{route('doctor.image.destory','front_image_two')}}"  onclick="return confirm('سوف تقوم بحذف الصورة')">حذف</a>

                    @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
            <h3>صفحة المتابعة</h3>
            <div class="row">
                <div class="col-md-6">
                    <label for="">الصورة الرئيسية</label>
                    <input type="file"  name="employee_image_lg"   class="form-control">
                    <img width="250" src="{{ !empty(Images()['employee_image_lg']) ? asset('storage/' . Images()['employee_image_lg']) : '' }}" alt="">
                    @if (!empty(Images()['employee_image_lg']))
                    <a class="btn btn-danger btn-sm" href="{{route('doctor.image.destory','employee_image_lg')}}"  onclick="return confirm('سوف تقوم بحذف الصورة')">حذف</a>

                @endif
                </div>
                <div class="col-md-6">
                    <label for="">اللوجو</label>
                    <input type="file" cla name="employee_image_sm" class="form-control">
                    <img width="250" src="{{ !empty(Images()['employee_image_sm']) ? asset('storage/' . Images()['employee_image_sm']) : '' }}" alt="">
                    @if (!empty(Images()['employee_image_sm']))
                    <a class="btn btn-danger btn-sm" href="{{route('doctor.image.destory','employee_image_sm')}}"  onclick="return confirm('سوف تقوم بحذف الصورة')">حذف</a>

                @endif
                </div>
            
            </div>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="حفظ">
    </div>
    </form>
@endsection
