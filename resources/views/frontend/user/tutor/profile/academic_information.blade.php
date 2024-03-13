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
                                        <input type="hidden" name="profile_information_type" value="academic_information">
                                        @csrf

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card-box mt-4">
                                                    <h4 class="header-title m-t-0">Academic Information</h4>
                                                    <div class="row">
                                                        <div class="col-lg-6 mt-3">
                                                            <div class="form-group">
                                                                <label for="subject_name">Subject/Department</label>
                                                                <input class="form-control select2" name="subject_name" value="{{ $tutor->subject_name }}" id="subject_name">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mt-3">
                                                            <div class="form-group">
                                                                <label for="pass1">Institution<span
                                                                        class="text-danger"></span></label>
                                                                <input id="institution" type="text"
                                                                       value="{{ $tutor->institution }}"
                                                                       placeholder="Institution" name="institution"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mt-3">
                                                            <div class="form-group">
                                                                <label for="session">Session</label>
                                                                <input id="session" type="text"
                                                                       value="{{ $tutor->session }}"
                                                                       placeholder="Session" name="sessions"
                                                                       class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mt-3">
                                                            <div class="form-group">
                                                                <label for="phone">HSC Group</label>
                                                                <input type="text" class="form-control" name="hsc_group" id="" value="{{ $tutor->hsc_group }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mt-3">
                                                            <div class="form-group">
                                                                <label for="phone">SSC Group</label>
                                                                <input type="text" class="form-control" name="ssc_group" id="" value="{{ $tutor->ssc_group }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mt-3">
                                                            <div class="form-group">
                                                                <label for="phone">SSC Medium</label>
                                                                <input type="text" class="form-control" name="ssc_medium" id="" value="{{ $tutor->ssc_medium }}">
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="row">
                                                        <div class="col-lg-6 mt-3">
                                                            <div class="form-group">
                                                                <label for="year_of_study">Year of Study</label>
                                                                <input id="year_of_study" type="text"
                                                                       value="{{ $tutor->year_of_study }}"
                                                                       placeholder="Year of Study" name="year_of_study"
                                                                       class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mt-3">
                                                            <div class="form-group">
                                                                <label for="hall">Hall/Hostel</label>
                                                                <input id="hall" type="text"
                                                                       value="{{ $tutor->hall }}"
                                                                       placeholder="Hall/Hostel" name="hall"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mt-3">
                                                            <div class="form-group">
                                                                <label for="hall">Student ID Card <small>(PDF, jpg, PNG)</small></label>
                                                                <div class="row">
                                                                    <div class="{{ $tutor->student_id_card ? 'col-md-6' : 'col-md-12' }}">
                                                                        <input type="file" name="student_id_card" class="form-control" accept=".pdf, .jpg, .png">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <img src="{{ $tutor->student_id_card }}" alt="STUDENT ID">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end card-box -->
                                            </div>


                                            <div class="form-group text-center pt-3">
                                                <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">Save & Continue</button>
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
