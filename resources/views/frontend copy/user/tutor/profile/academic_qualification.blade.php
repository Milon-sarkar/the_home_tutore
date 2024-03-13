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
                                    <form id="kt_ecommerce_settings_general_form" class="form" action="{{ route('tutor_profile_update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="profile_information_type" value="academic_qualification">



                                        <div class="row">
                                            <div class="card-box mt-4 ">
                                                <h4 class="header-title">Academic Qualification </h4>
                                                <div class="table-responsive">
                                                <table class="table table-bordered table-responsive" style="min-width: 500px;">
                                                    <tr>
                                                        <td style="vertical-align: middle; width: 20%" class="bg-light">Hons. / Fazil / Degree or Equivalent</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="phone">Subject</label>
                                                                <input type="text" class="form-control" name="hons_subject" id="" value="{{ $tutor->hons_subject }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="phone">Last passed result</label>
                                                                <input type="text" class="form-control" name="hons_last_passed_result" id="" value="{{ $tutor->hons_last_passed_result }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="phone">Year</label>
                                                                <input type="text" class="form-control" name="hons_last_passed_year" id="" value="{{ $tutor->hons_last_passed_year }}">
                                                            </div>
                                                        </td>
                                                        <td style="width: 25%">
                                                            <div class="form-group">
                                                                <label for="hons_marksheet">Mark Sheet (optional)</label>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input type="file" name="hons_marksheet" class="form-control" accept=".pdf, .jpg, .png">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <img src="{{ marksheet($tutor->hons_marksheet) }}" alt="marksheet">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle;" class="bg-light">HSC / Alim / A-level or Equivalent</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="phone">Group</label>
                                                                <input type="text" class="form-control" name="hsc_group" id="" value="{{ $tutor->hsc_group }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="phone">Result</label>
                                                                <input type="text" class="form-control" name="hsc_result" id="" value="{{ $tutor->hsc_result }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="phone">Year</label>
                                                                <input type="text" class="form-control" name="hsc_year" id="" value="{{ $tutor->hsc_year }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="hsc_marksheet">Mark Sheet (optional)</label>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input type="file" name="hsc_marksheet" class="form-control" accept=".pdf, .jpg, .png">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <img src="{{ marksheet($tutor->hsc_marksheet) }}" alt="marksheet">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: middle;" class="bg-light">SSC / Dhakil / O-level or Equivalent</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="phone">Group</label>
                                                                <input type="text" class="form-control" name="ssc_group" id="" value="{{ $tutor->ssc_group }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="phone">Result</label>
                                                                <input type="text" class="form-control" name="ssc_result" id="" value="{{ $tutor->ssc_result }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="phone">Year</label>
                                                                <input type="text" class="form-control" name="ssc_year" id="" value="{{ $tutor->ssc_year }}">
                                                            </div>
                                                        </td>
                                                        <td>

                                                            <div class="form-group">
                                                                <label for="ssc_marksheet">Mark Sheet (optional)</label>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input type="file" name="ssc_marksheet" class="form-control" accept=".pdf, .jpg, .png">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <img src="{{ marksheet($tutor->ssc_marksheet) }}" alt="marksheet">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                                </div>
                                            </div>


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
