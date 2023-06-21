<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="{{ route('adminHome') }}">
            <img src="{{ $setting->logo ?? asset('assets/uploads/empty.png') }}" class="header-brand-img light-logo1"
                alt="logo">
        </a>
        <!-- LOGO -->
    </div>
    <ul class="side-menu">
        <li>
            <h3>العناصر</h3>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('adminHome') }}">
                <i class="icon icon-home side-menu__icon"></i>
                <span class="side-menu__label">الرئيسية</span>
            </a>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fa fa-images side-menu__icon"></i>
                <span class="side-menu__label">الصور المتحركة</span><i class="angle fa fa-angle-left"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{ route('sliders.index') }}" class="slide-item">مطاعم</a></li>
                <li><a href="{{ route('coffee') }}" class="slide-item">كافيهات</a></li>
            </ul>
        </li>

        <li class="slide">
            <a class="side-menu__item" href="{{ route('admins.index') }}">
                <i class="fe fe-users side-menu__icon"></i>
                <span class="side-menu__label">المشرفين</span>
            </a>

        </li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-user-minus side-menu__icon"></i>
                <span class="side-menu__label">المستخدمين</span><i class="angle fa fa-angle-left"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{ route('users.index') }}" class="slide-item">مستخدمين</a></li>
                <li><a href="{{ route('restaurantProvider') }}" class="slide-item">مقدم خدمه مطاعم </a></li>
                <li><a href="{{ route('coffeeProvider') }}" class="slide-item">مقدم خدمه كافيهات </a></li>
            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-shopping-cart side-menu__icon"></i>
                <span class="side-menu__label">{{ __('admin.categories') }}</span><i class="angle fa fa-angle-left"></i>
            </a>
            <ul class="slide-menu">

                <li><a href="{{ route('categories.index') }}" class="slide-item">{{ __('admin.categories') }}</a></li>
                <li><a href="{{ route('products.index') }}" class="slide-item">{{ __('admin.products') }}</a></li>

            </ul>
        </li>

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-shopping-cart side-menu__icon"></i>
                <span class="side-menu__label">{{ __('admin.orders') }}</span><i class="angle fa fa-angle-left"></i>
            </a>
            <ul class="slide-menu">

                <li><a href="{{ route('newOrders') }}" class="slide-item">{{ __('admin.orders') }}</a></li>

            </ul>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="fe fe-settings side-menu__icon"></i>
                <span class="side-menu__label">الاعدادات</span><i class="angle fa fa-angle-left"></i>
            </a>
            <ul class="slide-menu">

                <li><a href="{{ route('setting.about') }}" class="slide-item"> من نحن</a></li>
                <li><a href="{{ route('setting.terms') }}" class="slide-item">الشروط و الاحكام</a></li>
                <li><a href="{{ route('setting.privacy') }}" class="slide-item">الخصوصية</a></li>

            </ul>
        </li>

        {{--        <li class="slide"> --}}
        {{--            <a class="side-menu__item" href="{{route('sliders.index')}}"> --}}
        {{--                <i class="fe fe-camera side-menu__icon"></i> --}}
        {{--                <span class="side-menu__label">البانر المتحرك</span> --}}
        {{--            </a> --}}
        {{--        </li> --}}



        {{--        <li class="slide"> --}}
        {{--            <a class="side-menu__item" href="{{route('users.index')}}"> --}}
        {{--                <i class="fe fe-user-minus side-menu__icon"></i> --}}
        {{--                <span class="side-menu__label">المواقع</span> --}}
        {{--            </a> --}}
        {{--        </li> --}}



        <li class="slide">
            <a class="side-menu__item" href="{{ route('admin.logout') }}">
                <i class="icon icon-lock side-menu__icon"></i>
                <span class="side-menu__label">تسجيل الخروج</span>
            </a>
        </li>

    </ul>
</aside>
