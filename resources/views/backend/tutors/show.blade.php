@extends('backend.layouts.app')

@section('content')
       {{-- @dd($tutor); --}}
    <div class="card">
        <div class="card-header">
            My Profile <span style="float: right;color: red;" class="text-right;">
                {{ $tutor->tutor_code ?? '' }}</span>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-6">

                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">Name</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->user->name ?? '' }}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">Phone</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->user->phone ?? '' }}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">E-mail</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->user->email ?? '' }}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">Whatsapp</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->user->whatsapp ?? '' }}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">Gender</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->gender ?? '' }}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">Home District</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->permanent_district->name ?? '' }}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">Present District</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->district->name ?? '' }}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">Present Thana</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->thana->name ?? '' }}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">Present Area</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->area->name ?? '' }}
                        </div>
                    </div>


                    <hr>

                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">Preferred Area</label>
                        </div>
                        <div class="col-md-6">
                            @if ($tutor && $tutor->areajeson)
                                @foreach ($tutor->areajeson as $area)
                                    {{ $area->name }} @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            @endif
                        </div>

                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">Preferred Class</label>
                        </div>
                        <div class="col-md-6">
                            @if ($tutor && $tutor->interest_class)
                                @foreach ($tutor->interest_class as $tclass_id)
                                    {{ \App\Models\Tclass::find($tclass_id)->name ?? '' }} @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            @endif
                        </div>

                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">Preferred Medium</label>
                        </div>
                        <div class="col-md-6">
                            @if ($tutor && $tutor->mediumjeson)
                                @foreach ($tutor->mediumjeson as $medium)
                                    {{ $medium->name ?? '' }} @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            @endif
                        </div>

                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">Preferred Subject</label>
                        </div>
                        <div class="col-md-6">
                            @if ($tutor && $tutor->subjectjeson)
                                @foreach ($tutor->subjectjeson as $subject)
                                    {{ $subject->name ?? '' }} @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            @endif
                        </div>

                    </div>
                    <div class="row mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="avatar">Profile</label>
                        </div>
                        <div class="col-md-10">
                            <img src="{{ $tutor->user->avatar ?? '' }}" class="picture-src" id="wizardPicturePreview"
                                title="" style="width: 150px">
                        </div>
                    </div>

                    <div class="row mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="avatar">Student ID/Pay in slip/NID</label>
                        </div>
                        <div class="col-md-10">
                            <label for="student_id_card"></label>
                            @if ($tutor && $tutor->student_id_card)
                                <img src="{{ $tutor->student_id_card }}" class="img-thumbnail img-fluid"
                                    alt="Student ID card" style="width: 150px">
                            @else
                                <!-- Display a placeholder or alternative content if the property is null or doesn't exist -->
                                <p>No student ID card available</p>
                            @endif
                        </div>

                    </div>

                </div>
                <div class="col-lg-6">

                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="institution">Institute/University</label>
                        </div>
                        <div class="col-md-6" style="padding-left: 50px;">
                            @if ($tutor && $tutor->institution)
                                {{ $tutor->institution }}
                            @else
                                <!-- Display a placeholder or alternative content if $tutor is null or if 'institution' is null -->
                                N/A
                            @endif
                        </div>

                    </div>

                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="faculty">Faculty</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->faculty ?? 'N/A' }}
                        </div>
                    </div>


                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="subject_name">Subject/Department</label>
                        </div>
                        <div class="col-md-6" style="padding-left: 50px;" >
                            {{ $tutor->subject_name ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="sessions">Session</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->session ?? 'N/A' }}
                        </div>
                    </div>


                    <hr class="mb-1 mt-4">


                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="hsc_institute">HSC Institute</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->hsc_institute ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="hsc_group">HSC Group</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->hsc_group ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="hsc_medium">HSC Medium</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->hsc_medium ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="hsc_result">HSC Result</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->hsc_result ?? 'N/A' }}
                        </div>
                    </div>
                    <hr class="mb-1 mt-4">
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="ssc_institute">SSC Institute</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->ssc_institute ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="ssc_group">SSC Group</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->ssc_group ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="ssc_medium">SSC Medium</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->ssc_medium ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="ssc_result">SSC Result</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->ssc_result ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mt-3 align-items-center">
                        <div class="col-md-2 text-md-end text-start">
                            <label for="details">Tuition Experience</label>
                        </div>
                        <div class="col-md-6">
                            {{ $tutor->details ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                @if ($tutor)
                    <a class="dropdown-item text-center" href="{{ route('tutors.edit', $tutor->id) }}">
                        <i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>
                        Edit
                    </a>
                @endif



            </div>

        </div>

    </div>

    {{--    <div class="card"> --}}
    {{--        <div class="card-header"> --}}
    {{--            My Profile <span style="float: right;color: red;" class="text-right;"> --}}
    {{--                                            {{ $tutor->tutor_code ?? '' }}</span> --}}
    {{--        </div> --}}
    {{--        <div class="card-body"> --}}
    {{--            <div class="table-responsive"> --}}
    {{--            <table class="table table-bordered"> --}}
    {{--                <tr> --}}
    {{--                    <td colspan="3" class="bg-light"><h3>Personal Information</h3></td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light" style="width: 25%">Name</td> --}}
    {{--                    <td>{{ $tutor->user->name ?? '' }}</td> --}}
    {{--                    <td rowspan="9" style="width: 25%"> --}}
    {{--                        <div class="card"> --}}
    {{--                            <div class="card-header">Avatar</div> --}}
    {{--                            <img src="{{ $tutor->user->avatar ?? '' }}" class="picture-src" --}}
    {{--                                 id="wizardPicturePreview" title=""> --}}
    {{--                        </div> --}}
    {{--                    </td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light">E-mail</td> --}}
    {{--                    <td>{{ $tutor->user->email ?? '' }}</td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td>Status</td> --}}
    {{--                    <td>{!! $tutor->user->status == 1 ? '<span class="badge badge-sm badge-info">Active</span>' : '<span class="badge badge-sm badge-info">Active</span>' !!}</td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td>Member Type</td> --}}
    {{--                    <td> --}}
    {{--                        {{ $tutor->member_type =='Normal'? 'General/Normal':'' }} --}}
    {{--                        {{ $tutor->member_type =='Premium'? 'Premium':'' }} --}}
    {{--                    </td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light">Phone</td> --}}
    {{--                    <td>{{ $tutor->user->phone ?? '' }}</td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light">Gender</td> --}}
    {{--                    <td>{{ $tutor->gender }}</td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light">Date of Birth</td> --}}
    {{--                    <td>{{ $tutor->date_of_birth }}</td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light">Whatsapp</td> --}}
    {{--                    <td>{{ $tutor->user->whatsapp ?? '' }}</td> --}}
    {{--                </tr> --}}

    {{--                <tr> --}}
    {{--                    <td class="bg-light">Present Address</td> --}}
    {{--                    <td>{{ $tutor->address }}, {{ $tutor->upazila->name ?? '' }}, {{ $tutor->district->name ?? ''}}, {{ $tutor->division->name ?? '' }}</td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light">NID</td> --}}
    {{--                    <td>{{ $tutor->user->nid_number ?? '' }}</td> --}}
    {{--                    <td rowspan="8"> --}}
    {{--                        <div class="card"> --}}
    {{--                            <img src="{{ $tutor->user->nid ?? '' }}" alt="NID Photo" class="img-fluid img-thumbnail"> --}}
    {{--                        </div> --}}
    {{--                    </td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light">Parmanent Address</td> --}}
    {{--                    <td>{{ $tutor->permanent_address }}, {{ $tutor->permanent_upazila->name ?? '' }}, {{ $tutor->permanent_district->name ?? ''}}, {{ $tutor->permanent_division->name ?? '' }}</td> --}}
    {{--                </tr> --}}

    {{--                <tr> --}}
    {{--                    <td class="bg-light">Father's Information</td> --}}
    {{--                    <td> --}}
    {{--                        {{ $tutor->father_name }}<br> --}}
    {{--                        {{ $tutor->father_number }} --}}
    {{--                    </td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light">Mother's Information</td> --}}
    {{--                    <td> --}}
    {{--                        {{ $tutor->mother_name }}<br> --}}
    {{--                        {{ $tutor->mother_number }} --}}
    {{--                    </td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light">Parent Address</td> --}}
    {{--                    <td> --}}
    {{--                        {{ $tutor->parent_address }} , {{ $tutor->parent_upazila->name ?? '' }}, {{ $tutor->parent_district->name ?? '' }}, {{ $tutor->parent_division->name ?? '' }} --}}
    {{--                    </td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td>Register at</td> --}}
    {{--                    <td>{{ date_format(date_create($tutor->user->created_at ?? '0000-00-00'),'M y, Y') }}</td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td>Tutor Register</td> --}}
    {{--                    <td>{{ date_format(date_create($tutor->created_at ?? '0000-00-00'),'M y, Y') }}</td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td>Facebook Link</td> --}}
    {{--                    <td><a href="{{ $tutor->facebook ?? '#' }}" class="badge badge-info"><i class="mdi mdi-facebook"></i></a></td> --}}
    {{--                </tr> --}}
    {{--            </table> --}}
    {{--        </div> --}}

    {{--            <div class="table-responsive"> --}}
    {{--            <table class="table table-bordered"> --}}
    {{--                <tr class="bg-light"> --}}
    {{--                    <td colspan="3"><h3>Academic Information</h3></td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light" style="width: 25%;">Institution</td> --}}
    {{--                    <td>{{ $tutor->institution }}</td> --}}
    {{--                    <td rowspan="5" style="width: 25%; height: 200px;"> --}}
    {{--                        <div class="card"> --}}
    {{--                             <img src="{{ $tutor->student_id_card }}" class="img-thumbnail img-fluid" alt="Student ID card"> --}}
    {{--                        </div> --}}
    {{--                    </td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light">Subject</td> --}}
    {{--                    <td>{{ $tutor->subject->name ?? '' }} {{ $tutor->subject_name }}</td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light">Session</td> --}}
    {{--                    <td>{{ $tutor->session ?? '' }}</td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light">Year of Study</td> --}}
    {{--                    <td>{{ $tutor->year_of_study ?? '' }}</td> --}}
    {{--                </tr> --}}
    {{--                <tr> --}}
    {{--                    <td class="bg-light">Hall/Hostel</td> --}}
    {{--                    <td>{{ $tutor->hall ?? '' }}</td> --}}
    {{--                </tr> --}}
    {{--            </table> --}}
    {{--        </div> --}}

    {{--            <div class="table-responsive"> --}}
    {{--                <table class="table table-bordered"> --}}
    {{--                    <tr> --}}
    {{--                        <td colspan="25" class="bg-light"><h3>Academic Qualification</h3></td> --}}
    {{--                    </tr> --}}
    {{--                    <tr> --}}
    {{--                        <td style="width: 35%" class="bg-light" colspan="2">Hons. / Fazil / Degree or Equivalent</td> --}}
    {{--                        <td> --}}
    {{--                            <div class="form-group"> --}}
    {{--                                <strong>Subject</strong> <br>{{ $tutor->hons_subject }} --}}
    {{--                            </div> --}}
    {{--                        </td> --}}
    {{--                        <td> --}}
    {{--                            <div class="form-group"> --}}
    {{--                                <strong>Last passed result</strong> <br>{{ $tutor->hons_last_passed_result }} --}}
    {{--                            </div> --}}
    {{--                        </td> --}}
    {{--                        <td> --}}
    {{--                            <div class="form-group"> --}}
    {{--                                <strong>Year</strong><br>{{ $tutor->hons_last_passed_year }} --}}
    {{--                            </div> --}}
    {{--                        </td> --}}
    {{--                        <td style="width: 15%"> --}}
    {{--                            <img src="{{ marksheet($tutor->hons_marksheet) }}" alt="marksheet"> --}}
    {{--                        </td> --}}
    {{--                    </tr> --}}
    {{--                    <tr> --}}
    {{--                        <td class="bg-light">HSC / Alim / A-level or Equivalent</td> --}}
    {{--                        <td> --}}
    {{--                            <div class="form-group"> --}}
    {{--                                <strong>Medium</strong><br>{{ $tutor->hsc_medium }} --}}
    {{--                            </div> --}}
    {{--                        </td> --}}
    {{--                        <td> --}}
    {{--                            <div class="form-group"> --}}
    {{--                                <strong>Group</strong><br>{{ $tutor->hsc_group }} --}}
    {{--                            </div> --}}
    {{--                        </td> --}}
    {{--                        <td> --}}
    {{--                            <div class="form-group"> --}}
    {{--                                <strong>Result</strong><br>{{ $tutor->hsc_result }} --}}
    {{--                            </div> --}}
    {{--                        </td> --}}
    {{--                        <td> --}}
    {{--                            <div class="form-group"> --}}
    {{--                                <strong>Year</strong><br>{{ $tutor->hsc_year }} --}}
    {{--                            </div> --}}
    {{--                        </td> --}}
    {{--                        <td> --}}
    {{--                            <img src="{{ marksheet($tutor->hsc_marksheet) }}" alt="marksheet"> --}}
    {{--                        </td> --}}
    {{--                    </tr> --}}
    {{--                    <tr> --}}
    {{--                        <td class="bg-light">SSC / Dhakil / O-level or Equivalent</td> --}}
    {{--                        <td> --}}
    {{--                            <div class="form-group"> --}}
    {{--                                <strong>Medium</strong><br>{{ $tutor->ssc_medium }} --}}
    {{--                            </div> --}}
    {{--                        </td> --}}
    {{--                        <td> --}}
    {{--                            <div class="form-group"> --}}
    {{--                                <strong>Group</strong><br>{{ $tutor->ssc_group }} --}}
    {{--                            </div> --}}
    {{--                        </td> --}}
    {{--                        <td> --}}
    {{--                            <div class="form-group"> --}}
    {{--                                <strong>Result</strong><br>{{ $tutor->ssc_result }} --}}
    {{--                            </div> --}}
    {{--                        </td> --}}
    {{--                        <td> --}}
    {{--                            <div class="form-group"> --}}
    {{--                                <strong>Year</strong><br>{{ $tutor->ssc_year }} --}}
    {{--                            </div> --}}
    {{--                        </td> --}}
    {{--                        <td> --}}
    {{--                            <img src="{{ marksheet($tutor->ssc_marksheet) }}" alt="marksheet"> --}}
    {{--                        </td> --}}
    {{--                    </tr> --}}
    {{--                </table> --}}
    {{--            </div> --}}

    {{--            <div class="table-responsive"> --}}
    {{--                <table class="table table-bordered"> --}}
    {{--                    <tr> --}}
    {{--                        <td colspan="2" class="bg-light"><h3>Interested Tuition</h3></td> --}}
    {{--                    </tr> --}}
    {{--                    <tr> --}}
    {{--                        <td class="bg-light" style="width: 25%">Interested Area</td> --}}
    {{--                        <td> --}}
    {{--                            @foreach ($areas as $area) --}}
    {{--                                @if (is_array($tutor->interest_location) && in_array($area->id, $tutor->interest_location)) --}}
    {{--                                    {{ $area->name }}, --}}
    {{--                                @endif --}}
    {{--                            @endforeach --}}
    {{--                        </td> --}}
    {{--                    </tr> --}}
    {{--                    <tr> --}}
    {{--                        <td class="bg-light">Interested Medium</td> --}}
    {{--                        <td> --}}
    {{--                            @foreach ($mediums as $medium) --}}
    {{--                                @if (is_array($tutor->interest_medium) && in_array($medium->id, $tutor->interest_medium)) --}}
    {{--                                    {{ $medium->name }}, --}}
    {{--                                @endif --}}
    {{--                            @endforeach --}}
    {{--                        </td> --}}
    {{--                    </tr> --}}
    {{--                    <tr> --}}
    {{--                        <td class="bg-light">Interested Class</td> --}}
    {{--                        <td> --}}
    {{--                            @foreach ($tclass as $tclas) --}}
    {{--                                @if (is_array($tutor->interest_class) && in_array($tclas->id, $tutor->interest_class)) --}}
    {{--                                    {{ $tclas->name }}, --}}
    {{--                                @endif --}}
    {{--                            @endforeach --}}
    {{--                        </td> --}}
    {{--                    </tr> --}}
    {{--                    <tr> --}}
    {{--                        <td class="bg-light">Interested Gender</td> --}}
    {{--                        <td> --}}
    {{--                            @if ($tutor->interest_gender) --}}
    {{--                                @foreach ($tutor->interest_gender as $gender) --}}
    {{--                                    {{ $gender }}, --}}
    {{--                                @endforeach --}}
    {{--                            @endif --}}
    {{--                        </td> --}}
    {{--                    </tr> --}}
    {{--                    <tr> --}}
    {{--                        <td class="bg-light">Interested Subject</td> --}}
    {{--                        <td> --}}
    {{--                            @foreach ($subjects as $subject) --}}
    {{--                                @if (is_array($tutor->interest_sub) && in_array($subject->id, $tutor->interest_sub)) --}}
    {{--                                    {{ $subject->name }}, --}}
    {{--                                @endif --}}
    {{--                            @endforeach --}}
    {{--                        </td> --}}
    {{--                    </tr> --}}
    {{--                    <tr> --}}
    {{--                        <td class="bg-light">Interested Time</td> --}}
    {{--                        <td> --}}
    {{--                            @foreach ($timelys as $timely) --}}
    {{--                                @if (is_array($tutor->interest_time) && in_array($timely->id, $tutor->interest_time)) --}}
    {{--                                    {{ $timely->name }}, --}}
    {{--                                @endif --}}
    {{--                            @endforeach --}}
    {{--                        </td> --}}
    {{--                    </tr> --}}
    {{--                    <tr> --}}
    {{--                        <td class="bg-light">Interested Weekly</td> --}}
    {{--                        <td> --}}
    {{--                            @foreach ($weeklys as $weekly) --}}
    {{--                                @if (is_array($tutor->weekly) && in_array($weekly->id, $tutor->weekly)) --}}
    {{--                                    {{ $weekly->name }}, --}}
    {{--                                @endif --}}
    {{--                            @endforeach --}}
    {{--                        </td> --}}
    {{--                    </tr> --}}
    {{--                    <tr> --}}
    {{--                        <td class="bg-light">Demanded Salary</td> --}}
    {{--                        <td>{{ $tutor->salary ?? '0' }}</td> --}}
    {{--                    </tr> --}}
    {{--                </table> --}}
    {{--            </div> --}}

    {{--            <div class="table-responsive"> --}}
    {{--                <table class="table table-bordered"> --}}
    {{--                    <tr> --}}
    {{--                        <td colspan="2" class="bg-light"><h3>Experience Details</h3></td> --}}
    {{--                    </tr> --}}
    {{--                    <tr> --}}
    {{--                        <td>{!! $tutor->details !!}</td> --}}
    {{--                    </tr> --}}
    {{--                </table> --}}
    {{--            </div> --}}
    {{--        </div> --}}

    {{--    </div> --}}



    {{--    <div class="row"> --}}
    {{--        <div class="col-md-3"> --}}
    {{--            <div class="card-box p-0" style="min-height: 600px;"> --}}
    {{--                <div class="card-header bg-dark text-light">Basic Information</div> --}}
    {{--                <div class="card-body"> --}}
    {{--                    <table class="table"> --}}
    {{--                        <tr> --}}
    {{--                            <td>Name</td> --}}
    {{--                            <td>{{ $tutor->user->name ?? '' }}</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>E-mail</td> --}}
    {{--                            <td>{{ $tutor->user->email ?? '' }}</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Phone</td> --}}
    {{--                            <td>{{ $tutor->user->phone ?? '' }}</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Status</td> --}}
    {{--                            <td>{!! $tutor->user->status == 1 ? '<span class="badge badge-sm badge-info">Active</span>' : '<span class="badge badge-sm badge-info">Active</span>' !!}</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Avatar</td> --}}
    {{--                            <td>NID</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td><img src="{{ $tutor->user->avatar ?? '' }}" alt="AVATAR" class="img-fluid img-thumbnail" style="width: 150px;"></td> --}}
    {{--                            <td><img src="{{ $tutor->user->nid ?? '' }}" alt="NID" class="img-fluid img-thumbnail" style="width: 300px;"></td> --}}
    {{--                        </tr> --}}


    {{--                    </table> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--        <div class="col-md-3"> --}}
    {{--            <div class="card-box p-0" style="min-height: 600px;"> --}}
    {{--                <div class="card-header bg-dark text-light">Address</div> --}}
    {{--                <div class="card-body"> --}}
    {{--                    <table class="table"> --}}
    {{--                        <tr> --}}
    {{--                            <td>Division</td> --}}
    {{--                            <td>{{ $tutor->division->name ?? '' }}</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>District</td> --}}
    {{--                            <td>{{ $tutor->district->name ?? '' }}</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Area</td> --}}
    {{--                            <td>{{ $tutor->area->name ?? '' }}</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Address</td> --}}
    {{--                            <td>{{ $tutor->address ?? '' }}</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Gender</td> --}}
    {{--                            <td>{{ $tutor->gender ?? '' }}</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Date of Birth</td> --}}
    {{--                            <td>{{ $tutor->date_of_birth ?? '' }}</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Institution</td> --}}
    {{--                            <td>{{ $tutor->institution ?? '' }}</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Subject</td> --}}
    {{--                            <td>{{ $tutor->subject_name ?? '' }}</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Session</td> --}}
    {{--                            <td>{{ $tutor->session ?? '' }}</td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Facebook Link</td> --}}
    {{--                            <td><a href="{{ $tutor->facebook ?? '#' }}" class="badge badge-info"><i class="mdi mdi-facebook"></i></a></td> --}}
    {{--                        </tr> --}}
    {{--                    </table> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--        <div class="col-md-6"> --}}
    {{--            <div class="card-box p-0" style="min-height: 600px;"> --}}
    {{--                <div class="card-header bg-dark text-light">Interested Section</div> --}}
    {{--                <div class="card-body"> --}}
    {{--                    <table class="table"> --}}
    {{--                        <tr> --}}
    {{--                            <td>Interested Area</td> --}}
    {{--                            <td> --}}
    {{--                                @foreach ($areas as $area) --}}
    {{--                                    @if (is_array($tutor->interest_location) && in_array($area->id, $tutor->interest_location)) --}}
    {{--                                        <span>{{ $area->name }},</span> --}}
    {{--                                    @else --}}
    {{--                                        @continue --}}
    {{--                                    @endif --}}
    {{--                                @endforeach --}}
    {{--                            </td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Interested Medium</td> --}}
    {{--                            <td> --}}
    {{--                                @foreach ($mediums as $medium) --}}
    {{--                                    @if (is_array($tutor->interest_medium) && in_array($medium->id, $tutor->interest_medium)) --}}
    {{--                                        <span>{{ $medium->name }},</span> --}}
    {{--                                    @else --}}
    {{--                                        @continue --}}
    {{--                                    @endif --}}
    {{--                                @endforeach --}}
    {{--                            </td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Interested Class</td> --}}
    {{--                            <td> --}}
    {{--                                @foreach ($tclass as $tclas) --}}
    {{--                                    @if (is_array($tutor->interest_class) && in_array($tclas->id, $tutor->interest_class)) --}}
    {{--                                        <span>{{ $tclas->name }},</span> --}}
    {{--                                    @else --}}
    {{--                                        @continue --}}
    {{--                                    @endif --}}
    {{--                                @endforeach --}}
    {{--                            </td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Interested Gender to Tutor</td> --}}
    {{--                            <td> --}}
    {{--                                {{is_array($tutor->interest_gender) && in_array('Male', $tutor->interest_gender) ? 'Male' : '' }} --}}
    {{--                                {{is_array($tutor->interest_gender) && in_array('Female', $tutor->interest_gender) ? 'Female' : '' }} --}}
    {{--                            </td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Demanded Salary</td> --}}
    {{--                            <td>{{ $tutor->salary }} </td> --}}
    {{--                        </tr> --}}

    {{--                        <tr> --}}
    {{--                            <td>Interested Subject</td> --}}
    {{--                            <td> --}}
    {{--                                @foreach ($subjects as $subject) --}}
    {{--                                    @if (is_array($tutor->interest_sub) && in_array($subject->id, $tutor->interest_sub)) --}}
    {{--                                        <span>{{ $subject->name }},</span> --}}
    {{--                                    @else --}}
    {{--                                        @continue --}}
    {{--                                    @endif --}}
    {{--                                @endforeach --}}
    {{--                            </td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Interested Time</td> --}}
    {{--                            <td> --}}
    {{--                                @foreach ($timelys as $timely) --}}
    {{--                                    @if (is_array($tutor->interest_time) && in_array($timely->id, $tutor->interest_time)) --}}
    {{--                                        <span>{{ $timely->name }},</span> --}}
    {{--                                    @else --}}
    {{--                                        @continue --}}
    {{--                                    @endif --}}
    {{--                                @endforeach --}}
    {{--                            </td> --}}
    {{--                        </tr> --}}
    {{--                        <tr> --}}
    {{--                            <td>Interested Days in week</td> --}}
    {{--                            <td> --}}
    {{--                                @foreach ($weeklys as $weekly) --}}
    {{--                                    @if (is_array($tutor->weekly) && in_array($weekly->id, $tutor->weekly)) --}}
    {{--                                        <span>{{ $weekly->name }},</span> --}}
    {{--                                    @else --}}
    {{--                                        @continue --}}
    {{--                                    @endif --}}
    {{--                                @endforeach --}}
    {{--                            </td> --}}
    {{--                        </tr> --}}

    {{--                    </table> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </div> --}}
    <hr>

    <div class="card-box">
        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap" cellspacing="0"
            width="100%" id="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tuition</th>
                    <th>Tutor Name</th>
                    <th>Request By</th>
                    <th>Status</th>
                    <th>Salary</th>
                    <th>Created Date</th>
                    <th class="hidden-sm">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tuition_all as $tuitions)
                    <tr>
                        <td><b>{{ $loop->index + 1 }}</b></td>
                        <td> {{ $tuitions->tuition ? $tuitions->tuition->name : '' }} -
                            {{ $tuitions->tuition ? $tuitions->tuition->job_id : '' }}</td>
                        <td>{{ $tuitions->tutor->user->name }}</td>
                        <td>{{ $tuitions->user->name }} ({{ $tuitions->user->user_type }})</td>
                        <td>{{ $tuitions->status == 1 ? 'Book' : 'Pending' }}</td>
                        <td>{{ $tuitions->salary <= 0 ? 'Negotiable' : $tuitions->salary }}</td>
                        <td>{{ date('d-m-Y', strtotime($tuitions->created_at)) }}</td>
                        <td>
                            <div class="btn-group dropdown">
                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle"
                                    data-toggle="dropdown" aria-expanded="false"><i
                                        class="mdi mdi-dots-horizontal"></i></a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="{{ route('tuition_book.edit', $tuitions->id) }}"><i
                                            class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit</a>

                                    <form action="{{ route('tuition_book.status', $tuitions->id) }}" method="get">
                                        @csrf
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('Are you sure to {{ $tuitions->status == 1 ? 'Pending' : 'Book' }} this Tutor?')">
                                            <i
                                                class="mdi mdi-check-all m-r-10 text-muted font-18 vertical-middle"></i>{{ $tuitions->status == 1 ? 'Pending' : 'Book This' }}</button>
                                    </form>

                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['tuition_book.destroy', $tuitions->id],
                                        'style' => 'display:inline',
                                    ]) !!}
                                    {{ Form::button('<i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete', ['type' => 'submit', 'class' => 'dropdown-item']) }}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>


    <script></script>
    <script>
        $('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
    </script>
@endsection
