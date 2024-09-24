<div class="col-lg-3 col-md-4">
    <div class="myaccount-tab-menu nav" role="tablist">

        <a href="{{route('home.users_profile.index')}}" class="{{request()->is('profile') ? 'active' : ''}}">
            <i class="sli sli-user ml-1"></i>
            پروفایل
        </a>

        <a href="{{route('home.users_profile.orders')}}"
           class="{{request()->is('profile/orders') ? 'active' : ''}}">
            <i class="sli sli-basket ml-1"></i>
            سفارشات
        </a>

        <a href="{{route('home.addresses.index')}}" class="{{request()->is('profile/addresses') ? 'active' : ''}}">
            <i class="sli sli-map ml-1"></i>
            آدرس ها
        </a>

        <a href="{{route('home.wishlist.users_profile.index')}}"
           class="{{request()->is('profile/wishlist') ? 'active' : ''}}">
            <i class="sli sli-heart ml-1"></i>
            لیست علاقه مندی ها
        </a>

        <a href="{{route('home.comments.users_profile.index')}}"
           class="{{request()->is('profile/comments') ? 'active' : ''}}">
            <i class="sli sli-bubble ml-1"></i>
            نظرات
        </a>

        <form action="{{route('logout')}}" method="post" id="logout">
            @csrf
            <a href="" onclick="event.preventDefault(); document.getElementById('logout').submit();">
                <i class="sli sli-logout ml-1"></i>خروج</a>
        </form>

    </div>
</div>
