@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h2 class="header-title m-b-15 m-t-0 h3"></h2>
                <div class="row">
                    <?php
                    if ($status == 0) {
                        $data_type = 'pending_book';
                        $type = 'pending_book=true';
                        $bg = 'c5fff3';
                    } elseif ($status == 2) {
                        $data_type = 'applied_book';
                        $type = 'applied_book=true';
                        $bg = '7ff0d9';
                    }
                    ?>

                    <form action="" method="get" id="searching_form">
                        <input type="hidden" name="{{ $data_type }}" value="true">
                    </form>
                    <div class="row d-flex justify-content-between">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="job_id" placeholder="Tuition ID/ Job ID" class="form-control"
                                    form="searching_form" value="{{ request()->get('job_id') }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="tutor_phone" placeholder="Tutor Phone" class="form-control"
                                    form="searching_form" value="{{ request()->get('tutor_phone') }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select name="area_id" class="form-control select2" id="" form="searching_form">
                                    <option value="">Area</option>
                                    @foreach (\App\Models\Area::take(100)->get() as $area)
                                        <option value="{{ $area->id }}"
                                            {{ request()->get('area_id') == $area->id ? 'selected' : '' }}>
                                            {{ $area->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select name="class_id" class="form-control select2" id="" form="searching_form">
                                    <option value="">Class</option>
                                    @foreach (\App\Models\Tclass::get() as $tclass)
                                        <option value="{{ $tclass->id }}"
                                            {{ request()->get('class_id') == $tclass->id ? 'selected' : '' }}>
                                            {{ $tclass->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="guardian_phone" placeholder="Guardian Phone"
                                    class="form-control" form="searching_form">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-secondary" form="searching_form"><i
                                        class="fa fa-search"></i></button>
                                <a href="{{ route('tuition_book.index') }}?{{ $type }}"
                                    class="btn btn-outline-danger"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="col">
                            @if ($tuition_all->isNotEmpty() && $tuition_all->first()->user)
                                <button class="btn btn-info send_sms_to_guardian"
                                    data-number="{{ $tuition_all->first()->user->phone }}" data-sms-type="guardian">
                                    <i class="fa fa-message"></i> Send G SMS
                                </button>
                            @endif
                        </div>
                        <div class="col">
                            @if ($tuition_all->isNotEmpty() && $tuition_all->first()->user)
                                <button class="btn btn-info send_notification"
                                    data-number="{{ $tuition_all->first()->user->phone }}" data-sms-type="guardian">
                                    <i class="fa fa-message"></i> Send G Notification
                                </button>
                            @endif
                        </div>
                        <div class="col">
                            <button class="btn btn-info send_notification" data-sms-type="multiple">
                                @foreach ($tuition_all->where('tuition_books.user', '!=', null) as $tuition)
{{ $tuition->tuition_books->first()->user->id ?? '' }},
@endforeach
                            <i class="fa fa-message"></i> Send T Notification
                        </button>


                    </div>

                </div>

                <div class="table-responsive-md" style="height: 70vh; overflow: scroll">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Date.</th>
                            <th class="d-flex justify-content-between">
                                <p>Title</p>
                                <h2>{{ $name ?? ' All' }}</h2>
                            </th>
                            <td>Time</td>
                            <td>Exact time to Assigned the tuition</td>
                            <th class="text-center">Note</th>
                            {{-- <th class="text-center">daily tuition</th> --}}
                            <th class="text-center">Tuition ID</th>


                            @if (request()->get('applied_book'))
<th class="text-center">Find Tutor</th>
                            <th class="text-center">Total Applied</th>
                            <th class="text-center">Assigned to Pending</th>
@endif
                            @if (request()->get('pending_book'))
<th class="text-center">Assigned to Pending</th>
@endif
                            @if (!request()->get('not_applied'))
<th class="text-center">Action</th>
@endif
                            <th>lock</th>
                        </tr>
                        @php
                            $currentDate = null;
                            $rowColor = null;
                        @endphp
                        @php $have_date = false @endphp
                        @php $default_date = null @endphp
                        @forelse($tuition_all as $tuition)
@php
    $total = count($tuition->tuition_books);
    $total_send_to_pending = $tuition->tuition_books->where('status', 0)->count();
    $total_tuition = \App\Models\Tuition::whereDate('created_at', $tuition->created_at)
        ->get()
        ->count();
    $tuitionDate = date_format(date_create($tuition->created_at), 'Y-m-d');
@endphp

                        @if ($tuitionDate !== $currentDate)
@php
    // Change color logic goes here, for example, generateRandomColor()
    $rowColor = $rowColor === 'bg-danger' ? 'bg-success' : 'bg-danger';
    $currentDate = $tuitionDate;
@endphp
@endif
                        {{-- @php dd($tuition->tuition_books) @endphp --}}
                        @php $total = count($tuition->tuition_books) @endphp

                        @if (request()->get('applied_book'))
{{-- যখন টিউশন ‘অ্যাপ্লায়েড হয়ে থাকবে, তখন যতজন পেন্ডিং এ পাঠানো হয়েছে, তাদের ডাটাও যেন আসে --}}
                        {{-- পরবর্তীতে তাদের পাশাপাশি রাখা হবে। --}}
                        {{-- @php $total = $tuition->tuition_books->where('status', 2)->count() @endphp --}}
                        @php $total_send_to_pending = $tuition->tuition_books->where('status', 0)->count() @endphp
@endif
                        @php
                            $total_tuition = \App\Models\Tuition::whereDate('created_at', $tuition->created_at)
                                ->get()
                                ->count();
                            $date = date_format(date_create($tuition->created_at), 'd-M y');
                        @endphp

                        <tr>

                            {{-- <td>({{ $total_tuition }}) {{ $date }}</td> --}}
                            <td class="{{ $rowColor }}" style="color: #fff">
                                ({{ $total_tuition }})
{{ \Carbon\Carbon::parse($tuitionDate)->format('d F Y') }}
                            </td>

                            <td>
                                {{ $tuition->name }}
                                {{-- <br> {{ $tuition->note ? "Note: $tuition->note" : '' }} --}}
                                {!! $tuition->tuitions_status == 2 ? '<span class="badge badge-info">Booked</span>' : '' !!}
                            </td>
                            <td>{{ $tuition->created_at->diffForHumans() }}</td>
                            <td>{{ $tuition->created_at->diff($tuition->admin_approved_at)->format('%h hours %i minutes %s seconds') }} </td>

                            <td>
                                <!-- {{ $tuition->note }} -->
                                <span class=" edit_note" data-id="{{ $tuition->id }}" data-note="{{ $tuition->note }}">
                                    <i class="fa fa-info-circle cursor-pointer"></i>
                                </span>

                            </td>
                            {{-- <td></td> --}}
                            <td class="text-center">{{ $tuition->job_id }}</td>
                            <td>
                                <a target="_blank" href="{{ route('tutors.index') }}?form_search=find_tutor&interest_institution={{ $tuition->interest_institution }}&interest_sub={{ json_encode($tuition->interest_sub) }}&interest_medium={{ json_encode($tuition->interest_medium) }}&interest_gender={{ json_encode($tuition->interest_gender) }}&tutor_faculty={{ $tuition->tutor_faculty }}&interest_class={{ json_encode($tuition->interest_class) }}">
                                    <small class="btn btn-sm btn-outline-dark">Find Tutor</small>
                                </a>
                            </td>
                            <td class="text-center" style="width: 50px">
                                <p class="badge m-0 {{ $total > 0 ? 'bg-danger' : 'bg-secondary' }}" style="font-size: 20px"> {{ $total }}</p>
                            </td>
                            <td style="width: 100px" class="text-center">
                                <p class="badge m-0 {{ $total > 0 ? 'bg-success' : 'bg-secondary' }}" style="font-size: 20px"> {{ $total_send_to_pending }}</p>
                            </td>
                            <td class="text-center">

                                <a href="{{ route('tuition_book.application_details') }}?{{ $type }}&tuition_id={{ $tuition->id }}" class="btn btn-outline-success btn-sm">Details</a>



                            </td>
                            {{-- <td>

                                        <span
                                            class="btn btn-outline-{{ $tuition->is_blocked_application == 'lock' ? 'danger' : 'success' }}">{{ $tuition->is_blocked_application == null ? 'Open' : $tuition->is_blocked_application }}</span>
                            <span data-toggle="modal" data-target="#lockModal"><i class="fa fa-edit cursor-pointer"></i></span>

                            </td> --}}
                            <td>
                                <form action="{{ route('is_blocked_application') }}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $tuition->id }}" name="tuition_id">
                                <button type="submit" id="blockButton" class="btn btn-outline-{{ $tuition->is_blocked_application == 'lock' ? 'danger' : 'success' }}" >
                                    {{ $tuition->is_blocked_application == null ? 'Open' : 'Lock' }}
                                </button>
                               
                                </form>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="25" class="text-center">No Data Found</td>
                        </tr>
@endforelse
                    </table>
                    <div class="modal fade" id="lockModal" tabindex="-1" role="dialog" aria-labelledby="lockModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="lockModalLabel">Block Application to Receive this Tuition</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('is_blocked_application') }}" method="post" id="is_blocked_application">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="tuition_id" value="{{ $tuition->id }}">
                                        <select name="is_blocked_application" class="form-control" id="">
                                            <option value="open" {{ ($tuition->is_blocked_application == 'open' or $tuition->is_blocked_application == null) ? 'selected' : '' }}>
                                                Open</option>
                                            <option value="lock" {{ $tuition->is_blocked_application == 'lock' ? 'selected' : '' }}>Lock
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
                </div>
                <br>
                {{ $tuition_all->appends(Request::except('branch_report'))->links() }}

            </div>
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->
<script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').dataTable();
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
                                    <select name="guardian_phone_modal" id="phone" class="form-control"
                                    required>
                                    <option selected disabled>Select phone Number</option>
                                    @foreach (\App\Models\User::where('status', 1)->where('user_type',
                                    'guardian')->get() as $user)
                                    <option value="{{ $user->phone }}">{{ $user->phone }}</option>
                                @endforeach
                                </select>
                                </div>
                                </div>
                                {{-- <input type="hidden" value="" name="tutor_phones_numbers" class="tutor_phones_numbers">
                <input type="hidden" value="sms_type" name="sms_type" id="sms_type"> --}}
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary close_text"
                                data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                                </form>
                                </div>
                                </div>
                                </div>
                                <div class="modal text-left fade" id="sendNotificationModal" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Send Notification to <strong
                                class="text-uppercase text-danger"
                                id="notification_type_message"></strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="{{ route('send_notification') }}" method="POST">
                                @csrf
                                <input type="hidden" value="" name="user_ids" class="user_ids">
                                <!-- Add the notification_type field with a name attribute -->
                                <input type="hidden" value="" name="notification_type"
                                id="notification_type">
                                <div class="modal-body">
                                <div class="form-group">
                                <label for="">Select Template</label>
                                <select id="notification_template" name="notification_title" class="form-control"
                                required>
                                <option selected disabled>Select Template</option>
                                @foreach (\App\Models\NotificationTemplate::where('status', 1)->get() as
                                $sms_template)
                                <option value="{{ $sms_template->title }}" data-body="{{ $sms_template->body }}">
                                {{ $sms_template->title }}
                                </option>
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
                                <button type="button" class="btn btn-secondary close_text"
                                data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                                </form>
                                </div>
                                </div>
                                </div>

                                <div class="modal text-left fade" id="noteModal" tabindex="-1" role="dialog"
                                aria-labelledby="noteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="noteModalLabel">Edit Notes</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <form action="{{ route('update_note') }}" method="post">

                                <!-- <form action="{{ route('tuitions.store') }}" method="post"
                                enctype="multipart/form-data"> -->
                                {{ csrf_field() }}
                                <div class="modal-body">
                                <!-- <input type="hidden" value="edit" name="action_type"> -->
                                <input type="hidden" id="tuition_id" name="tuition_id" value="tuition_id">
                                <textarea name="note" id="note" class="form-control" style="height: 100px;"
                                    placeholder="No Note. Add Your Note. [Only visible to admin]"></textarea>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary close_text"
                                data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                </form>
                                </div>
                                </div>
                                </div>
                                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                                {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
                                {{-- <script>
            $(document).ready(function() {
                $('.send_sms_to_guardian').click(function() {
                    var guardianPhone = $(this).data('number');
                    $('#guardian_phone_modal').val(guardianPhone);
                    $('#sendSmsModal').modal('show');
                });
            });
        </script> --}}
                                <script>
                                    $(document).ready(function() {
                                        $('.send_sms_to_guardian').click(function() {
                                            var guardianPhone = $(this).data('number');
                                            $('#guardian_phone_modal').val(guardianPhone);
                                            $('#sendSmsModal').modal('show');
                                        });

                                        $('.send_notification').click(function() {
                                            var notificationType = $(this).data('sms-type');

                                            // Set the value of notification_type when opening the modal
                                            $('#notification_type').val(notificationType);

                                            // Add script to handle opening sendNotificationModal
                                            $('#sendNotificationModal').modal('show');
                                        });

                                        $(".close, .close_text").click(function(e) {
                                            $("#sendSmsModal").modal('hide');
                                            $("#sendNotificationModal").modal('hide');
                                            $("#noteModal").modal('hide');
                                            $("#lockModal").modal('hide');
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
                                        $("#notification_template").change(function(e) {
                                            var conceptName = $('#notification_template').find(":selected").data('body');
                                            $("#notification_body").text('');
                                            $("#notification_body").text(conceptName);
                                        });


                                        $('.edit_note').click(function() {
                                            var tuitionId = $(this).data('id');
                                            var tuitionNote = $(this).data('note');
                                            $('#tuition_id').val(tuitionId);
                                            $('#note').val(tuitionNote);
                                            $('#noteModal').modal('show');
                                        });

                                    });
                                </script>
                            @endpush
                        @endsection
                        
