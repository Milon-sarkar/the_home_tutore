
@extends('frontend.layouts.app')

@section('content')

    <!-- profile start -->
    <div class="profile">
        <div class="profile_container">
            <div class="tutor_profile">
                <div class="row profile_padding">
                    <div class="col-md-4">
                        <div class="profile_image">
                            <img src="{{ user_img($tutor_profile->user->avatar ?? '') }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile_description">
                            <h3 class="profile_name">{{ $tutor_profile->user->name ?? ''}}</h3>
                            <p class="oneliner d-none">Spreading knowledge everywhere that,s all i do</p>
                            <div class="description_content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="content_item">
                                            <div class="icon star"><i class="fa fa-user" aria-hidden="true"></i>
                                            </div>
                                            <h3 class="item_data"><span> {{ ucfirst($tutor_profile->gender) }}</span> </h3>
                                        </div>
                                        <div class="content_item">
                                            <div class="icon"><i class="fas fa-map-marker-alt"></i> </i></div>
                                            <h3 class="item_data">{{ $tutor_profile->area->name ?? '' }} {{ $tutor_profile->division->name ?? '' }}</h3>
                                        </div>
                                        <div class="content_item">
                                            <div class="icon"><i class="fas fa-graduation-cap"></i> </i></div>
                                            <h3 class="item_data">{{ $tutor_profile->institution }}</h3>
                                        </div>
                                        <div class="content_item">
                                            <div class="icon"><i class="fa fa-book"></i> </i></div>
                                            <h3 class="item_data">{{ $tutor_profile->subject->name ?? '' }}</h3>
                                        </div>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="content_item">
                                            <div class="icon tik"><i class="fas fa-language"></i></div>
                                            <h3 class="item_data"> @forelse ($tutor_profile->mediumjeson as $medium)
                                                {{ $medium->name }}@if( !$loop->last) ,@endif
                                            @empty
                                            @endforelse</h3>
                                        </div>
                                        <div class="content_item">
                                            <div class="icon"><i class="far fa-clock"></i></div>
                                            <h3 class="item_data">@forelse ($tutor_profile->timejeson as $time)
                                                {{ $time->name }}@if( !$loop->last) ,@endif
                                            @empty
                                            @endforelse</h3>
                                        </div>
                                        <div class="content_item">
                                            <div class="icon"><i class="far fa-clock"></i></div>
                                            <h3 class="item_data">@forelse ($tutor_profile->weekjeson as $week)
                                                {{ $week->name }}@if( !$loop->last) ,@endif
                                            @empty
                                            @endforelse</h3>
                                        </div>
                                        <div class="content_item">
                                            <div class="icon"><i class="fas fa-check-circle"></i></div>
                                            <h3 class="item_data">Tutoring Offline</h3>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="starting_from">
                            <h5 class="starting_text">Starting from:</h5>
                            <h4 class="starting_money text-center">@if ($tutor_profile->salary_show_hide=='1' && $tutor_profile->salary >0)
                                {{ $tutor_profile->salary }}
                                    <p>Month</p>
                                @else
                                {{ 'Nagotiable' }}
                            @endif</h4>
                        </div>
                    </div>
                </div>
                <div class="action_btn">
                    <a href="#" class="save_btn d-none"><img src="images/love.png" alt=""> Save</a>
                    <a href="#" class="talk_btn d-none">Let’s talk now</a>

                    @if (auth()->user() != null && (auth()->user()->user_type !="admin" || auth()->user()->user_type !="tutor"))
                    @php $book = App\Models\TuitionBook::where('user_id',Auth::user()->id)->where('tutor_id',$tutor_profile->id)->first(); @endphp
                    @if(!empty($book))
                     <span class="book_btn">Already Apply</span>
                     @else
                     <form action="{{ route('tutor_book_apply') }}" method="POST">
                       @csrf
                       <input type="hidden" name="tutor_id" value="{{ $tutor_profile->id }}">
                       <input type="submit"  class="book_btn" value="Book This Tutor">
                   </form>
                    @endif
                    @else
                   <form action="{{ route('tutor_book_apply') }}" method="POST">
                       @csrf
                       <input type="hidden" name="tutor_id" value="{{ $tutor_profile->id }}">
                       <input type="submit"  class="book_btn" value="Book This Tutor">
                   </form>
                   @endif
                </div>
            </div>
            <!-- review start -->

            <div class="portfolio_experience">
                <div class="experience_title">
                    <h3>Tutoring Experience</h3>
                </div>
                <div class="experience_description">
                   {{ $tutor_profile->details }}
                </div>
            </div>


    <!-- review end -->
        </div>
    </div>
    <!-- profile end -->
@endsection
