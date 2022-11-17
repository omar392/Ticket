        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">

                        <li class="menu-title">{{ __('admin.menu') }}</li>
                        <li>
                            <a href="{{ route('home') }}" class="waves-effect">
                                <i class="icon-accelerator"></i><span
                                    class="badge badge-success badge-pill float-right"></span> <span>
                                    {{ __('admin.home') }} </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('complaint.index') }}" class="waves-effect">
                                <i class="fas fa-envelope-open-text"></i><span
                                    class="badge badge-success badge-pill float-right"></span> <span>
                                    {{ __('user.complaints') }} </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.index') }}" class="waves-effect">
                                <i class="fas fa-user"></i><span
                                    class="badge badge-success badge-pill float-right"></span> <span>
                                    {{ __('user.profile') }} </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('frequently-asked-questions.index') }}" class="waves-effect">
                                <i class="fas fa-question"></i><span
                                    class="badge badge-success badge-pill float-right"></span> <span>
                                    {{ __('user.faqs') }} </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="waves-effect" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i><span
                                    class="badge badge-success badge-pill float-right"></span> <span>
                                    {{ __('admin.logout') }} </span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
                {{-- <div class="clearfix"></div> --}}

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->
