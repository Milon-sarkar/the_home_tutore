@extends('frontend.layouts.app')

@section('content')
    <style>
        input{
            margin-bottom: 0px !important;
        }
        .select2-container{
            width: 100% !important;
        }

        .select2-container--default .select2-results > .select2-results__options {
            max-height: 110px;
        }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- Father registration start -->
    <section class="login_registration">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="image_area">
                        <img src="{{ asset('frontend/images/login.png') }}" alt="login registration">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input_area">
                        <div class="input_header">
                            <h4 class="subtitle_with_link">Already a member? <a href="{{ route('login') }}">Log in</a>
                            </h4>
                        </div>
                        <div class="field_area">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name <sup class="text-danger">*</sup> </label>
                                    <input type="name" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name') }}"
                                        placeholder="Enter Your Name" autocomplete="name" autofocus required>
                                    <input type="hidden" class="form-control" id="user_type" aria-describedby="user_type" value="tutor"
                                        name="user_type">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
{{--                                <div class="mb-3">--}}
{{--                                    <label for="email" class="form-label">E - mail</label>--}}
{{--                                    <input type="email" class="form-control @error('email') is-invalid @enderror"--}}
{{--                                        name="email" id="email" value="{{ old('email') }}"--}}
{{--                                        aria-describedby="emailHelp" required placeholder="example@mail.com">--}}
{{--                                    @error('email')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone <sup class="text-danger">*</sup> </label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" id="phone_number" value="{{ old('phone') }}"
                                        aria-describedby="phoneHelp" required  onkeyup="phone_input()">
                                    <small><strong class="text-danger" id="phone_msg"></strong></small>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
{{--                                <div class="mb-3">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <label for="exampleInputPassword1" class="form-label">Password</label>--}}
{{--                                            <input type="password" name="password"--}}
{{--                                                   class="form-control  @error('password') is-invalid @enderror" required id="password"--}}
{{--                                                   placeholder="*********">--}}
{{--                                            @error('password')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6">--}}
{{--                                            <label for="password-confirm" class="form-label">Confirm Password</label>--}}
{{--                                            <input type="password" name="password_confirmation" class="form-control"--}}
{{--                                                   id="password-confirm" required placeholder="*********">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}




{{--                                <div class="my-5">--}}
{{--                                    <ul class="list-unstyled d-lg-flex justify-content-between mb-4">--}}
{{--                                        <li><input type="radio" name="user_type" value="tutor" required id="tutor" {{ $register_type == 'tutor' ? 'checked' : '' }}> <label class="cursor-pointer text-muted mb-2 text-dark" for="tutor">I am a Tutor.</label></li>--}}
{{--                                        <li><input type="radio" name="user_type" value="guardian" required id="guardian" {{ $register_type == 'guardian' ? 'checked' : '' }}> <label class="cursor-pointer text-muted mb-2 text-dark" for="guardian">I am a Guardian</label></li>--}}
{{--                                        <li><input type="radio" name="user_type" value="student" required id="student" {{ $register_type == 'student' ? 'checked' : '' }}> <label class="cursor-pointer text-muted mb-2 text-dark" for="student">I need tutor for myself</label></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}


                                <div class="my-3" style="@if($register_type == 'tutor') display: none; @elseif($register_type == 'guardian') display: none; @elseif($register_type == 'student') display: none; @endif">
                                    <label for="user_type" class="form-label">Register as <sup class="text-danger">*</sup> </label>
                                    <select name="user_type" id="user_type" required class="form-control">
                                        <option selected disabled></option>
                                        <option value="tutor" id="tutor" {{ $register_type == 'tutor' ? 'selected' : '' }}>I am a Tutor</option>
                                        <option value="guardian" id="guardian" {{ $register_type == 'guardian' ? 'selected' : '' }}>I am a Guardian</option>
                                        <option value="student" id="student" {{ $register_type == 'student' ? 'selected' : '' }}>I need tutor for myself</option>
                                    </select>
                                </div>

                                <script>

                                    $(document).on('change', '#user_type', function(e){
                                        $("#tutor_form").hide()
                                        var selected_user_type = $(this).val()
                                        if(selected_user_type == 'tutor'){
                                            $("#tutor_form").show()
                                            $("#whatsapp").attr('required', '')
                                            $("#gender").attr('required', '')
                                            $("#district_id").attr('required', '')
                                            $("#thana_id").attr('required', '')
                                            $("#interest_class").attr('required', '')
                                            $("#interest_sub").attr('required', '')
                                            $("#interest_medium").attr('required', '')
                                            $("#image").attr('required', '')
                                        }else{
                                            $("#tutor_form").hide()
                                            $("#whatsapp").removeAttr('required')
                                            $("#gender").removeAttr('required')
                                            $("#district_id").removeAttr('required')
                                            $("#thana_id").removeAttr('required')
                                            $("#interest_class").removeAttr('required')
                                            $("#interest_sub").removeAttr('required')
                                            $("#interest_medium").removeAttr('required')
                                            $("#image").removeAttr('required')
                                        }
                                    })
                                </script>

                                <div id="tutor_form"
                                @if (count($errors) > 0 AND old('user_type') == 'tutor')
                                    style="display: inline"
                                @endif

                                @if($register_type != 'tutor')
                                     style="display: none"
                                @elseif($register_type == 'tutor')
                                     style="display: inline"
                                @endif
                                >
                                    <div class="row">
{{--                                        <div class="col-md-6">--}}
{{--                                            <label for="email" class="form-label">E-mail <sup class="text-danger">*</sup>  </label>--}}
{{--                                            <input type="text" class="form-control @error('email') is-invalid @enderror"--}}
{{--                                                   name="email" id="email" value="{{ old('email') }}"--}}
{{--                                                   aria-describedby="emailHelp" onkeyup="email_input()">--}}
{{--                                            <small><strong class="text-danger" id="email_msg"></strong></small>--}}
{{--                                            @error('email')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
                                        <div class="col-md-6">
                                            <label for="whatsapp" class="form-label">Whatsapp <sup class="text-danger">*</sup>  </label>
                                            <input type="text" class="form-control @error('whatsapp') is-invalid @enderror"
                                                   name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}" @if($register_type == 'tutor') required @endif
                                                   aria-describedby="whatsappHelp">
                                            @error('whatsapp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="gender" class="form-label">Gender <sup class="text-danger">*</sup></label>
                                            <select name="gender" id="" class="form-control" @if($register_type == 'tutor') required @endif>
                                                <option selected disabled></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="permanent_district_id" class="form-label">Home District <sup class="text-danger">*</sup></label>
                                            <select name="permanent_district_id" id="permanent_district_id" class="form-control" @if($register_type == 'tutor') required @endif>
                                                <option selected disabled></option>
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
                                        <div class="col-md-6">
                                            <label for="district_id" class="form-label">Present District <sup class="text-danger">*</sup></label>
                                            <select name="district_id" id="district_id" class="form-control" onchange="getThanaByDistrict()" @if($register_type == 'tutor') required @endif>
                                                <option selected disabled></option>
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
                                        <div class="col-md-6">
                                            <label for="thana_id" class="form-label">Present Thana <sup class="text-danger">*</sup></label>
                                            <select name="thana_id" id="thana_id" class="form-control" onchange="getAreaByThana()" @if($register_type == 'tutor') required @endif>
                                                <option selected disabled></option>
                                            </select>
                                            @error('thana_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="area_id" class="form-label">Your Present Location  <sup class="text-danger">*</sup></label></label>
                                                <input name="area_name" type="text" class="form-control" id="area_id" @if($register_type == 'tutor') required @endif>

                                                @error('area_id')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                            <div id="areaList"></div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group pt-2">
                                                <label for="interest_class" class="form-label">Preferred Classes <sup class="text-danger">*</sup></label>
                                                <select name="interest_class[]" id="interest_class" class="form-control select2" multiple="multiple" @if($register_type == 'tutor') required @endif>
                                                    @foreach(\App\Models\Tclass::orderBy('name', 'ASC')->get() as $tclass)
                                                        <option value="{{ $tclass->id }}">{{ $tclass->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('interest_class')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <label for="interest_sub" class="form-label">Preferred Subjects <sup class="text-danger">*</sup></label>
                                            <select name="interest_sub[]" id="interest_sub" class="form-control select2" multiple="multiple" @if($register_type == 'tutor') required @endif>
                                                @foreach(\App\Models\Subject::orderBy('name', 'ASC')->get() as $subject)
                                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('interest_sub')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label for="interest_medium" class="form-label">Preferred Medium <sup class="text-danger">*</sup></label>
                                            <select name="interest_medium[]" id="interest_medium" class="form-control select2" multiple="multiple" @if($register_type == 'tutor') required @endif>
                                                @foreach(\App\Models\Medium::orderBy('name', 'ASC')->get() as $medium)
                                                    <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('interest_medium')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label for="preferred_area_id" class="form-label">
                                                Preferred Locations <sup class="text-danger">*</sup>
                                                <small class="d-block text-muted"><strong>Note: </strong><i>If you don't find your option, <code>write your location name</code> and press <code>,</code></i></small>
                                            </label>
                                            <select name="preferred_area_id[]" id="preferred_area_id" class="form-control select2 multipleSelectWithTags" multiple="multiple" @if($register_type == 'tutor') required @endif>
                                                <option selected value=""></option>
                                            </select>


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
{{--                                        <div class="col-md-12">--}}
{{--                                            <label for="image" class="form-label">Image <sup class="text=danger">*</sup></label>--}}
{{--                                            <input type="file" name="image" class="form-control" id="image">--}}
{{--                                            <small><i class="text-muted">File must be in .jpg/.png/.jpeg format. Maximum size: 1MB</i></small>--}}
{{--                                            @error('image')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary submit mt-3">Create an account</button>

                            </form>
{{--                            @include('auth.social_login')--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Father registration end -->


    <script>

        $(document).on('click', '.area_name_li', function(){
            $('#area_id').val($(this).text());
            $('#areaList').fadeOut();
        })
        $(document).on('focus', '#area_id', function(){
            $('#areaList').fadeIn();
        })

        $(document).on("input propertychange paste change", '#area_id', function(e) {
            var value = $(this).val().toLowerCase();
            // var $ul = $(this).closest('ul');
            var $ul = $(".area_ul_list");
            //get all lis but not the one having search input
            var $li = $ul.find('li:gt(0)');
            //hide all lis
            $li.hide();
            $li.filter(function() {
                var text = $(this).text().toLowerCase();
                return text.indexOf(value)>=0;
            }).show();

        });

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
                url: "{{ url(route('getAreaByThanaArray2')) }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    thana_id: thana_id
                },
                method: "POST",
                success: function(data) {
                    document.getElementById("areaList" ).innerHTML = data.options
                    $('#areaList').fadeIn();
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
                        phone: phone
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
