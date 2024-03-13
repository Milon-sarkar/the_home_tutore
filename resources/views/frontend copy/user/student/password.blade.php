@extends('frontend.layouts.app')

@section('content')

    <!-- user dashboard start -->
    <div class="dashboard_wrapper" id="myTab3">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidber_menu">
                        @include('frontend.user.student.sidebar')
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="content_wrapper">

                        <div class="order_wraps">
                            <div class="card">
                                <div class="card-header">Password Change</div>
                                <div class="card-body">
                                    <form id="kt_ecommerce_settings_general_form" class="form"
                                          action="{{ route('student_pasword_change_store', Auth::user()->id) }}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf

                                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

                                            <div class="col">
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                        <span class="required">Old Password</span>
                                                    </label>
                                                    <div class="w-100">
                                                        <input type="password" class="form-control form-control-solid"
                                                               name="old_password" value="" />
                                                    </div>
                                                    @error('old_password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                            <div class="col">
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                        <span class="required">New Password</span>
                                                    </label>
                                                    <div class="w-100">
                                                        <input type="password" class="form-control form-control-solid"
                                                               name="password" value="" />
                                                    </div>
                                                    @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                        <span class="required">Confirm Password</span>
                                                    </label>
                                                    <div class="w-100">
                                                        <input type="password" class="form-control form-control-solid"
                                                               name="password_confirmation" value="" />
                                                    </div>
                                                    @error('password_confirmation')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group text-center pt-3">
                                                <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">Change</button>
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
                    'id': '{{ auth()->id() }}'
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
