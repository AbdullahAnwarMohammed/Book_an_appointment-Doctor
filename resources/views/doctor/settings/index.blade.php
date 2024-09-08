@extends('doctor.layout.app')

@section('content')
    <h2> <i class="la la-cog"></i> الاعدادت </h2>
    <Hr />

    @if (Session::has('Success'))
        <div class="alert alert-success">{{ Session::get('Success') }}</div>
    @endif
    <form action="{{ route('doctor.settings.save') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col">
                        <label for="">بدء العمل</label>
        
                        <input type="text" id="start_work" value="{{ $Setting ? $Setting->start_work : '' }}" name="start_work"
                            class="form-control" placeholder="HH:MM" oninput="validateTime(this)">
                        @error('start_work')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">صباحاً ام مساءاً</label>
                        <select name="morning_or_night" class="form-control">
                            <option value="Morning" @selected($Setting && $Setting->morning_or_night == 'Morning')>صباحاً</option>
                            <option value="Night" @selected($Setting && $Setting->morning_or_night == 'Night')>مساءاً</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">العمل بواسطة</label>
                        <select name="type_work" id="type_work" class="form-control">
                            <option value="1" @selected($Setting && $Setting->type_work == 1)>عدد الزوار</option>
                            <option value="0" @selected($Setting &&  $Setting->type_work == 0)>الساعات</option>
                        </select>
        
                    </div>
        
        
                </div>
                <div class="row WorkOne">
                    <div class="col-12 ">
                        <label for="">عدد الزوار اليومي</label>
        
                        <input type="text" value="{{ $Setting ? $Setting->number_of_patients : '' }}" name="number_of_patients" class="form-control">
                    </div>
                </div>
        
                <div class="row WorkTwo d-none">
                    <div class="col-md-6 ">
                        <label for="">عدد ساعات العمل</label>
                        <input type="text" value="{{ $Setting ? $Setting->working_hours : '' }}" name="working_hours"
                            class="form-control">
                        @error('working_hours')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="">عدد الدقائق لكل مريض</label>
                        <input type="text" value="{{ $Setting ? $Setting->patient_minutes : '' }}" name="patient_minutes"
                            class="form-control">
                        @error('patient_minutes')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">ايام الاجازة</label>
                        <div>
                            <label for="saturday">السبت</label>
                            <input type="checkbox" id="saturday" @checked($Setting->break && in_array('6', $Setting->break)) name="break[]" value="6">
                            
                            <label for="sunday">الاحد</label>
                            <input type="checkbox" id="sunday" @checked($Setting->break && $Setting && in_array('0', $Setting->break)) name="break[]" value="0">
                            
                            <label for="monday">الاثنين</label>
                            <input type="checkbox" id="monday" @checked($Setting->break && $Setting && in_array('1', $Setting->break)) name="break[]" value="1">
                            
                            <label for="tuesday">الثلاثاء</label>
                            <input type="checkbox" id="tuesday" @checked($Setting->break && $Setting && in_array('2', $Setting->break)) name="break[]" value="2">
                            
                            <label for="wednesday">الاربعاء</label>
                            <input type="checkbox" id="wednesday" @checked($Setting->break && $Setting && in_array('3', $Setting->break)) name="break[]" value="3">
                            
                            <label for="thursday">الخميس</label>
                            <input type="checkbox" id="thursday" @checked($Setting->break && $Setting && in_array('4', $Setting->break)) name="break[]" value="4">
                            
                            <label for="friday">الجمعة</label>
                            <input type="checkbox" id="friday" @checked($Setting->break && $Setting && in_array('5', $Setting->break)) name="break[]" value="5">
                        </div>
                        {{-- <select multiple class="form-control">
                            <option value="6" @selected($Setting && in_array('6', $Setting->break))>السبت</option>
                            <option value="0" @selected($Setting && in_array('0', $Setting->break))>الاحد</option>
                            <option value="1" @selected($Setting && in_array('1', $Setting->break))>الاثنين</option>
                            <option value="2" @selected($Setting && in_array('2', $Setting->break))>الثلاثاء</option>
                            <option value="3" @selected($Setting && in_array('3', $Setting->break))>الاربعاء</option>
                            <option value="4" @selected($Setting && in_array('4', $Setting->break))>الخميس</option>
                            <option value="5" @selected($Setting && in_array('5', $Setting->break))>الجمعة</option>
                        </select> --}}
                        @error('break')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        
                <hr />
        
                <div class="row">
                    <div class="col">
                        <h4>تصفير البيانات الحجز اليومي</h4>
                        <label for="activate">تفعيل</label>
                        <input type="radio" id="activate" name="reset_register" @checked($Setting->reset_register == 1) value="1" title="اختر هذا الخيار لتفعيل">
                        
                        <label for="deactivate">عدم التفعيل</label>
                        <input type="radio" id="deactivate" name="reset_register"  @checked($Setting->reset_register == 0)  value="0" title="اختر هذا الخيار لعدم التفعيل">
                    </div>
                    <div class="col mb-1">
                        <label for="">عدد ارقام البطاقة</label>
                        <input type="text" name="number_cid" value="{{$Setting->cid_number}}" placeholder="عدد ارقام البطاقة" class="form-control">
                    </div>
                </div>
              
                <div class="row bg-primary   py-2">
                    <div class="col-md-6 text">
                        <label for="" class="text-white">السماح بالحجز بدءاً من</label>
                        <input type="date" class="form-control"  value="{{$Setting->start_register}}" name="start_register">
                    </div>
                    <div class="col-md-6">
                        <label for="" class="text-white">السماح بالحجز حتي تاريخ</label>
                        <input type="date" class="form-control" value="{{$Setting->end_register}}" name="end_register">
                        @error('end_register')
                            <div class="alert alert-danger fw-bold">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <label for="">القيمة الافتراضية للكشف</label>
                        <input type="text" name="default_money" value="{{$Setting->default_money}}" placeholder="القيمة الافتراضية للمطلوب" class="form-control">

                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary my-2" value="حفظ">
                </div>
            </div>
        </div>

    </form>
@endsection


@push('js')
    <script>
        function validateTime(input) {
            var value = input.value;
            // Remove any AM/PM characters
            value = value.replace(/AM|PM|am|pm/gi, '');
            input.value = value;
        }

        if ($("#type_work").val() == 1) {
            $(".WorkTwo").addClass("d-none");
            $(".WorkOne").removeClass("d-none");
        } else {
            $(".WorkOne").addClass("d-none");
            $(".WorkTwo").removeClass("d-none");

        }

        $("#type_work").on("change", function() {
            if ($(this).val() == 1) {
                $(".WorkTwo").addClass("d-none");
                $(".WorkOne").removeClass("d-none");
            }else{
                $(".WorkOne").addClass("d-none");
                $(".WorkTwo").removeClass("d-none");

            }
        });
    </script>
@endpush
