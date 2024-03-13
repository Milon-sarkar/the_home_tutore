@extends('frontend.layouts.app')

@section('content')
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
                                    <div class="card-header">
                                        Create Tuition Post <span style="float: right;color: red;" class="text-right;">
                                            <a class="btn btn-info" href="{{ route('my_tuition_post') }}">My Tuition List</a></span>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('tuition_store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card-box">
                                                        <h4 class="header-title mb-0">Tuition Information <span style="float: right;color: red;" class="text-right;">{{ $code }}</span></h4>
                                                        <div class="row">
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="duration">Name/Title<span
                                                                            class="text-danger">*</span></label>
                                                                    <input id="title" type="text" placeholder="Title"
                                                                        name="title" value="{{ old('title') }}"
                                                                        required class="form-control">
                                                                    @error('title')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="interest_class">Class</label>
                                                                    <select class="form-control  multipleSelect"
                                                                            name="tclass[]" multiple="multiple">
                                                                        <option value="">Select</option>
                                                                        @foreach ($tclass as $tclas)
                                                                            <option value="{{ $tclas->id }}">
                                                                                {{ $tclas->name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                    @error('tclass')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                            </div>

                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="dristrict"> Medium</label>
                                                                    <select class="form-control multipleSelect"
                                                                            multiple="multiple" name="interest_medium[]">
                                                                        <option value="">Select</option>
                                                                        @foreach ($mediums as $medium)
                                                                            <option value="{{ $medium->id }}">
                                                                                {{ $medium->name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                    @error('interest_medium')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="userName">Subject</label>
                                                                    <select class="form-control multipleSelect"
                                                                            multiple="multiple" name="subject_ids[]">
                                                                        <option value="">Select</option>
                                                                        @foreach ($subjects as $subject)
                                                                            <option value="{{ $subject->id }}">
                                                                                {{ $subject->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('subject_ids')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="student_number">Number Of Student</label>
                                                                    <input id="student_number" type="number"
                                                                           placeholder="Number Of Student"
                                                                           name="student_number"
                                                                           value="{{ old('student_number') ?? 1 }}"
                                                                           required class="form-control">
                                                                    @error('student_number')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                            </div>

                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="userName">Gender </label>
                                                                    <select class="form-control multipleSelect"
                                                                            name="gender[]" multiple="multiple">
                                                                        <option value="">Select</option>
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    </select>
                                                                    @error('gender')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 mt-3">

                                                                <div class="form-group">
                                                                    <label for="phone">Contact Number <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                           name="contact_phone" required
                                                                           value="{{ old('contact_phone') ?? auth()->user()->phone }}"
                                                                           placeholder="Enter Contact Number"
                                                                           id="contact_phone">

                                                                    @error('contact_phone')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="pass1">Institution</label>
                                                                    <input id="institution" type="text"
                                                                           placeholder="Institution" name="institution"
                                                                           value="{{ old('institution') }}"
                                                                           class="form-control">
                                                                    @error('institution')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 mt-3">

                                                                <div class="form-group">
                                                                    <label for="duration">Duration (Hour)</label>
                                                                    <input id="duration" type="text"
                                                                           placeholder="Duration Per Day" name="duration"
                                                                           value="{{ old('duration') }}"
                                                                           class="form-control">
                                                                    @error('duration')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="student_number">Hiring From</label>
                                                                    <input id="hiring_date" type="date"
                                                                           name="hiring_date"
                                                                           value="{{ old('hiring_date') }}"
                                                                           class="form-control">
                                                                    @error('hiring_date')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="userName">Division <span
                                                                        class="text-danger">*</span></label>
                                                                    <select class="form-control multipleSelect" name="division_id"
                                                                        id="division_id" onchange="getDistrictByDivition()">
                                                                        <option value="">Select</option>
                                                                        @foreach ($divitions as $divition)
                                                                            <option value="{{ $divition->id }}">
                                                                                {{ $divition->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('division_id')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="dristrict">District <span
                                                                        class="text-danger">*</span></label>
                                                                    <select class="form-control multipleSelect" name="district_id"
                                                                        id="district_id" onchange="getAreaByDistrict()">

                                                                    </select>
                                                                    @error('district_id')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="userName">Area Name <span
                                                                        class="text-danger">*</span></label>
                                                                    <select class="form-control multipleSelect" id="area_id"
                                                                        name="area_id">
                                                                    </select>

                                                                    @error('area_id')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="phone">Address</label>
                                                                    <textarea class="form-control" name="address" id="" rows="1">{!! old('address') !!}</textarea>
                                                                    @error('address')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>








                                                        </div>
                                                    </div> <!-- end card-box -->
                                                    <hr>
                                                    <div class="card-box">
                                                        <h4 class="header-title m-t-0">Tutor Requirement </h4>
                                                        <div class="row">
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="dristrict"> Medium</label>
                                                                    <select class="form-control multipleSelect "
                                                                        multiple="multiple" name="interest_medium[]">
                                                                        <option value="">Select</option>
                                                                        @foreach ($mediums as $medium)
                                                                            <option value="{{ $medium->id }}">
                                                                                {{ $medium->name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                    @error('interest_medium')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="interest_class"> Class</label>
                                                                    <select class="form-control  multipleSelect"
                                                                        name="interest_class[]" multiple="multiple">
                                                                        <option value="">Select</option>
                                                                        @foreach ($tclass as $tclas)
                                                                            <option value="{{ $tclas->id }}">
                                                                                {{ $tclas->name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                    @error('interest_class')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="interest_gender">Tutor Gender</label>
                                                                    <select class="form-control  multipleSelect"
                                                                        name="interest_gender[]" multiple="multiple">
                                                                        <option value="">Select</option>
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>

                                                                    </select>
                                                                    @error('interest_gender')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="userName">Time</label>
                                                                    <select class="form-control multipleSelect"
                                                                            name="interest_time[]" multiple="multiple">
                                                                        <option value="">Select</option>
                                                                        @foreach ($timelys as $timely)
                                                                            <option value="{{ $timely->id }}">
                                                                                {{ $timely->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('interest_time')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="userName">Weekly Days</label>
                                                                    <select class="form-control multipleSelect"
                                                                            name="weekly[]" multiple="multiple">
                                                                        <option value="">Select</option>
                                                                        @foreach ($weeklys as $weekly)
                                                                            <option value="{{ $weekly->id }}">
                                                                                {{ $weekly->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('weekly')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mt-3">

                                                                <div class="form-group">
                                                                    <label for="userName">Subject</label>
                                                                    <select class="form-control multipleSelect"
                                                                            multiple="multiple" name="interest_sub[]">
                                                                        <option value="">Select</option>
                                                                        @foreach ($subjects as $subject)
                                                                            <option value="{{ $subject->id }}">
                                                                                {{ $subject->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('interest_sub')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="salary">Institution</label>
                                                                    <input id="interest_institution" type="text"
                                                                           placeholder="Requirement Institution"
                                                                           name="interest_institution"
                                                                           value="{{ old('interest_institution') }}"
                                                                           class="form-control">
                                                                    @error('interest_institution')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="dristrict">Class Type</label>
                                                                    <select class="form-control select2" name="class_type"
                                                                            id="class_type">
                                                                        <option value="Offline">Offline</option>
                                                                        <option value="Online">Online</option>
                                                                    </select>
                                                                    @error('class_type')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>





                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="salary">Salary</label>
                                                                    <input id="salary" type="text"
                                                                        placeholder="Salary" name="salary"
                                                                        value="{{ old('salary') }}"
                                                                        class="form-control">
                                                                    @error('salary')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 mt-3">
                                                                <div class="form-group">
                                                                    <label for="salary">Salary show/Hide</label>
                                                                    <select class="form-control" name="salary_show_hide"
                                                                        id="salary_show_hide">
                                                                        <option value="1">show</option>
                                                                        <option value="0">Hide</option>
                                                                    </select>
                                                                    @error('salary_show_hide')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 mt-3">
                                                                <div class="form-group">
                                                                    <label for="phone">Details Post/Requirement</label>
                                                                    <textarea name="details" class="form-control ckeditor" id="" cols="30" rows="10">{!! old('details') !!}</textarea>
                                                                    @error('details')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end card-box -->
                                                </div>
                                                <!-- end col -->


                                                <div class="form-group text-center" style="margin-top: 10px;">
                                                    <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">Save</button>
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
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('backend/js/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('.ckeditor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        $(document).ready(function() {
            $('.multipleSelect').select2();
            $('#email').attr('autocomplete', 'off');
            $('#textbox1').val(this.checked);

            $('#textbox1').change(function() {
                if (this.checked) {
                    $('#already_user').hide();
                    $('#photo').hide();
                    $('#user_dropdown').show();
                } else {
                    $('#already_user').show();
                    $('#photo').show();
                    $('#user_dropdown').hide();
                }
                $('#textbox1').val(this.checked);
            });

        });
    </script>
    <script>
        $('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        function getDistrictByDivition() {
            var division_id = $("#division_id").val();
            $('#area_id').find('option').remove().end();
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
