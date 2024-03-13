@extends('backend.layouts.app')

@section('content')
    <form action="{{ route('tutors.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card-box">
                    <h4 class="header-title m-t-0">Basic Section <span style="float: right;color: red;"
                            class="text-right;">
                            {{ $tutor_code }}</span></h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userName">Division<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="division_id" id="division_id"
                                    onchange="getDistrictByDivition()">
                                    <option>Select</option>
                                    @foreach ($divitions as $divition)
                                        <option value="{{ $divition->id }}">{{ $divition->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dristrict">District<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="district_id" id="district_id"
                                    onchange="getAreaByDistrict()">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userName">Area<span class="text-danger">*</span></label>
                                <select class="form-control select2" id="area_id" name="area_id">
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="phone">Address<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" id="" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userName">Gender<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="gender">
                                    <option>Select</option>
                                    <option value="male">Male</option>
                                    <option value="Female">Female</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="phone">Date Of birth</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="date_of_birth"
                                            placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pass1">Institution<span class="text-danger"></span></label>
                                <input id="institution" type="text" placeholder="Institution" name="institution" required
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="dristrict">Subject<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="subject_id" id="subject_id">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="facebook">Facebook Id</label>
                                <input id="facebook" type="text" placeholder="Facebook ID Link" name="facebook_link"
                                     class="form-control">
                            </div>


                        </div>
                    </div>
                </div> <!-- end card-box -->
                <div class="card-box">
                    <h4 class="header-title m-t-0">Interested Section </h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userName">Interested Area</label>
                                <select class="form-control multipleSelect" multiple="multiple" name="interest_location[]">
                                    <option>Select Area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dristrict">Interested Medium</label>
                                <select class="form-control multipleSelect" multiple="multiple" name="interest_medium[]">
                                    <option>Select</option>
                                    @foreach ($mediums as $medium)
                                        <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="interest_class">Interested Class</label>
                                <select class="form-control  multipleSelect" name="interest_class[]" multiple="multiple">
                                    <option>Select</option>
                                    @foreach ($tclass as $tclas)
                                        <option value="{{ $tclas->id }}">{{ $tclas->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="interest_gender">Interested Gender</label>
                                <select class="form-control  multipleSelect" name="interest_gender[]" multiple="multiple">
                                    <option>Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="salary">Interested Salary<span class="text-danger">*</span></label>
                                <input id="salary" type="text" placeholder="Salary" name="salary" required
                                    class="form-control">
                            </div>

                        </div>
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label for="userName">Interested Subject<span class="text-danger">*</span></label>
                                <select class="form-control multipleSelect" multiple="multiple" name="interest_sub[]">
                                    <option>Select</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userName">Interested Time<span class="text-danger">*</span></label>
                                <select class="form-control multipleSelect" name="interest_time[]" multiple="multiple">
                                    <option>Select</option>
                                    @foreach ($timelys as $timely)
                                        <option value="{{ $timely->id }}">{{ $timely->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userName">Interested Weekly<span class="text-danger">*</span></label>
                                <select class="form-control multipleSelect" name="weekly[]" multiple="multiple">
                                    <option>Select</option>
                                    @foreach ($weeklys as $weekly)
                                        <option value="{{ $weekly->id }}">{{ $weekly->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userName">Member Type<span class="text-danger">*</span></label>
                                <select class="form-control" name="member_type">
                                    <option>Select</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Premium">Premium</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div> <!-- end card-box -->
                  {{-- tutor infor --}}
                <div class="card-box">
                    <h4 class="header-title m-t-0">Tutor Info </h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userName">Home District<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="division_id" id="division_id"
                                    onchange="getDistrictByDivition()">
                                    <option>Select</option>
                                    @foreach ($divitions as $divition)
                                        <option value="{{ $divition->id }}">{{ $divition->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pass1">HSC College name
                                    <span class="text-danger"></span></label>
                                <input id="institution" type="text" placeholder="Institution" name="hsc_institute" required
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="pass1">HSC Result
                                    <span class="text-danger"></span></label>
                                <input id="institution" type="text" placeholder="hsc_result" name="hsc_result" required
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="pass1">SSC School name
                                    <span class="text-danger"></span></label>
                                <input id="institution" type="text" placeholder="Institution" name="ssc_institute" required
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="pass1">SSC Result
                                    <span class="text-danger"></span></label>
                                <input id="institution" type="text" placeholder="hsc_result" name="ssc_result" required
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="dristrict">prefered Medium</label>
                                <select class="form-control multipleSelect" multiple="multiple" name="interest_medium[]">
                                    <option>Select</option>
                                    @foreach ($mediums as $medium)
                                        <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="interest_class">prefered Class</label>
                                <select class="form-control  multipleSelect" name="interest_class[]" multiple="multiple">
                                    <option>Select</option>
                                    @foreach ($tclass as $tclas)
                                        <option value="{{ $tclas->id }}">{{ $tclas->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userName">prefered Area</label>
                                <select class="form-control multipleSelect" multiple="multiple" name="interest_location[]">
                                    <option>Select Area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>    
                    
                       
                    </div>
                </div>
                {{-- end tutor info --}}
            </div>
            <!-- end col -->

            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title m-t-0">Login Section</h4>
                    <div class="form-group">
                        <label for="userName">Full Name<span class="text-danger">*</span></label>
                        <input type="text" parsley-trigger="change" name="name" required placeholder="Enter user name"
                            class="form-control" id="userName">
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                        <input type="email" name="email" autocomplete="off" value="" parsley-trigger="change" required
                            placeholder="Enter email" class="form-control" id="email">
                        <span id="errorMsg2" style="color:red;display: none;"><i
                                class="ace-icon fa fa-spinner fa-spin orange bigger-120"></i>
                            &nbsp;&nbsp;Email already Exits!!</span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone<span class="text-danger">*</span></label>
                        <input type="number" name="phone" parsley-trigger="change" required placeholder="Enter Phone"
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

                </div>
                <div class="card-box">
                    <h4 class="header-title m-t-0">Photo Form</h4>
                    <div class="form-group row">
                        <label class="">Profile Picture</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <button type="button" class="btn btn-secondary btn-file">
                                    <input type="file" name="avatar" class="btn-secondary" />
                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="">NID Photo</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <button type="button" class="btn btn-secondary btn-file">
                                    <input type="file" name="nid" class="btn-secondary" />
                                </button>

                            </div>
                        </div>
                    </div>


                </div>
            </div> <!-- end col -->
            <div class="form-group row">
                <div class="col-8 offset-4">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                        Register
                    </button>
                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                        Cancel
                    </button>
                </div>
            </div>
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
