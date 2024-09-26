<div class="col-lg-3 col-md-3 col-xs-12 pr">
    <div class="sidebar-profile sidebar-navigation">
        <section class="profile-box">
            <header class="profile-box-header-inline">
                <div class="profile-avatar user-avatar profile-img">
                    <img src="{{ asset('assets/newsite/images/man.png') }}">
                </div>
            </header>
            <?php

            use Carbon\Carbon;

            if (!blank(auth()->user()->created_at)) {
                $createdAt = auth()->user()->created_at;
                $now = Carbon::now();

                $days = $createdAt->diffInDays($now);
                $hours = $createdAt->copy()->addDays($days)->diffInHours($now);
                $minutes = $createdAt->copy()->addDays($days)->addHours($hours)->diffInMinutes($now);

//                        $humanReadableTime = "{$days} روز, {$hours} hours, and {$minutes} minutes ago";
//                        $humanReadableTime = "{$days} روز و {$hours} ساعت و {$minutes} دقیقه پیش";
                if ($minutes == 0 && $hours == 0 && $days == 0) {
                    $humanReadableTime = "لحظاتی پیش";
                } elseif ($minutes > 0 && $hours == 0 && $days == 0) {
                    $humanReadableTime = "{$minutes} دقیقه پیش";
                } elseif ($hours > 0 && $days == 0) {
                    $humanReadableTime = "{$hours} ساعت و {$minutes} دقیقه پیش";
                } else {
                    $humanReadableTime = "{$days} روز و {$hours} ساعت و {$minutes} دقیقه پیش";
                }
            }
            ?>
            <footer class="profile-box-content-footer">
                <span class="profile-box-nameuser">{{ auth()->user()->name .' '. auth()->user()->family }}</span>
                {{--                                        <span class="profile-box-registery-date">عضویت در سایت:<br>{{ $humanReadableTime }}</span>--}}
                <span class="profile-box-registery-date">تاریخ عضویت: {{ auth()->user()->created_at ? dateTimeFormat(auth()->user()->created_at) : '-' }}</span>
                <span class="profile-box-phone">شماره همراه : {{auth()->user()->cellphone}}</span>
                <div class="profile-box-tabs">
                    <form action="{{route('logout')}}" method="post" id="logout">
                        @csrf
                    <a href="" onclick="event.preventDefault(); document.getElementById('logout').submit();" class="profile-box-tab-sign-out"><i
                            class="mdi mdi-logout-variant"></i>خروج از حساب</a>
                    </form>
                </div>
            </footer>
        </section>
        <section class="profile-box">
            <ul class="profile-account-navs">
                <li class="profile-account-nav-item navigation-link-dashboard">
                    <a href="{{route('home.users_profile.index')}}" class="{{ request()->is('profile') ? 'active' : '' }}"><i class="mdi mdi-account-outline"></i>
                        پروفایل
                    </a>
                </li>
                <li class="profile-account-nav-item navigation-link-dashboard">
                    <a href="{{route('home.users_profile.orders')}}" class="{{ request()->is('profile/orders') ? 'active' : '' }}"><i class="mdi mdi-cart"></i>
                        همه سفارش ها
                    </a>
                </li>
                <li class="profile-account-nav-item navigation-link-dashboard">
                    <a href="{{route('home.addresses.index')}}" class="{{ request()->is('profile/wishlist') ? 'active' : '' }}"><i class="mdi mdi-heart"></i>
                        لیست علاقه مندی
                    </a>
                </li>
                <li class="profile-account-nav-item navigation-link-dashboard">
                    <a href="{{route('home.wishlist.users_profile.index')}}" class="{{ request()->is('profile/addresses') ? 'active' : '' }}"><i class="mdi mdi-map-outline"></i>
                        آدرس ها
                    </a>
                </li>
                <li class="profile-account-nav-item navigation-link-dashboard">
                    <a href="{{route('home.comments.users_profile.index')}}" class="{{ request()->is('profile/comments') ? 'active' : '' }}"><i class="mdi mdi-email-open-outline"></i>
                        نظرات
                    </a>
                </li>
{{--                <li class="profile-account-nav-item navigation-link-dashboard">--}}
{{--                    <a href="#" class="{{ request()->is('profile') ? 'active' : '' }}"><i class="mdi mdi-tooltip-text-outline"></i>--}}
{{--                        اطلاعات حساب--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </section>
    </div>
</div>

