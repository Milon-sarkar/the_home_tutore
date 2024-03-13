@extends('backend.layouts.app')

@section('content')

    <form action="{{ route('tutors.update',$tutor->id) }}" method="POST" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card-box">
                    <h4 class="header-title m-t-0">Basic Section <span style="float: right;color: red;"
                            class="text-right;">
                            {{ $tutor->tutor_code }}</span></h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userName">Division<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="division_id" id="division_id"
                                    onchange="getDistrictByDivition()">
                                    <option value="">Select</option>
                                    @foreach ($divitions as $divition)
                                        <option  {{ $divition->id ==$tutor->division_id ? 'selected': '' }} value="{{ $divition->id }}">{{ $divition->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="permanent_district_id">Home District<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="permanent_district_id" id="permanent_district_id">
                                    @if(!empty($tutor->permanent_district_id))
                                    @foreach ($districts as $district)
                                        <option  {{ $district->id ==$tutor->permanent_district_id ? 'selected': '' }} value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dristrict">District<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="district_id" id="district_id"
                                    onchange="getAreaByDistrict()">
                                    @if(!empty($tutor->district_id))
                                    @foreach ($districts as $district)
                                        <option  {{ $district->id ==$tutor->district_id ? 'selected': '' }} value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userName">Area<span class="text-danger">*</span></label>
                                <select class="form-control select2" id="area_id" name="area_id">
                                    @if(!empty($tutor->area_id))
                                    @foreach ($areas as $area)
                                        <option  {{ $area->id ==$tutor->area_id ? 'selected': '' }} value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="phone">Address<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" id="" rows="5">{{ $tutor->address }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="userName">Gender<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="gender">
                                    <option value="">Select</option>
                                    <option {{ $tutor->gender =='Male' ? 'selected':'' }} value="Male">Male</option>
                                    <option {{ $tutor->gender  =='Female' ? 'selected':'' }} value="Female">Female</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="phone">Date Of birth<span class="text-danger">*</span></label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="date_of_birth" value="{{ $tutor->date_of_birth ? $tutor->date_of_birth:''  }}"
                                            placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pass1">Institution<span class="text-danger"></span></label>
                                <input id="institution" type="text" value="{{ $tutor->institution }}" placeholder="Institution" name="institution"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="dristrict">Subject<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="subject_id" id="subject_id">
                                    @foreach ($subjects as $subject)
                                        <option {{ $tutor->subject_id == $subject->id ? 'selected':'' }} value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="facebook">Facebook Id<span class="text-danger"></span></label>
                                <input id="facebook" value="{{ $tutor->facebook_link }}" type="text" placeholder="Facebook ID Link" name="facebook_link"
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
                                <label for="userName">Interested Area<span class="text-danger">*</span></label>
                                <select class="form-control multipleSelect" multiple="multiple" name="interest_location[]">
                                    <option value="">Select Area</option>
                                    @foreach ($areas as $area)
                                    <option  {{is_array($tutor->interest_location) && in_array($area->id, $tutor->interest_location) ? 'selected' : '' }}
                                         value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dristrict">Interested Medium<span class="text-danger">*</span></label>
                                <select class="form-control multipleSelect" multiple="multiple" name="interest_medium[]">
                                    <option value="">Select</option>
                                    @foreach ($mediums as $medium)
                                        <option  {{is_array($tutor->interest_medium) && in_array($medium->id, $tutor->interest_medium) ? 'selected' : '' }}
                                         value="{{ $medium->id }}">{{ $medium->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="interest_class">Interested Class<span class="text-danger">*</span></label>
                                <select class="form-control  multipleSelect" name="interest_class[]" multiple="multiple">
                                    <option value="">Select</option>
                                    @foreach ($tclass as $tclas)
                                        <option {{is_array($tutor->interest_class) && in_array($tclas->id, $tutor->interest_class) ? 'selected' : '' }}
                                         value="{{ $tclas->id }}">{{ $tclas->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="interest_gender">Interested Gender<span class="text-danger">*</span></label>
                                <select class="form-control  multipleSelect" name="interest_gender[]" multiple="multiple">
                                    <option value="">Select</option>
                                    <option {{is_array($tutor->interest_gender) && in_array('Male', $tutor->interest_gender) ? 'selected' : '' }} value="Male">Male</option>
                                    <option {{is_array($tutor->interest_gender) && in_array('Female', $tutor->interest_gender) ? 'selected' : '' }} value="Female">Female</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="salary">Interested Salary<span class="text-danger">*</span></label>
                                <input id="salary" type="text" placeholder="Salary" value="{{ $tutor->salary }}" name="salary" required
                                    class="form-control">
                            </div>

                        </div>
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label for="userName">Interested Subject</label>
                                <select class="form-control multipleSelect" multiple="multiple" name="interest_sub[]">
                                    <option value="">Select</option>
                                    @foreach ($subjects as $subject)
                                        <option {{is_array($tutor->interest_sub) && in_array($subject->id, $tutor->interest_sub) ? 'selected' : '' }}
                                         value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userName">Interested Time</label>
                                <select class="form-control multipleSelect" name="interest_time[]" multiple="multiple">
                                    <option value="">Select</option>
                                    @foreach ($timelys as $timely)
                                        <option {{is_array($tutor->interest_time) && in_array($timely->id, $tutor->interest_time) ? 'selected' : '' }}
                                        value="{{ $timely->id }}">{{ $timely->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userName">Interested Weekly</label>
                                <select class="form-control multipleSelect" name="weekly[]" multiple="multiple">
                                    <option value="">Select</option>
                                    @foreach ($weeklys as $weekly)
                                        <option  {{is_array($tutor->weekly) && in_array($weekly->id, $tutor->weekly) ? 'selected' : '' }}
                                        value="{{ $weekly->id }}">{{ $weekly->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userName">Member Type</label>
                                <select class="form-control" name="member_type">
                                    <option value="">Select</option>
                                    <option {{ $tutor->member_type =='Normal'? 'selected':'' }} value="Normal">Normal</option>
                                    <option {{ $tutor->member_type =='Premium'? 'selected':'' }} value="Premium">Premium</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div> <!-- end card-box -->
            </div>
            <!-- end col -->

            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title m-t-0">Login Section</h4>
                    <div class="form-group">
                        <label for="userName">Full Name<span class="text-danger">*</span></label>
                        <input type="text" parsley-trigger="change" value="{{ $tutor->user->name }}" name="name" required placeholder="Enter user name"
                            class="form-control" id="userName">
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                        <input type="email" name="email" autocomplete="off" value="{{ $tutor->user->email }}" parsley-trigger="change" required
                            placeholder="Enter email" class="form-control" id="email">
                        <span id="errorMsg2" style="color:red;display: none;"><i
                                class="ace-icon fa fa-spinner fa-spin orange bigger-120"></i>
                            &nbsp;&nbsp;Email already Exits!!</span>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone<span class="text-danger">*</span></label>
                        <input type="number" name="phone" value="{{ $tutor->user->phone }}" parsley-trigger="change" required placeholder="Enter Phone"
                            class="form-control" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="pass1">Password<span class="text-danger">*</span></label>
                        <input id="pass1" type="password" name="password" placeholder="Password"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>

                        <select class="form-control" name="status">
                            <option {{ $tutor->status=='1' ? 'selected':'' }} value="1">Active</option>
                            <option {{ $tutor->status=='0' ? 'selected':'' }} value="0">Inavtive</option>
                        </select>

                    </div>

                </div>
                <div class="card-box">
                    <h4 class="header-title m-t-0">Photo Form</h4>
                    <div class="form-group">
                        <label class="">Profile Picture</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                @if(!empty($tutor->user->avatar))
                                <img style="width: 50px;height:50px" src="{{ $tutor->user->avatar }}" alt="">
                                @endif
                                <button type="button" class="btn btn-secondary btn-file">
                                    <input type="file" name="avatar" class="btn-secondary" />
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">NID Photo</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                @if(!empty($tutor->user->nid))
                                <img style="width: 50px;height:50px" src="{{ $tutor->user->nid }}" alt="">
                                @endif
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
                        update
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
                    'id':'{{ $tutor->user->id }}'
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
