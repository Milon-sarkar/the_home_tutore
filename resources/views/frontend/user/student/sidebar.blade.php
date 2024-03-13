<ul class="jq-tab-menu" style="padding-left: 0px;">
{{--    <li class="dashboard_title_tab py-0 " data-tab="1"><a class="d-block py-2" href="{{ route('home') }}" style="text-decoration: none;">dashboard</a></li>--}}
    <li class="dashboard_title_tab py-0" data-tab="2"><a class="d-block py-2" href="{{ route('my_tuition_post') }}" style="text-decoration: none;">My Tuition Post</a> </li>
    <li class="dashboard_title_tab py-0 " data-tab="2"><a class="d-block py-2" href="{{ route('my_apply') }}" style="text-decoration: none;">my Apply List</a> </li>
    <li class="dashboard_title_tab py-0" data-tab="4"><a class="d-block py-2" href="{{ route('student_profile',Auth::user()->id) }}" style="text-decoration: none;">manage profile</a></li>
    <li class="dashboard_title_tab py-0" data-tab="4"><a class="d-block py-2" href="{{ route('opinion',Auth::user()->id) }}" style="text-decoration: none;">Guardian Opinion</a></li>
    <li class="dashboard_title_tab py-0 " data-tab="3"><a class="menu-link d-block py-2" style="text-decoration: none;"
                                                     href="{{ route('logout') }}"
                                                     onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
            <i class="icon-user"></i>{{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST"
              style="display: none;">
            @csrf
        </form>
    </li>
</ul>
