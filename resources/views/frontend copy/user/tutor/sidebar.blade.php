<style>
    a{
        text-decoration: none !important;
    }


</style>
@php
        $tutor = \App\Models\Tutor::where('user_id',Auth::user()->id)->first();
        $percentage = 0;
        $percentage += $tutor->experience_tuition_percentage;
        $percentage += $tutor->interested_requirement_percentage;
        $percentage += $tutor->personal_information_percentage;
        $percentage += $tutor->academic_qualification_percentage;
        $percentage += $tutor->academic_information_percentage;
@endphp
<div class="sidber_menu p-0">
    <ul class="jq-tab-menu mb-0" style="padding-left: 0px !important;">

        <li class="dashboard_title_tab {{ menu_active('home') ? 'active' : '' }}" data-tab="1"><a href="{{ route('home') }}" class="d-block">dashboard</a></li>

        @if($percentage > 70)
        <li class="dashboard_title_tab {{ menu_active('my_tuition') ? 'active' : '' }}" data-tab="2"><a href="{{ route('my_tuition') }}" class="d-block">my tuition</a> </li>
        <li class="dashboard_title_tab {{ menu_active('profile') ? 'active' : '' }}" data-tab="3"><a href="{{ route('profile') }}?type=profile"  class="d-block"> profile</a></li>
        @endif
        <li class="dashboard_title_tab " data-tab="3"><a class="menu-link "
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
</div>
