@extends('backend.layouts.app')
@push('brdcrmb_1_link'){{ route('guardian_or_student.index') }}?type={{ $type }} @endpush
@push('brdcrmb_1_text')/ {{ $type }} @endpush

@push('brdcrmb_2_link'){{ route('guardian_or_student.create') }}?type={{ $type }} @endpush
@push('brdcrmb_2_text')/ Create @endpush

@section('content')
    <form action="{{ route('guardian_or_student.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type" value="{{ $type }}">
        <div class="row d-flex justify-content-center">

            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title m-t-0 text-capitalize">{{ $type }} account information</h4>
                    <div class="form-group">
                        <label for="userName">Full Name<span class="text-danger">*</span></label>
                        <input type="text" name="name" required placeholder="Enter {{ $type }} name"
                            class="form-control" id="userName">
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                        <input type="email" name="email" autocomplete="off" value="" required
                            placeholder="Enter {{ $type }} email" class="form-control" id="email">
                        <span id="errorMsg2" style="color:red;display: none;"><i
                                class="ace-icon fa fa-spinner fa-spin orange bigger-120"></i>
                            &nbsp;&nbsp;Email already Exits!!</span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone<span class="text-danger">*</span></label>
                        <input type="number" name="phone" required placeholder="Enter {{ $type }} Phone"
                            class="form-control" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="pass1">Password<span class="text-danger">*</span></label>
                        <input id="pass1" type="password" name="password" placeholder="Password" required
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>

                        <select class="form-control" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inavtive</option>
                        </select>

                    </div>
                    <div class="form-group row">
                        <div class="col-8 offset-4">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Save
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->

        </div>
    </form>
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>

    <script src="{{ asset('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.multipleSelect').select2();
            $('#email').attr('autocomplete', 'off');
        });
    </script>
    <script>
        $('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });

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
                    'email': email
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
