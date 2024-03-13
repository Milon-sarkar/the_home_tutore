<div class="preloader">
    <div class="d-table">
        <div class="d-table-cell align-middle">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
</div>
<!--end preloader-->
<div class="sidebar-wrap">
    <div class="sidebar-inner">
        <div class="sidebar-close">
            <div class="sidebar-close-btn">
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="sidebar-content">
            <div class="sidebar-logo">
                <a class="logo" href="{{ route('index') }}"><img src="{{ asset('frontend/img/logo.png') }}"
                    alt="logo"></a>
            </div>
            <div class="mobile-menu"></div>
            <div class="search-form">
                <input type="text" placeholder="Search" class="form-control">
                <span><i class="fa fa-search"></i></span>
            </div>
            <div class="contact-info">
                <ul>
                    <li><i class="fa fa-envelope"></i> thtuserhelp@gmail.com
                    </li>
                    <li><i class="fa fa-phone"></i> <a href="tel:+8801601346383" class="phone-link"style="color:#fff">
                        +8801601346383
                    </a></li>
                </ul>
            </div>
            <div class="social-icon">
                <ul>
                    <li><span>Follow Us :</span></li>
                    <li><a href="https://www.facebook.com/thehometutor24/?show_switched_toast=0&show_invite_to_follow=0&show_switched_tooltip=0&show_podcast_settings=0&show_community_review_changes=0&show_community_rollback=0&show_follower_visibility_disclosure=0"
                        target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                    {{-- <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="#"><i class="fab fa-youtube"></i></a></li> --}}
                </ul>
            </div>
            <div class="header-log-reg">
                <ul>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><small>|</small></li>
                    <li><a href="{{ route('registration') }}?register_type=tutor">Register</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- start header-top-area -->
<header class="header-area">
    <div class="header-top-area">
        <div class="container">
            <div class="header-top-wrap">
                <!-- <div class="img">
                        <img src="asset('frontend/img/logo.png" alt="logo">
                    </div> -->
                <div class="t-title">
                    <h4>The Home Tutor</h4>
                </div>
            </div>
        </div>
    </div>
    <!--end header-top-area-->
    <!--start header-btm-area-->
    <div class="header-btm-area">
        <div class="container">
            <div class="main-menu-wrap">
                <!--start site logo-->
                <div class="site-logo">
                    {{-- <a class="logo" href="{{ url('index.html') }}"><img src="{{ asset('frontend/img/logo.png') }}" alt="logo"></a> --}}

                    <a class="logo" href="{{ route('index') }}"><img src="{{ asset('frontend/img/logo.png') }}"
                        alt="logo"></a>
                </div>
                <!--end site logo-->
                <!--start mainmenu-->
                <div class="main-menu-area text-right">
                    <nav class="mainmenu">
                        <ul>
                            <li>
                                <a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ route('index') }}">
                                    <span class="nav_icon"> <i class="fas fa-home"></i></span>
                                    <span>Home</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('tuition_list') ? 'active' : '' }}"
                                    href="{{ route('tuition_list') }}">
                                    <span class="nav_icon"> <i class="fas fa-briefcase"></i></span>
                                    <span>Tuition</span>
                                </a>
                            </li>
                            {{-- <li>
                                @auth
                                    @php
                                        $user = auth()->user();
                                        $tutor = $user->tutor; // Assuming there's a relationship between User and Tutor models
                                    @endphp

                                    <a class="{{ request()->is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                                        <span class="nav_icon"> <i class="fas fa-briefcase"></i></span>
                                        <span>Profile</span>
                                    </a>
                                @else
                                    <a class="{{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">
                                        <span class="nav_icon"> <i class="fas fa-briefcase"></i></span>
                                        <span>Login</span>
                                    </a>
                                @endauth
                            </li> --}}
                        @php
                            $route_check=Request::route()->getName();
                        @endphp
                            <li>
                                <a class="{{ $route_check=='profile' ? 'active' : '' }}" href="{{ auth()->check() ? route('my_tuition_post') : route('login') }}">
                                    <span class="nav_icon"> <i class="fas fa-user"></i></span>
                                    <span>Profile</span>
                                </a>
                            </li>

                            <li>
                                <a class="{{ request()->is('tutor_list') ? 'active' : '' }}"
                                    href="{{ route('tutor_list') }}">
                                    <span class="nav_icon"> <i class="fas fa-users"></i></span>
                                    <span>Tutor</span>
                                </a>
                            </li>

                            <li class="other-btn">
                                <a class="other-btn {{ request()->is(['pages/privacy-policy', 'pages/data-privacy', 'package_list', 'contact_page']) ? 'active' : '' }}"
                                    href="#">
                                    <span class="nav_icon"> <i class="fas fa-bars"></i></span>
                                    <span>Others</span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('pages', 'privacy-policy') }}">Privacy & Policy</a></li>
                                    <li><a href="{{ route('pages', 'data-privacy') }}">Data Privacy</a></li>
                                    <li><a href="{{ route('package_list') }}">Package List</a></li>
                                    <li><a href="{{ route('contact_page') }}">Contact</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--end mainmenu-->
                <!--start login registration btn-->
                <div class="header-log-reg text-right">
                    <ul>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><small>|</small></li>
                        <li><a href="registration?register_type=tutor">Register</a></li>
                    </ul>
                </div>
                <!--end login registration btn-->
                <!--start toggle button-->
                <div class="header-toggle-btn">
                    <a class="sidebar-toggle-btn">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <!--end toggle button done-->
            </div>
        </div>
    </div>
</header>
