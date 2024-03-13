@extends('frontend.layouts.app')
@section('content')
    <!-- user dashboard start -->
    <div class="dashboard_wrapper" id="myTab3">
        <div class="container">
            {{-- <div class="row">
                <div class="col-md-3">
                    <div class="sidber_menu"> --}}
            {{--                        <ul class="jq-tab-menu"> --}}
            {{--                            <li class="dashboard_title_tab " data-tab="1"><a href="{{ route('home') }}">dashboard</a> --}}
            {{--                            </li> --}}
            {{--                            <li class="dashboard_title_tab active" data-tab="2"><a --}}
            {{--                                    href="{{ route('my_tuition_post') }}">My Tuition Post</a> </li> --}}
            {{--                            <li class="dashboard_title_tab" data-tab="3"><a href="{{ route('my_apply') }}">my --}}
            {{--                                    Apply List</a> </li> --}}
            {{--                            <li class="dashboard_title_tab" data-tab="4"><a href="{{ route('student_profile',Auth::user()->id) }}">manage profile</a></li> --}}

            {{--                            <li class="dashboard_title_tab" data-tab="3"><a href="{{ route('student_pasword_change',Auth::user()->id) }}">Password Change</a></li> --}}

            {{--                            <li class="dashboard_title_tab" data-tab="5"><a class="menu-link " --}}
            {{--                                    href="{{ route('logout') }}" --}}
            {{--                                    onclick="event.preventDefault(); --}}
            {{--                                document.getElementById('logout-form').submit();"> --}}
            {{--                                    <i class="icon-user"></i>{{ __('Logout') }}</a> --}}
            {{--                                <form id="logout-form" action="{{ route('logout') }}" method="POST" --}}
            {{--                                    style="display: none;"> --}}
            {{--                                    @csrf --}}
            {{--                                </form> --}}
            {{--                            </li> --}}
            {{--                        </ul> --}}
            {{-- @include('frontend.user.student.sidebar')
                    </div>
                </div> --}}
            <section class="profile-area section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="profile-content">
                                <div class="profile-top">
                                    <div class="img">
                                        <a href="{{ route('student_profile', Auth::user()->id) }}"><img
                                                src="{{ Auth::user()->image }}" alt="img"></a>
                                        <span class="id_number">ID:{{ Auth::user()->id }}</span>
                                    </div>

                                    <div class="name-des">
                                        <ul>
                                            <li><span>Name:</span>{{ Auth::user()->name }}</li>
                                            <li><span>Number:</span> {{ Auth::user()->phone }}</li>
                                            <li><span>Veryfide:</span>Yes</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="profile-button">
                                    <ul>
                                        <li><a href="{{ route('my_apply') }}">Applied Tution </a></li>
                                        <li><a href="#">Beverified Tutor</a></li>
                                        <li><a href="{{ route('my_tuition_post') }}">continue tution</a></li>
                                        <li><a href="#">earn money</a></li>
                                        <li><a href="#">payment</a></li>
                                        <li><a href="#">Review home tutor</a></li>
                                        <li><a href="#">notification</a></li>
                                        <li><a href="#">share</a></li>
                                        <li><a href="{{ route('student_profile', Auth::user()->id) }}">update
                                                profile</a></li>
                                        <li><a href="#">setting</a></li>
                                        <li><a href="#">Applied Tution prefer area</a></li>
                                        <li><a href="{{route('tuition_delete',Auth::user()->id)}}">Remove Account</a></li>
                                        <li><a href="{{ route('logout') }}"
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    </div>
    <div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="updateProfileModalLabel"
    aria-hidden="true">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="updateProfileModalLabel">Update Profile and Verify</h5>
                       <button onclick="closeModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <p class="verify">Please update your profile and verify your account.</p>
                   </div>
                   <div class="modal-footer">
                       <button type="button" onclick="closeModal()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                       <!-- You can add buttons here for actions related to updating profile and verification -->
                   </div>
               </div>
           </div>
       </div>
    <!-- user dashboard end -->
   

@endsection
@push('footer_js')

<script>
    $(document).ready(function() {
        console.log('Document ready function executed');
        var needUpdateProfile = true; 
        var isVerified = true; 
        if (needUpdateProfile && isVerified) {
            $('#updateProfileModal').modal('show');
        }
    });

    function closeModal(){
        $('#updateProfileModal').modal('hide');
    }

</script>
    
@endpush
