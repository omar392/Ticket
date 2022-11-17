        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="{{ route('adminhome') }}" class="logo">
                    <span class="logo-light">
                        <i class="mdi mdi-camera-control"></i> {{ __('user.usersgate') }}
                    </span>
                    <span class="logo-sm">
                        <i class="mdi mdi-camera-control"></i>
                    </span>
                </a>
            </div>

            <nav class="navbar-custom">
                <ul class="navbar-right list-inline float-right mb-0">

                    <!-- language-->
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if ($localeCode == LaravelLocalization::getCurrentLocale())
                        @elseif($url = LaravelLocalization::getLocalizedURL($localeCode))
                            <li class="d-md-inline-block">
                                <a class="nav-link arrow-none waves-effect"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    @if (app()->getLocale() == 'ar')
                                        <span style="color: #111">English</span>
                                    @else
                                        <span style="color: #111">العربية</span>
                                    @endif
                                </a>
                        @endif
                    @endforeach
                    </li>

                    <!-- full screen -->
                    <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                        <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                            <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                        </a>
                    </li>

                    <!-- notification -->
                    <li class="dropdown notification-list list-inline-item">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="mdi mdi-bell-outline noti-icon"></i>
                            <span class="badge badge-pill badge-danger noti-icon-badge">*</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg px-1">
                            <!-- item-->
                            <h6 class="dropdown-item-text">
                                Notifications
                            </h6>
                            <div class="slimscroll notification-item-list">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details"><b>Your order is placed</b><span
                                            class="text-muted">Dummy text of the printing and typesetting
                                            industry.</span></p>
                                </a>

                            </div>
                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center notify-all text-primary">
                                View all <i class="fi-arrow-right"></i>
                            </a>
                        </div>
                    </li>

                    <li class="dropdown notification-list list-inline-item">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#"
                                role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('dashboard/assets_ar/images/users/user-4.jpg') }}" alt="user"
                                    class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ route('profile.index') }}"><i
                                        class="mdi mdi-account-circle"></i>{{ __('user.profile') }}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="mdi mdi-power text-danger"></i> {{ __('admin.logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                    <li class="d-none d-md-inline-block">
                    </li>
                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->
