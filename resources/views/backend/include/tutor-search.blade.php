<label class="cursor-pointer">
    <input type="checkbox" id="advance_search_checkbox" {{ $request->form_search ? 'checked' : '' }}> Advance Search Option
</label>

<form action="" method="get" class="{{ $request->form_search ?? 'd-none' }}" id="advance_search_form">
    <div class="row">
{{--        <div class="col-md-2 col-12">--}}
{{--            <div class="form-group">--}}
{{--                <select class="form-control select2" name="division_id" id="division_id"--}}
{{--                        onchange="getDistrictByDivition()">--}}
{{--                    <option value="">Select Tutor Division</option>--}}
{{--                    @foreach ($divisions as $division)--}}
{{--                        <option value="{{ $division->id }}">{{ $division->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="col-md-2 col-12">
            <div class="form-group">
                <select class="form-control select2" name="district_id" id="district_id"
                        onchange="getAreaByDistrict()">
                    <option value=""> Tutor District</option>
                    @foreach(\App\Models\District::orderBy('name', 'ASC')->get() as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="form-group">
                <select class="form-control select2" name="thana_id" id="thana_id">
                    <option value=""> Tutor Thana</option>
                </select>
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="form-group">
                <select class="form-control select2" id="area_id" name="area_id">
                    <option value=""> Tutor Area</option>
                </select>
            </div>
        </div>

        <div class="col-md-2 col-12">
            <div class="form-group">
                <input type="text" name="tutor_institution" placeholder="Tutor Institution" class="form-control">
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="form-group">
                <select name="faculty" class="form-control" id="">
                    <option selected value="" class="text-muted">Faculty</option>
                    @foreach(\App\Models\TutorFaculty::get() as $tutor_faculty)
                        <option {{ request()->get('faculty') == $tutor_faculty->name ? 'selected' : '' }}>{{ $tutor_faculty->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-md-2 col-12">
            <div class="form-group">
                <input type="text" name="tutor_subject_name" placeholder="Tutor Subject" class="form-control" id="tutor_subject_name">
            </div>
        </div>

        <div class="col-md-2 col-12">
            <div class="form-group">
                <select class="form-control select2" name="medium_id" id="medium_id">
                    <option value=""> SSC Medium</option>
                    @foreach ($mediums as $medium)
                        <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="form-group">
                <select class="form-control select2" name="medium_id" id="medium_id">
                    <option value="">HSC Medium</option>
                    @foreach ($mediums as $medium)
                        <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="form-group">
                <select class="form-control select2" name="medium_id" id="medium_id">
                    <option value="">HSC Medium</option>
                    @foreach ($mediums as $medium)
                        <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="form-group">
                <select class="form-control select2" name="area_id" id="area_id">
                    <option value="">Prefered Area</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-2 col-12">
            <div class="form-group">
                <select class="form-control select2" id="tutor_gender" name="tutor_gender">
                    <option value="">Tutor Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>

        <div class="col-md-2 col-12">
            <div class="form-group">
                <input type="text" name="tutor_name" placeholder="Tutor Name" class="form-control">
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="form-group">
                <input type="text" name="tutor_phone" placeholder="Tutor Phone" class="form-control">
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="form-group">
                <input type="text" name="tutor_code" placeholder="Tutor Code" class="form-control">
            </div>
        </div>






{{--        <div class="col-md-2 col-12">--}}
{{--            <div class="form-group">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-3 pr-0">--}}
{{--                        <select name="tutor_salary_type" class="form-control text-center" id=""  style="border-radius: 5px 0 0 5px; border-right: 0">--}}
{{--                            <option value="=" selected>=</option>--}}
{{--                            <option value="<"><</option>--}}
{{--                            <option value=">">></option>--}}
{{--                            <option value="Negotiable">Negotiable</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-9 pl-0">--}}
{{--                        <input type="text" min="1" name="tutor_salary" placeholder="Tutor Salary" class="form-control" style="border-radius: 0 5px 5px 0">--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-md-2 col-12">--}}
{{--            <div class="form-group">--}}
{{--                <select class="form-control select2 cursor-disabled" name="premium" id="premium" disabled title="Temporary Disabled till not complete being developed">--}}
{{--                    <option value="">Select Premium Status</option>--}}
{{--                    <option value="1">Premium Tutor</option>--}}
{{--                    <option value="0">Non-Premium Tutor</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-md-2 col-12">--}}
{{--            <div class="form-group">--}}
{{--                <select class="form-control select2" name="status" id="status">--}}
{{--                    <option value="">Status</option>--}}
{{--                    <option value="active">Active</option>--}}
{{--                    <option value="inactive">In-active</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="col-md-2 col-12">
            <div class="form-group">
                <select class="form-control select2" name="top" id="top">
                    <option value=""> Top Status</option>
                    <option value="1">Top Tutor</option>
                    <option value="0">Non-top Tutor</option>
                </select>
            </div>
        </div>

    </div>


    <div class="row">



        <div class="col-md-2 col-12">
            <div class="form-group">
                <select class="form-control select2" name="interested_medium_id" id="interested_medium_id">
                    <option value=""> Preferred Medium</option>
                    @foreach ($mediums as $medium)
                        <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="form-group">
                <select class="form-control select2" name="interested_subject_id" id="interested_subject_id">
                    <option value=""> Preferred Subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2 col-12">
            <div class="form-group">
                <select class="form-control select2" name="interested_class_id" id="interested_class_id">
                    <option value=""> Preferred Class</option>
                    @foreach ($tclasses as $tclas)
                        <option value="{{ $tclas->id }}">{{ $tclas->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

{{--        <div class="col-md-2 col-12">--}}
{{--            <div class="form-group">--}}
{{--                <select class="form-control select2" name="interested_time_id" id="interested_time_id">--}}
{{--                    <option value=""> Time</option>--}}
{{--                    @foreach ($timelys as $timely)--}}
{{--                        <option value="{{ $timely->id }}">{{ $timely->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-md-2 col-12">
            <div class="form-group">
                <select class="form-control select2" name="permanent_district_id" id="permanent_district_id">
                    <option value=""> Home District</option>
                    @foreach (\App\Models\District::orderBy('name', 'ASC')->get() as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2 col-12 text-center">
            <div class="form-group">
                <button class="btn btn-success btn-light" type="submit" name="form_search" value="search_submitted"><i class="fa fa-search"></i> Search</button>
                <button class="btn btn-outline-info btn-light"><a class="fa fa-refresh text-dark" href="{{ route('tutors.index') }}">Abort Searching</a></button>
            </div>
        </div>
    </div>
</form>

@push('footer_js')
    <script>
        $("#advance_search_checkbox").change(function(e){
            if($(this).prop("checked")){
                $("#advance_search_form").removeClass('d-none');  // checked
                $("#advance_search_form").addClass('d-inline');  // checked
            }else{
                $("#advance_search_form").removeClass('d-inline');
                $("#advance_search_form").addClass('d-none');  // checked
            }
        })
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

        function getThanaByDistrict() {
            let district_id = $("#district_id").val();
            $('#area_id').find('option').remove().end();
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
                    console.log(data.options);
                    document.getElementById("thana_id").innerHTML = data.options
                },
                error: function() {
                    alert('Something Getting Wrong! Please reload the page and try again')
                }
            });
        }

        function getAreaByDistrict() {
            getThanaByDistrict()
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

    </script>


@endpush
