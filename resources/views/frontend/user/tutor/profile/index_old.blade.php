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
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td colspan="3" class="bg-light"><h3>Personal Information</h3></td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light" style="width: 25%">Name</td>
                                                <td>{{ Auth::user()->name }}</td>
                                                <td rowspan="8" style="width: 25%">
                                                    <div class="card">
                                                        <div class="card-header">Avatar</div>
                                                        <img src="{{ Auth::user()->avatar }}" class="picture-src"
                                                             id="wizardPicturePreview" title="">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">E-mail</td>
                                                <td>{{ Auth::user()->email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">Phone</td>
                                                <td>{{ Auth::user()->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">Gender</td>
                                                <td>{{ $tutor->gender }}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">Date of Birth</td>
                                                <td>{{ $tutor->date_of_birth }}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">Whatsapp</td>
                                                <td>{{ Auth::user()->whatsapp }}</td>
                                            </tr>

                                            <tr>
                                                <td class="bg-light">Present Address</td>
                                                <td>{{ $tutor->address }}, {{ $tutor->upazila->name ?? '' }}, {{ $tutor->district->name ?? ''}}, {{ $tutor->division->name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">Parmanent Address</td>
                                                <td>{{ $tutor->permanent_address }}, {{ $tutor->permanent_upazila->name ?? '' }}, {{ $tutor->permanent_district->name ?? ''}}, {{ $tutor->permanent_division->name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">NID</td>
                                                <td>{{ Auth::user()->nid_number }}</td>
                                                <td rowspan="4">
                                                    <div class="card">
                                                        <div class="card-header">NID Photo</div>
                                                        <img src="{{ Auth::user()->nid }}" alt="NID Photo" class="img-fluid img-thumbnail">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">Father's Information</td>
                                                <td>
                                                    {{ $tutor->father_name }}<br>
                                                    {{ $tutor->father_number }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">Mother's Information</td>
                                                <td>
                                                    {{ $tutor->mother_name }}<br>
                                                    {{ $tutor->mother_number }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">Parent Address</td>
                                                <td>
                                                    {{ $tutor->parent_address }} , {{ $tutor->parent_upazila->name ?? '' }}, {{ $tutor->parent_district->name ?? '' }}, {{ $tutor->parent_division->name ?? '' }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr class="bg-light">
                                                <td colspan="3"><h3>Academic Information</h3></td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light" style="width: 25%;">Institution</td>
                                                <td>{{ $tutor->institution }}</td>
                                                <td rowspan="5" style="width: 25%; height: 200px;">
                                                    <div class="card">
                                                        <div class="card-header">Student ID Card</div>
                                                        <img src="{{ $tutor->student_id_card }}" class="img-thumbnail img-fluid" alt="Student ID card">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">Subject</td>
                                                <td>{{ $tutor->subject->name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">Session</td>
                                                <td>{{ $tutor->session ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">Year of Study</td>
                                                <td>{{ $tutor->year_of_study ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">Hall/Hostel</td>
                                                <td>{{ $tutor->hall ?? '' }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-responsive" style="min-width: 500px;">
                                            <tr>
                                                <td colspan="5" class="bg-light"><h3>Academic Qualification</h3></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 25%" class="bg-light">Hons. / Fazil / Degree or Equivalent</td>
                                                <td>
                                                    <div class="form-group">
                                                        <strong>Subject</strong> <br>{{ $tutor->hons_subject }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <strong>Last passed result</strong> <br>{{ $tutor->hons_last_passed_result }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <strong>Year</strong><br>{{ $tutor->hons_last_passed_year }}
                                                    </div>
                                                </td>
                                                <td style="width: 15%">
                                                    <img src="{{ marksheet($tutor->hons_marksheet) }}" alt="marksheet">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">HSC / Alim / A-level or Equivalent</td>
                                                <td>
                                                    <div class="form-group">
                                                        <strong>Group</strong><br>{{ $tutor->hsc_group }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <strong>Result</strong><br>{{ $tutor->hsc_result }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <strong>Year</strong><br>{{ $tutor->hsc_year }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="{{ marksheet($tutor->hsc_marksheet) }}" alt="marksheet">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light">SSC / Dhakil / O-level or Equivalent</td>
                                                <td>
                                                    <div class="form-group">
                                                        <strong>Group</strong><br>{{ $tutor->ssc_group }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <strong>Result</strong><br>{{ $tutor->ssc_result }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <strong>Year</strong><br>{{ $tutor->ssc_year }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <img src="{{ marksheet($tutor->ssc_marksheet) }}" alt="marksheet">
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="table-responsive">

                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td colspan="2" class="bg-light"><h3>Interested Tuition Requirements</h3></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-light" style="width: 25%">Area</td>
                                                        <td>
                                                            @foreach ($areas as $area)
                                                                @if(is_array($tutor->interest_location) && in_array($area->id, $tutor->interest_location))
                                                                    {{ $area->name }},
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-light">Medium</td>
                                                        <td>
                                                            @foreach ($mediums as $medium)
                                                                @if(is_array($tutor->interest_medium) && in_array($medium->id, $tutor->interest_medium))
                                                                    {{ $medium->name }},
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-light">Class</td>
                                                        <td>
                                                            @foreach ($tclass as $tclas)
                                                                @if( is_array($tutor->interest_class) && in_array($tclas->id, $tutor->interest_class))
                                                                    {{ $tclas->name }},
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-light">Gender</td>
                                                        <td>
                                                            @if($tutor->interest_gender)
                                                                @foreach ($tutor->interest_gender as $gender)
                                                                    {{ $gender }},
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-light">Interested Subject</td>
                                                        <td>
                                                            @foreach ($subjects as $subject)
                                                                @if(is_array($tutor->interest_sub) && in_array($subject->id, $tutor->interest_sub))
                                                                    {{ $subject->name }},
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-light">Interested Time</td>
                                                        <td>
                                                            @foreach ($timelys as $timely)
                                                                @if(is_array($tutor->interest_time) && in_array($timely->id, $tutor->interest_time))
                                                                    {{ $timely->name }},
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-light">Interested Weekly</td>
                                                        <td>
                                                            @foreach ($weeklys as $weekly)
                                                                @if(is_array($tutor->weekly) && in_array($weekly->id, $tutor->weekly))
                                                                    {{ $weekly->name }},
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-light">Salary</td>
                                                        <td>{{ $tutor->salary ?? '0' }}</td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td colspan="2" class="bg-light"><h3>Experience Details</h3></td>
                                                    </tr>
                                                    <tr>
                                                        <td>{!! $tutor->details !!}</td>
                                                    </tr>
                                                </table>
                                            </div>

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
