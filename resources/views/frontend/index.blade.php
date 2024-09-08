@extends('frontend.layout.app')
@push('css')
    <style>
        .img-thumbnail {
            max-width: 65%;
        }
    </style>
@endpush
@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
            

                <div class="col-12 text-center">
                    <h2>محتويات الموقع</h2>
                </div>


                <div class="col-12">
                    @if (Session::has('Success'))
                        <div class="alert alert-success fw-bold text-center">{{ Session::get('Success') }}</div>
                    @endif
                </div>

                
                <div class="col-12 text-center my-2">
                    <img class="img-thumbnail" src="{{!empty(Images()['front_image_one']) ? asset('storage/'.Images()['front_image_one']) : ''}}" alt="">
                    <img class="img-thumbnail" src="{{!empty(Images()['front_image_two']) ? asset('storage/'.Images()['front_image_two']) : ''}}" alt="">
                </div>
                
             

                
            </div>
        </div>
       
    </div>
@endsection
