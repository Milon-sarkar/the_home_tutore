@extends('frontend.layouts.app')
@section('title')
    Tutor List
@endsection
@section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
<section class="team-area bg-gray section-padding">
    <div class="container">
        <form action="" class="">
        <div class="row">
               <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="filter_category">
                    <h4 class="text-muted"></h4>
                    <select class="form-control select2" name="area_id">
                        <option  value="">Select Area</option>
                        @foreach ($areas as $area)
                            <option {{ $request->area_id == $area->id ? 'selected' : '' }}
                                value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>
               </div>
               <div class="col-lg-3 col-md-4 col-sm-12">      
                <div class="filter_category">
                    <h4 class="text-muted"></h4>
                    <select name="gender"class="form-control Gender" style="margin-bottom: 10px;font-size: 20px;background: white;">
                        <option value="" selected="selected">Select Gender</option>
                        <option {{ $request->gender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                        <option {{ $request->gender == 'Female' ? 'selected' : '' }} value="Female">Female
                        </option>
                    </select>
                </div>
               </div>
               <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="filter_category">
                    <h4 class="text-muted"></h4>
                    <select class="form-control Subject" name="subject_id">
                        <option  value="">Select Subject</option>
                        @foreach ($subjects as $subject)
                            <option {{ $request->subject_id == $subject->id ? 'selected' : '' }}
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
            @foreach ($tutors as $tutor)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="instructor-single shadow-none">
                    <div class="instructor-image">
                        <img src="{{ user_img($tutor->user->avatar ?? '') }}" class="img-fluid" alt="image">
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
                         <p>{{ $tutor->subject_name.'' ?? '' }}</p>
                         <p>{{ $tutor->institution ?? '' }}</p>
                        <a href="{{ route('tutor_profile',$tutor->id) }}" class="view_details">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
            <!--end member-single-->
        </div>
        <nav aria-label="">
            <ul class="pagination justify-content-center">
    
              <li class="page-item"> {{ $tutors->links('pagination::bootstrap-4')  }}</li>
    
    
            </ul>
        </nav>
    </div>
</section>
@endsection
