<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pr-0" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" target="_blank" href="{{route('home.index')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> داشبورد </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        اکانت ها
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.razer_accounts.index')}}">
            <i class="fas fa-fw fa-user"></i>
            <span> اکانت ها </span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.payment-pins.using', ['app_type' => 1])}}">
            <i class="fas fa-fw fa-user"></i>
            <span> شارژ سریع بیگو </span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.payment-pins.using', ['app_type' => 2])}}">
            <i class="fas fa-fw fa-user"></i>
            <span> شارژ سریع لایکی </span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePins" aria-expanded="true"
           aria-controls="collapsePins">
            <i class="fas fa-fw fa-cart-plus"></i>
            <span> پین ها </span>
        </a>
        <div id="collapsePins" class="collapse
{{request()->is('admin/payment-pins*') && !request()->query('app_type') ? 'show' : ''}}
" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('admin/payment-pins') && !request()->query('app_type') ? 'active' : '' }}" href="{{ route('admin.payment-pins.index') }}">لیست پین ها</a>
                <a class="collapse-item {{ request()->is('admin/payment-pins/create') && !request()->query('type') ? 'active' : '' }}" href="{{ route('admin.payment-pins.create') }}">افزودن تکی</a>
                <a class="collapse-item {{ request()->is('admin/payment-pins/create*') && request()->query('type') === 'bulk' ? 'active' : '' }}" href="{{ route('admin.payment-pins.create', ['type' => 'bulk']) }}">افزودن گروهی</a>
                <a class="collapse-item {{ request()->is('admin/payment-pins/create*') && request()->query('type') === 'file' ? 'active' : '' }}" href="{{ route('admin.payment-pins.create', ['type' => 'file']) }}">افزودن فایل</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        کاربران
    </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true"
           aria-controls="collapseUsers">
            <i class="fas fa-fw fa-cart-plus"></i>
            <span> کاربران </span>
        </a>
        <div id="collapseUsers" class="collapse
{{request()->is('admin/users*') ? 'show' : ''}}
{{request()->is('admin/roles*') ? 'show' : ''}}
{{request()->is('admin/permissions*') ? 'show' : ''}}
" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{request()->is('admin/users*') ? 'active' : ''}}" href="{{route('admin.users.index')}}">لیست کاربران</a>
                <a class="collapse-item {{request()->is('admin/roles*') ? 'active' : ''}}" href="{{route('admin.roles.index')}}">گروه های کاربری</a>
                <a class="collapse-item {{request()->is('admin/permissions*') ? 'active' : ''}}" href="{{route('admin.permissions.index')}}">مجوزها</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.blacklist.index')}}">
            <i class="fas fa-fw fa-ban"></i>
            <span> بلک لیست </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        فروشگاه
    </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.brands.index')}}">
            <i class="fas fa-fw fa-store"></i>
            <span> برندها </span></a>
    </li>

{{--    @can('create_product')--}}
{{--    @role('product_management')--}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
               aria-expanded="true"
               aria-controls="collapseProducts">
                <i class="fas fa-fw fa-cart-plus"></i>
                <span> محصولات </span>
            </a>
            <div id="collapseProducts" class="collapse
{{request()->is('admin/products*') ? 'show' : ''}}
{{request()->is('admin/categories*') ? 'show' : ''}}
{{request()->is('admin/attributes*') ? 'show' : ''}}
{{request()->is('admin/tags*') ? 'show' : ''}}
{{request()->is('admin/comments*') ? 'show' : ''}}
" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{request()->is('admin/products*') ? 'active' : ''}}" href="{{route('admin.products.index')}}">محصولات</a>
                    <a class="collapse-item {{request()->is('admin/categories*') ? 'active' : ''}}" href="{{route('admin.categories.index')}}">دسته بندی ها</a>
                    <a class="collapse-item {{request()->is('admin/attributes*') ? 'active' : ''}}" href="{{route('admin.attributes.index')}}">ویژگی ها</a>
                    <a class="collapse-item {{request()->is('admin/tags*') ? 'active' : ''}}" href="{{route('admin.tags.index')}}">تگ ها</a>
                    <a class="collapse-item {{request()->is('admin/comments*') ? 'active' : ''}}" href="{{route('admin.comments.index')}}">نظرات</a>
                </div>
            </div>
        </li>
{{--    @endrole--}}
{{--    @endcan--}}

<!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        سفارشات
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="true"
           aria-controls="collapseOrders">
            <i class="fas fa-fw fa-folder"></i>
            <span> سفارشات </span>
        </a>
        <div id="collapseOrders" class="collapse
{{request()->is('admin/orders*') ? 'show' : ''}}
{{request()->is('admin/transactions*') ? 'show' : ''}}
{{request()->is('admin/coupons*') ? 'show' : ''}}
" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{request()->is('admin/orders*') ? 'active' : ''}}" href="{{route('admin.orders.index')}}">سفارشات</a>
                <a class="collapse-item {{request()->is('admin/transactions*') ? 'active' : ''}}" href="{{route('admin.transactions.index')}}">تراکنش ها</a>
                <a class="collapse-item {{request()->is('admin/coupons*') ? 'active' : ''}}" href="{{route('admin.coupons.index')}}">کوپن ها</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        تنظیمات
    </div>

    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.banners.index')}}">
            <i class="fas fa-fw fa-images"></i>
            <span> بنرها </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
