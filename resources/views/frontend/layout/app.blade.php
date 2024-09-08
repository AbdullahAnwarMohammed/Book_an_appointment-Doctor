<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>دكتور احمد حجازي</title>
    <link rel="icon" type="image/x-icon" href="/frontend/images/favicon.png">

    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" href="/frontend/css/style.css">
    @livewireStyles

    @stack('css')
</head>

<body>



    <header id="header">
        <div class="container">
            <div class="d-flex flex-row  justify-content-between align-items-center">
                
                <div class="links">

                    <a style="padding: 3px;font-size:12px;" href="{{ route('frontend.home') }}" class="btn btn-dark btn-sm"> <i
                            class="fa-solid fa-house"></i> </a>
                    <div class="dropdown d-inline">
                        <button style="padding: 3px;font-size:12px;" class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            العملاء
                        </button>
                        <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton1">
                            <li>

                                @if (!Auth::guard('patient')->check())
                                    <a href="{{ route('frontend.register.stepOne') }}"
                                        class="dropdown-item text-danger fw-bold"> فتح
                                        ملف
                                        <i class="fa-solid fa-folder-open"></i></a>
                                @endif

                                <a href="{{ route('frontend.register.stepTwo') }}"
                                    class="dropdown-item text-primary fw-bold"> حجز
                                    موعد
                                    <i class="fa-solid fa-folder-open"></i></a>


                                <a href="{{ route('patient.home') }}" class="dropdown-item text-success   fw-bold">
                                    بروفايل
                                    <i class="fa-solid fa-user"></i></a>


                            </li>

                        </ul>
                    </div>


                    @if (!Auth::guard('employee')->check() && !Auth::guard('doctor')->check())
                        <a style="padding: 3px;font-size:12px;" href="{{ route('frontend.auth.create.dashboard') }}" class="btn btn-secondary btn-sm"> تسجيل
                            الدخول </a>
                    @endif

                    @if (Auth::guard('doctor')->check())
                        <a href="{{ route('doctor.dashboard') }}" class="text-dark fw-bold">مرحباً : المدير</a>
                        <form action="{{ route('frontend.auth.logout.doctor.employee') }}" method="POST"
                            class="d-inline">
                            @csrf
                            <button style="padding: 3px;font-size:12px;" class="btn btn-danger">خروج</button>
                        </form>
                    @endif

                    @if (Auth::guard('employee')->check())
                        <a href="{{ route('employee.dashboard') }}" class="text-dark fw-bold">مرحباً :
                            {{ Auth::guard('employee')->user()->name }}</a>

                        <form action="{{ route('frontend.auth.logout.doctor.employee') }}" method="POST"
                            class="d-inline">
                            @csrf
                            <button class="btn btn-danger">خروج</button>
                        </form>
                    @endif

                    <button class="btn btn-danger fw-bold  rounded-0"> اليومي
                        {{ generalSetting()['number_of_patients'] }}</button>


                </div>

            </div>
        </div>
    </header>
    <div id="banner"
        style="background-image:url({{ !empty(Images()['front_banner_image']) ? asset('storage/' . Images()['front_banner_image']) : '' }}">
        <div class="container-fluid">

            <div class="btn-relative">



            </div>

            <div class="row contanerBanner">



          



                {{-- <div class="col-8 ">x</div>

                <div class="col-4 d-flex flex-column align-items-center justify-content-center">
                    <h3 style="height:50%;width:100%"
                        class="bg-success d-flex align-items-center justify-content-center">الدور :
                        {{ isset(patients_register_today(2)['number']) ? patients_register_today(2)['number'] : 0 }}
                    </h3>
                    <h3 style="height:50%;width:100%"
                        class="bg-warning d-flex align-items-center justify-content-center">الانتظار :
                        {{ isset(patients_register_today(3)['number']) ? patients_register_today(3)['number'] : 0 }}
                    </h3>
                </div> --}}
            </div>
        </div>
    </div>
    
    <div class="information d-flex justify-content-center py-1" style="background: #d9d9d9">
        <button class="btn btn-dark">{{ date('Y-m-d') }} <i class="fa-solid fa-calendar-days"></i></button>

        <button class="btn btn-success">الدور
            {{ isset(patients_register_today(2)['number']) ? patients_register_today(2)['number'] : 0 }} <i
                class="fa-solid fa-person"></i></button>

                @if (count(waiting_items()) > 0)
                    <select class="bg-warning" style="border:none">
                    <option value="">الانتظار</option>
                    @foreach (App\Models\Alhajz::where('status', 3)->get() as $item)
                        <option value="">{{ $item->number }}</option>
                    @endforeach
                </select>

            @endif

{{--             
        <button class="btn btn-warning">انتظار
            {{ waiting_items() ? waiting_items()->count() : 0 }} <i class="fa-solid fa-person"></i></button> --}}

       
        <button class="btn btn-primary fw-bold  rounded-0"> المتاح
            {{ generalSetting()['number_of_patients'] - count_registers_today() }}</button>
    </div>
    
    <div id="ads">
        <div class="news-ticker">
            <div class="ticker-container">

                @foreach (\App\Models\News::orderBy('position', 'asc')->where('status', 1)->get() as $item)
                    <div class="ticker-item">{{ $item->text }}</div>
                @endforeach

            </div>
        </div>
    </div>
 
    @yield('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    @livewireScripts

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $(".waiting-btn").on("click", function(e) {
                e.preventDefault();
                // Send the AJAX request
                $.ajax({
                    url: '{{ route('frontend.waiting.modal') }}', // Your route
                    type: 'POST',

                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            let data = '';
                            $.each(response.data, function(key, value) {
                                data +=
                                    `<span class="btn btn-dark m-1">${value.number}</span>`;
                            })
                            $(".modal-body-waiting").html(data)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            })
        })
    </script>
    @stack('js')


</body>

</html>
