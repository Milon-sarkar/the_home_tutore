@extends('frontend.layouts.app')

@push('meta')
    <meta property="og:title" content="{{ $tuition->name }}">
    <meta name="twitter:title" content="{{ $tuition->name }}">
    <meta property="og:description" content="Tuition Code : <span>{{ $tuition->job_id }}">
@endpush

@section('content')


<div class="tution_details pt-md-3 pt-1">
    <div class="tution_details-container">
        <div class="row alert bg-white text-dark mx-1 py-2 px-0 align-items-center" style="border: 1px solid #f6f6f6">
            <div class="col-md-10 col-12">
                <h3><strong>{{ $tuition->name }}</strong></h3>
            </div>
            <div class="col-md-2 col-12 text-md-end text-start">
                <h4 class="align-items-center">ID: <span>{{ $tuition->job_id }}</span></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="post_card">
                    <div class="post_card_header">
                        <div class="class_title">
                            <h4>Student Information</h4>
                        </div>
                    </div>
                    <div class="post_card_content">
                        <div class="row">
                            <div class="col">

                                <div class="content_item">
                                    <div class="icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                                    <h3 class="item_data text-muted">Class Type : <strong class="text-dark">{{ $tuition->class_type }} </strong>
                                    </h3>
                                </div>
                                @if($tuition->classjeson->count() > 0)
                                <div class="content_item">
                                    <div class="icon"><i class="fa-solid fa-book-open-reader"></i></div>
                                    <h3 class="item_data text-muted">Class : <strong class="text-dark">
                                            @forelse ($tuition->classjeson as $tclass)
                                                {{ $tclass->name }}@if (!$loop->last),@endif
                                                @empty
                                            @endforelse
                                            </strong>
                                        </h3>
                                    </div>
                                @endif

                                @if($tuition->student_mediumjeson->count() > 0)
                                    <div class="content_item">
                                        <div class="icon"><i class="fa-solid fa-code-branch"></i></div>
                                        <h3 class="item_data text-muted">Medium :<strong class="text-dark">
                                                @forelse ($tuition->student_mediumjeson as $medium)
                                                    {{ $medium->name }}@if (!$loop->last)
                                                        ,
                                                    @endif
                                                    @empty
                                                    @endforelse
                                                </strong> </h3>
                                        </div>
                                @endif

                                @if($tuition->student_number > 0)
                                        <div class="content_item">
                                            <div class="icon"><i class="fa-regular fa-user"></i></div>
                                            <h3 class="item_data text-muted">Number Of Student :<strong class="text-dark">{{ $tuition->student_number }}
                                                </strong> </h3>
                                        </div>
                                @endif

                                @if($tuition->gender)
                                        <div class="content_item">
                                            <div class="icon"><i class="fa fa-mars"></i></div>
                                            <h3 class="item_data text-muted">Gender
                                                :<strong class="text-dark">{{ is_array($tuition->gender) && in_array('Male', $tuition->gender) ? 'Male' : '' }}
                                                    {{ is_array($tuition->gender) && in_array('Female', $tuition->gender) ? 'Female' : '' }}
                                                </strong> </h3>
                                        </div>
                                @endif

                                @if($tuition->subject_idsjeson->count() > 0)
                                        <div class="content_item">
                                            <div class="icon"><i class="fa-solid fa-book"></i></div>
                                            <h3 class="item_data text-muted">Subjects : <strong class="text-dark">
                                                    @forelse ($tuition->subject_idsjeson as $subject)
                                                        {{ $subject->name }}@if (!$loop->last)
                                                            ,
                                                        @endif
                                                        @empty
                                                        @endforelse
                                                    </strong>
                                                </h3>
                                            </div>
                                @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="post_card_header mt-4">
                                    <div class="class_title">
                                        <h4>Tutor Requirements</h4>
                                    </div>
                                </div>
                                <div class="post_card_content">
                                    <div class="row">
                                        <div class="col">

                                            @if($tuition->interest_gender)
                                            <div class="content_item">
                                                <div class="icon"><i class="fa fa-mars"></i></div>
                                                <h3 class="item_data text-muted"> Tutor Gender : <strong class="text-dark">
                                                        {{ is_array($tuition->interest_gender) && in_array('Male', $tuition->interest_gender) ? 'Male' : '' }}
                                                        {{ is_array($tuition->interest_gender) && in_array('Female', $tuition->interest_gender) ? 'Female' : '' }}</strong>
                                                </h3>
                                            </div>
                                            @endif

                                                @if($tuition->subjectjeson->count() > 0)
                                            <div class="content_item">
                                                <div class="icon"><i class="fa-solid fa-book"></i></div>
                                                <h3 class="item_data text-muted">Subject : <strong class="text-dark">
                                                        @forelse ($tuition->subjectjeson as $subject)
                                                            {{ $subject->name }}@if (!$loop->last)
                                                                ,
                                                            @endif
                                                            @empty
                                                            @endforelse
                                                        </strong>
                                                    </h3>
                                                </div>
                                                @endif

                                                @if($tuition->interest_classjeson->count() > 0)
                                                <div class="content_item">
                                                    <div class="icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                                                    <h3 class="item_data text-muted">Class : <strong class="text-dark">
                                                            @forelse ($tuition->interest_classjeson as $eclass)
                                                                {{ $eclass->name }}@if (!$loop->last)
                                                                    ,
                                                                @endif
                                                                @empty
                                                                @endforelse
                                                            </strong>
                                                        </h3>
                                                    </div>
                                                @endif

                                                @if($tuition->interest_institution)
                                                    <div class="content_item">
                                                        <div class="icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                                                        <h3 class="item_data text-muted">Institution :
                                                            <strong class="text-dark">{{ $tuition->interest_institution }}</strong>
                                                        </h3>
                                                    </div>
                                                @endif

                                                @if($tuition->weekjeson->count() > 0)
                                                    <div class="content_item">
                                                        <div class="icon"><i class="fa-regular fa-clock"></i></div>
                                                        <h3 class="item_data text-muted">Weekly Per Day : <strong class="text-dark">
                                                                @forelse ($tuition->weekjeson as $week)
                                                                    {{ $week->name }}@if (!$loop->last)
                                                                        ,
                                                                    @endif
                                                                    @empty
                                                                    @endforelse
                                                                </strong>
                                                            </h3>
                                                        </div>
                                                @endif

                                                @if($tuition->duration)
                                                        <div class="content_item">
                                                            <div class="icon"><i class="fa-regular fa-clock"></i></div>
                                                            <h3 class="item_data text-muted">Duration: {{ $tuition->duration }}</h3>
                                                        </div>
                                                @endif

                                                @if($tuition->timejeson->count() > 0)
                                                        <div class="content_item">
                                                            <div class="icon"><i class="fa-regular fa-clock"></i></div>
                                                            <h3 class="item_data text-muted">Time : <strong class="text-dark">
                                                                    @forelse ($tuition->timejeson as $time)
                                                                        {{ $time->name }} @if (!$loop->last)
                                                                            ,
                                                                        @endif
                                                                    @empty
                                                                    @endforelse
                                                                </strong>
                                                            </h3>
                                                        </div>
                                                @endif

                                                @if($tuition->hiring_date)
                                                        <div class="content_item">
                                                            <div class="icon"><i class="fa fa-calendar"></i></div>
                                                            <h3 class="item_data text-muted"> Hiring From :
                                                                <strong class="text-dark">{{ $tuition->hiring_date ? date('d-M-Y', strtotime($tuition->hiring_date)) : '' }}</strong>
                                                            </h3>
                                                        </div>
                                                @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="post_card">
                                            <div class="post_card_header">
                                                <div class="class_title">
                                                    <h4>Contact Information</h4>
                                                </div>
                                            </div>
                                            <div class="post_card_content">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="content_item">
                                                            <div class="icon"><i class="fa fa-map-marker"></i></div>
                                                            <h3 class="item_data text-muted">City : <strong class="text-dark">{{ $tuition->division->name ?? '' }}</strong>
                                                            </h3>
                                                        </div>
                                                        <div class="content_item">
                                                            <div class="icon"><i class="fa fa-map-marker"></i></div>
                                                            <h3 class="item_data text-muted">Location : <strong class="text-dark">@if($tuition->address) {{ $tuition->address.", " }} @endif {{ $tuition->area->name ?? '' }},
                                                                    {{ $tuition->district->name ?? '' }}</strong>
                                                            </h3>
                                                        </div>
                                                        <p style="font-size: 15px" class="alert alert-danger mt-2">লোকেশন ভালো করে দেখুন। টিউশন নেয়ার পরে দূরত্বের কারণে বাদ দেয়া যাবে না।</p>

                                                        <div class="starting_from pt-3" style="font-size: 15px">
                                                            <h5 class="starting_text">Salary: </h5>
                                                            <h4 class="starting_money">
                                                                @if ($tuition->salary_show_hide=='1')
                                                                    @if($tuition->salary_range != '')
                                                                        {{ $tuition->salary_range }} ৳
                                                                    @elseif($tuition->salary > 0.00)
                                                                         {{ $tuition->salary }} ৳
                                                                    @else
                                                                        Negotiable
                                                                    @endif
                                                                @endif
                                                            </h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post_card">
                                            @if (auth()->user() != null && auth()->user()->user_type == 'tutor')
                                                @php
                                                    $tutor = \App\Models\Tutor::where('user_id', auth()->id())->first();
                                                    $percentage = 0;
                                                    $percentage += $tutor->experience_tuition_percentage;
                                                    $percentage += $tutor->interested_requirement_percentage;
                                                    $percentage += $tutor->personal_information_percentage;
                                                    $percentage += $tutor->academic_qualification_percentage;
                                                    $percentage += $tutor->academic_information_percentage;
                                                @endphp
                                            @endif

                                            <div class="row align-items-center">
                                                <div class="col-12">
                                                    <div class="action_btn text-center">

                                                        @if ($tuition->status == '2')
                                                            <button class="text-light bg-secondary btn-lg disabled cursor-disable" disabled>Already Booked </button>
                                                        @else
                                                            @if (auth()->user() != null && auth()->user()->user_type == 'tutor')

                                                                {{--If it is tutor start--}}
                                                                @if($percentage > 70)
                                                                    @php
                                                                        $book = App\Models\TuitionBook::where('user_id', auth()->id())->where('tuition_id', $tuition->id)->first();
                                                                    @endphp
                                                                    @if ($book AND $book->status != 3)
                                                                        <span class="d-flex justify-content-around">
                                                                            <span class="btn btn-success cursor-disable">Applied</span>
                                                                            <form action="{{ route('unapply_tuition') }}" method="post">
                                                                                {{ csrf_field() }}
                                                                                <input type="hidden" name="tuition_id" value="{{ $tuition->id }}">
                                                                                <input type="submit" class="btn btn-danger" value="Unapply">
                                                                            </form>
                                                                        </span>
                                                                    @elseif($book AND  $book->status == '3')
                                                                        <span class="text-danger" disabled><code>Rejected</code> </span>
                                                                    @else
                                                                        @if($tuition->is_blocked_application != 'lock')
                                                                            @if(App\Models\Tutor::where('user_id', auth()->id())->first()->status == 1)
                                                                                <input type="button" class="btn-info btn-lg" value="Apply Now" data-toggle="modal" data-target="#applyModalCenter">
                                                                            @else
                                                                                <code class="text-left">Your Account is not active. Contact to admin to activate.</code>
                                                                            @endif
                                                                        @else
                                                                            <a href="#" class="not_available_btn">Not Available</a>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                     #
                                                                @endif
                                                                {{--If it is tutor end--}}
                                                            @else
                                                                @if($tuition->is_blocked_application != 'lock')
                                                                    @if(auth()->id() != $tuition->user_id)
                                                                        <input type="button" class="btn-info btn-lg" value="Apply Now" data-toggle="modal" data-target="#applyModalCenter">
                                                                    @endif
                                                                @else
                                                                    <a href="#" class="not_available_btn">Not Available</a>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                @push('modal')
                                <style>
                                    @media all and (max-width: 570px) {
                                        #applyModalCenter{
                                            margin-top: 50px;
                                        }
                                    }
                                </style>
                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                                    <div class="modal fade" id="applyModalCenter" tabindex="-1" role="dialog" aria-labelledby="applyModalCenterTitle" aria-hidden="true"  data-keyboard="false" data-backdrop="static">
                                        <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-light">
                                                    <h5 class="modal-title" id="applyModalLongTitle">Read Carefully before Apply</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @if($tuition->details)
                                                <div class="modal-body" style="min-height: 200px">
                                                    {!! $tuition->details !!}
                                                </div>
                                                @endif

                                                <div class="modal-footer d-flex justify-content-start">
                                                    <label for="tutor_urgency text-start">Write down your <span class="text-danger">urgency, experience, qualification</span> for this tuition <sup class="text-danger">*</sup></label>
                                                    <textarea name="tutor_urgency" id="tutor_urgency" maxlength="500" form="tuition_book_apply" required cols="30" rows="10" class="form-control" style="height: 150px;"></textarea>
                                                    <p>
                                                        <label class="d-block cursor-pointer">
                                                            <input type="checkbox" required form="tuition_book_apply"> I agree with the terms and Conditions
                                                        </label>
                                                    </p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn  btn-lg btn-secondary" data-dismiss="modal">Close</button>
                                                    <form action="{{ route('tution_book_apply') }}" method="POST" id="tuition_book_apply">
                                                        @csrf
                                                        <input type="hidden" name="tuition_id" value="{{ $tuition->id }}">
{{--                                                        <span id="reaction">{{ $tuition->reaction }}</span>--}}
{{--                                                        <a id="reaction_btn" onclick="add_reaction('<?php echo $tuition->id; ?>', '1');" class="save_btn">--}}
                                                        @if(auth()->id() != $tuition->user_id)
                                                            <div>
                                                                <input type="submit" class="book_btn btn btn-lg btn-info" value="Apply Now">
                                                            </div>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endpush

{{--                                <div class="profile_review" id="myTab">--}}

{{--                                    <div class="review_menu">--}}
{{--                                        <ul class="jq-tab-menu">--}}

{{--                                            <li class="profile_review_title_tab active" data-tab="2">Comments</li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                    <div class="content_wrapper">--}}
{{--                                        <div class="tab_content active" data-tab="2">--}}
{{--                                            @forelse ($comments as $comment)--}}
{{--                                                <div class="review_content">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-1 col-md-2 col-sm-2 col-3">--}}
{{--                                                            <div class="profile_image">--}}
{{--                                                                <img src="images/reviewer.png" alt="">--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-11 col-md-10 col-sm-10 col-7">--}}
{{--                                                            <h3 class="reviewer_name">{{ $comment->user->name ?? '' }}</h3>--}}

{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-1 col-md-2">--}}

{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-11 col-md-10">--}}
{{--                                                            <div class="review_comment">--}}
{{--                                                                <span id="short_version{{ $comment->id }}">{{ Str::limit($comment->body, 150) }}</span>--}}
{{--                                                               <span class="d-none" id="full_version{{ $comment->id }}">{{ $comment->body }}</span>--}}
{{--                                                              <button onclick="readMoreLess{{ $comment->id }}()" style="border:0;" id="read_more{{ $comment->id }}">Read More</button>--}}

{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <script>--}}
{{--                                                    function readMoreLess{{ $comment->id }}(){--}}
{{--                                                        document.getElementById('short_version{{ $comment->id }}').classList.add('d-none');--}}
{{--                                                        document.getElementById('full_version{{ $comment->id }}').classList.remove('d-none');--}}
{{--                                                        document.getElementById('read_more{{ $comment->id }}').classList.add('d-none');--}}
{{--                                                    }--}}
{{--                                                </script>--}}
{{--                                            @empty--}}
{{--                                                <div class="review_content">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-1 col-md-2 col-sm-2 col-3">--}}
{{--                                                            <div class="profile_image">--}}
{{--                                                                <img src="images/reviewer.png" alt="">--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-11 col-md-10 col-sm-10 col-7">--}}
{{--                                                            <h3 class="reviewer_name">Comment Not Fund</h3>--}}

{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                            @endforelse--}}

{{--                                            <div class="review_content" style="height: 240px">--}}
{{--                                                @if (Auth::user() != '')--}}
{{--                                                    <form action="{{ route('review_comment') }}" method="POST">--}}
{{--                                                        @csrf--}}
{{--                                                        <input type="hidden" name="tuition_id" value="{{ $tuition->id }}">--}}
{{--                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">--}}
{{--                                                        <div class="row" style="padding-top: 20px">--}}

{{--                                                            <div class="col-12">--}}
{{--                                                                <textarea name="body" style="margin-bottom: 5px; padding: 10px 15px; border-radius: 5px; font-size: 14px; height: 100px" class="form-control" placeholder="Write a review"></textarea>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <button class="btn btn-info">Submit</button>--}}
{{--                                                    </form>--}}
{{--                                                @else--}}

{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-1 col-md-2 col-sm-2 col-3">--}}
{{--                                                            <div class="profile_image">--}}
{{--                                                                <img src="images/reviewer.png" alt="">--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-11 col-md-10 col-sm-10 col-7">--}}
{{--                                                            <h3 class="reviewer_name">Are You Want To Comment? Please <a class="btn btn-info" href="{{ route('login') }}">Log in</a></h3>--}}

{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>

                        </div>
                        <script>
                            function add_reaction(id, reaction) {

                                jQuery.ajax({
                                    url: "{{ url(route('add_reaction')) }}",
                                    headers: {
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                    },

                                    data: {
                                        id: id,
                                        reaction: reaction
                                    },
                                    method: "POST",
                                    success: function(data) {
                                        console.log(data.options);
                                        document.getElementById("reaction").innerHTML = data.options
                                        document.getElementById("reaction_btn").onclick = function() {
                                            return false;
                                        };
                                    },
                                    error: function() {
                                        alert('Something Getting Wrong! Please reload the page and try again')
                                    }
                                });
                            }
                        </script>
                    @endsection
