@extends('backend.layouts.app')

@section('content')
    <form action="{{ route('tuition_book.application_update',$tuition->id ) }}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card-box">
                    <h4 class="header-title m-t-0">Basic Section </h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="userName">Tutor<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="tutor_id" id="tutor_id">
                                     @foreach ($tutors as $tutor)
                                        <option {{ $tuitionBook->tutor_id ==$tutor->id ? 'selected': '' }} value="{{ $tutor->id }}">{{ $tutor->user->name }} - {{ $tutor->tutor_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dristrict">Tuition<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="tuition_id" id="tuition_id">
                                    <option value="{{ $current_tuition->id }}" selected>{{ $current_tuition->name }} {{ $current_tuition->job_id }}</option>
{{--                                    @foreach ($tuitions as $tuition)--}}
{{--                                    <option value="{{ $tuition->id }}">{{ $tuition->name }} {{ $tuition->job_id }}</option>--}}
{{--                                @endforeach--}}
                                </select>
                                @error('tuition_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="duration">Salary<span class="text-danger"></span></label>
                                <input id="salary" type="text" value="{{ $tuitionBook->salary ?? 0 }}" placeholder="salary" name="salary"  required class="form-control" onkeyup="calculate_media_charge()">
                            </div>
                            <div class="form-group">
                                <label for="duration">Media Charge (%)<span class="text-danger"></span></label>
                                <input id="media_charge_percent" type="text" value="{{ $tuitionBook->payment->media_charge_percent ?? 0 }}"  placeholder="Media Charge (%)" name="media_charge_percent"  required class="form-control"  onkeyup="calculate_media_charge()">
                            </div>
                            <div class="form-group">
                                <label for="duration">Media Charge Payment<span class="text-danger"></span></label>
                                <input id="media_charge_amount" readonly type="text" value="{{ $tuitionBook->payment->amount ?? 0 }}" placeholder="Media Charge" name="media_charge_amount"
                                    required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="dristrict">Payment Status</label>
                                <select class="form-control select2" name="payment_status" id="payment_status">

                                    <option {{ $tuitionBook->payment_status=='Pending'? 'selected':'' }} value="Pending">Unpaid</option>
                                    <option {{ $tuitionBook->payment_status=='Completed'? 'selected':'' }} value="Completed">Paid</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dristrict">Status</label>
                                <select class="form-control select2" name="status" id="status">
                                    <option {{ $tuitionBook->status=='0'? 'selected':'' }} value="0">Pending</option>
                                    <option {{ $tuitionBook->status=='1'? 'selected':'' }} value="1">Booked</option>
                                    @if($tuitionBook->status=='0' OR $tuitionBook->status=='2')
                                        <option {{ $tuitionBook->status=='3' ? 'selected': '' }} value="3">Reject</option>
                                    @endif
                                </select>
                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label for="phone">Details<span class="text-danger">*</span></label>--}}
{{--                                <textarea class="form-control ckeditor" name="details" id="" rows="5"> {{$tuitionBook->details  }}</textarea>--}}
{{--                            </div>--}}

                            <span id="send_sms">
                                <div class="form-group">
                                    <label for="send_sms_to_tutor" class="cursor-pointer">
                                        <input type="checkbox" name="send_sms_to_tutor" value="on" id="send_sms_to_tutor" checked> Notify Tutor
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="send_sms_to_tution_provider" class="cursor-pointer">
                                        <input type="checkbox" name="send_sms_to_tution_provider" value="on" id="send_sms_to_tution_provider"> Notify Guardian
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="move_to_next_stage" class="cursor-pointer">
                                        <input type="checkbox" name="move_to_next_stage" value="on" id="move_to_next_stage"> Move to next stage
                                    </label>
                                </div>
                            </span>




                        </div>

                    </div>
                </div> <!-- end card-box -->

            </div>
            <!-- end col -->


            <div class="form-group row">
                <div class="col-8 offset-4">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                        Save
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
    <script src="{{ asset('backend/js/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
        .create( document.querySelector( '.ckeditor' ) )
        .catch( error => {
        console.error( error );
        } );
        </script>
    <script>
        var salary = $("#salary").val()
        var percent = $("#media_charge_percent").val()

        function calculate_media_charge(){
            var salary = $("#salary").val()
            var percent = $("#media_charge_percent").val()

            var result = (salary / 100) * percent
            console.log(result)
            document.getElementById('media_charge_amount').value = result
        }

        calculate_media_charge()
    </script>
    <script>
        $(document).ready(function() {
            $('.multipleSelect').select2();
            $('#email').attr('autocomplete', 'off');
            $('#textbox1').val(this.checked);

            $('#textbox1').change(function() {
                if(this.checked) {
                    $('#already_user').hide();
                    $('#photo').hide();
                    $('#user_dropdown').show();
                }else{
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
