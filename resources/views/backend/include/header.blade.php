<div class="topbar">
    <style>
        .topbar .topbar-left {
            background: #fff;
        }
    </style>
    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{ route('home') }}" class="logo">
                    <span>
                        <img src="{{ asset('backend/images/logo.png') }}" alt="" height="50" style="width: 150px;">
                    </span>
            <i>
                <img src="{{ asset('backend/images/logo_sm.png') }}" alt="" height="28">
            </i>
        </a>
    </div>

    <nav class="navbar-custom">
        <ul class="float-right mb-0">

            <li class="list-inline-item notification-list">
                <a class="nav-link waves-effect waves-light nav-user" target="_blank" href="https://www.facebook.com/profile.php?id=100057324794784">
                    <img src="{{ asset('img/facebok.png') }}" alt="user" class="rounded-circle">
                </a>
            </li>
            <li class="list-inline-item notification-list">
                <a class="nav-link waves-effect waves-light nav-user" target="_blank" href="https://business.facebook.com/latest/inbox/all?asset_id=102206974506144&bpn_id=506645696548401&nav_ref=redirect_biz_inbox">
                    <img src="{{ asset('img/messenger.png') }}" alt="user" class="rounded-circle">
                </a>
            </li>

            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <span class="badge bg-dark text-lowercase"><i>
                            @if(auth()->user()->user_type == 'admin')
                                @foreach(auth()->user()->getRoleNames() as $role_name)
                                    {{ $role_name }}
                                @endforeach
                            @else
                                {{ $user->user_type }}
                            @endif
                        </i></span>
                    <img src="{{ user_img(auth()->user()['avatar'] ?? '') }}" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="text-overflow"><small>{{ Auth::user()->name }}</small> </h5>
                    </div>

                    <!-- item-->
                    <a href="{{ route('users.show', Auth::user()->id) }}" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-circle"></i> <span>Profile</span>
                    </a>

                    <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-power"></i> <span>Logout</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="dripicons-menu"></i>
                </button>
                <script>
                    $(function(){
                        let open_left = document.querySelector('.open-left');

                        open_left.addEventListener('toggle', function () {
                            // alert('Mouse Clicked');
                        });

                        let clickEvent = new Event('toggle');
                        open_left.dispatchEvent(clickEvent);
                    })

                </script>
            </li>
            <li class="hide-phone app-search" style="display: none;">
                <form role="search" class="">
                    <input type="text" placeholder="Search..." class="form-control">
                    <a href=""><i class="fa fa-search"></i></a>
                </form>
            </li>
        </ul>

    </nav>

</div>
