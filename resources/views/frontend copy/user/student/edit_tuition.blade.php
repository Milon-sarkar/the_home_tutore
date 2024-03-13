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

                        <div class="tab_content active" data-tab="2">

                            <div class="order_wraps">
                                <div class="card">
                                    <div class="card-header">
                                        Update Tuition Post <span style="float: right;color: red;" class="text-right;">
                                            <a class="btn btn-info" href="{{ route('my_tuition_post') }}">My Tuition List</a></span>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('tuition_update',$tuitions->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('patch')
                                            @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card-box">
                                                    <h4 class="header-title m-t-0">Basic Section <span style="float: right;color: red;"
                                                            class="text-right;">
                                                            {{ $tuitions->job_id }}</span></h4>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="userName">Division</label>
                                                                <select class="form-control select2" name="division_id" id="division_id"
                                                                    onchange="getDistrictByDivition()">
                                                                    <option>Select</option>
                                                                    @foreach ($divitions as $divition)
                                                                    <option  {{ $divition->id ==$tuitions->division_id ? 'selected': '' }} value="{{ $divition->id }}">{{ $divition->name }}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="dristrict">District</label>
                                                                <select class="form-control select2" name="district_id" id="district_id"
                                                                    onchange="getAreaByDistrict()">
                                                                    @if(!empty($tuitions->district_id))
                                                                    @foreach ($districts as $district)
                                                                        <option  {{ $district->id ==$tuitions->district_id ? 'selected': '' }} value="{{ $district->id }}">{{ $district->name }}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="userName">Area Name</label>
                                                                <select class="form-control select2" id="area_id" name="area_id">
                                                                    @if(!empty($tuitions->area_id))
                                                                    @foreach ($areas as $area)
                                                                        <option  {{ $area->id ==$tuitions->area_id ? 'selected': '' }} value="{{ $area->id }}">{{ $area->name }}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="phone">Address</label>
                                                                <textarea class="form-control" name="address" id="" rows="5">{{ $tuitions->address }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="duration">Name/Title<span class="text-danger">*</span></label>
                                                                <input id="title" type="text" value="{{ $tuitions->name }}" placeholder="Title" name="title"
                                                                    required class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="duration">Duration (Hour)</label>
                                                                <input id="duration" type="text" value="{{ $tuitions->duration }}" placeholder="Duration Per Day" name="duration"
                                                                     class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="student_number">Hiring From</label>
                                                                <input id="hiring_date" type="date" value="{{ $tuitions->hiring_date?$tuitions->hiring_date:''  }}"   name="hiring_date"
                                                                     class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="userName">Gender</label>
                                                                <select class="form-control multipleSelect" name="gender[]" multiple="multiple">
                                                                    <option>Select</option>
                                                                    <option {{is_array($tuitions->gender) && in_array('Male', $tuitions->gender) ? 'selected' : '' }} value="Male">Male</option>
                                                                    <option {{is_array($tuitions->gender) && in_array('Female', $tuitions->gender) ? 'selected' : '' }} value="Female">Female</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="phone">Contact Number</label>
                                                                <input type="text" class="form-control" name="contact_phone" value="{{ $tuitions->phone }}"
                                                                            placeholder="Enter Contact Number" id="contact_phone">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="interest_class">Class</label>
                                                                <select class="form-control  multipleSelect" name="tclass[]" multiple="multiple">
                                                                    <option>Select</option>

                                                                    @foreach ($tclass as $tclas)
                                                                    <option {{is_array($tuitions->tclass) && in_array($tclas->id, $tuitions->tclass) ? 'selected' : '' }}
                                                                     value="{{ $tclas->id }}">{{ $tclas->name }}</option>
                                                                @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="userName">Subject</label>
                                                                <select class="form-control multipleSelect" multiple="multiple" name="subject_ids[]">
                                                                    <option>Select</option>
                                                                    @foreach ($subjects as $subject)
                                                                        <option {{is_array($tuitions->subject_ids) && in_array($subject->id, $tuitions->subject_ids) ? 'selected' : '' }} value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pass1">Institution<span class="text-danger">*</span></label>
                                                                <input id="institution" type="text" placeholder="Institution" value="{{ $tuitions->institution }}" name="institution" required
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="dristrict"> Medium</label>
                                                                @php

                                                                    @endphp
                                                                <select class="form-control multipleSelect" multiple="multiple" name="interest_medium[]">
                                                                    <option>Select</option>

                                                                    @foreach ($mediums as $medium)
                                                                        <option  {{is_array($tuitions->student_medium) && in_array($medium->id, $tuitions->student_medium) ? 'selected' : '' }}
                                                                         value="{{ $medium->id }}">{{ $medium->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="student_number">Number Of Student<span class="text-danger">*</span></label>
                                                                <input id="student_number" type="number" value="{{ $tuitions->student_number }}" placeholder="Number Of Student" name="student_number"
                                                                    required class="form-control">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div> <!-- end card-box -->
                                                <div class="card-box">
                                                    <h4 class="header-title m-t-0">Requirement/Tutor Section </h4>
                                                    <div class="row">
                                                        <div class="col-lg-6">

                                                            <div class="form-group">
                                                                <label for="dristrict"> Medium</label>
                                                                @php

                                                                    @endphp
                                                                <select class="form-control multipleSelect" multiple="multiple" name="interest_medium[]">
                                                                    <option>Select</option>

                                                                    @foreach ($mediums as $medium)
                                                                        <option  {{is_array($tuitions->interest_medium) && in_array($medium->id, $tuitions->interest_medium) ? 'selected' : '' }}
                                                                         value="{{ $medium->id }}">{{ $medium->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="interest_class"> Class</label>
                                                                <select class="form-control  multipleSelect" name="interest_class[]" multiple="multiple">
                                                                    <option>Select</option>
                                                                    @foreach ($tclass as $tclas)
                                                                    <option {{is_array($tuitions->interest_class) && in_array($tclas->id, $tuitions->interest_class) ? 'selected' : '' }}
                                                                     value="{{ $tclas->id }}">{{ $tclas->name }}</option>
                                                                @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="interest_gender">Tutor Gender</label>
                                                                <select class="form-control  multipleSelect" name="interest_gender[]" multiple="multiple">
                                                                    <option>Select</option>
                                                                    <option {{ $tuitions->interest_gender=='Male'? 'selected':'' }} value="Male">Male</option>
                                                                    <option {{ $tuitions->interest_gender=='Female'? 'selected':'' }} value="Female">Female</option>

                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="salary">Salary</label>
                                                                <input id="salary" type="text" value="{{ $tuitions->salary }}" placeholder="Salary" name="salary"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="salary">Salary show/Hide</label>
                                                                <select class="form-control" name="salary_show_hide" id="salary_show_hide">
                                                                    <option {{ $tuitions->salary_show_hide=='1'? 'selected':'' }} value="1">show</option>
                                                                    <option {{ $tuitions->salary_show_hide=='0'? 'selected':'' }} value="0">Hide</option>
                                                                 </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-6">

                                                            <div class="form-group">
                                                                <label for="userName">Subject</label>
                                                                <select class="form-control multipleSelect" multiple="multiple" name="interest_sub[]">
                                                                    <option>Select</option>
                                                                    @foreach ($subjects as $subject)
                                                                        <option {{is_array($tuitions->interest_sub) && in_array($subject->id, $tuitions->interest_sub) ? 'selected' : '' }}
                                                                         value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="userName">Time</label>
                                                                <select class="form-control multipleSelect" name="interest_time[]" multiple="multiple">
                                                                    <option>Select</option>
                                                                    @foreach ($timelys as $timely)
                                                                        <option {{is_array($tuitions->interest_time) && in_array($timely->id, $tuitions->interest_time) ? 'selected' : '' }}
                                                                        value="{{ $timely->id }}">{{ $timely->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="userName">Weekly Days</label>
                                                                <select class="form-control multipleSelect" name="weekly[]" multiple="multiple">
                                                                    <option>Select</option>
                                                                    @foreach ($weeklys as $weekly)
                                                                        <option  {{is_array($tuitions->weekly) && in_array($weekly->id, $tuitions->weekly) ? 'selected' : '' }}
                                                                        value="{{ $weekly->id }}">{{ $weekly->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="salary">Institution</label>
                                                                <input id="interest_institution" type="text" value="{{ $tuitions->interest_institution }}" placeholder="Requirement Institution" name="interest_institution"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="dristrict">Class Type</label>
                                                                <select class="form-control select2" name="class_type" id="class_type">
                                                                   <option {{ $tuitions->class_type=='Offline'? 'selected':'' }} value="Offline">Offline</option>
                                                                   <option {{ $tuitions->class_type=='Online'? 'selected':'' }} value="Online">Online</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="phone">Details Post/Requirement</label>
                                                                <textarea name="details" class="form-control ckeditor" id="" cols="30" rows="10">{{ $tuitions->details }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end card-box -->
                                            </div>
                                            <!-- end col -->


                                            <div class="form-group row" style="margin-top: 10px;">
                                                <div class="col-8 offset-4">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Update
                                                    </button>

                                                </div>
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
