@extends('frontend.layouts.app')

@section('content')

    <!-- user dashboard start -->
    <div class="dashboard_wrapper  pt-md-4 pt-2" id="myTab3">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('frontend.user.tutor.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="content_wrapper">

                        <div class="order_wraps">
                            @include('frontend.user.tutor.complete_profile.percent')
                            <div class="card">
{{--                                <div class="card-header">--}}
{{--                                    My Profile <span style="float: right;color: red;" class="text-right;">--}}
{{--                                            {{ $tutor->tutor_code ?? '' }}</span>--}}
{{--                                </div>--}}
                                <div class="card-body">
                                    <form id="kt_ecommerce_settings_general_form" class="form"
                                          action="{{ route('tutor_complete_profile_update', Auth::user()->id) }}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="profile_information_type" required value="personal_information ">


                                        <!--begin::Input group-->
                                        <div class="mb-7">
                                            <!--begin::Label-->

                                            <!--end::Label-->
                                            <!--begin::Image input wrapper-->
                                            <div class="mt-1">
                                                <!--begin::Image input-->
                                                <div class="picture-container">
                                                    <div class="picture">
                                                        <img src="{{ Auth::user()->avatar }}" class="picture-src"
                                                             id="wizardPicturePreview" title="">
                                                        <input type="file" name="image" id="wizard-picture"
                                                               class="" accept=".jpg, .png, .jpeg">
                                                    </div>
                                                    <h6 class="">Change Profile Picture</h6>

                                                </div>
                                                <!--end::Image input-->
                                            </div>
                                            <!--end::Image input wrapper-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                            <!--begin::Col-->
                                            <div class="col">

                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                        <span class="required">Full Name<sup class="text-danger">*</sup></span>

                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid" name="name"
                                                           value="{{ Auth::user()->name }}" required/>
                                                    <input type="hidden" class="form-control form-control-solid" name="id"
                                                           value="{{ Auth::user()->id }}" required />
                                                    <!--end::Input-->
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                        <span>Phone<sup class="text-danger">*</sup></span>

                                                    </label>
                                                    <input type="text" readonly class="form-control form-control-solid"
                                                           name="phone" required value="{{ Auth::user()->phone }}" />
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

                                            <div class="col">
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                        <span>Whatsapp <sup class="text-danger">*</sup></span>
                                                    </label>
                                                    <input type="text" class="form-control form-control-solid"
                                                           name="whatsapp" required value="{{ Auth::user()->whatsapp }}" />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row mb-7 mt-3">
                                                    <div class="form-group">
                                                        <label for="userName">Gender<span class="text-danger">*</span></label>
                                                        <select class="form-control select2" name="gender" required>
                                                            <option>Select</option>
                                                            <option
                                                                {{ $tutor->gender == 'Male' ? 'selected' : '' }}
                                                                value="Male">Male</option>
                                                            <option
                                                                {{ $tutor->gender == 'Female' ? 'selected' : '' }}
                                                                value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

{{--                                            <div class="col">--}}
{{--                                                <div class="fv-row mb-7 mt-3">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="phone">Date Of birth</label>--}}
{{--                                                        <div>--}}
{{--                                                            <div class="input-group">--}}
{{--                                                                <input type="date" class="form-control"--}}
{{--                                                                       name="date_of_birth"--}}
{{--                                                                       value="{{ $tutor->date_of_birth ? $tutor->date_of_birth : '' }}"--}}
{{--                                                                       placeholder="mm/dd/yyyy"--}}
{{--                                                                       id="datepicker-autoclose" required>--}}

{{--                                                            </div><!-- input-group -->--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="col">--}}
{{--                                                <div class="fv-row mb-7 mt-3">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="facebook">Facebook Id<span--}}
{{--                                                                class="text-danger"></span></label>--}}
{{--                                                        <input id="facebook"--}}
{{--                                                               value="{{ $tutor->facebook_link }}"--}}
{{--                                                               type="text" placeholder="Facebook ID Link"--}}
{{--                                                               name="facebook_link" class="form-control" required>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="col">--}}
{{--                                                <div class="fv-row mb-7">--}}
{{--                                                    <label class="fs-6 fw-bold form-label mt-3"><span>NID Number</span></label>--}}
{{--                                                    <input type="text" class="form-control form-control-solid"--}}
{{--                                                           name="nid_number" value="{{  Auth::user()->nid_number }}" />--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col">--}}
{{--                                                <div class="fv-row mb-7">--}}
{{--                                                    <label class="fs-6 fw-bold form-label mt-3"><span>NID photo</span></label>--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <div class="">--}}
{{--                                                            <div class="fileupload fileupload-new" data-provides="fileupload">--}}
{{--                                                                <div class="row">--}}
{{--                                                                    <div class="col-md-9">--}}
{{--                                                                        <input type="file" name="nid" class="form-control" />--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="col-md-3">--}}
{{--                                                                        @if(!empty($tutor->user->nid))--}}
{{--                                                                            <img class="img-fluid" src="{{ $tutor->user->nid }}" alt="">--}}
{{--                                                                        @endif--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}

{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <!--end::Col-->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mt-3">
                                                <label for="city_id">Select City</label>
                                                <select name="city_id" id="city_id" class="form-control select2">
                                                    @foreach(\App\Models\District::orderBy('name', 'ASC')->get() as $district)
                                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="area_id">Your Location</label>
                                                <select name="area_id" id="area_id" class="form-control select2">
                                                    @foreach(\App\Models\Area::orderBy('name', 'ASC')->get() as $area)
                                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="preferred_area_id">Preferred Location</label>
                                                <select name="preferred_area_id" id="preferred_area_id" class="form-control select2">
                                                    @foreach(\App\Models\Area::orderBy('name', 'ASC')->get() as $area)
                                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group text-center pt-3">
                                            <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">Complete Registration</button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- user dashboard end -->
    <script src="{{ asset('frontend/js/ajax_jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            //shipping_calculation();
            $("#wizard-picture").change(function() {
                readURL(this);
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.multipleSelect').select2({
                width: "resolve"
            });
            $('.select2').select2({
                width: "resolve"
            });
        });
    </script>

    <script>
        function getDistrictByDivition() {
            var division_id = $("#division_id").val();
            $('#upazila_id').find('option').remove().end();
            $('#union_id').find('option').remove().end();
            jQuery.ajax({
                url: "{{ url(route('getDistrictByDivition')) }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },

                data: {
                    division_id: division_id
                },
                method: "POST",
                success: function(data) {
                    document.getElementById("district_id").innerHTML = data.options
                },
                error: function() {
                    alert('Something Getting Wrong! Please reload the page and try again')
                }
            });
        }

        function getAreaByDistrict() {
            let district_id = $("#district_id").val();
            $('#area_id').find('option').remove().end();
            jQuery.ajax({
                url: "{{ url(route('getAreaByDistrict')) }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },

                data: {
                    district_id: district_id
                },
                method: "POST",
                success: function(data) {
                    console.log(data.options);
                    document.getElementById("area_id").innerHTML = data.options
                },
                error: function() {
                    alert('Something Getting Wrong! Please reload the page and try again')
                }
            });
        }




        function getPermanentDistrictByDivition() {
            var division_id = $("#permanent_division_id").val();
            $('#permanent_upazila_id').find('option').remove().end();
            $('#permanent_union_id').find('option').remove().end();
            jQuery.ajax({
                url: "{{ url(route('getDistrictByDivition')) }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },

                data: {
                    division_id: division_id
                },
                method: "POST",
                success: function(data) {
                    document.getElementById("permanent_district_id").innerHTML = data.options
                },
                error: function() {
                    alert('Something Getting Wrong! Please reload the page and try again')
                }
            });
        }

        function getPermanentUpizalaByDistrict() {
            let district_id = $("#permanent_district_id").val();
            $('#permanent_upazila_id').find('option').remove().end();
            jQuery.ajax({
                url: "{{ url(route('getUpazilaByDistrict')) }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },

                data: {
                    district_id: district_id
                },
                method: "POST",
                success: function(data) {
                    console.log(data.options);
                    document.getElementById("permanent_upazila_id").innerHTML = data.options
                },
                error: function() {
                    alert('Something Getting Wrong! Please reload the page and try again')
                }
            });
        }


        function getParentDistrictByDivition() {
            var division_id = $("#parent_division_id").val();
            $('#parent_upazila_id').find('option').remove().end();
            $('#parent_union_id').find('option').remove().end();
            jQuery.ajax({
                url: "{{ url(route('getDistrictByDivition')) }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },

                data: {
                    division_id: division_id
                },
                method: "POST",
                success: function(data) {
                    document.getElementById("parent_district_id").innerHTML = data.options
                },
                error: function() {
                    alert('Something Getting Wrong! Please reload the page and try again')
                }
            });
        }

        function getParentUpizalaByDistrict() {
            let district_id = $("#parent_district_id").val();
            $('#parent_upazila_id').find('option').remove().end();
            jQuery.ajax({
                url: "{{ url(route('getUpazilaByDistrict')) }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },

                data: {
                    district_id: district_id
                },
                method: "POST",
                success: function(data) {
                    console.log(data.options);
                    document.getElementById("parent_upazila_id").innerHTML = data.options
                },
                error: function() {
                    alert('Something Getting Wrong! Please reload the page and try again')
                }
            });
        }


        $("#email").on('keyup', function() {
            email = $("#email").val();
            checkDuplicateEmail(email);
        });

        function checkDuplicateEmail(email) {
            var url = '<?php echo route('checkDuplicateEmailForUser'); ?>';
            $.ajax({
                type: 'POST',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    'email': email,
                    'id': '{{ $tutor->user->id }}'
                },
                success: function(data) {
                    if (data == 1) {
                        $("#errorMsg2").show();
                        // document.getElementById('errorMsg2').show();
                    } else {
                        $("#errorMsg2").hide();
                    }
                }
            });
        }
    </script>

@endsection
