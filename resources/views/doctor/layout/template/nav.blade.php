<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ Request::is('doctor') ? 'active' : '' }}"><a href="{{ route('doctor.dashboard') }}"><i
                        class="la la-home"></i><span class="menu-title" data-i18n="Dashboard Hospital">الصفحة
                        الرئيسية</span></a>
            </li>

            <li class="{{ Request::is('doctor/employees/*') || Request::is('doctor/employees') ? 'active' : '' }}">
                <a href="{{ route('doctor.employees.index') }}">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="Dashboard Hospital">المستخدمون</span>
                </a>
            </li>


            <li class="{{ Request::is('doctor/settings') ? 'active' : '' }}">
                <a href="{{ route('doctor.settings') }}"><i class="la la-cog"></i>
                    <span class="menu-title" data-i18n="Dashboard Hospital">الاعدادت</span>
                </a>
            </li>

            <li class="{{ Request::is('doctor/reasons/*') || Request::is('doctor/reasons') ? 'active' : '' }}">
                <a href="{{ route('doctor.reasons.index') }}"><i class="la la-dashboard"></i>
                    <span class="menu-title" data-i18n="Dashboard Hospital">اسباب الحجز</span>
                </a>
            </li>


            </li>

            <li class="{{ Request::is('doctor/news/*') || Request::is('doctor/news') ? 'active' : '' }}">
                <a href="{{ route('doctor.news.index') }}">
                    <i class="la la-newspaper-o"></i>
                    <span class="menu-title" data-i18n="Dashboard Hospital">شريط الاخبار</span>
                </a>
            </li>


            <li class="{{ Request::is('doctor/upload/*')  ? 'active' : '' }}">
                <a href="{{ route('doctor.upload.image') }}">
                    <i class="la la-cloud-upload"></i>
                    <span class="menu-title" data-i18n="Dashboard Hospital">رفع الصور</span>
                </a>
            </li>


            <li class="{{ Request::is('doctor/export')  ? 'active' : '' }}">
                <a href="{{ route('doctor.export') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="Dashboard Hospital">قاعدة البيانات</span>
                </a>
            </li>



            <li class="">
                <a href="{{ route('frontend.home') }}" target="_blank">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="Dashboard Hospital">معاينة الرئيسية</span>
                </a>
            </li>

            <li class="">
                <a href="{{ route('employee.dashboard') }}" target="_blank">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="Dashboard Hospital">المتابعة</span>
                </a>
            </li>







        </ul>
    </div>
</div>
