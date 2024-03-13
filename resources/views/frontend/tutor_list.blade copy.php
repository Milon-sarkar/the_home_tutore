@extends('frontend.layouts.app')

@section('content')
<section class="tutors_section">
    <div class="all_tutors">
         <div class="container">
            <form action="" class="">
                <div class="filtering">
                    <div class="row justify-content-between align-items-end">
                        <div class="col-sm">

                            <div class="filter_category">
                                <h4 class="text-muted">Area</h4>
                                <select class="form-control select2" name="area_id">
                                    <option  value="">All Option</option>
                                    @foreach ($areas as $area)
                                        <option {{ $request->area_id == $area->id ? 'selected' : '' }}
                                            value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm">

                            <div class="filter_category">
                                <h4 class="text-muted">Gender</h4>
                                <select name="gender"class="form-control" style="margin-bottom: 10px;font-size: 20px;background: white;">
                                    <option value="" selected="selected">All Gender</option>
                                    <option {{ $request->gender == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                                    <option {{ $request->gender == 'Female' ? 'selected' : '' }} value="Female">Female
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm">

                            <div class="filter_category">
                                <h4 class="text-muted">Subject</h4>
                                <select class="form-control select2" name="subject_id">
                                    <option  value="">All Option</option>
                                    @foreach ($subjects as $subject)
                                        <option {{ $request->subject_id == $subject->id ? 'selected' : '' }}
                                            value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="filter_category">
                                <h4 class="text-muted">Medium</h4>
                                <div class="form-group">
                                    <select class="form-control select2" name="medium_id">
                                        <option  value="">All Option</option>
                                        @foreach ($mediums as $medium)
                                            <option {{ $request->medium_id == $medium->id ? 'selected' : '' }}
                                                    value="{{ $medium->id }}">{{ $medium->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="search_by">
                                <h4 class="text-muted">Institution</h4>
                                <span class="header-top__search-form">
                                    <input type="text" id="search_input" value="{{ $request->search_input }}"
                                        name="search_input" class="form-control" placeholder="Search">
                                    <button class="header-top__search-form__button"><i
                                            class="fas fa-search"></i></button>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            <div class="row">
               @forelse ($tutors as $tutor)
                <div class="col-xl-3 col-lg-4 col-6">
                    <div class="single_tutor">
                        <div class="tutor_profile_image">
                            <img src="{{ user_img($tutor->user->avatar ?? '') }}" alt="">
                        </div>
                        <div class="tutor_description">
                            <h4 class="name">{{ $tutor->user->name ?? '' }}</h4>
                            <p class="subject text-muted mb-0">{{ $tutor->subject_name.',' ?? '' }}</p>
                            <p class="subject text-muted">{{ $tutor->institution ?? '' }}</p>
                            <a href="{{ route('tutor_profile',$tutor->id) }}" class="view_details">View Details</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 col-sm-12 d-flex justify-content-center align-items-end">
                    <h2 class="text-center" style="margin-top: 43px;"> <i class="fa fa-filter" aria-hidden="true"></i> Sorry! we couldn't find any Tutor related to your search.</h2>
                    </div>
                @endforelse
             </div>
         </div>
    </div>
    <!-- pagination start -->
    <nav aria-label="">
        <ul class="pagination justify-content-center">

          <li class="page-item"> {{ $tutors->links('pagination::bootstrap-4')  }}</li>


        </ul>
    </nav>
    <!-- pagination end -->
</div>
</section>
<script>
    $(document).ready(function() {
        $(".select2").select2({
            placeholder: "All Option",
            width: "resolve",
            allowClear: true,
        });

    });
</script>
@endsection
