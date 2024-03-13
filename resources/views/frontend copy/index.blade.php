
@extends('frontend.layouts.app')

@section('content')
    <style>
        .banner_section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            @if($welcome->welcome_dark_overlay_on_image == 1)
                background: linear-gradient(to right, rgba(11, 16, 51, 0.7),rgba(11, 16, 51, 0.7)) !important;
            @endif
            z-index: 0;
        }
    </style>
   <!-- banner section start-->
    <div class="banner_section" style="background-image: url({{ $welcome->welcome_image }});">
        <div class="container">
            <div class="banner_content">
                <h1 class="banner_title">{{ $welcome->welcome_title_on_image }}</h1>
                <p class="banner_text">{{ $welcome->welcome_short_title_on_image }}</p>
            </div>
        </div>
    </div>
   <style>
       a{
           text-decoration: none !important;
       }
   </style>


    <style>
        .button_list{
            display: block;
            list-style: none;
            text-align: center;
        }
        .button_list li{
            display: inline-block;
            padding: 10px 12px;
        }
        .mb-2.list-show{
            display: none;
        }

        @media all and (max-width:570px){
            .button_list li a.btn {
                font-size: 14px;
                padding: 7px 11px !important;
                display: inline-block;
                font-size: 16px !important;
            }
            .button_list li {
                margin-bottom: 0 !important;
            }
            .mb-2.list-hide {
                display: none;
            }
            .mb-2.list-show{
                display: block;
            }
        }
    </style>

   <ul class="button_list" style="padding-left: 0 !important;">
       <li class="mb-2">
           <a href="{{ route('registration') }}?register_type=guardian" class="btn btn-lg text-light bg-success px-5" style="font-size: 20px;">Hire a Tutor</a>
       </li>
       <li class="mb-2 list-hide">
           <a href="{{ route('registration') }}?register_type=tutor" class="btn btn-lg text-light bg-info px-5" style="font-size: 20px;">Tutor Registration</a>
       </li>

       <li class="mb-2">
           <a href="{{ route('login') }}" class="btn btn-lg text-light bg-primary px-5" style="font-size: 20px;">Login</a>
       </li>
       <li class="mb-2 list-show">
           <a href="{{ route('registration') }}?register_type=tutor" class="btn btn-lg text-light bg-info px-5" style="font-size: 20px;">Tutor Registration</a>
       </li>
   </ul>
    <!-- banner section end-->

   <hr class="mt-0" style="margin: 0 !important;">
    <!-- tution news start -->
    <section class="tuition pt-2">
        <div class="container">
            <div class="section_title">
                <h2 class="mb-0">All Tuition</h2>
            </div>
            <div class="row py-3 pt-2 d-flex justify-content-center">
                <div class="col-md-4">
                    <form action="{{ route('index') }}" class="d-flex justify-content-start">
                        <input type="text" name="tuition_id" class="form-control" placeholder="Job ID" style="width: 90%; border-radius: 0">
                        <button class="btn btn-outline-secondary" type="submit" style="border-radius: 0"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>

            @include('frontend.include.tuition_category')
            <div class="tuition_news">
                <div class="row">
                    @foreach ($tuitions->where('status', 1) as $tuition)
                        @include('frontend.include.tuition')
                    @endforeach
                </div>
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <a href="{{ route('tuition_list') }}" class="btn btn-lg btn-info px-5 py-3 text-light">View More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- tution news end -->




    <!-- newsletter section start -->
    <section class="newsletter">
        <div class="container">
            <h2 class="news_title">Subscribe To Our Newsletter</h2>
            <div class="newsletter_form">
                <form class="form-inline" method="POST" action="{{ route('subscribers.store') }}">
                    @csrf
                    <input type="text" name="email" placeholder="Enter your email">
                    @error('email')
                        <small class="text-danger text-left">{{ $message }}</small>
                    @enderror
                    <button type="submit" class="news_btn">Get Started</button>
                </form>
            </div>
        </div>
    </section>
    <!-- newsletter section end -->

   <div class="container py-3 pb-5 pt-5">
       <div class="row d-flex justify-content-center">

           <div class="col-xl-4 col-sm-6 mb-2">
               <div class="card-box bg-white p-4" style=" border: 1px solid #999999;">
                   <div class="row">
                       <div class="col-4">
                           <i class="fa-solid fa-briefcase widget-two-icon" style="font-size: 75px; color: #0975f9;"></i>
                       </div>
                       <div class="col-8">
                           <div class="wigdet-two-content">
                               <p class="m-0 text-uppercase font-bold font-secondary" style="text-align: right;" title="Statistics"><strong>Total Active Tuition</strong></p>
                               <h2 class="text-muted" style="text-align: right;"><span><i class="fa-solid fa-arrow-trend-up"></i></span> <strong data-plugin="counterup">{{ App\Models\Tuition::where('status','1')->count(); }}</strong></h2>
                               <p class="m-0" style="text-align: right;">In {{ App\Models\Tuition::count(); }}</p>
                           </div>
                       </div>
                   </div>

               </div>
           </div><!-- end col -->

           <div class="col-xl-4 col-sm-6 mb-2">
               <div class="card-box bg-white p-4" style=" border: 1px solid #999999;">
                   <div class="row">
                       <div class="col-4">
                           <i class="fa-solid fa-users widget-two-icon" style="font-size: 75px; color: #3e4095;"></i>
                       </div>
                       <div class="col-8">
                           <div class="wigdet-two-content">
                               <p class="m-0 text-uppercase font-bold font-secondary" style="text-align: right;" title="Statistics"><strong>Available Tutor</strong></p>
                               <h2 class="text-muted" style="text-align: right;"><span><i class="fa-solid fa-check-double"></i></span> <strong data-plugin="counterup">{{ App\Models\Tutor::where('status','1')->count(); }}</strong></h2>
                               <p class="m-0" style="text-align: right;">In {{ App\Models\Tutor::count(); }}</p>
                           </div>
                       </div>
                   </div>

               </div>
           </div><!-- end col -->

{{--           <div class="col-xl-4 col-sm-6 mb-2">--}}
{{--               <div class="card-box bg-white p-4" style=" border: 1px solid #999999;">--}}
{{--                   <div class="row">--}}
{{--                       <div class="col-4">--}}
{{--                           <i class="fa-solid fa-users widget-two-icon" style="font-size: 75px; color: #0975f9;"></i>--}}
{{--                       </div>--}}
{{--                       <div class="col-8">--}}
{{--                           <div class="wigdet-two-content">--}}
{{--                               <p class="m-0 text-uppercase font-bold font-secondary" style="text-align: right;" title="Statistics"><strong>Tuition Booked</strong></p>--}}
{{--                               <h2 class="text-muted" style="text-align: right;"><span><i class="fa-solid fa-handshake-angle"></i></span> <strong data-plugin="counterup">{{ App\Models\TuitionBook::where('status','1')->count(); }}</strong></h2>--}}
{{--                               <p class="m-0" style="text-align: right;">In {{ App\Models\Tuition::count(); }}</p>--}}
{{--                           </div>--}}
{{--                       </div>--}}
{{--                   </div>--}}

{{--               </div>--}}
{{--           </div><!-- end col -->--}}
       </div>
   </div>

    @endsection
