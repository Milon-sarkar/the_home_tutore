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
                                            <div class="card-header">
                                                <h4 class="text-center"> Academic Information</h4>
                                            <h4 class="header-title m-t-0 text-center"> Secondary/SSC/O-Level/Dakhil</h4></div>
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
                                                                    <option value="{{ $institute_type->id }}" @if($institute_type->id == $tutor->institute_type) selected @endif>{{$institute_type->name}}</option>
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
                                                                    <option value="{{ $faculty->name }}" @if($faculty->name == $tutor->faculty) selected @endif>{{ $faculty->name }}</option>
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
                                                <span id="hons_dom">
                                                    <div class="card-header mt-4"><h4 class="header-title m-t-0 text-center">Tutoring Info field</h4></div>
                                                    <span class="card-box">
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="faculty">Present District
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <select name="district" id="district" class="form-control">
                                                                        @foreach(\App\Models\District::get() as $district)
                                                                            <option  value="{{ $district->id }}" @if($district->id == $tutor->district_id) selected @endif>{{ $district->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('district')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="thana">Present Thana</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <select name="thana" id="thana" class="form-control">
                                                                        @foreach(\App\Models\Thana::get() as $thana)
                                                                            <option value="{{ $thana->id }}" @if($thana->id == $tutor->district_id) selected @endif>{{ $thana->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('thana')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="location">Present location</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <select name="location" id="location" class="form-control">
                                                                        @foreach(\App\Models\Area::get() as $area)
                                                                            <option value="{{ $area->id }}" @if($area->id == $tutor->interest_location) selected @endif>{{ $area->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('location')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="area">Your prefered tution area</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
{{--                                                                    <select name="area" id="area" class="form-control">--}}
{{--                                                                        @foreach(\App\Models\Area::get() as $area)--}}
{{--                                                                            <option>{{ $area->name }}</option>--}}
{{--                                                                        @endforeach--}}
{{--                                                                    </select>--}}
                                                                    <select name="preferred_area_id" id="preferred_area_id" class="form-control">
                                                                        @foreach(\App\Models\Area::get() as $p_area)
                                                                            <option value="{{ $p_area->id }}" @if($p_area->id == $tutor->preferred_area_id) selected @endif>{{ $p_area->name }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                                @error('area')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="medium">Preferred medium
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <select name="interest_medium" id="interest_medium" class="form-control">
                                                                        @foreach(\App\Models\Medium::get() as $mediums)
                                                                            <option value="{{ $mediums->id }}" @if($mediums->id == $tutor->interest_medium) selected @endif>{{ $mediums->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('medium')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="location">Preferred class
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <select name="class" id="class" class="form-control">
                                                                        @foreach(\App\Models\Tclass::get() as $class)
                                                                            <option value="{{ $class->id }}" @if($class->id == $tutor->interest_class) selected @endif>{{ $class->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('class')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="subject">Present subject</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <select name="subject" id="subject" class="form-control">
                                                                        @foreach(\App\Models\Subject::get() as $subjects)
                                                                            <option>{{ $subjects->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @error('subject')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="hons_last_passed_result">Tutoring experience (year)
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="experience" required type="text"  placeholder="Tutoring experience" name="experience" class="form-control" value="{{$tutor->experience_tuition_percentage}}">
                                                                </div>
                                                                @error('experience')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="hons_last_passed_result">Tutoring experience details
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <textarea id="experience" type="text"  placeholder="Tutoring experience details" name="details" class="form-control"></textarea>
                                                                </div>
                                                                @error('experience')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="hons_last_passed_result">Tutoring time
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="time" type="text"  placeholder="Tutoring time" name="time" class="form-control" value="{{$tutor->interest_time}}">
                                                                </div>
                                                                @error('time')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="hons_last_passed_result">Tutoring type
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="type" type="text"  placeholder="Tutoring type" name="type" class="form-control">
                                                                </div>
                                                                @error('time')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="Expected salary">Expected salary
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="type" required type="text"  placeholder="Expected salary" name="salary" class="form-control" value="{{$tutor->salary}}">
                                                                </div>
                                                                @error('salary')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </span>
                                                <span id="hons_dom">
                                                    <div class="card-header mt-4"><h4 class="header-title m-t-0 text-center">Personal info field</h4></div>
                                                    <span class="card-box">
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
                                                                <label for="hons_last_passed_result">name
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="experience" required type="text"  placeholder="Enter your name" name="name" class="form-control" value="{{$user->name}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone">phone
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="experience" required type="text"  placeholder="Enter your phone" name="phone" class="form-control" value="{{$user->phone}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone">Gender
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input required type="text"  placeholder="Enter your Gender" name="gender" class="form-control" value="{{$tutor->gender}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone">Email
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="experience" required type="text"  placeholder="Enter your Email" name="email" class="form-control" value="{{$user->email}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone">whatsapp
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="experience" required type="text"  placeholder="whatsapp" name="whatsapp" class="form-control" value="{{$user->whatsapp}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone">Permanent full addres
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="experience" type="text"  placeholder="addres" name="addres" class="form-control" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone">Blood group
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="experience" type="text"  placeholder="Blood group" name="Blood" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone">Religion
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="experience" type="text"  placeholder="Religion" name="Religion" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone"> Fathers name
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input required type="text"  placeholder="Fathers name" name="father_name" class="form-control" value="{{$tutor->father_name}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone"> Fathers phone
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input required type="text"  placeholder="Fathers phone" name="father_number" class="form-control" value="{{$tutor->father_number}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone"> Mothers name
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input required type="text"  placeholder="Mothers name" name="mother_name" class="form-control" value="{{$tutor->mother_name}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone"> Mothers phone
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input required type="text"  placeholder="Mothers phone" name="mother_number" class="form-control" value="{{$tutor->mother_number}}">
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone"> Local guardian (on emergency)
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="experience" type="text"  placeholder="Local guardian (on emergency)" name="guardian" class="form-control">
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone">  - Local guardian number (on emergency)
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="experience" type="text"  placeholder=" - Local guardian number (on emergency)" name="emergency" class="form-control">
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone">Local guardian relation
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input id="experience" type="text"  placeholder=" - Local guardian relation" name="relation" class="form-control">
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone"> - FB link
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="text"  placeholder="  - FB link  " name="facebook_link" class="form-control" value="{{$tutor->facebook_link}}">
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="phone">About yourself
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="text"  placeholder="about
                                                                    " name="about" class="form-control">
                                                                </div>
                                                            </div>
                                                            </div>
                                                    </span>
                                                <span id="hons_dom">
                                                    <div class="card-header mt-4"><h4 class="header-title m-t-0 text-center">Document info </h4></div>
                                                    <span class="card-box">
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="slip">Pay in slip/student ID card (optional)</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="file" class="form-control" name="slip">
                                                                </div>
                                                                @error('slip')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="slip">HSC/A Level/Alim/Marksheet or certificate (optional)
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="file" class="form-control" name="certificate">
                                                                </div>
                                                                @error('slip')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="slip">SSC/O Level/Dakhil/Marksheet or certificate (optional)
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="file" class="form-control" name="Marksheet">
                                                                </div>
                                                                @error('Marksheet')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                                            <div class="col-md-2 text-md-end text-start">
                                                                <label for="slip">ID card (National)
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="file" class="form-control" name="National">
                                                                </div>
                                                                @error('National')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </span>

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
