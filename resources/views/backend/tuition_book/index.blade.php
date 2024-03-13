@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <ul class="d-flex justify-content-between list-unstyled" style="font-size: 25px">
                    <li>{{ $name }} </li>
                    <li>
                        {{ $tuition->name }} - {{ $tuition->job_id }}
                    </li>
                    <li>
                        <strong>Guardian: </strong>{{ $tuition->phone }}
                        @if ($tuition_all->isNotEmpty() && $tuition_all->first()->user)
                            <button class="btn btn-info send_sms_to_guardian"
                                data-number="{{ $tuition_all->first()->user->phone }}" data-sms-type="guardian">
                                <i class="fa fa-message"></i> G SMS
                            </button>
                        @endif
                        @if ($tuition_all->isNotEmpty() && $tuition_all->first()->user)
                            <button class="btn btn-info send_notification"
                                data-number="{{ $tuition_all->first()->user->phone }}" data-sms-type="guardian">
                                <i class="fa fa-message"></i>G Notification
                            </button>
                        @endif
                        {{-- <div class="col">
                            <button class="btn btn-info send_notification"
                                data-number="@foreach ($tuition_all->where('user', '!=', null) as $tutor){{ $tuition_all->user->id ?? '' }}, @endforeach"
                                data-sms-type="multiple"><i class="fa fa-message"></i>Send Tutor Notification</button>
                        </div> --}}


                        <button class="btn btn-info send_sms" data-number="" data-sms-type="multiple"><i
                                class="fa fa-message"></i>SMS</button>
                        <button class="btn btn-danger delete_all_selected" data-number="" data-delete-type="multiple"><i
                                class="fa fa-trash"></i></button>
                    </li>
                </ul>
                <table class="table table-bordered" style="position: sticky; ">
                    <tr class="bg-info text-light">
                        <th>Class</th>
                        <th>Medium</th>
                        <th>Subject</th>
                        <th>Gender</th>
                        <th title="Per week class">PW Class</th>
                        <th>Salary</th>
                        <th>Location</th>
                        <th>Offline/Online</th>
                        <th>No. of Students</th>
                        <th class="Per Class Duration">Duration</th>
                        <th>Notes</th>
                        <th>#</th>
                    </tr>
                    <tr>
                        <td>
                            @foreach ($tclass as $tclas)
                                {{ is_array($tuition->tclass) && in_array($tclas->id, $tuition->tclass) ? $tclas->name : '' }}
                            @endforeach
                        </td>
                        <td>

                            @foreach ($tuition->student_mediumjeson as $medium)
                                {{ $medium->name }} @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($subjects as $subject)
                                {{ is_array($tuition->subject_ids) && in_array($subject->id, $tuition->subject_ids) ? $subject->name : '' }}
                            @endforeach
                        </td>

                        <td>
                            {{ is_array($tuition->gender) && in_array('Male', $tuition->gender) ? 'Male' : '' }}
                            {{ is_array($tuition->gender) && in_array('Female', $tuition->gender) ? 'Female' : '' }}
                        </td>

                        <td>
                            @foreach ($weeklys as $weekly)
                                {{ is_array($tuition->weekly) && in_array($weekly->id, $tuition->weekly) ? $weekly->name . ($loop->last == false ? ', ' : '') : '' }}
                            @endforeach
                        </td>

                        @if ($tuition->salary_range)
                            <td>{{ $tuition->salary_range }}
                                ({{ $tuition->salary <= 0 ? 'Negotiable' : $tuition->salary }})
                            </td>
                        @else
                            <td>{{ $tuition->salary }}</td>
                        @endif

                        <td class="Location">
                            {{ $tuition->area->name ?? '' }}
                            <span class="d-block">{{ $tuition->address }}</span>
                        </td>
                        <td>
                            {{ $tuition->class_type == 'Offline' ? 'Offline' : '' }}
                            {{ $tuition->class_type == 'Online' ? 'Online' : '' }}
                        </td>
                        <td class="text-center">{{ $tuition->student_number }}</td>
                        <td class="text-center">
                            {{ $tuition->duration }}
                            {{--                            @foreach ($timelys as $timely) --}}
                            {{--                                {{is_array($tuition->interest_time) && in_array($timely->id, $tuition->interest_time) ? $timely->name . (($loop->last ==false) ? ', ' : ''): '' }} --}}
                            {{--                            @endforeach --}}
                        </td>
                        <td class="text-center">{{ $tuition->note }}</td>
                        <td>

                            <span
                                class="btn btn-outline-{{ $tuition->is_blocked_application == 'lock' ? 'danger' : 'success' }}">{{ $tuition->is_blocked_application == null ? 'Open' : $tuition->is_blocked_application }}</span>
                            <span data-toggle="modal" data-target="#lockModal"><i
                                    class="fa fa-edit cursor-pointer"></i></span>
                            <a class="btn btn-outline-success br-0"
                                href="{{ route('tuitions.edit', $tuition->id) }}">
                                <i class="fa fa-edit"></i> Edit
                            </a>

                     <td>
                        </td>
                    </tr>
                </table>

                <div class="modal fade" id="lockModal" tabindex="-1" role="dialog" aria-labelledby="lockModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="lockModalLabel">Block Application to Receive this Tuition</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('is_blocked_application') }}" method="post"
                                    id="is_blocked_application">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="tuition_id" value="{{ $tuition->id }}">
                                    <select name="is_blocked_application" class="form-control" id="">
                                        <option value="open"
                                            {{ ($tuition->is_blocked_application == 'open' or $tuition->is_blocked_application == null) ? 'selected' : '' }}>
                                            Open</option>
                                        <option value="lock"
                                            {{ $tuition->is_blocked_application == 'lock' ? 'selected' : '' }}>Lock
                                        </option>
                                    </select>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" form="is_blocked_application" class="btn btn-primary">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .tutor_table tr td {
                        vertical-align: middle !important;
                    }

                    .br-0 {
                        border-radius: 0 !important;
                    }
                </style>
                <div class="table-responsive" style="height: 70vh; overflow: scroll">
                    <table class="table table-striped tutor_table table-bordered">
                        <tr>
                            <td>SMS | Delete</td>
                            <td>No.</td>
                            <td>Name</td>
                            <td>Faculty</td>
                            <td>Department</td>
                            <td>Session</td>
                            <td>University/Institution</td>
                            <td>Area</td>
                            <td>Phone Number</td>
                            <td>Gender</td>
                            <td>SSC</td>
                            <td>HSC</td>
                            <th class="text-center">Action</th>
                        </tr>
                        @php $total_number_in_this_day = 0 @endphp
                        @php $default_date = 0 @endphp
                        @forelse ($tuition_all as $tuitions)
                            @if ($request->pending_charge)
                                @if ($tuitions->payment == null)
                                    {{--                                    @continue --}}
                                @endif
                            @endif
                            @if ($tuitions->tutor->user == '')
                                {{--                                @continue --}}
                            @endif
                            <tr>
                                <td class="position-left-sticky" style="left: 0px !important;">

                                    <span class="d-flex justify-content-around">
                                        <input type="checkbox" name="sms_phone_number"
                                            value="{{ $tuitions->tutor->user->phone ?? '' }}">
                                        <input type="checkbox" name="delete_application" value="{{ $tuitions->id ?? '' }}"
                                            tutor_name="{{ $tuitions->tutor->user->name ?? '' }}">
                                    </span>

                                </td>
                                <td>

                                    {{ $loop->index + 1 }}
                                </td>
                                <td class="position-left-sticky" style="left: 80px !important;">
                                    @if($tuitions->tutor)
                                        <a href="{{ route('tutors.show', $tuitions->tutor->id) }}">{{ $tuitions->tutor->user->name ?? '' }}</a>
                                    @else
                                        N/A 
                                    @endif
                                </td>                                {{-- <td>{{ $tuitions->tutor->user->name ?? '' }}</td> --}}
                                <td>{{ $tuitions->tutor->faculty  ?? '' }}</td>
                                <td> {{ $tuitions->tutor->subject_name ?? '' }}</td>
                                <td>{{ $tuitions->tutor->session ?? '' }}</td>
                                <td>{{ $tuitions->tutor->institution ?? '' }}</td>
                                <td>{{ $tuitions->tutor->area->name ?? '' }} ,
                                    {{ $tuitions->tutor->division->name ?? '' }}</td>
                                <td>{{ $tuitions->tutor->user->phone ?? '' }}</td>
                                <td>{{ ucfirst($tuitions->tutor->gender ?? '') }}</td>
                                <td>
                                    <p class="m-0">G- {{ $tuitions->tutor->ssc_group ?? '' }}</p>
                                    <p class="m-0">M- {{ $tuitions->tutor->hsc_medium ?? '' }}</p>
                                </td>
                                <td>
                                    <p class="m-0">G- {{ $tuitions->tutor->hsc_group ?? '' }}</p>
                                    <p class="m-0">M- {{ $tuitions->tutor->hsc_medium ?? '' }}</p>
                                </td>
                                <td>
                                    <span class="d-flex justify-content-around">
                                        <a class="btn btn-outline-dark br-0" role="button" data-toggle="popover"
                                            data-trigger="focus" data-html="true" title="Tutor Urgency"
                                            data-content="
                                            {{ \App\Models\TuitionBook::where('tutor_id', $tuitions->tutor->id ?? 0)->where('tuition_id', $tuition->id)->first()->tutor_urgency ?? null }}
                                        "
                                            tabindex="0" data-placement="left">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-outline-success br-0"
                                            href="{{ route('tuition_book.edit', $tuitions->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('tutors.show', $tuitions->tutor->id ?? 0) }}"
                                            class="btn btn-sm btn-outline-info br-0" target="_blank">
                                            <i class="fa fa-user"></i>
                                        </a>
                                        <a href="{{ route('tutors.print', $tuitions->tutor->id ?? 0) }}?tuition_id={{ $tuition->id }}"
                                            class="btn btn-sm btn-outline-info br-0" target="_blank">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </span>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="25" class="text-center">No Data Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.popover-dismiss').popover({
                trigger: 'focus'
            })
        })
    </script>


    @push('footer_js')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable({
                    paging: false,
                    "searching": false
                });


                $(".send_sms").click(function(e) {
                    nunbers = ''

                    var checkboxes = document.querySelectorAll('input[name=sms_phone_number]:checked')

                    for (var i = 0; i < checkboxes.length; i++) {
                        nunbers += ',' + (checkboxes[i].value)
                    }

                    sms_type = $(this).data('sms-type')

                    $(".tutor_phones_numbers").val(nunbers)

                    if (sms_type == 'multiple') {
                        $('#sms_type_message').text('All Selected Tutor')
                        $('.sms_type').val('multiple')
                    } else {
                        $('#sms_type_message').text($(this).data('sms-receiver-name'))
                        $('.sms_type').val('single')
                    }

                    $("#sendSmsModal").modal('show');
                });


                $(".delete_all_selected").click(function(e) {
                    ids = ''
                    names = ''

                    var checkboxes = document.querySelectorAll('input[name=delete_application]:checked')

                    for (var i = 0; i < checkboxes.length; i++) {
                        ids += ',' + (checkboxes[i].value)
                        // names += ','+(checkboxes[i].attr('tutor_name'))
                    }

                    delete_type = $(this).data('delete-type')

                    $(".tuition_book_ids").val(ids)
                    $(".tutor_names").text(names)

                    $('#delete_type_message').text('All Selected Tutor')


                    $("#delete_selected_Modal").modal('show');
                });
            });
        </script>
    @endpush

    @push('modals')
        <div class="modal text-left fade" id="send_sms_to_guardian" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send SMS to <strong class="text-uppercase text-danger"
                                id="sms_type_message"></strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('sendSms') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Select Template</label>
                                <select id="sms_template" class="form-control">
                                    <option selected disabled>Select Template</option>
                                    @foreach (\App\Models\SmsTemplate::where('status', 1)->get() as $sms_template)
                                        <option value="{{ $sms_template->body }}">{{ $sms_template->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">SMS Body</label>
                                <textarea name="sms_body" id="sms_body" class="form-control" style="height: 100px;">{{ old('sms_body') }}</textarea>
                                @error('sms_body')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Select Guardian Phone</label>
                                <select name="guardian_phone_modal" id="phone" class="form-control" required>
                                    <option selected disabled>Select phone Number</option>
                                    @foreach (\App\Models\User::where('status', 1)->where('user_type', 'guardian')->get() as $user)
                                        <option value="{{ $user->phone }}">{{ $user->phone }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <input type="hidden" value="" name="tutor_phones_numbers" class="tutor_phones_numbers">
                <input type="hidden" value="sms_type" name="sms_type" id="sms_type"> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close_text" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal text-left fade" id="sendNotificationModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send Notification to <strong
                                class="text-uppercase text-danger" id="notification_type_message"></strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('send_notification') }}" method="POST">
                        @csrf
                        <input type="hidden" value="" name="user_ids" class="user_ids">
                        <!-- Add the notification_type field with a name attribute -->
                        <input type="hidden" value="" name="notification_type" id="notification_type">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Select Template</label>
                                <select id="notification_template" name="notification_title" class="form-control" required>
                                    <option selected disabled>Select Template</option>
                                    @foreach (\App\Models\NotificationTemplate::where('status', 1)->get() as $sms_template)
                                        <option value="{{ $sms_template->title }}" data-body="{{ $sms_template->body }}">
                                            {{ $sms_template->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Notification Body</label>
                                <textarea name="notification_body" id="notification_body" class="form-control" style="height: 100px;">{{ old('notification_body') }}</textarea>
                                @error('notification_body')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close_text" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal text-left fade" id="sendSmsModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send SMS to <strong class="text-uppercase text-danger"
                                id="sms_type_message"></strong></h5>
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
                                <label for="">Select Template</label>
                                <select id="sms_template" class="form-control">
                                    <option selected disabled>Select Template</option>
                                    @foreach (\App\Models\SmsTemplate::where('status', 1)->get() as $sms_template)
                                        <option value="{{ $sms_template->body }}">{{ $sms_template->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">SMS Body</label>
                                <textarea name="sms_body" id="sms_body" class="form-control" style="height: 100px;">{{ old('sms_body') }}</textarea>
                                @error('sms_body')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close_text" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(".close, .close_text").click(function(e) {
                $("#sendSmsModal").modal('hide')
            });

            $("#sms_template").change(function(e) {
                var conceptName = $('#sms_template').find(":selected").val();
                $("#sms_body").text('')
                $("#sms_body").text(conceptName)
            });
        </script>

        <div class="modal text-left fade" id="delete_selected_Modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Application <strong
                                class="text-uppercase text-danger" id="delete_type_message"></strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('delete_application') }}" method="POST">
                        @csrf
                        <input type="hidden" value="" name="tuition_book_ids" class="tuition_book_ids">
                        <div class="modal-body">


                            <span id="tutor_names"></span>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close_text" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(".close, .close_text").click(function(e) {
                $("#delete_selected_Modal").modal('hide')
            });

            $("#sms_template").change(function(e) {
                var conceptName = $('#sms_template').find(":selected").val();
                $("#sms_body").text('')
                $("#sms_body").text(conceptName)
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.send_sms_to_guardian').click(function() {
                    var guardianPhone = $(this).data('number');
                    $('#guardian_phone_modal').val(guardianPhone);
                    $('#send_sms_to_guardian').modal('show');
                });

                $('.send_notification').click(function() {
                    var notificationType = $(this).data('sms-type');

                    // Set the value of notification_type when opening the modal
                    $('#notification_type').val(notificationType);

                  // Add script to handle opening sendNotificationModal
                    $('#sendNotificationModal').modal('show');
                });

                $(".close, .close_text").click(function(e) {
                    $("#send_sms_to_guardian").modal('hide');
                    $("#sendNotificationModal").modal('hide');
                });

                $("#sms_template").change(function(e) {
                    var conceptName = $('#sms_template').find(":selected").val();
                    $("#sms_body").text('');
                    $("#sms_body").text(conceptName);
                });

                $("#notification_template").change(function(e) {
                    var conceptName = $('#notification_template').find(":selected").data('body');
                    $("#notification_body").text('');
                    $("#notification_body").text(conceptName);
                });
            });
        </script>
    @endpush



@endsection
