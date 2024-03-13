@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="d-flex justify-content-between">
                <h4 class="header-title m-b-15 m-t-0">Manage Tutors</h4>
                <span>
                    <select name="total_rows" id="total_rows" onchange="total_rows_of_tutors()" class="py-2" form="advance_search_form">
                        <option value="default" {{ request()->get('total_rows') == 'default' ? 'selected' : '' }}>Default</option>
                        <option value="30" {{ request()->get('total_rows') == '30' ? 'selected' : '' }}>30</option>
                        <option value="50" {{ request()->get('total_rows') == '50' ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request()->get('total_rows') == '100' ? 'selected' : '' }}>100</option>
                        <option value="500" {{ request()->get('total_rows') == '500' ? 'selected' : '' }}>500</option>
                        <option value="1000" {{ request()->get('total_rows') == '1000' ? 'selected' : '' }}>1000</option>
                        <option value="all" {{ request()->get('total_rows') == 'all' ? 'selected' : '' }}>All</option>
                    </select>
                    <script>
                        function total_rows_of_tutors() {
                            $("#advance_search_checkbox").prop('checked', true);
                            $("#advance_search_checkbox").trigger("change");
                        }
                    </script>
                    <button class="btn btn-light" onclick="copyWANumbers()"><i class="fa fa-copy"></i>Copy whatsapp Numbers</button>
                    <input type="text" class="d-none" value="@foreach($tutors->where('user','!=',null) as $tutor){{ $tutor->user->whatsapp ?? '' }}{{ $tutor->user->whatsapp ? ',' : '' }}@endforeach" id="whatsapp_numbers">
                    <button class="btn btn-info send_sms" data-number="@foreach($tutors->where('user','!=',null) as $tutor){{ $tutor->user->phone ?? '' }},@endforeach" data-sms-type="multiple"><i class="fa fa-message"></i>Send SMS</button>
                    <button class="btn btn-info send_notification" data-number="@foreach($tutors->where('user','!=',null) as $tutor){{ $tutor->user->id ?? '' }},@endforeach" data-sms-type="multiple"><i class="fa fa-message"></i>Send Notification</button>
                </span>
            </div>
            @include('backend.include.tutor-search')
            <div class="wrapper1">
                <div class="div1 d-flex justify-content-between">
                    @if($request->form_search == 'search_submitted')
                    @if($request->division_id != null)
                    <span>Division: <strong>{{ \App\Models\Division::find($request->division_id)['name'] }}</strong></span>,
                    @endif
                    @if($request->district_id != null)
                    <span>District: <strong>{{ \App\Models\District::find($request->district_id)['name'] }}</strong></span>,
                    @endif
                    @if($request->area_id != null)
                    <span>Area: <strong>{{ \App\Models\Area::find($request->area_id)['name'] }}</strong></span>,
                    @endif
                    @if($request->thana_id != null)
                    <span>Thana: <strong>{{ \App\Models\Thana::find($request->thana_id)['name'] }}</strong></span>,
                    @endif
                    @if($request->tutor_institution != null)
                    <span>Tutor Institution: <strong>{{ $request->tutor_institution }}</strong></span>,
                    @endif
                    @if($request->tutor_subject_name != null)
                    <span>Tutor Subject: <strong>{{ $request->tutor_subject_name }}</strong></span>,
                    @endif
                    @if($request->medium_id != null)
                    <span>Medium: <strong>{{ \App\Models\Medium::find($request->medium_id)['name'] }}</strong></span>,
                    @endif
                    @if($request->tutor_gender != null)
                    <span>Gender: <strong>{{ ($request->tutor_gender) }}</strong></span>,
                    @endif
                    @if($request->tutor_name != null)
                    <span>Tutor Name: <strong>{{ ($request->tutor_name) }}</strong></span>,
                    @endif
                    @if($request->tutor_phone != null)
                    <span>Tutor Phone: <strong>{{ ($request->tutor_phone) }}</strong></span>,
                    @endif
                    @if($request->tutor_code != null)
                    <span>Tutor Code: <strong>{{ ($request->tutor_code) }}</strong></span>,
                    @endif
                    @if($request->tutor_salary != null)
                    <span>Tutor Salary: <strong>{{ ($request->tutor_salary) }}</strong></span>,
                    @endif
                    @if($request->permanent_district_id != null)
                    <span>Home/Permanent Dist.: <strong>{{ \App\Models\District::find($request->permanent_district_id)->name ?? '' }}</strong></span>,
                    @endif

                    @endif
                </div>
            </div>
            @if(request()->get('form_search'))
            <ul class="d-flex justify-content-around list-unstyled">
                <li><strong>Institution: </strong> {{ request()->get('interest_institution') }}</li>
                <li><strong>Faculty: </strong> {{ request()->get('tutor_faculty') }}</li>
                <li>
                    <strong>Medium:</strong>
                    @php $mediums= json_decode(request()->get('interest_medium')) @endphp
                    @if($mediums)
                    @foreach($mediums as $medium)
                    {{ \App\Models\Medium::find($medium)->name }}@if($loop->last == false), @endif
                    @endforeach
                    @endif
                </li>
                <li>
                    <strong>Subject:</strong>
                    @php $subjects= json_decode(request()->get('interest_sub')) @endphp
                    @if($subjects)
                    @foreach($subjects as $subject)
                    {{ \App\Models\Subject::find($subject)->name ?? '' }}@if($loop->last == false), @endif
                    @endforeach
                    @endif
                </li>
                <li>
                    <strong>Gender:</strong>
                    @php $genders = json_decode(request()->get('interest_gender')) @endphp
                    @if($genders)
                    @foreach($genders as $gender)
                    {{ $gender }}@if($loop->last == false), @endif
                    @endforeach
                    @endif
                </li>
            </ul>
            @endif
            <div class="wrapper2">
                <div class="div2">
                    <div class="table-responsive" style="height: 65vh; overflow: scroll;">
                        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap table-bordered" cellspacing="0" width="100%" id="datatable">
                            <thead>
                                <tr>
                                    <th class="position-left-sticky" style="left: 0px !important; z-index: 1; width: 20px">
                                        <input type="checkbox" id="all_checked">
                                    </th>
                                    <th class="position-left-sticky" style="left: 0px !important; z-index: 1">ID</th>
                                    <th class="position-left-sticky" style=" left: 70px !important; z-index: 1">Name</th>
                                    <th class="position-left-sticky" style=" left: 180px !important; z-index: 1">Phone</th>
                                    <th>Institute & Subject</th>
                                    <th>Present Address</th>
                                    <th>Option</th>
                                    <th class="hidden-sm">Action</th>
                                    <th class="text-center" title="Assigned Total">Assigned</th>
                                    <th class="text-center" title="Request Waiting">Waiting</th>
                                    <th>Salary</th>
                                    {{-- <th class="position-left-sticky" style=" left: 180px !important; z-index: 1">Feculty</th>
                                <th class="position-left-sticky" style=" left: 180px !important; z-index: 1">Session</th> --}}
                                    <th class="text-center">Status</th>

                                    {{-- <th>Whatsapp</th> --}}
                                    {{-- <th style="width: 10%">Address</th> --}}
                                    <th>Created Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($tutors->where('user','!=',null) as $tutor)

                                <tr style="background: {{ (($loop->index + 1) % 2 == 1) ? '#f6f6f6' : '#CCC'  }}">
                                    <td class="position-left-sticky" style="left: 0px !important;">
                                        <input type="checkbox" class="sms_phone_checkbox" name="sms_phone_checkbox" value="{{ $tutor->user->phone ?? '' }}" data-id="{{ $tutor->id }}" style="visibility: hidden; position: absolute">
                                        <input type="checkbox" class="notification_checkbox" id="notification_checkbox_{{ $tutor->id }}" name="notification_checkbox" value="{{ $tutor->user->id ?? '' }}">
                                    </td>
                                    <td class="position-left-sticky" style="left: 20px !important;"><b>{{ $tutor->tutor_code }} </b></td>
                                    <td class="position-left-sticky" style="left: 80px !important;"><a href="{{ route('tutors.show', $tutor->id) }}">{{ $tutor->user->name ?? '' }}</a> </td>
                                    <td class="position-left-sticky" style="left: 190px !important;">{{ $tutor->user->phone ?? '' }}</br>
                                        @php $whatsapp = $tutor->user->whatsapp ?? '' @endphp
                                        @if(strlen($whatsapp) > 11)
                                        <a href="https://wa.me/{{ $tutor->user->whatsapp  ?? '' }}" target="_blank"> @php $whatsapp = $tutor->user->whatsapp ?? '' @endphp
                                            @if(strlen($whatsapp) > 11)
                                            <a href="https://wa.me/{{ $tutor->user->whatsapp  ?? '' }}" target="_blank">{{ $tutor->user->whatsapp ?? '' }}</a>
                                            @else
                                            <a href="https://wa.me/+88{{ $tutor->user->whatsapp  ?? '' }}" target="_blank">{{ $tutor->user->whatsapp ?? '' }}</a>
                                            @endif{{ $tutor->user->whatsapp ?? '' }}</a>
                                        @else
                                        <a href="https://wa.me/+88{{ $tutor->user->whatsapp  ?? '' }}" target="_blank">w:{{ $tutor->user->whatsapp ?? '' }}</a>
                                        @endif
                                    </td>

                                    {{-- <td>
                                    <span class="d-block">{{ $tutor->institution }}</span>
                                    Subject: {{ $tutor->subject_name }}
                                    </td> --}}
                                    <td>
                                        <span class="d-block">{{ $tutor->institution }}</span>
                                        Subject: {{ $tutor->subject_name }}
                                    </td>
                                    <td>{{ $tutor->address }}</td>
                                    <td>
                                        {{--{{ $tutor->experience_tuition_percentage + $tutor->interested_requirement_percentage + $tutor->personal_information_percentage + $tutor->academic_qualification_percentage + $tutor->academic_information_percentage }}%--}}
                                        <a tabindex="0" class="btn btn-sm btn-secondary text-light" role="button" data-toggle="popover" data-trigger="focus" data-html="true" title="Short Details" data-content="
                                    <table class='table'>
                                        <tr>
                                            <td>Institution-</td>
                                            <td>{{ $tutor->institution }}</td>
                                        </tr>
                                        <tr>
                                            <td>Subject-</td>
                                            <td>{{ $tutor->subject_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>SSC Medium-</td>
                                            <td>{{ $tutor->ssc_medium }}</td>
                                        </tr>
                                        <tr>
                                            <td>HSC Medium-</td>
                                            <td>{{ $tutor->hsc_medium }}</td>
                                        </tr>
                                        <tr>
                                            <td>Gender-</td>
                                            <td>{{ $tutor->gender }}</td>
                                        </tr>
                                        <tr>
                                            <td>Area-</td>
                                            <td>{{ $tutor->area?->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Home District-</td>
                                            <td>{{ optional($tutor->district)->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>HSC college</td>
                                            <td>{{ $tutor->hsc_institute }}</td>
                                        </tr>
                                        <tr>
                                            <td>SSC District-</td>
                                            <td>{{ $tutor->ssc_institute }}</td>
                                        </tr>
                                        <tr>
                                            <td>Medium-</td>
                                            <td>
                                                @foreach($tutor->mediums as $medium)
                                                    {{ $medium->name }}
                                                @endforeach
                                            </td>
                                        </tr>

                                           <tr>

                                               <td>Preferred medium-</td>
                                                <td>
                                                    @foreach ($tutors as $tutor)
                                                    @if(is_array($tutor->interest_medium))
                                                        {{ implode(', ', $tutor->interest_medium) }}
                                                    @else
                                                        {{ $tutor->interest_medium }}
                                                    @endif
                                                    @endforeach
                                                </td>
                                                <!-- Add other columns here -->

                                            </tr>





                                    </table>">Info</a>
                                    </td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item" href="{{ route('tutor_profile',$tutor->id) }}" target="_blank"><i class="mdi mdi-information m-r-10 text-muted font-18 vertical-middle"></i>Public Link</a>
                                                <a class="dropdown-item" href="{{ route('tutors.show',$tutor->id) }}"><i class="mdi mdi-information m-r-10 text-muted font-18 vertical-middle"></i>Details</a>
                                                <a class="dropdown-item" href="{{ route('tutors.edit',$tutor->id) }}"><i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit</a>


                                                <span class="send_sms dropdown-item cursor-pointer" data-number="{{ $tutor->user->phone }}" data-sms-type="single" data-sms-receiver-name="{{ $tutor->user->name }}"><i class="mdi mdi-message m-r-10 text-muted font-18 vertical-middle"></i>Send SMS</span>

                                                <form action="{{ route('tutors.status', $tutor->id) }}" method="get">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to {{ $tutor->status==1 ?'InActive':'Active' }} this Tutor?')"> <i class="mdi mdi-check-all m-r-10 text-muted font-18 vertical-middle"></i>{{ $tutor->status==1 ?'InActive':'Active' }}</button>
                                                </form>
                                                <form action="{{ route('tutors.destroy', $tutor->id) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to delete this Tutor?')"> <i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>


                                    <td class="text-center">
                                        @php
                                        $book_tuition = App\Models\TuitionBook::select('id')->where('tutor_id', $tutor->id)->where('status', 1)->get();
                                        $book_tuition_number = count($book_tuition);
                                        @endphp
                                        @if($book_tuition_number > 0)
                                        <span class="badge bg-success">{{ $book_tuition_number }}</span>
                                        @else
                                        <span class="badge bg-danger">{{ $book_tuition_number }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @php
                                        $book_tuition_waiting = App\Models\TuitionBook::select('id')->where('tutor_id', $tutor->id)->where('status', 0)->get();
                                        $book_tuition_number_waiting = count($book_tuition_waiting);
                                        @endphp
                                        @if($book_tuition_number_waiting > 0)
                                        <span class="badge bg-success">{{ $book_tuition_number_waiting }}</span>
                                        @else
                                        <span class="badge bg-danger">{{ $book_tuition_number_waiting }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $tutor->salary <= 0 ? 'Negotiable': $tutor->salary}}</td>
                                    {{-- <td class="position-left-sticky" style="left: 20px !important;"><b>{{ $tutor->faculty }} </b></td>
                                    <td class="position-left-sticky" style="left: 20px !important;"><b>{{ $tutor->session }} </b></td> --}}
                                    <td class="text-center"> <span class="badge badge-{{ $tutor->status==1 ? 'info' : 'danger' }}">{{ $tutor->status==1 ?'Active':'InActive' }}</span></td>

                                    {{-- <td>
                                    @php $whatsapp = $tutor->user->whatsapp ?? '' @endphp
                                    @if(strlen($whatsapp) > 11)
                                        <a href="https://wa.me/{{ $tutor->user->whatsapp  ?? '' }}" target="_blank">{{ $tutor->user->whatsapp ?? '' }}</a>
                                    @else
                                    <a href="https://wa.me/+88{{ $tutor->user->whatsapp  ?? '' }}" target="_blank">{{ $tutor->user->whatsapp ?? '' }}</a>
                                    @endif
                                    </td> --}}

                                    {{-- <td>{{ $tutor->address }}</td> --}}





                                    <td>{{ date('d-m-Y',strtotime($tutor->created_at)) }}</td>

                                </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            {{ $tutors->appends(Request::except('page'))->links() }}
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->
<script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>

@push('footer_js')
<script>
    $('#all_checked').click(function() {
        if ($("#all_checked").is(':checked')) {
            $(':checkbox.sms_phone_checkbox').prop('checked', this.checked).change();
            $(':checkbox.notification_checkbox').prop('checked', this.checked).change();
        } else {
            $(".sms_phone_checkbox").removeAttr('checked')
            $(".notification_checkbox").removeAttr('checked')
        }
    });
</script>

<script type="text/javascript">
    $('.popover-dismiss').popover({
        trigger: 'focus'
    })


    function copyWANumbers() {
        // Get the text field
        let copyText = document.getElementById('whatsapp_numbers')

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        alert("Copied whatsapp numbers: " + copyText.value);
    }


    $(document).ready(function() {
        $('#datatable').dataTable({
            paging: false,
            "searching": false
        });

        $(".sms_phone_checkbox").click(function(e) {
            var id = this.data('id')

        })



        $(".send_sms").click(function(e) {
            nunbers = ''

            var checkboxes = document.querySelectorAll('input[name=sms_phone_checkbox]:checked')

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


        $(".send_notification").click(function(e) {
            ids = ''

            var checkboxes = document.querySelectorAll('input[name=notification_checkbox]:checked')

            for (var i = 0; i < checkboxes.length; i++) {
                ids += ',' + (checkboxes[i].value)
            }

            notification_type = $(this).data('sms-type')

            console.log(ids)

            $(".user_ids").val(ids)

            if (notification_type == 'multiple') {
                $('#notification_type_message').text('All Selected Tutor')
                $('.notification_type').val('multiple')
            } else {
                $('#notification_type_message').text($(this).data('sms-receiver-name'))
                $('.notification_type').val('single')
            }

            $("#sendNotificationModal").modal('show');
        });
    });
</script>
@endpush




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
                        <label for="">Select Template</label>
                        <select id="sms_template" class="form-control">
                            <option selected disabled>Select Template</option>
                            @foreach(\App\Models\SmsTemplate::where('status', 1)->get() as $sms_template)
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
<div class="modal text-left fade" id="sendNotificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Notification to <strong class="text-uppercase text-danger" id="notification_type_message"></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('send_notification') }}" method="POST">
                @csrf
                <input type="hidden" value="" name="user_ids" class="user_ids">
                <input type="hidden" value="" name="notification_type" class="notification_type">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Select Template</label>
                        <select id="notification_template" name="notification_title" class="form-control" required>
                            <option selected disabled>Select Template</option>
                            @foreach(\App\Models\NotificationTemplate::where('status', 1)->get() as $sms_template)
                            <option value="{{ $sms_template->title }}" data-body="{{ $sms_template->body }}">{{ $sms_template->title }}</option>
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

<script>
    $(".close, .close_text").click(function(e) {
        $("#sendSmsModal").modal('hide')
        $("#sendNotificationModal").modal('hide')
    });

    $("#sms_template").change(function(e) {
        var conceptName = $('#sms_template').find(":selected").val();
        $("#sms_body").text('')
        $("#sms_body").text(conceptName)
    });

    $("#notification_template").change(function(e) {
        var conceptName = $('#notification_template').find(":selected").data('body');
        $("#notification_body").text('')
        $("#notification_body").text(conceptName)
    });
</script>
@endpush

@endsection
