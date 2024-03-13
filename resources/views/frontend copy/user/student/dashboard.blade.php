@extends('frontend.layouts.app')
@section('content')
    <!-- user dashboard start -->
    <div class="dashboard_wrapper" id="myTab3">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidber_menu">
                        @include('frontend.user.student.sidebar')
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="content_wrapper">
                        <div class="tab_content active" data-tab="1">
                            <h2>Welcome to the {{ Auth::user()->user_type }} dashboard.</h2>
                          <p> You will find your account settings, password change, transactions in your dashboard here. <br> Thanks for staying with us

                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>


      </div>
    <!-- user dashboard end -->

        <script type="text/javascript">
            window.addEventListener("scroll", function(){
                var header = document.querySelector("nav");
                header.classList.toggle("sticky", window.scrollY > 0);
            })
        </script>
@endsection
