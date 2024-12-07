<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="{{route('adminHome')}}">
            <img src="{{isset($setting) ? asset($setting->logo) : asset('assets/uploads/log.gif')}}"
                 class="header-brand-img light-logo1" alt="logo">
        </a>
        <!-- LOGO -->
    </div>
{{--    i made a helper function to check if user has permission or not and i test in admin  --}}
    <ul class="side-menu">
        @if(ifHasPermissions('view_home'))
            <li><h3>العناصر</h3></li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route('adminHome') }}">
                    <i class="fa fa-home side-menu__icon"></i>
                    <span class="side-menu__label">الرئيسية</span>
                </a>
            </li>
        @endif





        @if(ifHasPermissions('view_admin'))
        <li class="slide">
            <a class="side-menu__item" href="{{route('admins.index')}}">
                <i class="fa fa-users side-menu__icon"></i>
                <span class="side-menu__label">المشرفين</span>
            </a>
        </li>
        @endif

        @if(ifHasPermissions('view_category'))

        <li class="slide">
            <a class="side-menu__item" href="{{route('admins.index')}}">
                <i class="fa fa-users side-menu__icon"></i>
                <span class="side-menu__label">التصنيفات</span>
            </a>
        </li>
        @endif



        @if(ifHasPermissions('view_role'))
        <li class="slide">
            <a class="side-menu__item" href="{{route('roles.index')}}">
                <i class="fa fa-users side-menu__icon"></i>
                <span class="side-menu__label">role</span>
            </a>
        </li>
        @endif



        @if(ifHasPermissions('view_home'))
        <li class="slide">
            <a class="side-menu__item" href="{{route('admins.index')}}">
                <i class="fa fa-wrench side-menu__icon"></i>
                <span class="side-menu__label">الاعدادات</span>
            </a>
        </li>
        @endif

        <li class="slide">
            <a class="side-menu__item" href="{{route('admin.logout')}}">
                <i class="fa fa-lock side-menu__icon"></i>
                <span class="side-menu__label">تسجيل الخروج</span>
            </a>
        </li>

    </ul>
</aside>

