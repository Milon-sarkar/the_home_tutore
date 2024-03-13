@extends('backend.layouts.app')


@section('content')
    @if ($page_type == 'create')
        <form action="{{ route('tuitions.store') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" value="create" name="action_type">
            <input type="hidden" name="job_id" value="{{ $code }}">
        @else
            <form action="{{ route('tuitions.store') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" value="edit" name="action_type">
                <input type="hidden" value="{{ $tuition->id }}" name="tuition_id">
    @endif
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card-box">
                <h4 class="header-title m-t-0">Basic Section <span style="float: right;color: red;" class="text-right;">
                        {{ $page_type == 'create' ? $code : $tuition->job_id }}</span></h4>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tuition_institute_template">Name/Title<span class="text-danger">*</span></label>

                            {{-- @dd($tuitionTemplate->title); --}}
                            <select id="tuition_institute_template" name="title" class="form-control">
                                <option selected disabled>Select Title</option>
                                @foreach (\App\Models\TitleTemplate::all() as $tuitionTemplate)
                                    <option value="{{ $tuitionTemplate->title }}"
                                        {{ $page_type == 'edit' && $tuitionTemplate->title == $tuition->title ? 'selected' : '' }}>
                                        {{ $tuitionTemplate->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="interest_class">Student's Class</label>
                            <select class="form-control  multipleSelect" name="tclass[]" multiple="multiple">
                                <option value="">Select</option>
                                @foreach ($tclass as $tclas)
                                    <option value="{{ $tclas->id }}"
                                        {{ $page_type == 'edit' ? (is_array($tuition->tclass) && in_array($tclas->id, $tuition->tclass) ? 'selected' : '') : '' }}>
                                        {{ $tclas->name }}</option>
                                @endforeach

                            </select>
                            @error('tclass')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="form-group">
                            <label for="dristrict">Student's Medium</label>
                            <select class="form-control multipleSelect" multiple="multiple" name="student_medium[]">
                                <option value="">Select</option>
                                @foreach ($mediums as $medium)
                                    <option value="{{ $medium->id }}"
                                        {{ $page_type == 'edit' ? (is_array($tuition->student_medium) && in_array($medium->id, $tuition->student_medium) ? 'selected' : '') : '' }}>
                                        {{ $medium->name }}</option>
                                @endforeach

                            </select>
                            @error('interest_medium')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="userName">Student's Subject</label>
                            <select class="form-control multipleSelect" multiple="multiple" name="subject_ids[]">
                                <option value="">Select</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ $page_type == 'edit' ? (is_array($tuition->subject_ids) && in_array($subject->id, $tuition->subject_ids) ? 'selected' : '') : '' }}>
                                        {{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('subject_ids')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="student_number">Number Of Student<span class="text-danger">*</span></label>
                            <input id="student_number" type="number" placeholder="Number Of Student" name="student_number"
                                value="{{ $page_type == 'edit' ? $tuition->student_number ?? 1 : old('student_number') ?? 1 }}"
                                required class="form-control">
                            @error('student_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="userName">Student's Gender</label>
                            <select class="form-control multipleSelect" name="gender[]" multiple="multiple">
                                <option value="">Select</option>
                                <option value="Male"
                                    {{ $page_type == 'edit' ? (is_array($tuition->gender) && in_array('Male', $tuition->gender) ? 'selected' : '') : '' }}>
                                    Male</option>
                                <option value="Female"
                                    {{ $page_type == 'edit' ? (is_array($tuition->gender) && in_array('Female', $tuition->gender) ? 'selected' : '') : '' }}>
                                    Female</option>
                            </select>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="duration">Duration (Hour)</label>
                            <input id="duration" type="text" placeholder="Duration Per Day" name="duration"
                                value="{{ $page_type == 'edit' ? $tuition->duration : old('duration') ?? 2 }}"
                                class="form-control">
                            @error('duration')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="userName">Area Name</label>
                            <select class="form-control select2" id="area_id" name="area_id">
                                <option selected></option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"
                                        {{ $page_type == 'edit' ? ($area->id == $tuition->area_id ? 'selected' : '') : '' }}>
                                        {{ $area->name }}, {{ $area->district->name ?? '' }}</option>
                                @endforeach
                            </select>
                            @error('area_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="salary">Salary</label>
                            @if ($page_type == 'edit')
                                @if ($tuition->salary_range)
                                    <input id="salary" type="text" value="{{ $tuition->salary_range }}"
                                        placeholder="Salary" name="salary" class="form-control">
                                @else
                                    <input id="salary" type="text" value="{{ $tuition->salary }}"
                                        placeholder="Salary" name="salary" class="form-control">
                                @endif
                            @else
                                <input id="salary" type="text" placeholder="Salary" name="salary"
                                    value="{{ old('salary') }}" class="form-control">
                            @endif
                            <small class="text-muted" style="display: block"><i>যেকোন একটি ফরম্যাটে দিবেন।
                                    <code>5000</code> অথবা <code>5000-7000</code></i></small>

                            @error('salary')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <div class="form-group">
                            <label for="Guardian Name">Guardian Name</label>
                            <input type="text" placeholder="Guardian Name" name="guardian"
                            value="" class="form-control">
                        </div>
                    </div> --}}

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="userName">Weekly Days</label>
                            <select class="form-control multipleSelect" name="weekly[]" multiple="multiple">
                                <option value="">Select</option>
                                @foreach ($weeklys as $weekly)
                                    <option value="{{ $weekly->id }}"
                                        {{ $page_type == 'edit' ? (is_array($tuition->weekly) && in_array($weekly->id, $tuition->weekly) ? 'selected' : '') : '' }}>
                                        {{ $weekly->name }}</option>
                                @endforeach
                            </select>
                            @error('weekly')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="pass1">Student's Institution</label>
                            <input id="institution" type="text" placeholder="Institution" name="institution"
                                value="{{ $page_type == 'edit' ? $tuition->institution : old('institution') }}"
                                class="form-control">
                            @error('institution')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="student_number">Hiring From</label>
                            <input id="hiring_date" type="date" name="hiring_date"
                                value="{{ $page_type == 'edit' ? ($tuition->hiring_date ? $tuition->hiring_date : '') : old('hiring_date') ?? date('Y-m-d') }}"
                                class="form-control">
                            @error('hiring_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tuition_category">Tuition Category</label>
                            <select name="tuition_category" class="form-control" id="">
                                <option selected></option>
                                @foreach (\App\Models\TuitionCategory::get() as $tuition_category)
                                    <option value="{{ $tuition_category->name }}"
                                        {{ $page_type == 'edit' ? ($tuition->tuition_category == $tuition_category->name ? 'selected' : '') : '' }}>
                                        {{ $tuition_category->name }}</option>
                                @endforeach
                            </select>
                            @error('tuition_category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{--                        <div class="col-lg-6"> --}}
                    {{--                            <div class="form-group"> --}}
                    {{--                                <label for="userName">Division</label> --}}
                    {{--                                <select class="form-control select2" name="division_id" id="division_id" --}}
                    {{--                                        onchange="getDistrictByDivition()"> --}}
                    {{--                                    <option value="">Select</option> --}}
                    {{--                                    @foreach ($divitions as $divition) --}}
                    {{--                                        <option value="{{ $divition->id }}" {{ $page_type == 'edit' ? ($divition->id ==$tuition->division_id ? 'selected': '') : '' }}>{{ $divition->name }}</option> --}}
                    {{--                                    @endforeach --}}
                    {{--                                </select> --}}
                    {{--                                @error('division_id') --}}
                    {{--                                <small class="text-danger">{{ $message }}</small> --}}
                    {{--                                @enderror --}}
                    {{--                            </div> --}}
                    {{--                        </div> --}}
                    {{--                        <div class="col-lg-6"> --}}
                    {{--                            <div class="form-group"> --}}
                    {{--                                <label for="dristrict">District</label> --}}
                    {{--                                <select class="form-control select2" name="district_id" id="district_id" --}}
                    {{--                                        onchange="getAreaByDistrict()"> --}}
                    {{--                                </select> --}}
                    {{--                                @error('district_id') --}}
                    {{--                                <small class="text-danger">{{ $message }}</small> --}}
                    {{--                                @enderror --}}
                    {{--                            </div> --}}
                    {{--                        </div> --}}

                    <div class="col-lg-6">

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" name="address" id="" rows="5">{!! $page_type == 'edit' ? $tuition->address : old('address') !!}</textarea>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                    </div>
                </div>
            </div> <!-- end card-box -->
            <div class="card-box">
                <h4 class="header-title m-t-0">Requirement/Interested Section </h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary">Salary show/Hide</label>
                            <select class="form-control" name="salary_show_hide" id="salary_show_hide">
                                <option value="1"
                                    {{ $page_type == 'edit' ? ($tuition->salary_show_hide == '1' ? 'selected' : '') : '' }}>
                                    show
                                </option>
                                <option value="0"
                                    {{ $page_type == 'edit' ? ($tuition->salary_show_hide == '0' ? 'selected' : '') : '' }}>
                                    Hide
                                </option>
                            </select>
                            @error('salary_show_hide')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="userName">Time</label>
                            <select class="form-control multipleSelect" name="interest_time[]" multiple="multiple">
                                <option value="">Select</option>
                                @foreach ($timelys as $timely)
                                    <option value="{{ $timely->id }}"
                                        {{ $page_type == 'edit' ? (is_array($tuition->interest_time) && in_array($timely->id, $tuition->interest_time) ? 'selected' : '') : '' }}>
                                        {{ $timely->name }}</option>
                                @endforeach
                            </select>
                            @error('interest_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="col-lg-6">
                        <div class="form-group">
                            <label for="dristrict">Tutor's Medium</label>
                            <select class="form-control multipleSelect" multiple="multiple" name="interest_medium[]">
                                <option value="">Select</option>
                                @foreach ($mediums as $medium)
                                    <option value="{{ $medium->id }}"
                                        {{ $page_type == 'edit' ? (is_array($tuition->interest_medium) && in_array($medium->id, $tuition->interest_medium) ? 'selected' : '') : '' }}>
                                        {{ $medium->name }}</option>
                                @endforeach

                            </select>
                            @error('interest_medium')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div> --}}
                    {{--                        <div class="col-lg-6"> --}}
                    {{--                            <div class="form-group"> --}}
                    {{--                                <label for="interest_class">Tutor's Class</label> --}}
                    {{--                                <select class="form-control  multipleSelect" name="interest_class[]"  multiple="multiple"> --}}
                    {{--                                    <option value="">Select</option> --}}
                    {{--                                    @foreach ($tclass as $tclas) --}}
                    {{--                                        <option value="{{ $tclas->id }}" {{ $page_type == 'edit' ? (is_array($tuition->interest_class) && in_array($tclas->id, $tuition->interest_class) ? 'selected' : '') : '' }}>{{ $tclas->name }}</option> --}}
                    {{--                                    @endforeach --}}

                    {{--                                </select> --}}
                    {{--                                @error('interest_class') --}}
                    {{--                                <small class="text-danger">{{ $message }}</small> --}}
                    {{--                                @enderror --}}
                    {{--                            </div> --}}
                    {{--                        </div> --}}
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="interest_gender">Tutor's Gender</label>
                            <select class="form-control  multipleSelect" name="interest_gender[]" multiple="multiple">
                                <option value="">Select</option>
                                <option value="Male"
                                    {{ $page_type == 'edit' ? (is_array($tuition->interest_gender) && in_array('Male', $tuition->interest_gender) ? 'selected' : '') : '' }}>
                                    Male</option>
                                <option value="Female"
                                    {{ $page_type == 'edit' ? (is_array($tuition->interest_gender) && in_array('Female', $tuition->interest_gender) ? 'selected' : '') : '' }}>
                                    Female</option>

                            </select>
                            @error('interest_gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="userName">Tutor's Subject</label>
                            <select class="form-control multipleSelect" multiple="multiple" name="interest_sub[]">
                                <option value="">Select</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ $page_type == 'edit' ? (is_array($tuition->interest_sub) && in_array($subject->id, $tuition->interest_sub) ? 'selected' : '') : '' }}>
                                        {{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="interest_institution">Tutor's Institution</label>
                            <input id="interest_institution" type="text"
                                value="{{ $page_type == 'edit' ? $tuition->interest_institution : '' }}" placeholder=""
                                name="interest_institution" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tutor_faculty">Tutor Faculty</label>
                            <select name="tutor_faculty" class="form-control" id="">
                                <option selected></option>
                                @foreach (\App\Models\TutorFaculty::get() as $tutor_faculty)

                                    <option value="{{ $tutor_faculty->name }}"
                                        {{ $page_type == 'edit' ? ($tuition->tutor_faculty == $tutor_faculty->name ? 'selected' : '') : '' }}>
                                        {{ $tutor_faculty->name }}</option>
                                @endforeach
                            </select>
                            @error('tutor_faculty')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="form-group">
                            <label for="dristrict">Class Type</label>
                            <select class="form-control select2" name="class_type" id="class_type">
                                <option
                                    {{ $page_type == 'edit' ? ($tuition->class_type == 'Offline' ? 'selected' : '') : '' }}
                                    value="Offline">Offline</option>
                                <option
                                    {{ $page_type == 'edit' ? ($tuition->class_type == 'Online' ? 'selected' : '') : '' }}
                                    value="Online">Online</option>
                            </select>
                            @error('class_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Select Template</label>
                            <select id="tuition_condition_template" class="form-control">
                                <option selected disabled>Select Template</option>
                                @foreach (\App\Models\TuitionConditionTemplate::where('status', 1)->get() as $tuition_template)
                                    <option value="{{ $tuition_template->body }}">{{ $tuition_template->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="form-group">
                            <label for="dristrict"> SSC Medium Section</label>
                            <select class="form-control multipleSelect select2" multiple="multiple" name="student_medium[]">
                                <option value="">Select</option>
                                @foreach ($mediums as $medium)
                                    <option value="{{ $medium->id }}"
                                        {{ $page_type == 'edit' ? (is_array($tuition->student_medium) && in_array($medium->id, $tuition->student_medium) ? 'selected' : '') : '' }}>
                                        {{ $medium->name }}</option>
                                @endforeach

                            </select>
                            @error('interest_medium')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="dristrict">HSC Medium Section</label>
                            <select class="form-control multipleSelect select2" multiple="multiple" name="student_medium[]">
                                <option value="">Select</option>
                                @foreach ($mediums as $medium)
                                    <option value="{{ $medium->id }}"
                                        {{ $page_type == 'edit' ? (is_array($tuition->student_medium) && in_array($medium->id, $tuition->student_medium) ? 'selected' : '') : '' }}>
                                        {{ $medium->name }}</option>
                                @endforeach

                            </select>
                            @error('interest_medium')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="scheduleDate">Schedule Post</label>
                            <input type="datetime-local" class="form-control" name="schedule_date_time">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="details">Details Post/Requirement</label>
                            <textarea name="details" id="details" class="form-control" style="height: 100px;">{!! $page_type == 'edit' ? $tuition->details : old('details') !!}</textarea>
                            @error('details')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="note">Note<span> [Only visible to admin]</span></label>
                            <textarea name="note" id="note" class="form-control" style="height: 100px;">{!! $page_type == 'edit' ? $tuition->note : old('note') !!}</textarea>
                            @error('note')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                </div>
            </div> <!-- end card-box -->
        </div>
        <!-- end col -->

        <div class="col-lg-4">
            <div class="card-box">
                <h4 class="header-title m-t-0">Login Section</h4><input type="checkbox" name="already_user"
                    value="{{ old('already_user') }}" id="textbox1">
                <label for="textbox1" class="cursor-pointer">Already Have Account</label>
                <div id="already_user">

                    <div class="form-group">
                        <label for="phone">Phone<sup class="text-danger">*</sup></label>
                        <input type="number" name="phone" required
                            value="{{ $page_type == 'edit' ? $tuition->user->phone ?? '' : old('phone') }}"
                            parsley-trigger="change" placeholder="Enter Phone" class="form-control" id="phone">
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="userName">Full Name</label>
                        <input type="text" parsley-trigger="change" name="name"
                            value="{{ $page_type == 'edit' ? $tuition->user->name ?? '' : old('name') }}"
                            placeholder="Enter user name" class="form-control" id="userName">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Whatsapp Number<sup class="text-danger">*</sup></label>
                        <input type="number" name="whatsapp" 
                            value="{{ $page_type == 'edit' ? $tuition->user->whatsapp ?? '' : old('phone') }}"
                            parsley-trigger="change" placeholder="Enter Phone" class="form-control" id="phone">
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="dristrict">User Type</label>
                        {{-- <select class="form-control select2" name="user_type" id="class_type">
                            <option value="guardian"
                                {{ $page_type == 'edit' ? ($tuition->user->user_type == 'guardian' ? 'selected' : '') : '' }}>
                                Guardian</option>
                            <option value="student"
                                {{ $page_type == 'edit' ? ($tuition->user->user_type == 'student' ? 'selected' : '') : '' }}>
                                Student</option>
                        </select> --}}
                        <select class="form-control select2" name="user_type" id="class_type">
                            <option value="guardian"
                                {{ $page_type == 'edit' && $tuition->user && $tuition->user->user_type == 'guardian' ? 'selected' : '' }}>
                                Guardian</option>
                            <option value="student"
                                {{ $page_type == 'edit' && $tuition->user && $tuition->user->user_type == 'student' ? 'selected' : '' }}>
                                Student</option>
                        </select>
                        
                        @error('user_type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>




                    {{--                        <div class="form-group"> --}}
                    {{--                            <label for="emailAddress">Email address</label> --}}
                    {{--                            <input type="email" name="email" value="{{ $page_type == 'edit' ? ($tuition->user->email) : old('email') }}" autocomplete="off"  parsley-trigger="change" --}}
                    {{--                                placeholder="Enter email" class="form-control" id="email"> --}}
                    {{--                            <span id="errorMsg2" style="color:red;display: none;"><i --}}
                    {{--                                    class="ace-icon fa fa-spinner fa-spin orange bigger-120"></i> --}}
                    {{--                                &nbsp;&nbsp;Email already Exits!!</span> --}}
                    {{--                            @error('email') --}}
                    {{--                            <small class="text-danger">{{ $message }}</small> --}}
                    {{--                            @enderror --}}
                    {{--                        </div> --}}

                    {{--                    <div class="form-group"> --}}
                    {{--                        <label for="pass1">Password</label> --}}
                    {{--                        <input id="pass1" type="text" name="password" value="{{ old('password') ?? 123456 }}" placeholder="Password" --}}
                    {{--                            class="form-control"> --}}
                    {{--                        @error('password') --}}
                    {{--                        <small class="text-danger">{{ $message }}</small> --}}
                    {{--                        @enderror --}}
                    {{--                    </div> --}}
                </div>
                <div class="form-group" id="user_dropdown" style="display: none;">
                    <label for="dristrict">Student/Guardian</label>
                    <select class="form-control select2" name="user_id">
                        <option value="">Select</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                {{ $page_type == 'edit' ? ($tuition->user_id == $user->id ? 'selected' : '') : '' }}>
                                {{ $user->name }} ({{ $user->phone }})</option>
                        @endforeach

                    </select>
                    @error('user_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Status</label>

                    <select class="form-control" name="status">
                        <option value="1"
                            {{ $page_type == 'edit' ? ($tuition->status == '1' ? 'selected' : '') : '' }}>Active</option>
                        <option value="0">In-active</option>
                    </select>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Select SMS Template</label>
                        <select id="tuition_guardian_sms_template" class="form-control">
                            <option selected disabled>Select SMS Template</option>
                            @foreach (\App\Models\SmsTemplate::where('status', 1)->where('type', 'guardian_student')->get() as $guardian_sms_template)
                                <option value="{{ $guardian_sms_template->body }}">{{ $guardian_sms_template->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="details">SMS Body</label>
                        <textarea name="tuition_guardian_sms_body" id="tuition_guardian_sms_body" class="form-control"
                            style="height: 300px;"></textarea>
                    </div>
                </div>

            </div>
        </div> <!-- end col -->
        <div class="form-group row">
            <div class="col-8 offset-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light">
                    {{ $page_type == 'edit' ? 'Update' : 'Save' }}
                </button>
                <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    </form>

    <pre>
        <?php
        // print_r($areas)
        // foreach($areas as $area){
        //     echo $area->name;
        //     print_r($area);
        //     print_r($area->district);
        //     echo "<br>";
        // }
        ?>
    </pre>
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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    @if ($page_type == 'create')
        <!-- <script>
            $(function() {
                var availableNames = [
                    @foreach ($tuitions as $tuition)
                        "{{ $tuition->name }}",
                    @endforeach
                ];
                $("#title").autocomplete({
                    source: availableNames
                });
            });
        </script> -->
    @endif
    <script>
        $(function() {
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
            $("#interest_institution").autocomplete({
                source: availableInstitute,
                minLength: 0,
            }).focus(function() {
                $(this).autocomplete("search");
            });

        });
    </script>

    <script>
        $("#tuition_condition_template").change(function(e) {
            var conceptName = $('#tuition_condition_template').find(":selected").val();
            $("#details").text('')
            $("#details").text(conceptName)
        });
    </script>

    <script>
        $("#tuition_guardian_sms_template").change(function(e) {
            var conceptSMS = $('#tuition_guardian_sms_template').find(":selected").val();
            $("#tuition_guardian_sms_body").text('')
            $("#tuition_guardian_sms_body").text(conceptSMS)
        });
    </script>
@endsection
