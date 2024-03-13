@extends('backend.layouts.app')

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <div class="d-flex justify-content-between">
                    <h4 class="header-title m-b-15 m-t-0 text-capitalize">Manage {{ $type }}</h4>
                    <button class="btn btn-info fa fa-message send_sms" data-number="@foreach($users as $user){{ $user->phone ?? '' }},@endforeach" data-sms-type="multiple">SMS to ALL</button>
                </div>

                <form action="{{ route('guardian_or_student.index') }}" method="get" class="{{ $request->form_search ?? 'd-none' }}" id="search_form"></form>
                <div class="table-responsive">
                <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap" cellspacing="0" width="100%" id="datatable">
                    <thead>
                    <tr>
                        <th class="position-left-sticky" style="left: 0px !important; z-index: 1; width: 20px">
                            <input type="checkbox" id="all_checked">
                        </th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>District</th>
                        <th>Thana</th>
                        <th>Area</th>
                        <th>Status</th>
                        <th>Offered Tuition</th>
                        <th>Created Date</th>
                        <th class="hidden-sm">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="position-left-sticky" style="left: 0px !important;">
                            <input type="checkbox" class="sms_phone_checkbox" name="sms_phone_checkbox" value="{{ $user->user->phone ?? '' }}" data-id="{{ $user->id }}">
                        </td>
                        <td>#</td>
                        <td>
                            <input type="text" name="name" placeholder="Name" class="form-control" form="search_form" value="{{ request()->get('name') }}">
                            <input type="hidden" name="type" value="{{ $type }}" form="search_form">
                        </td>
                        <td>
                            <input type="text" name="phone" placeholder="phone" class="form-control" form="search_form" value="{{ request()->get('phone') }}">
                        </td>
                        <td>
                            <select name="district_id" class="form-control" id="district_id" onchange="getThanaByDistrict()" form="search_form">
                                <option value="" selected disabled>--District--</option>
                                @foreach(\App\Models\District::orderBy('name', 'ASC')->get() as $district)
                                    <option value="{{ $district->id }}" @if(request()->get('district_id') == $district->id) selected @endif>{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="thana_id" class="form-control" id="thana_id" onchange="getAreaByThana()" form="search_form">
                                <option value="" selected disabled>--Thana--</option>
                                @foreach(\App\Models\Thana::orderBy('name', 'ASC')->get() as $thana)
                                    <option value="{{ $thana->id }}" @if(request()->get('thana_id') == $thana->id) selected @endif>{{ $thana->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="area_id" class="form-control" id="area_id" form="search_form">
                                <option value="" selected disabled>--Area--</option>
                                @foreach(\App\Models\Area::orderBy('name', 'ASC')->get() as $area)
                                    <option value="{{ $area->id }}" @if(request()->get('area_id') == $area->id) selected @endif>{{ $area->name }}</option>
                                @endforeach
                            </select>
                        </td>


                        <td>

                        </td>
                        <td>#</td>
                        <td>#</td>
                        <td>
                            <button class="btn btn-outline-dark btn-light" type="submit" name="form_search" value="search_submitted" form="search_form"><i class="fa fa-search"></i> Search</button>
                            <a class="btn btn-outline-warning btn-light" href="{{ route('guardian_or_student.index') }}?type={{ $type }}"><i class="fa fa-times"></i> Clear</a>
                        </td>
                    </tr>

                    @forelse ($users as $user)

                    <tr>

                        <td class="position-left-sticky" style="left: 0px !important;">
                            <input type="checkbox" class="sms_phone_checkbox" name="sms_phone_checkbox" value="{{ $user->user->phone ?? '' }}" data-id="{{ $user->id }}">
                        </td>
                        <td><b><?= $user->id ?> </b></td>

                        {{-- <td><b>{{ $loop->index + 1 }}</b></td> --}}
                        <td><a href="{{ route('guardian_or_student.show', $user->id) }}">{{ $user->name ?? '' }}</a> </td>

                        <td>{{ $user->phone ?? '' }}</br>
                            <a href="https://wa.me/+88{{ $user->whatsapp  ?? '' }}" target="_blank">w:{{ $user->whatsapp }}</a></td>
                        </td>
                        <td>{{ $user->guardian_student->district->name ?? '' }}</td>
                        <td>{{ $user->guardian_student->thana->name ?? '' }}</td>
                        <td>{{ $user->guardian_student->area->name ?? '' }}</td>
                        <td> <span class="badge badge-{{ $user->status==1 ? 'info' : 'danger' }}">{{ $user->status==1 ?'Active':'In-Active' }}</span></td>
                        <td>{{ count($user->tuitions)  }}</td>
                        <td>{{ date('d-m-Y',strtotime($user->created_at)) }}</td>
                        <td class="text-center">
                            <div class="btn-group dropdown">
                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="{{ route('guardian_or_student.show',$user->id) }}?type={{$type}}&user_id={{ $user->id }}"><i class="mdi mdi-information m-r-10 text-muted font-18 vertical-middle"></i>Details</a>
                                    <a class="dropdown-item" href="{{ route('guardian_or_student.edit',$user->id) }}?type={{$type}}&user_id={{ $user->id }}"><i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit</a>


                                    <span class="send_sms dropdown-item cursor-pointer" data-number="{{ $user->phone }}" data-sms-type="single" data-sms-receiver-name="{{ $user->name }}"><i class="mdi mdi-message m-r-10 text-muted font-18 vertical-middle"></i>Send SMS</span>

                                    <form action="{{ route('guardian_or_student.status') }}" method="post">
                                        <input type="hidden" name="type" value="{{ $type }}">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to {{ $user->status==1 ?'InActive':'Active' }} this Tutor?')"> <i class="mdi mdi-check-all m-r-10 text-muted font-18 vertical-middle"></i>{{ $user->status==1 ?'InActive':'Active' }}</button>
                                    </form>
                                    <form action="{{ route('guardian_or_student.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to delete this Tutor?')"> <i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty

                    @endforelse
                    </tbody>
                </table>
                </div>
                {{ $users->appends(Request::except('page'))->links() }}
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>

    @push('footer_js')

        <script>

            function getThanaByDistrict() {
                var district_id = $("#district_id").val();
                $('#thana_id').find('option').remove().end();
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
                        document.getElementById("thana_id").innerHTML = data.options
                    },
                    error: function() {
                        alert('Something Getting Wrong! Please reload the page and try again')
                    }
                });
            }

            function getAreaByThana() {
                var thana_id = $("#thana_id").val();
                $('#area_id').find('option').remove().end();
                jQuery.ajax({
                    url: "{{ url(route('getAreaByDistrict')) }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        thana_id: thana_id
                    },
                    method: "POST",
                    success: function(data) {
                        document.getElementById("area_id").innerHTML = data.options
                    },
                    error: function() {
                        alert('Something Getting Wrong! Please reload the page and try again')
                    }
                });
            }
        </script>

    @endpush
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').dataTable({
                paging: false,
                "searching": false
            });


            $(".send_sms").click(function(e){
                nunbers = $(this).data('number')
                sms_type = $(this).data('sms-type')

                $(".tutor_phones_numbers").val(nunbers)

                if(sms_type == 'multiple'){
                    $('#sms_type_message').text('All Viewed Tutor')
                    $('.sms_type').val('multiple')
                }else{
                    $('#sms_type_message').text($(this).data('sms-receiver-name'))
                    $('.sms_type').val('single')
                }

                $("#sendSmsModal").modal('show');
            });
        });
    </script>

    @push('modals')
    <div class="modal text-left fade" id="sendSmsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send SMS to <strong class="text-uppercase text-danger" id="sms_type_message"></strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('send_sms') }}" method="POST">
                    @csrf
                    <input type="hidden" value="" name="tutor_phones_numbers" class="tutor_phones_numbers">
                    <input type="hidden" value="" name="sms_type" class="sms_type">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">SMS Body</label>
                            <textarea name="sms_body" id="" class="form-control" style="height: 100px;">{{ old('sms_body') }}</textarea>
                            @error('sms_body')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            // ...

            // Handle top checkbox to select all
            $("#all_checked").click(function(){
                $(".sms_phone_checkbox").prop('checked', $(this).prop('checked'));
            });

            // Handle individual checkboxes
            $(".sms_phone_checkbox").click(function(){
                if($(".sms_phone_checkbox:checked").length == $(".sms_phone_checkbox").length) {
                    $("#all_checked").prop('checked', true);
                } else {
                    $("#all_checked").prop('checked', false);
                }
            });

            // ...
        });
    </script>
    @endpush

@endsection
