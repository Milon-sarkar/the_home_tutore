@extends('frontend.layouts.app')

@section('content')

    <!-- user dashboard start -->
    <div class="dashboard_wrapper pt-md-4 pt-2" id="myTab3">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('frontend.user.tutor.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="content_wrapper">

                        <div class="order_wraps">
                            @include('frontend.user.tutor.profile.percent')
                            <div class="card">
                                <div class="card-header">
                                    My Profile <span style="float: right;color: red;" class="text-right;">
                                            {{ $tutor->tutor_code ?? '' }}</span>
                                </div>
                                <div class="card-body">
                                    <form id="kt_ecommerce_settings_general_form" class="form"
                                          action="{{ route('tutor_profile_update', Auth::user()->id) }}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="profile_information_type" value="interested_requirement">

                                        <div class="row">
                                            <div class="col-lg-12">

                                                <div class="card-box mt-4">
                                                    <h4 class="header-title">Interested Section </h4>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mt-3">
                                                                <label for="userName">Interested Location</label>
                                                                <select class="form-control multipleSelect select2"
                                                                        multiple="multiple" name="interest_location[]">
                                                                    <option>Select Location</option>
                                                                    @foreach ($areas as $area)
                                                                        <option
                                                                            {{ is_array($tutor->interest_location) && in_array($area->id, $tutor->interest_location) ? 'selected' : '' }}
                                                                            value="{{ $area->id }}">
                                                                            {{ $area->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label for="dristrict">Interested Medium</label>
                                                                <select class="form-control multipleSelect select2"
                                                                        multiple="multiple" name="interest_medium[]">
                                                                    <option>Select</option>
                                                                    @foreach ($mediums as $medium)
                                                                        <option
                                                                            {{ is_array($tutor->interest_medium) && in_array($medium->id, $tutor->interest_medium) ? 'selected' : '' }}
                                                                            value="{{ $medium->id }}">
                                                                            {{ $medium->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <label for="interest_class">Interested Class</label>
                                                                <select class="form-control  multipleSelect select2"
                                                                        name="interest_class[]" multiple="multiple">
                                                                    <option>Select</option>
                                                                    @foreach ($tclass as $tclas)
                                                                        <option
                                                                            {{ is_array($tutor->interest_class) && in_array($tclas->id, $tutor->interest_class) ? 'selected' : '' }}
                                                                            value="{{ $tclas->id }}">
                                                                            {{ $tclas->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label for="interest_gender">Interested Gender</label>
                                                                <select class="form-control  multipleSelect select2"
                                                                        name="interest_gender[]" multiple="multiple">
                                                                    <option>Select</option>
                                                                    <option
                                                                        {{ is_array($tutor->interest_gender) && in_array('Male', $tutor->interest_gender) ? 'selected' : '' }}
                                                                        value="Male">Male</option>
                                                                    <option
                                                                        {{ is_array($tutor->interest_gender) && in_array('Female', $tutor->interest_gender) ? 'selected' : '' }}
                                                                        value="Female">Female</option>

                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-6">

                                                            <div class="form-group mt-3">
                                                                <label for="userName">Interested Subject</label>
                                                                <select class="form-control multipleSelect select2"
                                                                        multiple="multiple" name="interest_sub[]">
                                                                    <option>Select</option>
                                                                    @foreach ($subjects as $subject)
                                                                        <option
                                                                            {{ is_array($tutor->interest_sub) && in_array($subject->id, $tutor->interest_sub) ? 'selected' : '' }}
                                                                            value="{{ $subject->id }}">
                                                                            {{ $subject->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label for="userName">Interested Time</label>
                                                                <select class="form-control multipleSelect select2"
                                                                        name="interest_time[]" multiple="multiple">
                                                                    <option>Select</option>
                                                                    @foreach ($timelys as $timely)
                                                                        <option
                                                                            {{ is_array($tutor->interest_time) && in_array($timely->id, $tutor->interest_time) ? 'selected' : '' }}
                                                                            value="{{ $timely->id }}">
                                                                            {{ $timely->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <label for="userName">Interested Weekly</label>
                                                                <select class="form-control multipleSelect select2"
                                                                        name="weekly[]" multiple="multiple">
                                                                    <option>Select</option>
                                                                    @foreach ($weeklys as $weekly)
                                                                        <option
                                                                            {{ is_array($tutor->weekly) && in_array($weekly->id, $tutor->weekly) ? 'selected' : '' }}
                                                                            value="{{ $weekly->id }}">
                                                                            {{ $weekly->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group mt-3">
                                                                <label for="salary">Interested Salary (If You input
                                                                    no value,it will be Nagotiable )<span
                                                                        class="text-danger">*</span></label>
                                                                <input id="salary" type="text"
                                                                       placeholder="Salary"
                                                                       value="{{ $tutor->salary ?? '0' }}"
                                                                       name="salary" required class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end card-box -->
                                            </div>
                                            <!-- end col -->


                                            <div class="form-group text-center pt-3">
                                                <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">Update</button>
                                            </div>
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
