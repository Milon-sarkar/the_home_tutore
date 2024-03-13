@extends('backend.layouts.app')
@push('brdcrmb_1_link'){{ route('guardian_or_student.index') }}?type={{ $type }} @endpush
@push('brdcrmb_1_text')/ {{ $type }} @endpush

@push('brdcrmb_2_link'){{ route('guardian_or_student.create') }}?type={{ $type }} @endpush
@push('brdcrmb_2_text')/ Create @endpush

@section('content')
        @if($page_type == 'create')
            <form action="{{ route('guardian_or_student.store') }}" method="post" enctype="multipart/form-data">
            @csrf
        <input type="hidden" name="action_type" value="create">
        @else
            <form action="{{ route('guardian_or_student.store') }}" method="post" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="action_type" value="edit">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
        @endif
        <input type="hidden" name="type" value="{{ $type }}">
        <div class="row d-flex justify-content-center">

            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title m-t-0 text-capitalize">{{ $type }} account information</h4>
                    <div class="form-group">
                        <label for="userName">Full Name</label>
                        <input type="text" name="name" placeholder="Enter {{ $type }} name"
                            class="form-control" id="userName" value="{{ $page_type == 'edit' ? $user->name : old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Email address</label>
                        <input type="email" name="email" autocomplete="off"
                            placeholder="Enter {{ $type }} email" class="form-control" id="email" value="{{ $page_type == 'edit' ? $user->email : old('email') }}">
                        <span id="errorMsg2" style="color:red;display: none;"><i
                                class="ace-icon fa fa-spinner fa-spin orange bigger-120"></i>
                            &nbsp;&nbsp;Email already Exits!!</span>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone<span class="text-danger">*</span></label>
                        <input type="number" name="phone" required placeholder="Enter {{ $type }} Phone"
                            class="form-control" id="phone_number" onkeyup="phone_input()" value="{{ $page_type == 'edit' ? $user->phone : old('phone') }}">
                        <small><strong class="text-danger" id="phone_msg"></strong></small>
                    </div>
                    <div class="form-group">
                        <label for="district_id" class="form-label">District </label>
                        <select name="district_id" id="district_id" class="form-control" onchange="getThanaByDistrict()">
                            @if($page_type != 'edit')
                            <option selected disabled></option>
                            @else
                                @php
                                $distrct = \App\Models\District::where('id', $user->guardian_student->district_id ?? '')->first();
                                @endphp
                                @if($distrct)
                                    <option value="{{ $distrct->id }}">{{ $distrct->name }}</option>
                                @endif
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
                    <div class="form-group">
                        <label for="thana_id" class="form-label">Present Thana </label>
                        <select name="thana_id" id="thana_id" class="form-control" onchange="getAreaByThana()">
                            @if($page_type != 'edit')
                                <option selected disabled></option>
                            @else
                                @php
                                    $thana = \App\Models\Thana::where('id', $user->guardian_student->thana_id ?? '')->first();
                                @endphp
                                @if($thana)
                                    <option value="{{ $thana->id }}">{{ $thana->name }}</option>
                                @endif
                            @endif
                        </select>
                        @error('thana_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="area_id" class="form-label">Present Area  </label></label>
                            <input list="area_data_list" name="area_name" type="text" class="form-control" id="area_id" value="{{ $page_type == 'edit' ? (\App\Models\Area::where('id', $user->guardian_student->area_id ?? '')->first()->name ?? '') : '' }}">
                            @error('area_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <datalist id="area_data_list">

                        </datalist>
                    </div>
                    <div class="form-group">
                        <label>Status</label>

                        <select class="form-control" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inavtive</option>
                        </select>

                    </div>
                    <div class="form-group row">
                        <div class="col-8 offset-4">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Save
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->

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
@endsection
