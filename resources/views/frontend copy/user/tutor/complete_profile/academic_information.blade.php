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
{{--                           @include('frontend.user.tutor.complete_profile.percent')--}}
                            <div class="card">
{{--                                <div class="card-header">--}}
{{--                                    My Profile <span style="float: right;color: red;" class="text-right;">--}}
{{--                                            {{ $tutor->tutor_code ?? '' }}</span>--}}
{{--                                </div>--}}
                                <form id="kt_ecommerce_settings_general_form" class="form"
                                      action="{{ route('tutor_complete_profile_update', Auth::user()->id) }}" method="POST"
                                      enctype="multipart/form-data">
                                    <input type="hidden" name="profile_information_type" value="academic_information">
                                    @csrf

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card-header"><h4 class="header-title m-t-0 text-center"> Secondary/SSC/O-Level/Dakhil</h4></div>
                                            <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                <div class="col-md-2 text-md-end text-start">
                                                    <label for="ssc_institute"> Institute</label>
                                                    <span class="text-danger">*</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" required name="ssc_institute" id="ssc_institute" value="{{ $tutor->ssc_institute }}">
                                                    </div>
                                                    @error('ssc_institute')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                <div class="col-md-2 text-md-end text-start">
                                                    <label for="ssc_medium"> Curriculum</label>
                                                    <span class="text-danger">*</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" required name="ssc_medium" id="ssc_medium" value="{{ $tutor->ssc_medium }}">
                                                    </div>
                                                    @error('ssc_medium')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                <div class="col-md-2 text-md-end text-start">
                                                    <label for="ssc_group"> Group</label>
                                                    <span class="text-danger">*</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" required name="ssc_group" id="ssc_group" value="{{ $tutor->ssc_group }}">
                                                    </div>
                                                    @error('ssc_group')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                <div class="col-md-2 text-md-end text-start">
                                                    <label for="ssc_result"> Result</label>
                                                    <span class="text-danger">*</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" required name="ssc_result" id="ssc_result" value="{{ $tutor->ssc_result }}">
                                                    </div>
                                                    @error('ssc_result')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                <div class="col-md-2 text-md-end text-start">
                                                    <label for="ssc_year"> Passing Year</label>
                                                    <span class="text-danger">*</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" required name="ssc_year" id="ssc_year" value="{{ $tutor->ssc_year }}">
                                                    </div>
                                                    @error('ssc_year')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>




                                            <div class="card-header mt-4"><h4 class="header-title m-t-0 text-center">Higher Secondary/HSC/A-Level/Alim</h4></div>
                                            <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-6">
                                                    <input type="checkbox" id="i_am_diploma_student" onclick="diploma_student()"> <label for="i_am_diploma_student" style="cursor: pointer">I am a Diploma Student</label>
                                                </div>
                                            </div>


                                            <span id="hsc_dom">
{{--                                                <div class="row d-flex justify-content-center mt-3 align-items-center">--}}
{{--                                                    <div class="col-md-2"></div>--}}
{{--                                                    <div class="col-md-6">--}}
{{--                                                        <input type="checkbox" id="currently_studying" onclick="currently_studying_here()"> <label for="currently_studying" style="cursor: pointer">I am currently studing here.</label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="hsc_institute"> Institute</label>
                                                        <span class="text-danger">*</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" required class="form-control" name="hsc_institute" id="hsc_institute" value="{{ $tutor->hsc_institute }}">
                                                        </div>
                                                        @error('hsc_institute')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="hsc_medium"> Curriculum</label>
                                                        <span class="text-danger">*</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" required class="form-control" name="hsc_medium" id="hsc_medium" value="{{ $tutor->hsc_medium }}">
                                                        </div>
                                                        @error('hsc_medium')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="hsc_group"> Group</label>
                                                        <span class="text-danger">*</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" required class="form-control" name="hsc_group" id="hsc_group" value="{{ $tutor->hsc_group }}">
                                                        </div>
                                                        @error('hsc_group')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="hsc_result"> Result</label>
                                                        <span class="text-danger">*</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" required class="form-control" name="hsc_result" id="hsc_result" value="{{ $tutor->hsc_result }}">
                                                        </div>
                                                        @error('hsc_result')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="hsc_year"> Passing Year</label>
                                                        <span class="text-danger">*</span>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" required class="form-control" name="hsc_year" id="hsc_year" value="{{ $tutor->hsc_year }}">
                                                        </div>
                                                        @error('hsc_year')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                </span>







                                            <span id="hons_dom">
                                            <div class="card-header mt-4"><h4 class="header-title m-t-0 text-center">Graduation/Bachelor/Diploma</h4></div>
                                            <span class="card-box">
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="institution">Institute/University</label>
                                                        <span class="text-danger">*</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input id="hons_institution" required type="text" value="{{ $tutor->institution }}" placeholder="Institution" name="institution" class="form-control" >
                                                        </div>
                                                        @error('institution')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="faculty">Institute Type</label>
                                                        <span class="text-danger">*</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <select name="institute_type" id="institute_type" class="form-control" required>
                                                                @foreach(\App\Models\TutorInstituteType::get() as $institute_type)
                                                                    <option>{{ $institute_type->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('institute_type')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="faculty">Degree Title</label>
                                                        <span class="text-danger">*</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <select name="faculty" id="faculty" class="form-control" required>
                                                                @foreach(\App\Models\TutorFaculty::get() as $faculty)
                                                                    <option>{{ $faculty->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('faculty')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="subject_name">Subject/Department</label>
                                                        <sup class="text-danger">*</sup>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control select2" required name="subject_name" value="{{ $tutor->subject_name }}" id="subject_name">
                                                        </div>
                                                        @error('subject_name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="hons_medium"> Curriculum</label>
                                                        <span class="text-danger">*</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" required class="form-control" name="hons_medium" id="hons_medium" value="{{ $tutor->hons_medium }}">
                                                        </div>
                                                        @error('hons_medium')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="sessions">Session</label>
                                                        <span class="text-danger">*</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input id="sessions" required type="text" value="{{ $tutor->session }}" placeholder="Session" name="sessions" class="form-control">
                                                        </div>
                                                        @error('sessions')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="hons_last_passed_year">Passing Year</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input id="hons_last_passed_year" type="text" value="{{ $tutor->hons_last_passed_year }}" placeholder="Passing Year" name="hons_last_passed_year" class="form-control">
                                                        </div>
                                                        @error('hons_last_passed_year')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="hons_last_passed_result">Current CGPA</label>
                                                        <span class="text-danger">*</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input id="hons_last_passed_result" required type="text" value="{{ $tutor->hons_last_passed_result }}" placeholder="Passing Year" name="hons_last_passed_result" class="form-control">
                                                        </div>
                                                        @error('hons_last_passed_result')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </span>


                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="avatar">Profile</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="file" class="form-control" name="avatar" id="avatar" accept=".jpg, .png, .jpeg">
                                                            <small><i class="text-muted">Note: file must be .jpg/.png/.jpeg format.</i></small>
                                                        </div>
                                                        @error('avatar')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="student_id_card">Student ID/Pay in slip/NID</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="file" class="form-control" name="student_id_card" id="student_id_card" accept=".jpg, .png, .jpeg">
                                                            <small><i class="text-muted">Note: file must be .jpg/.png/.jpeg format.</i></small>
                                                        </div>
                                                        @error('student_id_card')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                    <div class="col-md-2 text-md-end text-start">
                                                        <label for="details">Tuition Experience</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <textarea name="details" id="" class="form-control" style="height: 100px">{{ $tutor->details }}</textarea>
                                                        </div>
                                                        @error('details')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>


                                                @push('footer_js')
                                                    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
                                                    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
                                                    <script>
                                                        function diploma_student(){
                                                            if(document.getElementById('i_am_diploma_student').checked) {
                                                                $("#hsc_dom").fadeOut()
                                                                $("#hsc_institute").removeAttr('required')
                                                                $("#hsc_medium").removeAttr('required')
                                                                $("#hsc_group").removeAttr('required')
                                                                $("#hsc_year").removeAttr('required')
                                                                $("#hsc_result").removeAttr('required')
                                                            }else{
                                                                $("#hsc_dom").fadeIn()
                                                                $("#hsc_institute").attr('required', '')
                                                                $("#hsc_medium").attr('required', '')
                                                                $("#hsc_group").attr('required', '')
                                                                $("#hsc_result").attr('required', '')
                                                                $("#hsc_year").attr('required', '')
                                                            }
                                                        }


                                                        function currently_studying_here(){
                                                            if(document.getElementById('currently_studying').checked) {
                                                                $("#hons_dom").fadeOut()
                                                                $("#hons_institute").removeAttr('required')
                                                                $("#institute_type").removeAttr('required')
                                                                $("#faculty").removeAttr('required')
                                                                $("#subject_name").removeAttr('required')
                                                                $("#hons_medium").removeAttr('required')
                                                                $("#sessions").removeAttr('required')
                                                                $("#hons_last_passed_year").removeAttr('required')
                                                            }else{
                                                                $("#hons_dom").fadeIn()

                                                                $("#hons_institute").attr('required')
                                                                $("#institute_type").attr('required')
                                                                $("#faculty").attr('required')
                                                                $("#subject_name").attr('required')
                                                                $("#hons_medium").attr('required')
                                                                $("#sessions").attr('required')
                                                                $("#hons_last_passed_year").attr('required')
                                                            }
                                                        }



                                                        $( function() {
                                                            // var availableFaculties = ['Science', 'Arts', 'Commerce'];
                                                            var availableFaculties =
                                                                [
                                                                    @foreach(\App\Models\TutorFaculty::orderBy('name', 'ASC')->get() as $tutor_faculty)
                                                                        "{{ $tutor_faculty->name }}" @if($loop->last == false) , @endif
                                                                    @endforeach
                                                                ]
                                                            ;
                                                            // $( "#faculty" ).autocomplete({
                                                            //     source: availableFaculties,
                                                            //     minLength: 0,
                                                            // }).focus(function () {
                                                            //     $(this).autocomplete("search");
                                                            // });


                                                            var availableMediums = [
                                                                @foreach(\App\Models\Medium::get() as $medium)
                                                                    '{{ $medium->name }}',
                                                                @endforeach
                                                            ];
                                                            $( "#hons_medium" ).autocomplete({
                                                                source: availableMediums,
                                                                minLength: 0,
                                                            }).focus(function () {
                                                                $(this).autocomplete("search");
                                                            });
                                                            $( "#hsc_medium" ).autocomplete({
                                                                source: availableMediums,
                                                                minLength: 0,
                                                            }).focus(function () {
                                                                $(this).autocomplete("search");
                                                            });

                                                            $( "#ssc_medium" ).autocomplete({
                                                                source: availableMediums,
                                                                minLength: 0,
                                                            }).focus(function () {
                                                                $(this).autocomplete("search");
                                                            });
                                                        } );


                                                        $( function() {
                                                            var availableGroup = [
                                                                'Humanities',
                                                                'Commerce',
                                                                'Science',
                                                            ];
                                                            $( "#hsc_group" ).autocomplete({
                                                                source: availableGroup,
                                                                minLength: 0,
                                                            }).focus(function () {
                                                                $(this).autocomplete("search");
                                                            });

                                                            $( "#ssc_group" ).autocomplete({
                                                                source: availableGroup,
                                                                minLength: 0,
                                                            }).focus(function () {
                                                                $(this).autocomplete("search");
                                                            });
                                                        } );


                                                        $( function() {
                                                            var availableInstitute = [
                                                                'University of Dhaka',
                                                                'BUET',
                                                                'BUTEX',
                                                                'Jagannath University',
                                                                'Jahangirnagar University',
                                                                'Dhaka College',
                                                                'North-South University',
                                                                'Brack University',
                                                            ];
                                                            $( "#institution" ).autocomplete({
                                                                source: availableInstitute,
                                                                minLength: 0,
                                                            }).focus(function () {
                                                                $(this).autocomplete("search");
                                                            });

                                                        } );
                                                    </script>
                                                @endpush
                                            </div> <!-- end card-box -->
                                        </div>


                                        <div class="form-group text-center pt-3 d-flex justify-content-center">
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
