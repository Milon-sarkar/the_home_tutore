@extends('backend.layouts.app')
@section('content')

    <div class="row">
        <div class="col-12">

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div id="message" class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button id="closeModalBtn" type="button" class="btn btn-secondary"
                                data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="card-box pb-5" style="min-height: 800px;">
                <h4 class="header-title m-b-15 m-t-0">Manage Tuitions</h4>
                <form action="{{ route('tuitions.index') }}" method="get" id="search_form">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="job_id">ID</label>
                                <input type="text" name="job_id" id="job_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="name">Tuition Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="area_id">Area</label>
                                <select name="area_id" id="area_id" class="form-control">
                                    <option value="" selected disabled>--Area--</option>
                                    @foreach (\App\Models\Area::orderBy('name', 'ASC')->get() as $area)
                                        <option value="{{ $area->id }}"
                                            @if (request()->get('area_id') == $area->id) selected @endif>{{ $area->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="padding-top: 30px !important;">
                                <input type="submit" name="Search" value="Search" class="btn btn-info">
                            </div>
                        </div>
                    </div>
                </form>

                {{-- <form action="{{ route('tuitions.searchByGuardianNumber') }}" method="post" id="search_form">
            @csrf
            <div class="row">
               <div class="col-md-3">
                  <div class="form-group">
                     Guardian Number
                     <input type="text" name="phone" class="form-control">
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group" style="padding-top: 30px !important;">
                     <button>submit</button>
                  </div>
               </div>
            </div>
         </form> --}}
                <div class="table-responsive" style="height: 70vh; overflow: scroll">
                    <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap table-bordered"
                        cellspacing="0" width="100%" id="datatable">
                        <thead>
                            <tr>
                                <th class="position-left-sticky" style="left: 0px !important;">ID</th>
                                <th class="position-left-sticky-2" style=" left: 80px !important; width: 15%;">Name</th>
                                <th style="padding-left: 40px;">Phone</th>
                                <th>Address</th>
                                <th>Area</th>
                                <th>Edit Data</th>
                                <th>FB Action</th>
                                {{-- <th>Edit Data</th> --}}
                                <th>Status</th>
                                <th>Salary</th>
                                <th>Guardian Number</th>
                                <th>Public Link</th>
                                <th>Created Date</th>
                                <th class="hidden-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tuitions as $tuition)
                                <tr class="d-none">
                                    <td>
                                        <textarea class="d-none" cols="60" rows="100" id="social_copy_{{ $tuition->id }}">
                                      Job ID: {{ $tuition->job_id }},
                                      Title:{{ $tuition->name }},
                                      Location: {{ $tuition->area->name ?? '' }} {{ $tuition->district->name ?? '' }} {{ $tuition->address }},
                                     {{-- {{ $tuition->address }},  --}}
                                       Class:@if ($tuition->classjeson->count() > 0)@foreach ($tuition->classjeson as $tclass){{ $tclass->name }}@if (!$loop->last),@endif  @endforeach @endif
                                        
                                        Medium:@if ($tuition->student_mediumjeson->count() > 0)@foreach ($tuition->student_mediumjeson as $medium) {{ $medium->name }}@if (!$loop->last),@endif @endforeach @endif
                
                                        Subjects:@if ($tuition->subject_idsjeson->count() > 0)@foreach ($tuition->subject_idsjeson as $subject){{ $subject->name }}@if (!$loop->last),@endif @endforeach @endif
 
                                        Gender:@if ($tuition->gender){{ is_array($tuition->gender) && in_array('Male', $tuition->gender) ? 'Male' : '' }}{{ is_array($tuition->gender) && in_array('Female', $tuition->gender) ? 'Female' : '' }}@endif  

                                        Number Of Student:@if ($tuition->student_number > 0){{ $tuition->student_number }} @endif

                                        Weekly:@if ($tuition->weekjeson->count() > 0)@foreach ($tuition->weekjeson as $week){{ $week->name }}@if (!$loop->last) ,

                                    @endif
                                    @endforeach
                                    @endif

                                      Duration:{{ $tuition->duration }},
                                      class type:{{ strtoupper($tuition->class_type) }},

                                      Salary:@if ($tuition->salary_show_hide == '1')@if ($tuition->salary_range != '') {{ $tuition->salary_range }} ৳@elseif($tuition->salary > 0.0){{ $tuition->salary }} ৳ @else Negotiable, @endif  @endif
                                        
                                   
                                  </textarea>
                                    </td>
                                </tr>


                                <tr style="background: {{ ($loop->index + 1) % 2 == 1 ? '#f6f6f6' : '#CCC' }}">
                                    <td class="position-left-sticky" style="left: 0px !important;">
                                        <b>{{ $tuition->job_id }}</b>
                                    </td>
                                    <td class="position-left-sticky" style=" left: 80px !important;"><a
                                            href="{{ route('tuitions.show', $tuition->id) }}" class="text-dark"
                                            style="white-space: normal">{{ $tuition->name }}</a></td>
                                    {{-- <td style="padding-left: 35px">{{ $tuition->phone }}</br>
                        <a href="https://wa.me/+88{{ $tuition->user->whatsapp  ?? '' }}" target="_blank">w:{{ $tuition->user->whatsapp }}</a></td>
                     --}}
                                    <td style="padding-left: 35px">
                                        {{ $tuition->phone }}</br>
                                        @if ($tuition->user)
                                            <a href="https://wa.me/+88{{ $tuition->user->whatsapp }}"
                                                target="_blank">w:{{ $tuition->user->whatsapp }}</a>
                                        @endif
                                    </td>

                                    <td>{{ $tuition->address }}</td>
                                    <td>{{ $tuition?->area?->name ?? 'N/A' }}</td>
                                    <td><a href="{{ route('tuitions.edit', $tuition->id) }}"><br>
                                            <i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit</a>
                                    </td>
                                    <td>
                                        <a class="dropdown-item copySocialNumber" href="#"
                                            data-id="{{ $tuition->id }}"
                                            data-tuition_text_id="social_copy_{{ $tuition->id }}"><i
                                                class="mdi mdi-content-copy m-r-10 text-muted font-18 vertical-middle"></i>Copy</a>
                                    </td>
                                    {{-- <td>
                                        <a class="dropdown-item" href="{{ route('tuitions.edit', $tuition->id) }}"><i
                                                class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit</a>
                                    </td> --}}
                                    <td>
                                        @php $tuition_status = $tuition->status @endphp
                                        @if ($tuition_status == 1)
                                            <span class="badge badge-info badge-sm">Active</span>
                                        @elseif($tuition_status == 2)
                                            <span class="badge badge-secondary badge-sm">Booked</span>
                                        @elseif($tuition_status == 0)
                                            <span class="badge badge-danger badge-sm">In-active</span>
                                        @endif
                                        @if ($tuition->is_blocked_application == 'lock')
                                            <span class="badge badge-danger badge-sm">Locked</span>
                                        @else
                                            <span class="badge badge-success badge-sm">Open</span>
                                        @endif
                                    </td>
                                    @if ($tuition->salary_range)
                                        <td>{{ $tuition->salary_range }}
                                            ({{ $tuition->salary <= 0 ? 'Negotiable' : $tuition->salary }})
                                        </td>
                                    @else
                                        <td>{{ $tuition->salary }}</td>
                                    @endif
                                    {{-- 
                     <td></td>
                     --}}
                                    {{-- @if ($tuition->user->user_type == 'guardian')
                 
                     <td>{{  $tuition->user->phone }}</td>
                     @else
                     <td>Don't have contact number</td>
                     @endif --}}
                                    @if ($tuition->user)
                                        @if ($tuition->user->user_type == 'guardian')
                                            {{-- @dump($tuition->user); --}}
                                            <td>{{ $tuition->user->phone }}</td>
                                        @else
                                            <td>Don't have contact number</td>
                                        @endif
                                    @else
                                        <td>No user associated with this tuition</td>
                                    @endif

                                    <td>
                                        <a href="{{ route('tuition_details', ['tuition_id' => $tuition->job_id]) }}?id={{ $tuition->id }}"
                                            target="_blank" class="btn btn-sm btn-info">Public Link</a>
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($tuition->created_at)) }}</td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false"><i
                                                    class="mdi mdi-dots-horizontal"></i></a>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item"
                                                    href="{{ route('tutors.index') }}?form_search=find_tutor&tutor_institution={{ $tuition->interest_institution }}&subject_id={{ json_encode($tuition->subject_ids) }}&medium={{ json_encode(array_column(json_decode($tuition->student_mediumjeson), 'name')) }}&gender={{ json_encode($tuition->gender) }}&interested_subject_id={{ json_encode($tuition->interest_sub) }}&interested_medium_id={{ json_encode($tuition->interest_medium) }}&tutor_gender={{ json_encode($tuition->interest_gender) }}"
                                                    target="_blank"><i
                                                        class="mdi mdi-account-search m-r-10 text-muted font-18 vertical-middle"></i>Find
                                                    Tutors</a>
                                                {{--                                    <a class="dropdown-item" href="{{ route('tutors.index') }}?form_search=find_tutor&tutor_institution={{ $tuition->interest_institution }}&subject_id={{ json_encode($tuition->subject_ids) }}&medium={{ array_column(json_encode($tuition->student_mediumjeson), 'name') }}&gender={{ json_encode($tuition->gender) }}&interested_subject_id={{ json_encode($tuition->interest_sub) }}&interested_medium_id={{ json_encode($tuition->interest_medium) }}&tutor_gender={{ json_encode($tuition->interest_gender) }}" target="_blank"><i class="mdi mdi-account-search m-r-10 text-muted font-18 vertical-middle"></i>Find Tutors</a> --}}
                                                {{--                                    <a class="dropdown-item" href="{{ route('tutors.index') }}?form_search=find_tutor&tutor_institution={{ $tuition->interest_institution }}" target="_blank"><i class="mdi mdi-account-search m-r-10 text-muted font-18 vertical-middle"></i>Find Tutors</a> --}}
                                                @if ($tuition_status == 1)
                                                    <a class="dropdown-item"
                                                        href="{{ route('tuition_book.create') }}?tuition_id={{ $tuition->id }}"><i
                                                            class="mdi mdi-human-handsup m-r-10 text-muted font-18 vertical-middle"></i>Assign
                                                        Booking</a>
                                                @endif
                                                <a class="dropdown-item"
                                                    href="{{ route('tuitions.edit', $tuition->id) }}"><i
                                                        class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit</a>
                                                <form action="{{ route('tuitions.status', $tuition->id) }}"
                                                    method="get">
                                                    <button type="submit" class="dropdown-item"
                                                        onclick="return confirm('Are you sure to {{ $tuition->status == 1 ? 'InActive' : 'Active' }} this Tutor?')">
                                                        <i
                                                            class="mdi mdi-check-all m-r-10 text-muted font-18 vertical-middle"></i>{{ $tuition->status == 1 ? 'InActive' : 'Active' }}</button>
                                                </form>
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['tuitions.destroy', $tuition->id],
                                                    'style' => 'display:inline',
                                                ]) !!}
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item"
                                                    onclick="return confirm('Are you sure to delete {{ $tuition->name }} tuition?')">
                                                    <i
                                                        class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete</button>
                                                {!! Form::close() !!}
                                                <a class="dropdown-item"
                                                    href="{{ route('tuition_comment.create') }}?tuition_id={{ $tuition->id }}"><i
                                                        class="mdi mdi-comment-plus-outline m-r-10 text-muted font-18 vertical-middle"></i>Add
                                                    Comments</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('tuition_comment.index') }}?tuition_id={{ $tuition->id }}"><i
                                                        class="mdi mdi-comment m-r-10 text-muted font-18 vertical-middle"></i>Comments
                                                    <span
                                                        class="text-right badge badge-info">{{ count($tuition->comments) }}</span></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    {{ $tuitions->links() }}
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.copySocialNumber').click(function() {
                $('#exampleModal').modal('show');
                $('#message').empty();
    
                var tuition_text = $(this).data('tuition_text_id');
                var targetvalue = $('#' + tuition_text).val();
    
                var lines = targetvalue.split('\n');
                var formattedText = ""; // Initialize an empty string to store the formatted text
                lines.forEach(function(line) {
                    line = line.trim();
                    if (line !== '') {
                        $('#message').append('<p>' + line + '</p>'); // Wrap each line in a <p> tag
                        formattedText += line + '\n'; // Append the line to the formatted text with a line break
                    }
                });
    
                // Copy the formatted text to clipboard
                navigator.clipboard.writeText(formattedText);
    
            });
    
            $('#closeModalBtn').on('click', function() {
                $('#exampleModal').modal('hide');
            });
    
            $('#datatable').dataTable();
        });
    </script>
    
    @push('modals')
    @endpush
@endsection
{{-- complete --}}
