@extends('frontend.layouts.app')

@section('content')
    <style>
        td{
            vertical-align: middle !important;
        }
    </style>

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
{{--                            @include('frontend.user.tutor.profile.percent')--}}

                            <div class="card">
                                <div class="card-header">
                                    My Profile <span style="float: right;color: red;" class="text-right;">
                                            {{ $tutor->tutor_code ?? '' }}</span>
                                </div>
                                <div class="card-body">

                                    <ul class="d-flex justify-content-start list-unstyled">
                                        <li class="btndashboard_title_tab {{ (menu_active('edit_account') AND request()->get('type') == 'basic') ? 'active' : '' }}" style="margin-right: 10px" data-tab="3">
                                            <a href="{{ route('edit_account') }}?type=basic" class="btn btn-outline-dark"> Update Account</a>
                                        </li>
                                        <li class="dashboard_title_tab {{ (menu_active('edit_account') AND request()->get('type') == 'academic') ? 'active' : '' }}" data-tab="3">
                                            <a href="{{ route('edit_account') }}?type=academic" class="btn btn-outline-dark"> Update Academic</a>
                                        </li>
                                    </ul>


                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card-box">

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Name</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                       {{ $tutor->user->name ?? '' }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Phone</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                       {{ $tutor->user->phone ?? '' }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">E-mail</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                       {{ $tutor->user->email ?? '' }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Whatsapp</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                       {{ $tutor->user->whatsapp ?? '' }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Gender</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                       {{ $tutor->gender ?? '' }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Home/Permanent District</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                       {{ $tutor->permanent_district->name ?? '' }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Present District</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                       {{ $tutor->district->name ?? '' }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Present Thana</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                       {{ $tutor->thana->name ?? '' }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Present Area</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                       {{ $tutor->area->name ?? '' }}
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Preferred Area</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if($tutor->areajeson)
                                                        @foreach($tutor->areajeson as $area)
                                                            {{ $area->name }} @if($loop->last == false), @endif
                                                        @endforeach
                                                            @endif
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Preferred Class</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if($tutor->interest_class)
                                                        @foreach($tutor->interest_class as $tclass_id)
                                                            {{ \App\Models\Tclass::find($tclass_id)->name ?? '' }} @if($loop->last == false), @endif
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Preferred Medium</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if($tutor->mediumjeson)
                                                        @foreach($tutor->mediumjeson as $medium)
                                                            {{ $medium->name ?? '' }} @if($loop->last == false), @endif
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Preferred Subject</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if($tutor->subjectjeson)
                                                        @foreach($tutor->subjectjeson as $subject)
                                                            {{ $subject->name ?? '' }} @if($loop->last == false), @endif
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Institute/University</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                       {{ $tutor->institution }}
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="faculty">Faculty</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{ $tutor->faculty }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="subject_name">Subject/Department</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{ $tutor->subject_name }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="sessions">Session</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{ $tutor->session }}
                                                    </div>
                                                </div>

                                                <hr class="mb-1 mt-4">


                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="hsc_institute">HSC Institute</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{ $tutor->hsc_institute }}
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="hsc_group">HSC Group</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{ $tutor->hsc_group }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="hsc_medium">HSC Medium</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{ $tutor->hsc_medium }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="hsc_result">HSC Result</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                       {{ $tutor->hsc_result }}
                                                    </div>
                                                </div>
                                                <hr class="mb-1 mt-4">
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="ssc_institute">SSC Institute</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{ $tutor->ssc_institute }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="ssc_group">SSC Group</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{ $tutor->ssc_group }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="ssc_medium">SSC Medium</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{ $tutor->ssc_medium }}
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="ssc_result">SSC Result</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{ $tutor->ssc_result }}
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="details">Tuition Experience</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{ $tutor->details }}
                                                    </div>
                                                </div>


                                                <hr class="mb-1 mt-4">
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="avatar">Profile</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <img src="{{ Auth::user()->avatar }}" class="picture-src" id="wizardPicturePreview" title="">
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="student_id_card">Student ID/Pay in slip/NID</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <img src="{{ $tutor->student_id_card }}" class="img-thumbnail img-fluid" alt="Student ID card">
                                                    </div>
                                                </div>


                                            </div> <!-- end card-box -->
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
