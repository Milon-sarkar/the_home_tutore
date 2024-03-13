@extends('frontend.layouts.app')
@section('title')
    Tution List
@endsection
@section('content')

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
    <section class="all-tuition-area section-padding">
        <div class="container">
            <form action="" class="">
                <div class="row">
                       <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="filter_category">
                            <h4 class="text-muted"></h4>
                            <select class="form-control select2" name="area_id">
                                <option  value="">Select  Area</option>
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
                <form action="{{ route('tuition_list') }}" method="get" class="">
                    <div class="col-lg-12">
                        <div class="button-list">
                            <ul class="button-list-nav">
                                <li>
                                    <a href="{{ route('tuition_list') }}" class="btn btn-sm {{ request()->get('tuition_category') == false ? 'btn-success' : 'btn-secondary' }}" style="border-radius: 30px; text-decoration: none;">All Tution</a>
                                </li>
                                @foreach (\App\Models\TuitionCategory::get() as $tuition_category)
                                    <li class="pr-2">
                                        <a href="{{ route('tuition_list', ['tuition_category' => $tuition_category->name]) }}" class="btn btn-sm {{ request()->get('tuition_category') == $tuition_category->name ? 'btn-success' : 'btn-secondary' }}" style="border-radius: 30px; text-decoration: none;">{{str_replace('Tuition', 'Tution', $tuition_category->name);  }}</a>
                                        {{-- <a href="{{ route('tuition_list', ['tuition_category' => $tuition_category->name]) }}" class="btn btn-sm {{ request()->get('tuition_category') == $tuition_category->name ? 'btn-success' : 'btn-secondary' }}" style="border-radius: 30px; text-decoration: none;">{{str_replace('tuition', 'tution',strtolower($tuition_category->name));  }}</a> --}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
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
                                            class="fas fa-map-marker-alt"></i></span>{{ $tuition->area->name ?? '' }},
                                    {{ $tuition->district->name ?? '' }}</h6>
                            </div>

                            <div class="content-box-nav">
                                <ul>
                                    <li>
                                        <span class="icon"><i class="fas fa-book-open"></i></span>
                                        <span>Class: <strong class="text-success">
                                                @forelse ($tuition->classjeson as $tclass)
                                                    {{ $tclass->name }}@if (!$loop->last)
                                                        ,
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
                                                            ,
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
                                                            ,
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                </strong></span>
                                        </li>
                                        <li>
                                            <span class="icon"><i class="far fa-clock"></i></span>
                                            <span>Per Week : <strong class="text-dark">
                                                    @forelse ($tuition->weekjeson as $week)
                                                        {{ $week->name }} @if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                </strong></span>
                                        </li>
                                        <li>
                                            <span class="icon"><i class="fas fa-mars"></i></span>
                                            <span>Gender :<strong
                                                    class="text-dark">{{ is_array($tuition->gender) && in_array('Male', $tuition->gender) ? 'Male' : '' }}
                                                    {{ is_array($tuition->gender) && in_array('Female', $tuition->gender) ? 'Female' : '' }}</strong></span>
                                        </li>
                                        <li>
                                            <span class="icon"><i class="far fa-clock"></i></span>
                                            <span>Duration (h) :<strong
                                                    class="text-dark">{{ $tuition->duration }}</strong></span>
                                        </li>
                                        <li>
                                            <span class="icon"><i class="far fa-user"></i></span>
                                            <span>Number Of Student :<strong
                                                    class="text-dark">{{ $tuition->student_number }}</strong></span>
                                        </li>
                                        <li>
                                            <span class="icon"><i class="fas fa-dollar-sign"></i></span>
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
                                            <li><a href="#" style="color: #01d31f;"><i class="fas fa-dot-circle"></i> Online</a></li>
                                        @else
                                            <li><a href="#"><i class="fas fa-dot-circle"></i> Offline</a></li>
                                        @endif

                                        @if ($tuition->is_blocked_application == 'lock')
                                            <li><a href="#" class="not_available_btn">Not Available</a></li>
                                        @else
                                            <li><a href="{{ route('tuition_details', $tuition->job_id) }}?id={{ $tuition->id }}">Details</a></li>
                                        @endif
                                        <li><a href="https://www.facebook.com/">Share</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <nav aria-label="">
                    <ul class="pagination justify-content-center">
                        <li class="page-item"> {{ $tuitions->appends(Request::except('page'))->links('pagination::bootstrap-4') }}</li>
                    </ul>
                </nav>

        </div>
    </section>

    @push('footer_js')
        <script>
            // if($("#filter_checkbox").is(':checked')){
            $("#filter_checkbox").click(function() {
                if ($('#filter_checkbox').prop('checked')) {
                    console.log('ok')
                    $("#filter_option").fadeIn // checked
                    $("#filter_option").show() // checked
                } else {
                    $("#filter_option").hide() // unchecked
                }
            })
        </script>
    @endpush
@endsection
