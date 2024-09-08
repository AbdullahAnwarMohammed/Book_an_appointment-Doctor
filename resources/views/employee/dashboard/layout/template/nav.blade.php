<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{Request::is('employee') ? 'active' : ''}}"><a href="{{ route('employee.dashboard') }}"><i class="la la-home"></i><span class="menu-title"
                        data-i18n="Dashboard Hospital">الصفحة الرئيسية</span></a>
            </li>

     


            <li class="nav-item has-sub"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="Templates">الحجوزات</span></a>
                <ul class="menu-content">
                    <ul class="menu-content">
                      <li><a class="menu-item" href="{{route('employee.register.today')}}"><i></i><span data-i18n="Classic Menu">حجوزات اليوم</span></a>
                      </li>
                      <li><a class="menu-item" href="{{route('employee.register.all')}}"><i></i><span data-i18n="Classic Menu">جميع الحجوزات</span></a>
                      </li>

                    </ul>
                  </li>
                 
                </ul>
              </li>

        </ul>
    </div>
</div>
