@php
    $percentage = 0;
    $percentage += $tutor->experience_tuition_percentage;
    $percentage += $tutor->interested_requirement_percentage;
    $percentage += $tutor->personal_information_percentage;
    $percentage += $tutor->academic_qualification_percentage;
    $percentage += $tutor->academic_information_percentage;
@endphp
{{--<p class="alert--}}
{{--<?php--}}
{{--    if($percentage < 20)--}}
{{--        echo ('alert-danger');--}}
{{--    elseif ($percentage < 40)--}}
{{--        echo ('alert-warning');--}}
{{--    elseif ($percentage < 60)--}}
{{--        echo ('alert-warning');--}}
{{--    elseif ($percentage < 80)--}}
{{--        echo ('alert-info');--}}
{{--    elseif ($percentage > 80)--}}
{{--        echo ('alert-success');--}}
{{--    else--}}
{{--        echo('alert-secondary');--}}
{{-- ?>--}}
{{--    ">{{ $percentage }}% profile completed.</p>--}}
<style>
    .second_nav>li{
        padding: 10px;
        background-color: #ffffff;
        line-height: 50px !important;
    }
    .active_sub {
        background-color: #b9b9b9 !important;
    }
    .active_sub a {
        color: #ffffff !important;
    }
</style>
<ul class="list-unstyled list-inline second_nav">
    <li class="mb-1 {{ menu_active('profile') && request()->get('type') == 'profile' ? 'active_sub' : '' }}"><a href="{{ route('profile') }}?type=profile">Profile</a></li>
    <li class="mb-1 {{ menu_active('profile') && request()->get('type') == 'academic_information' ? 'active_sub' : '' }}"><a href="{{ route('profile') }}?type=academic_information">Academic Information</a></li>
    <li class="mb-1 {{ menu_active('profile') && request()->get('type') == 'academic_qualification' ? 'active_sub' : '' }}"><a href="{{ route('profile') }}?type=academic_qualification">Academic Qualification</a></li>
    <li class="mb-1 {{ menu_active('profile') && request()->get('type') == 'personal_information' ? 'active_sub' : '' }}"><a href="{{ route('profile') }}?type=personal_information">Personal Information</a></li>
    <li class="mb-1 {{ menu_active('profile') && request()->get('type') == 'interested_requirement' ? 'active_sub' : '' }}"><a href="{{ route('profile') }}?type=interested_requirement">Interested Requirement</a></li>
    <li class="mb-1 {{ menu_active('profile') && request()->get('type') == 'tuition_experience' ? 'active_sub' : '' }}"><a href="{{ route('profile') }}?type=tuition_experience">Tuition Experience</a></li>
</ul>
