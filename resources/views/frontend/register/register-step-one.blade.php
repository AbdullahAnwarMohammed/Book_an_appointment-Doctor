@extends('frontend.layout.app')
@push('css')
    <style>
        .position-relative {
    position: relative;
}

.placeholder {
    position: absolute;
    top: 50%;
    right: 61px;
    transform: translateY(-50%);
    pointer-events: none;
    color: #6c757d;
    font-size: 14px;
    transition: 0.2s;
}

input:focus ~ .placeholder,
input:not(:placeholder-shown) ~ .placeholder {
    opacity: 1;
}
    </style>
@endpush
@section('content')
    <div id="content"  class=" d-flex align-items-center my-4">
        <div class="container ">
            <h2><i class="fa-solid fa-folder-open"></i> فتح ملف  </h2>

            <div class="d-flex align-items-center justify-content-center gap-2 my-2">
                <span class="d-block rounded-2" style="background: #ffdbb6;width:30px;height:30px;padding:4px"></span>آجباري

            </div>
            @if (Session::has('Success'))
                <div class="alert alert-success">{{ Session::get('Success') }}</div>
            @endif

          
                @livewire('frontend.step-one-form')
        </div>
    </div>
@endsection


@push('js')
<script>
      $('input[data-input="required"],select[data-input="required"]').each(function() {
        $(this).css('background-color', '#ffdbb6');
    });
</script>
@endpush
