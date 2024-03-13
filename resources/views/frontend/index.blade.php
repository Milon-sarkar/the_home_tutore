@extends('frontend.layouts.app')
@section('content')
    <!--hero area-->
    <section class="banner-slider-area" style="background-image:url('{{ asset('frontend/img/ft.png') }}')">
        <div class="container">
            <div class="row">
                <div class="slider-area-full owl-carousel owl-theme desktop_image" items="1">

                    @foreach ($banners as $banner)
                        <a href="#">
                            <div class="silder-single silder-single-img "
                                style="background-image:url('{{ asset('storage/' . $banner->image) }}')">
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!--end hero area-->
    <!-- button section -->
    <section class="button-area gradient-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6">
                    <div class="add-button">
                        <a href="{{ route('frontend.hire.hire') }}">Hire a Tutor</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6">
                    <div class="add-button">
                        <a href="{{ route('registration') }}?register_type=tutor">Tutor Registration</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="add-button add-button2">
                        <a href="{{ route('login') }}">login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="all-tuition-area section-padding">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="search-form widget">
                        <form action="{{ route('index') }}">
                            <input type="text" name="tuition_id" placeholder="Search Your JOB ID" class="form-control">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Select Your Tuition Category</h2>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="button-list">
                        <ul class="button-list-nav">
                            <div class="destop-menu">
                                <li>
                                    <a href="{{ route('tuition_list') }}"
                                        class="btn btn-sm {{ request()->get('tuition_category') == false ? 'btn-success' : 'btn-secondary' }}"
                                        style="border-radius: 30px; text-decoration: none;">All Tution</a>
                                </li>

                                @foreach (\App\Models\TuitionCategory::get() as $tuition_category)
                                    <li class="pr-2">
                                        <a href="{{ route('tuition_list', ['tuition_category' => $tuition_category->name]) }}"
                                            class="btn btn-sm {{ request()->get('tuition_category') == $tuition_category->name ? 'btn-success' : 'btn-secondary' }}"
                                            style="border-radius: 30px; text-decoration: none;">{{ str_replace('Tuition', 'Tution', $tuition_category->name) }}</a>
                                    </li>
                                @endforeach
                            </div>
                            <div class="d-none" id="mobile-menu" items="2" style="text-align: center">

                                <li>
                                    <a href="{{ route('tuition_list') }}"
                                        class="btn btn-sm {{ request()->get('tuition_category') == false ? 'btn-success' : 'btn-secondary' }}"
                                        style="border-radius: 30px; text-decoration: none;">All Tution</a>
                                </li>
                                @foreach (\App\Models\TuitionCategory::get() as $tuition_category)
                                    <li class="responsive_load pr-2">
                                        <a href="{{ route('tuition_list', ['tuition_category' => $tuition_category->name]) }}"
                                            class="btn btn-sm {{ request()->get('tuition_category') == $tuition_category->name ? 'btn-success' : 'btn-secondary' }}"
                                            style="border-radius: 30px; text-decoration: none;">{{ str_replace('Tuition', 'Tution', $tuition_category->name) }}</a>
                                    </li>
                                @endforeach
                                {{-- </div>
                            <div class="owl-carousel owl-theme d-none" id="mobile" items="2">
                                <li>
                                    <a href="{{ route('tuition_list') }}"
                                        class="btn btn-sm {{ request()->get('tuition_category') == false ? 'btn-success' : 'btn-secondary' }}"
                                        style="border-radius: 30px; text-decoration: none;">All Tution</a>
                                </li>
                                @foreach (\App\Models\TuitionCategory::get()->reverse() as $tuition_category)
                                    <li class="pr-2">
                                        <a href="{{ route('tuition_list', ['tuition_category' => $tuition_category->name]) }}"
                                            class="btn btn-sm {{ request()->get('tuition_category') == $tuition_category->name ? 'btn-success' : 'btn-secondary' }}"
                                            style="border-radius: 30px; text-decoration: none;">{{ str_replace('Tuition', 'Tution', $tuition_category->name) }}</a>
                                    </li>
                                @endforeach
                            </div> --}}
                                <div class="justify-content-center align-items-center">
                                    <button class="view btn btn-lg px-5 py-1 text-light mt-3" onclick="loadMoredata(event)">View
                                        More</button>
                                </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="phone-view">
                <div class="row pt-40">

                    @foreach ($tuitions->where('status', 1) as $tuition)
                        {{-- @dd($tuition) --}}
                        <div class="col-lg-4 col-md-6">
                            <div class="tuition-box my-5">
                                <div class="t-top">
                                    <span>JOB ID: {{ $tuition->job_id ?? '' }}</span>
                                    {{-- <div class="job_id d-flex flex-column align-items-center">
                                    <p class="text-nowrap text-light m-0">JOB ID: {{ $tuition->job_id ?? '' }}</p>

                                </div> --}}
                                    <span>{{ $tuition->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="box-title">
                                    <h5>{{ $tuition->name }}</h5>
                                </div>
                                <div class="loctin">
                                    <h6><span class="icon"><i
                                                class="fas fa-map-marker-alt"></i></span>{{ $tuition->area->name ?? '' }}
                                        {{ $tuition->district->name ?? '' }}</h6>
                                </div>

                                <div class="content-box-nav">
                                    <ul>
                                        <li>
                                            <span class="icon"><i class="fas fa-book-open"></i></span>
                                            <span>Class: <strong class="text-success">
                                                    @forelse ($tuition->classjeson as $tclass)
                                                        {{ $tclass->name }}@if (!$loop->last)
                                                        @endif
                                                        @empty
                                                        @endforelse
                                                    </strong></span>
                                            </li>
                                            <li>
                                                <span class="icon"><i class="fas fa-code-branch"></i></span>
                                                <span>Medium : <strong class="text-success">
                                                        @forelse ($tuition->student_mediumjeson as $medium)
                                                            {{ $medium->name }} @if (!$loop->last)
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    </strong></span>
                                            </li>
                                            <li>
                                                <span class="icon"><i class="fas fa-book"></i></span>
                                                <span>Subject: <strong class="text-success">
                                                        @forelse ($tuition->subject_idsjeson as $subject)
                                                            {{ $subject->name }}@if (!$loop->last)
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    </strong></span>
                                            </li>
                                            <li>
                                                <span class="icon"><i class="far fa-clock"></i>
                                                </span>
                                                <span>Per Week : <strong class="text-dark">
                                                        @forelse ($tuition->weekjeson as $week)
                                                            {{ $week->name }} @if (!$loop->last)
                                                            @endif
                                                        @empty
                                                        @endforelse
                                                    </strong></span>
                                            </li>
                                            <li>
                                                <span class="icon"><i class="fas fa-mars"></i>
                                                </span>
                                                <span>Gender :<strong
                                                        class="text-dark">{{ is_array($tuition->gender) && in_array('Male', $tuition->gender) ? 'Male' : '' }}
                                                        {{ is_array($tuition->gender) && in_array('Female', $tuition->gender) ? 'Female' : '' }}</strong></span>
                                            </li>
                                            <li>
                                                <span class="icon"><i class="far fa-clock"></i>
                                                </span>
                                                <span>Duration (h) :<strong
                                                        class="text-dark">{{ $tuition->duration }}</strong></span>
                                            </li>
                                            <li>
                                                <span class="icon"><i class="far fa-user"></i>
                                                </span>
                                                <span>Number Of Student :<strong
                                                        class="text-dark">{{ $tuition->student_number }}</strong></span>
                                            </li>
                                            <li>
                                                <span class="icon"><i class="fas fa-dollar-sign"></i>
                                                </span>
                                                <span>Salary : <strong class="text-dark">
                                                        @if ($tuition->salary_show_hide == '1')
                                                            @if ($tuition->salary_range != '')
                                                                {{ $tuition->salary_range }} ৳
                                                            @elseif($tuition->salary > 0.0)
                                                                {{ $tuition->salary }} ৳
                                                            @else
                                                                Negotiable
                                                            @endif
                                                        @endif
                                                    </strong></span>
                                            </li>


                                        </ul>
                                    </div>
                                    <div class="tuition-all-btn">
                                        <ul>
                                            @if ($tuition->class_type == 'Online')
                                                <li><a href="#" style="color: #01d31f;"><i class="fas fa-dot-circle"></i>
                                                        Online</a></li>
                                            @else
                                                <li><a href="#"><i class="fas fa-dot-circle"></i> Offline</a></li>
                                            @endif
                                            @if ($tuition->is_blocked_application == 'lock')
                                                <li><a href="#" class="not_available_btn">Not Available</a></li>
                                            @else
                                                <li><a
                                                        href="{{ route('tuition_details', $tuition->job_id) }}?id={{ $tuition->id }}">Details</a>
                                                </li>
                                            @endif
                                            <li><a href="https://www.facebook.com/">Share</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <a href="{{ route('tuition_list') }}" class="view btn btn-lg px-5 py-3 text-light ">View More</a>
                </div>
                <hr>

                <div class="col-lg-12">
                    <div class="Tutor">
                        <h2>Find Your Tutor</h2>
                    </div>
                </div>
                <section class="team-area bg-gray section-padding">
                    <div class="container">
                        <form action="" class="">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="filter_category">
                                        <h4 class="text-muted"></h4>
                                        <select class="form-control select2" name="area_id">
                                            <option value="">Select Area</option>
                                            @foreach ($data['areas'] as $area)
                                                <option {{ $data['request']->area_id == $area->id ? 'selected' : '' }}
                                                    value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="filter_category">
                                        <h4 class="text-muted"></h4>
                                        <select name="gender" class="form-control Gender"
                                            style="margin-bottom: 10px; font-size: 20px; background: white;">
                                            <option value="" selected="selected">Select Gender</option>
                                            <option {{ $data['request']->gender == 'Male' ? 'selected' : '' }} value="Male">
                                                Male</option>
                                            <option {{ $data['request']->gender == 'Female' ? 'selected' : '' }}
                                                value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="filter_category">
                                        <h4 class="text-muted"></h4>
                                        <select class="form-control Subject" name="subject_id">
                                            <option value="">Select Subject</option>
                                            @foreach ($data['subjects'] as $subject)
                                                <option {{ $data['request']->subject_id == $subject->id ? 'selected' : '' }}
                                                    value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <div class="search_by">
                                        <h4 class="text-muted"></h4>
                                        <span class="header-top__search-form d-flex" style="gap: 5px">
                                            <input type="text" id="search_input" value="{{ $request->search_input }}"
                                                name="search_input" class="form-control" placeholder="Search Institution">
                                            <button class="yikes-easy-mc-submit-button" type="submit">Submit</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row pt-40">
                            <!--start member-single-->
                            @foreach ($data['tutors'] as $tutor)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="instructor-single shadow-none">
                                        <div class="instructor-image">
                                            <img src="{{ user_img($tutor->user->avatar ?? '') }}" class="img-fluid"
                                                alt="image">
                                            <div class="instructor-links">
                                                <ul>
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="instructor-body">
                                            <h4><a href="#">{{ $tutor->user->name ?? '' }}</a></h4>
                                            <p>{{ $tutor->subject_name . '' ?? '' }}</p>
                                            <p>{{ $tutor->institution ?? '' }}</p>
                                            <a href="{{ route('tutor_profile', $tutor->id) }}" class="view_details">View
                                                Details</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!--end member-single-->
                        </div>
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <a href="{{ route('tutor_list') }}" class="view btn btn-lg px-5 py-3 text-light ">View More</a>
                        </div>

                        <nav aria-label="">
                            <ul class="pagination justify-content-center">

                                <li class="page-item">{{ $data['tutors']->links('pagination::bootstrap-4') }}</li>


                            </ul>
                        </nav>
                        <hr>
                        <div class="col-lg-12 mt-2">
                            <div class="Tutor">
                                <h2>Our Gurdian Review</h2>
                            </div>
                        </div>

                        <div class="owl-carousel owl-theme" id="comment" items="3">
                            @foreach ($user as $users)
                                <div class="card">
                                    <div class="card-body">
                                        <p>{{ $users->body }}</p>
                                        <span class="badge badge-warning">{{ $users->user->name }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </section>
    @endsection
    @push('footer_js')
        <script>
            $(document).ready(function() {
                $('.desktop_image').owlCarousel({
                    items: 1, // Display one image at a time
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 4000,
                    autoplayHoverPause: true
                });

                // $('#mobile-menu').owlCarousel({
                //     items: 2, 
                //     loop: true,
                //     autoplay: true,
                //     autoplayTimeout: 4000,
                //     autoplayHoverPause: true
                // });
                // $('#mobile').owlCarousel({
                //     items: 2, 
                //     loop: true,
                //     autoplay: true,
                //     autoplayTimeout: 4000,
                //     autoplayHoverPause: true
                // });

                $('#comment').owlCarousel({
                    items: 3, // Display three items at a time on large devices
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 4000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1 // Display one item at a time on phone devices
                        },
                        768: {
                            items: 2 // Display three items at a time on larger devices like tablets
                        },
                        992: {
                            items: 3 // Display three items at a time on larger devices like small laptops
                        },
                        1200: {
                            items: 3 // Display three items at a time on larger devices like desktops
                            // Display three items at a time on larger devices like desktops
                        }
                    }
                });
            });

            let loadMore = document.querySelectorAll('.responsive_load')
            if (loadMore) {
                loadMore.forEach((element, index) => {
                    if (index > 2) {
                        element.classList.add('d-none')
                    }
                });
            }
            var is_loaded = false;

            function loadMoredata(event) {
                if (!is_loaded) {
                    let loadMore = document.querySelectorAll('.responsive_load')
                    if (loadMore) {
                        loadMore.forEach((element, index) => {
                            element.classList.remove('d-none')
                        });
                    }
                    event.target.innerText = 'Hide'
                    is_loaded = true
                } else {
                    let loadMore = document.querySelectorAll('.responsive_load')
                    loadMore.forEach((element, index) => {
                        if (index > 2) {
                            element.classList.add('d-none')
                        }
                    });
                    event.target.innerText = 'View More'
                    is_loaded = false
                }

            }
        </script>
    @endpush
