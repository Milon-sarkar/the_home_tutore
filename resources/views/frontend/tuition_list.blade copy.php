@extends('frontend.layouts.app')

@section('content')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
    <section class="job_board">
        <div class="container">
            <div class="jobs_post pt-3">
                <form action="" class="">
                    <div class="filtering">
                        <p class="d-flex justify-content-end text-light d-none">
                            <label for="filter_checkbox" style="font-size: 18px; cursor: pointer">
                                <span class="bg-info py-1 px-2"><i class="fa fa-search"></i> Filter</span>
                            </label>
                        </p>

                        <input type="checkbox" id="filter_checkbox" class="d-none">

                        <div class="row justify-content-between align-items-end" id="filter_option">
                            <div class="col-lg-2 col-sm-12">

                                <div class="filter_category mb-2">
                                    <input type="text" name="tuition_id" class="form-control" placeholder="Tuition ID">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">

                                <div class="filter_category">
                                    <select class="form-control select2" name="area_id">
                                        <option disabled selected="">Select a Area</option>
                                        @foreach ($areas as $area)
                                            <option {{ $request->area_id == $area->id ? 'selected' : '' }}
                                                value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">

                                <div class="filter_category">

                                    <select name="gender"class="form-control" style="margin-bottom: 10px;font-size: 20px;background: white;">
                                        <option value="" selected="selected">All Gender</option>
                                        <option {{ $request->gender == 'Male' ? 'selected' : '' }} value="Male">Male
                                        </option>
                                        <option {{ $request->gender == 'Female' ? 'selected' : '' }} value="Female">Female
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="search_by">

                                        <select name="class_id" class="form-control" style="margin-bottom: 10px;font-size: 20px;background: white;">
                                            <option value="" selected="selected">All class</option>
                                            @foreach ($classes as $class)
                                                <option {{ $request->class_id == $class->id ? 'selected' : '' }}value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <div class="search_by">

                                    <span class="header-top__search-form">
                                        <select name="subject_id" class="form-control" style="margin-bottom: 10px;font-size: 20px;background: white;">
                                            <option value="" selected>All Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option {{ $request->subject_id == $subject->id ? 'selected' : '' }}value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        <button class="header-top__search-form__button"><i class="fas fa-search"></i></button>
                                    </span>
                                </div>
                            </div>

                        </div>
                        @include('frontend.include.tuition_category')
                    </div>
                </form>
                <div class="row">
                    @forelse ($tuitions->where('status', 1) as $tuition)
                        @include('frontend.include.tuition')
                        @empty
                        <div class="col-12 col-sm-12">
                            <h2 class="text-center" style="margin-top: 43px;"> <i class="fa fa-filter" aria-hidden="true"></i> Sorry! we couldn't find any Tuition related to your search.</h2>
                            </div>
                          @endforelse

                    </div>
                </div>
                <nav aria-label="">
                    <ul class="pagination justify-content-center">
                        <li class="page-item"> {{ $tuitions->appends(Request::except('page'))->links('pagination::bootstrap-4') }}</li>
                    </ul>
                </nav>
            </div>
        </section>
        <script>
            $(document).ready(function() {
                $(".select2").select2({
                    placeholder: "Select Option",
                    width: "resolve",
                    allowClear: true,
                });



            });
        </script>
    @push('footer_js')
        <script>
            // if($("#filter_checkbox").is(':checked')){
            $("#filter_checkbox").click(function() {
                if ($('#filter_checkbox').prop('checked')) {
                    console.log('ok')
                    $("#filter_option").fadeIn  // checked
                    $("#filter_option").show()  // checked
                } else {
                    $("#filter_option").hide()  // unchecked
                }
            })
        </script>
    @endpush
    @endsection
