@extends('backend.layouts.app')
@push('brdcrmb_1_link'){{ route('guardian_or_student.index') }}?type={{ $type }} @endpush
@push('brdcrmb_1_text')/ {{ $type }} @endpush

@push('brdcrmb_2_link'){{ route('guardian_or_student.edit',$user->id) }}?type={{$type}}&user_id={{ $user->id }} @endpush
@push('brdcrmb_2_text')/ Edit @endpush
@section('content')

    <form action="{{ route('guardian_or_student.update',$user->id) }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="{{ $type }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        @method('patch')
        @csrf
        <div class="row d-flex justify-content-center">

            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title m-t-0 text-capitalize">Edit {{ $type }} account information</h4>
                    <div class="form-group">
                        <label for="userName">Full Name<span class="text-danger">*</span></label>
                        <input type="text" parsley-trigger="change" value="{{ $user->name }}" name="name" required placeholder="Enter user name"
                            class="form-control" id="userName">
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                        <input type="email" name="email" autocomplete="off" value="{{ $user->email }}" parsley-trigger="change" required
                            placeholder="Enter email" class="form-control" id="email">
                        <span id="errorMsg2" style="color:red;display: none;"><i
                                class="ace-icon fa fa-spinner fa-spin orange bigger-120"></i>
                            &nbsp;&nbsp;Email already Exits!!</span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone<span class="text-danger">*</span></label>
                        <input type="number" name="phone" value="{{ $user->phone }}" parsley-trigger="change" required placeholder="Enter Phone"
                            class="form-control" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="pass1">Password</label>
                        <input id="pass1" type="password" name="password" placeholder="Password"
                            class="form-control">
                        <small class="text-muted"><i>If not provided, password not change.</i></small>
                    </div>
                    <div class="form-group">
                        <label>Status</label>

                        <select class="form-control" name="status">
                            <option {{ $user->status=='1' ? 'selected':'' }} value="1">Active</option>
                            <option {{ $user->status=='0' ? 'selected':'' }} value="0">Inavtive</option>
                        </select>

                    </div>
                    <div class="form-group row">
                        <div class="col-8 offset-4">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Update
                            </button>
                            <a href="{{ route('guardian_or_student.index') }}?type={{ $type }})" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </a>
                        </div>
                    </div>

                </div>

            </div> <!-- end col -->

        </div>
    </form>
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>

    <script src="{{ asset('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('backend/bootstrap-toastr/toastr.min.js') }}"></script>
    <script type="text/javascript">
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        </script>
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                var msg = '{{ $error }}';
                toastr.info(msg);
            </script>
        @endforeach
    @endif
    @if(session('fail'))
        <script>
            var msg = '{{ session('fail') }}';

            toastr.error(msg);
        </script>
    @endif
    @if(session('success'))
        <script>
            var msg = '{{ session('success') }}';









            toastr.success(msg);
        </script>
    @endif

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
                    'email': email,
                    'id':'{{ $user->id }}'
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
