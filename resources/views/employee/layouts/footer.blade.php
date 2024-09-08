<div class="navbar-bottom">
    <div>
        <a href="{{route("employee.dashboard")}}" class="home {{Route::is('employee.dashboard') ? 'active' : ''}}">
            الرئيسية
        </a>
        @if (Auth::guard('doctor')->check())
        <a href="{{route('employee.dashboard.customers')}}" class="home {{Route::is('employee.dashboard.customers') ? 'active' : ''}}">
            العملاء
        </a>
        @endif
        @if (Auth::guard('employee')->check())
        <a target="_blank" href="{{route('frontend.register.stepTwo')}}" class="home">
            حجز موعد
        </a>
        @endif
    </div>
</div>
</div>
<script src="/backend/employee/assets/js/jquery.min.js"></script>
<script src="/backend/employee/assets/js/bootstrap.bundle.min.js"></script>
<script src="/backend/employee/assets/js/sweetalert2.min.js"></script>
<script src="/backend/employee/assets/js/jquery.dataTables.min.js"></script>
<script src="/backend/employee/assets/js/select2.min.js"></script> <!-- <script src="/backend/employee/assets/js/main/ajax.js"></script> -->
<script src="/backend/employee/assets/js/script2.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

 
</script>
@stack('js')
</body>

</html>
