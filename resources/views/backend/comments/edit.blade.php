@extends('backend.layouts.app')

@section('content')
    <form action="{{ route('tuition_comment.update', $comment->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <input type="hidden" name="comment_id" value="{{ $comment->id }}" readonly>
        <div class="row">
            <div class="col-6 col-md-8 d-flex justify-content-center">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">User</label>
                            <select name="user_id" id="" class="form-control select2">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $comment->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Tuition <i>(By Job ID)</i></label>
                            <select name="tuition_id" id="" class="form-control select2">
                                @foreach($tuitions as $tuition)
                                    <option value="{{ $tuition->id }}" {{ $tuition->id == $comment->id ? 'selected' : '' }}>{{ $tuition->job_id }}</option>
                                @endforeach
                            </select>
                            @error('tuition_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="" class="form-control cursor-pointer">
                                <option value="1" {{ $comment->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0"  {{ $comment->status == 0 ? 'selected' : '' }}>In-Active</option>
                            </select>
                            @error('status')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Verification Status</label>
                            <select name="verified" id="" class="form-control cursor-pointer">
                                <option value="1"  {{ $comment->verified == 1 ? 'selected' : '' }}>Verified</option>
                                <option value="0"  {{ $comment->verified == 0 ? 'selected' : '' }}>General</option>
                            </select>
                            @error('verified')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Anonymous Status</label>
                            <select name="anonymous" id="" class="form-control cursor-pointer">
                                <option value="0"  {{ $comment->anonymous == 0 ? 'selected' : '' }}>Public</option>
                                <option value="1" {{ $comment->anonymous == 1 ? 'selected' : '' }}>Anonymous</option>
                            </select>
                            @error('anonymous')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Comment</label>
                            <textarea name="body" id="" cols="30" class="w-100">{{ $comment->body }}</textarea>
                            @error('body')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Save
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Reset
                            </button>
                        </div>
                    </div>
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
