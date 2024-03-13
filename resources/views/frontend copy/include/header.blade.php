{{-- <nav class="navbar main_header navbar-expand-lg" uk-sticky="start: 200; animation: uk-animation-slide-top" style="box-shadow: 0 0 20px 0 #e1dcdc;">
    <div class="container align-items-center">
      <a class="navbar-brand logo" href="{{ route('index') }}"> <img style="width: 50px;height:50px" class="" src="{{ get_settings('logo') ?? 'The Home Tutor' }}" alt="logo"></a>


      <div class="main_menu collapse navbar-collapse" id="navbar_toggle">
        <ul class="navbar-nav m-auto my-2 my-lg-0">
           <li>
               <a href="{{ route('index') }}" class="{{ \Route::currentRouteName() == 'index'?'active':''}} text-center">
                   <i class="fa fa-home-alt text-center"></i>
                   <p class="mb-0">Home</p>
               </a>
           </li>
           <li style="margin-left: 25px;">
               <a href="{{ route('tutor_list') }}" class="{{ \Route::currentRouteName() == 'tutor_list'?'active':''}} text-center">
                   <i class="fa fa-users text-center"></i>
                   <p class="mb-0">Tutors</p>
               </a>
           </li>
           <li style="margin-left: 25px;">
               <a href="{{ route('tuition_list') }}" class="{{ \Route::currentRouteName() == 'tuition_list'?'active':''}} text-center">
                   <i class="fa fa-briefcase text-center"></i>
                   <p class="mb-0">Tuitions</p>
               </a>
           </li>
             @php
              $page = App\Models\Page::where('title', 'Like',"%about us%")->first();
            @endphp
           <li style="margin-left: 25px;">
               <a href="#" style="position: absolute; bottom: 15%;" class="dropleft"><i class="fa-solid fa-bars" style="font-size: 35px;"></i></a>
                <ul>
                  @php
                  $pages = App\Models\Page::get();
                  @endphp

                  @forelse ($pages as $page)
                  <li><a href="{{ route('pages',$page->slug) }}">{{ $page->title }}</a></li>
                  @empty

                  @endforelse
                  <li><a href="{{ route('package_list') }}">Package List</a></li>
{{--                    <li><a href="{{ $page? route('pages',$page->slug):''  }}" class="">About</a></li>--}}
                    <li><a href="{{ route('contact_page') }}"  class="">Contact</a></li>

                </ul>
           </li>
        </ul>
        <div class="">
           <div class="apply">

            @guest
            <a href="{{ route('registration') }}" style="border-radius: 50px 0 0 50px; padding-left: 30px; padding-right: 17px;" class="apply_btn">Register</a>
            <a href="{{ route('login') }}" class="apply_btn" style="border-radius: 0 50px 50px 0; padding-left: 23px; padding-right: 30px;" >Login</a>
            @else
            <div class="account">
            <a href="{{ route('home') }}"><i class="fa-regular fa-user"></i></a>
          </div>
            @endguest
           </div>
        </div>
      </div>
        <style>
            .uk-offcanvas-bar{
                background: #3e4095 !important;
            }
            .list-inline> li{
                display: inline !important;
            }
        </style>



        <ul class="m-0 list-unstyled list-inline d-lg-none align-items-center">
            <li>
                <a href="{{ route('tutor_list') }}" class="btn px-1">
{{--                    <i class="fa fa-users"></i>--}}
                    <p class="mb-0">Tutors</p>
                </a>
                <a href="{{ route('tuition_list') }}" class="btn px-1">
{{--                    <i class="fa fa-briefcase"></i>--}}
                    <p class="mb-0">Tuitions</p>
                </a>

                @guest
{{--                    <a href="{{ route('login') }}" class="btn px-2">Login</a>--}}
                    <a href="{{ route('registration') }}" class="btn px-1">

{{--                        <i class="fa fa-user"></i>--}}
                        <p class="mb-0">Profile</p>
                    </a>
                @else
                    <a href="{{ route('home') }}" class="text-muted btn px-1">
{{--                        <i class="fa fa-user"></i>--}}
                        <p class="mb-0">Profile</p>
                    </a>
                @endguest
            </li>
            <li>
                <i class="fa-solid fa-bars mdi-cursor-pointer mr-3" style="font-size: 25px; cursor: pointer; vertical-align: middle;" uk-toggle="target: #offcanvas-nav"></i>
            </li>
        </ul>



        <div id="offcanvas-nav" uk-offcanvas="overlay: true">
            <div class="uk-offcanvas-bar p-0">
                <img src="img/home_tutor.jpg" alt="">
                <ul class="uk-nav uk-nav-default p-3">
                    <li class="mb-2">
                        <a href="{{ route('index') }}" style="font-size: 20px;" class="{{ \Route::currentRouteName() == 'index'?'active':''}} text-center">
                            <i class="fa fa-home-alt text-center"></i>
                            <p class="mb-0">Home</p>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('tutor_list') }}" style="font-size: 20px;" class="{{ \Route::currentRouteName() == 'tutor_list'?'active':''}} text-center">
                            <i class="fa fa-users text-center"></i>
                            <p class="mb-0">Tutors</p>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('tuition_list') }}" style="font-size: 20px;" class="{{ \Route::currentRouteName() == 'tuition_list'?'active':''}} text-center">
                            <i class="fa fa-briefcase text-center"></i>
                            <p class="mb-0">Tuitions</p>
                        </a>
                    </li>
                    @php
                        $page = App\Models\Page::where('title', 'Like',"%about us%")->first();
                    @endphp
                    @php
                        $pages = App\Models\Page::get();
                    @endphp

                    @forelse ($pages as $page)
                        <li class="mb-2"><a href="{{ route('pages',$page->slug) }}" style="font-size: 20px;">{{ $page->title }}</a></li>
                    @empty

                    @endforelse
                    <li class="mb-2">
                        <a href="{{ route('package_list') }}" style="font-size: 20px;">
                            <i class="fa fa-boxes-packing text-center"></i>
                            <p class="mb-0">Pricing</p>
                        </a>
                    </li>
                    {{--                    <li class="mb-2"><a href="{{ $page? route('pages',$page->slug):''  }}" class="">About</a></li>--}}
                    <li class="mb-2">
                        <a href="{{ route('contact_page') }}" style="font-size: 20px;"  class="">
                            <i class="fa fa-contact-card text-center"></i>
                            <p class="mb-0">Contact</p>
                        </a>
                    </li>

                </ul>

            </div>
        </div>



    </div>
</nav> --}}
    <!--start header-btm-area-->
    <div class="header-btm-area">
        <div class="container">
            <div class="main-menu-wrap">
                <!--start site logo-->
                <div class="site-logo">
                    <a class="logo" href="index.html"><img src="assets/img/logo.png" alt="logo"></a>
                </div>
                <!--end site logo-->
                <!--start mainmenu-->
                <div class="main-menu-area text-right">
                    <nav class="mainmenu">
                        <ul>
                            <li>
                                <a class="active" href="index.html">
                                    <span class="nav_icon"> <i class="fas fa-home"></i></span>
                                    <span>home</span>
                                </a> 
                            </li>
                            <li>
                                <a href="tuitor.html">
                                    <span class="nav_icon"> <i class="fas fa-users"></i></span>
                                    <span>Tuitor</span>
                                </a>
                            </li>
                            <li>
                                 <a href="tuition.html">
                                    <span class="nav_icon"> <i class="fas fa-briefcase"></i></span>
                                    <span>Tuition</span>
                                </a>
                            </li>
                           <li class="other-btn">
                                <a href="#">
                                    <span class="nav_icon"> <i class="fas fa-bars"></i></span>
                                    <span>Others</span>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="policy.html">Privacy & Policy</a></li>
                                    <li><a href="policy.html">Data Privacy</a></li>
                                    <li><a href="policy.html">Package List</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--end mainmenu-->
                <!--start login registration btn-->
                <div class="header-log-reg text-right">
                    <ul>
                        <li><a href="login.html">Login</a></li>
                        <li><small>|</small></li>
                        <li><a href="registration.html">Register</a></li>
                    </ul>
                </div>
                <!--end login registration btn-->
                <!--start toggle button-->
                <div class="header-toggle-btn">
                    <a class="sidebar-toggle-btn">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <!--end toggle button-->
            </div>
        </div>
    </div>
</header>
<!--end header-->
