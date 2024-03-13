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
                                <div class="card-body">
                                    <form method="POST" action="{{ route('update_basic_information') }}">
                                        @csrf

                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                            <div class="col-md-2 text-md-end text-start">
                                                <label for="name">Name</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                           name="name" id="name" value="{{ $tutor->user->name ?? '' }}"
                                                           placeholder="Enter Your Name" autocomplete="name" autofocus required>
                                                </div>
                                                @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                            <div class="col-md-2 text-md-end text-start">
                                                <label for="phone_number">Phone</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <small class="d-block"><i>Changing phone number suppose to verify by otp</i></small>
                                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                           name="phone" id="phone_number" value="{{ $tutor->user->phone ?? '' }}"
                                                           aria-describedby="phoneHelp" required  onkeyup="phone_input()">
                                                    <small><strong class="text-danger" id="phone_msg"></strong></small>
                                                </div>
                                                @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
{{--                                        <div class="row d-flex justify-content-center mt-3 align-items-center">--}}
{{--                                            <div class="col-md-2 text-md-end text-start">--}}
{{--                                                <label for="email">Email</label>--}}
{{--                                                <span class="text-danger">*</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <input type="email" class="form-control @error('email') is-invalid @enderror"--}}
{{--                                                           name="email" id="email" value="{{ $tutor->user->email ?? '' }}"--}}
{{--                                                           aria-describedby="phoneHelp" required  onkeyup="email_input()">--}}
{{--                                                    <small><strong class="text-danger" id="email_msg"></strong></small>--}}
{{--                                                </div>--}}
{{--                                                @error('email')--}}
{{--                                                <small class="text-danger">{{ $message }}</small>--}}
{{--                                                @enderror--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                            <div class="col-md-2 text-md-end text-start">
                                                <label for="whatsapp">Whatsapp</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror"
                                                           name="whatsapp" id="whatsapp" value="{{ $tutor->user->whatsapp ?? '' }}"
                                                           aria-describedby="phoneHelp" required>
                                                </div>
                                                @error('whatsapp')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                            <div class="col-md-2 text-md-end text-start">
                                                <label for="gender">Gender</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="gender" id="gender" class="form-control" required>
                                                    <option selected disabled></option>
                                                    <option value="Male" {{ $tutor->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female" {{ $tutor->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                                @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                            <div class="col-md-2 text-md-end text-start">
                                                <label for="district_id">Home District</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="permanent_district_id" id="permanent_district_id" class="form-control" required>
                                                    @php $district = \App\Models\District::find($tutor->permanent_district_id) @endphp
                                                    @if($district)
                                                    <option selected value="{{ $district->id }}">{{ $district->name }} </option>
                                                    @endif
                                                    @foreach(\App\Models\District::orderBy('name', 'ASC')->get() as $district)
                                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('permanent_district_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                            <div class="col-md-2 text-md-end text-start">
                                                <label for="district_id">Present District</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="district_id" id="district_id" class="form-control" onchange="getThanaByDistrict()" required>
                                                    @php $district = \App\Models\District::find($tutor->district_id) @endphp
                                                    @if($district)
                                                    <option selected value="{{ $district->id }}">{{ $district->name }} </option>
                                                    @endif
                                                    @foreach(\App\Models\District::orderBy('name', 'ASC')->get() as $district)
                                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('district_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                            <div class="col-md-2 text-md-end text-start">
                                                <label for="thana_id">Present Thana</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="thana_id" id="thana_id" class="form-control" onchange="getAreaByThana()" required>
                                                    @php $thanas = \App\Models\Thana::where('district_id', $tutor->district_id)->get() @endphp
                                                    @foreach($thanas as $thana)
                                                    <option value="{{ $thana->id }}" {{ ($tutor->thana_id == $thana->id) ? 'selected' : '' }}>{{ $thana->name }}</option>
                                                    @endforeach

                                                </select>
                                                @error('thana_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                            <div class="col-md-2 text-md-end text-start">
                                                <label for="area_id">Present Area</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-6">
                                                <input list="area_data_list" name="area_name" type="text" class="form-control" id="area_id" required value="{{ $tutor->area->name ?? '' }}">
                                                @error('area_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <datalist id="area_data_list">
                                                    @foreach(\App\Models\Area::where('thana_id', $tutor->thana_id)->where('status', 'Active')->get() as $area)
                                                        <option>{{ $area->name }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                            <div class="col-md-2 text-md-end text-start">
                                                <label for="interest_class">Preferred Classes</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="interest_class[]" id="interest_class" class="form-control select2" multiple="multiple" required>
                                                    @foreach(\App\Models\Tclass::orderBy('name', 'ASC')->get() as $tclass)
                                                        <option value="{{ $tclass->id }}" @if(in_array($tclass->id, (($tutor->interest_class) ?? array()))) selected @endif>{{ $tclass->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('interest_class')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                            <div class="col-md-2 text-md-end text-start">
                                                <label for="interest_sub">Preferred Subjects</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="interest_sub[]" id="interest_sub" class="form-control select2" multiple="multiple" required>
                                                    @foreach(\App\Models\Subject::orderBy('name', 'ASC')->get() as $subject)
                                                        <option value="{{ $subject->id }}" @if(in_array($subject->id, (($tutor->interest_sub) ?? array()))) selected @endif>{{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('interest_sub')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                            <div class="col-md-2 text-md-end text-start">
                                                <label for="interest_medium">Preferred Medium</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="interest_medium[]" id="interest_medium" class="form-control select2" multiple="multiple" required>
                                                    @foreach(\App\Models\Medium::orderBy('name', 'ASC')->get() as $medium)
                                                        <option value="{{ $medium->id }}" @if(in_array($medium->id, (($tutor->interest_medium) ?? array()))) selected @endif>{{ $medium->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('interest_medium')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center mt-3 align-items-center">
                                            <div class="col-md-2 text-md-end text-start">
                                                <label for="preferred_area_id">Preferred Areas</label>
                                                <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="preferred_area_id[]" id="preferred_area_id" class="form-control select2 multipleSelectWithTags" multiple="multiple" required>
                                                   @if($tutor->areajeson)
                                                    @foreach($tutor->areajeson as $interest_area)
                                                    <option {{ $interest_area->id }} selected>{{ $interest_area->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <small class="d-block text-muted"><strong>Note: </strong><i>If you don't find your option, <code>write your area name</code> and press <code>,</code></i></small>

                                                <script>
                                                    $( function() {
                                                        var availableFaculties = ['Science', 'Arts', 'Commerce'];
                                                        $("#faculty").autocomplete({
                                                            source: availableFaculties,
                                                            minLength: 0,
                                                        }).focus(function () {
                                                            $(this).autocomplete("search");
                                                        });
                                                    })
                                                </script>
                                                @error('preferred_area_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary submit mt-3">Save</button>
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
        function getThanaByDistrict() {
            var district_id = $("#district_id").val();
            $('#thana_id').find('option').remove().end();
            jQuery.ajax({
                url: "{{ url(route('getThanaByDistrict')) }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    district_id: district_id
                },
                method: "POST",
                success: function(data) {
                    document.getElementById("thana_id").innerHTML = data.options
                },
                error: function() {
                    alert('Something Getting Wrong! Please reload the page and try again')
                }
            });
        }


        function getAreaByThana() {
            let thana_id = $("#thana_id").val();
            $('#area_id').find('option').remove().end();
            jQuery.ajax({
                url: "{{ url(route('getAreaByThanaArray')) }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    thana_id: thana_id
                },
                method: "POST",
                success: function(data) {
                    document.getElementById("area_data_list").innerHTML = data.options
                },
                error: function() {
                    alert('Something Getting Wrong! Please reload the page and try again')
                }
            });

            jQuery.ajax({
                url: "{{ url(route('getAreaByThana_sameValue')) }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    thana_id: thana_id
                },
                method: "POST",
                success: function(data) {
                    document.getElementById("preferred_area_id").innerHTML = data.options
                },
                error: function() {
                    alert('Something Getting Wrong! Please reload the page and try again')
                }
            });
        }


    </script>

    <script>
        $(document).ready(function() {

            $('.select2').select2({
                width: "resolve",
            });

            $('.multipleSelectWithTags').select2({
                tags: true,
                tokenSeparators: [','],
            });
        });
    </script>



    <script>
        function phone_input(e){
            var phone = document.getElementById('phone_number').value

            if(phone.length != 11){
                document.getElementById('phone_msg').innerText = 'Invalid phone number'
            }else{
                document.getElementById('phone_msg').innerText = ''
            }

            if(phone.length == 11){

                jQuery.ajax({
                    url: "{{ url(route('check_phone_number')) }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },

                    beforeSend: function(e){

                    },

                    data: {
                        phone: phone,
                        avoid_already: true
                    },
                    method: "POST",
                    success: function(data) {
                        if(data.result == false){
                            document.getElementById('phone_msg').innerText = 'Phone number already exist'
                        }
                    },
                    error: function() {
                        alert('Something Getting Wrong! Please reload the page and try again')
                    }
                });
            }

        }
    </script>
    <script>
        function email_input(e){
            var email = document.getElementById('email').value


            if(email.length == 11){

                jQuery.ajax({
                    url: "{{ url(route('check_email')) }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },

                    beforeSend: function(e){

                    },

                    data: {
                        email: email
                    },
                    method: "POST",
                    success: function(data) {
                        if(data.result == false){
                            document.getElementById('email_msg').innerText = 'E-mail already exist'
                        }
                    },
                    error: function() {
                        alert('Something Getting Wrong! Please reload the page and try again')
                    }
                });
            }

        }
    </script>

@endsection
