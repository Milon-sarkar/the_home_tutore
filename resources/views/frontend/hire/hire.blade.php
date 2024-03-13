@extends('frontend.layouts.app')
@section('title')
   Hire Tutor
@endsection
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            // Show the message
            $('.alert').slideDown();

            // Hide the message after 1 minute
            setTimeout(function(){
                $('.alert').slideUp();
            }, 30000); // 60000 milliseconds = 1 minute
        });
    </script>
    {{-- <style>
        input{
            margin-bottom: 0px !important;
        }
        .select2-container{
            width: 100% !important;
        }

        .select2-container--default .select2-results > .select2-results__options {
            max-height: 110px;
        }
    </style> --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- Father registration start -->
    <section class="banner-slider-area" style="background-image:url('{{ asset('frontend/img/ft.png') }}')">
        <div class="container">
            <div class="row">
                <div class="slider-area-full owl-carousel owl-theme desktop_image">
                    @foreach ($hireBanners as $banner)
                    <a href="#">
                        <div class="silder-single silder-single-img "
                            style="background-image:url('{{ asset("storage/".$banner->image )}}')">
                        </div>
                    </a>
                    @endforeach
                    {{-- <a href="#">
                        <div class="silder-single silder-single-img "
                            style="background-image:url('{{ asset('frontend/img/banner/1.jpg') }}')">
                        </div>
                    </a>
                    <a href="#">
                        <div class="silder-single silder-single-img "
                            style="background-image:url('{{ asset('frontend/img/banner/1.jpg') }}')">
                        </div>
                    </a> --}}
                </div>
            </div>
        </div>
    </section>
    <!--end hero area-->
    <section class="contact-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>HIRE TUTOR</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Tutor Search Section -->
                <section class="mailchimpSection01 new_hire">
                    <div class="container largeContainer large">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="col-lg-12 col-md-6">
                                <h2 class="sec">আপনি কি টিউটর খুঁজছেন ?</h2>
                                <p>অনুগ্রহ করে আপনার নাম্বার দিন আমাদের প্রতিনিধি আপনার সাথে যোগাযোগ করবে</p>
                                <div class="SubsrcribeForm">
                                    <form class="yikes-easy-mc-form" action="{{Route('frontend.hire.store')}}" method="post" style="margin-top:30px;">
                                        @csrf
                                        <input type="number" name="number" placeholder="Enter Phone Number"pattern="[0-9]{10}" required>
                                        <button class="yikes-easy-mc-submit-button" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>

                    </div>
                </section>

                <!-- Video Section -->
                <div class="col-lg-6 col-md-6">
                    <div class="video-single">
                        <img src="{{ asset('frontend/img/tuitor/vd.jpg') }}" alt="video">
                        <div class="technology-video">
                            <a class="video-btn popup-youtube" href="https://www.youtube.com/watch?v=Z0A7OMkYQf8">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                        <h5 class="title"><a href="blog-detail.html">Lorem ipsum dolor sit amet consectetur</a></h5>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
