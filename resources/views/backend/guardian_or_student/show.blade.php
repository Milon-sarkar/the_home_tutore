@extends('backend.layouts.app')
@push('brdcrmb_1_link'){{ route('guardian_or_student.index') }}?type={{ $type }} @endpush
@push('brdcrmb_1_text')/ {{ $type }} @endpush

@push('brdcrmb_2_link'){{ route('guardian_or_student.show',$user->id) }}?type={{$type}}&user_id={{ $user->id }} @endpush
@push('brdcrmb_2_text')/ Show @endpush

@section('content')


    <div class="row">
        <div class="col-md-3">
            <div class="card-box p-0" style="min-height: 600px;">
                <div class="card-header bg-dark text-light">Basic Information</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>{{ $user->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td>{{ $user->email ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{ $user->phone ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{!! $user->status == 1 ? '<span class="badge badge-sm badge-info">Active</span>' : '<span class="badge badge-sm badge-info">Active</span>' !!}</td>
                        </tr>
                        <tr>
                            <td>Avatar</td>
                            <td>NID</td>
                        </tr>
                        <tr>
                            <td><img src="{{ user_img($user->avatar) }}" alt="AVATAR" class="img-fluid img-thumbnail" style="width: 150px;"></td>
                            <td><img src="{{ cover_img($user->nid) }}" alt="NID" class="img-fluid img-thumbnail" style="width: 300px;"></td>
                        </tr>

                        <tr>
                            <td>Register at</td>
                            <td>{{ date_format(date_create($user->created_at ?? '0000-00-00'),'M y, Y') }}</td>
                        </tr>
                        <tr>
                            <td>Tutor Register</td>
                            <td>{{ date_format(date_create($user->created_at ?? '0000-00-00'),'M y, Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap" cellspacing="0" width="100%" id="datatable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tuition</th>
                    <th>Tutor Name</th>
                    <th>Status</th>
                    <th>Salary</th>
                    <th>Created Date</th>
                    <th class="hidden-sm">Action</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($user->tuitions as $tuition)
                    <tr>
                        <td><b>{{ $loop->index+1 }}</b></td>
                        <td> {{$tuition->name ?? '' }} - {{ $tuition->job_id ?? '' }}</td>
                        <td>{{ $tuition->tutor->user->name ?? '' }}</td>
                        <td>{!! $tuition->status==1 ? '<span class="badge bg-info">Book</span>' : '<span class="badge bg-warning">Pending</span>' !!} </td>
                        <td>{{ $tuition->salary <= 0 ? 'Negotiable': $tuition->salary}}</td>
                        <td>{{ date('d-m-Y',strtotime($tuition->created_at)) }}</td>
                        <td>
                            <div class="btn-group dropdown">
                                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="{{ route('tuition_book.edit',$tuition->id) }}"><i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit</a>

                                    <form action="{{ route('tuition_book.status',$tuition->id) }}" method="get">
                                        @csrf
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to {{ $tuition->status==1 ?'Pending':'Book' }} this Tutor?')"> <i class="mdi mdi-check-all m-r-10 text-muted font-18 vertical-middle"></i>{{ $tuition->status==1 ?'Pending':'Book This' }}</button>
                                    </form>

                                    {!! Form::open(['method' => 'DELETE','route' => ['tuition_book.destroy', $tuition->id],'style'=>'display:inline']) !!}
                                    {{ Form::button('<i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete', ['type' => 'submit', 'class' => 'dropdown-item'] )  }}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="25" CLASS="text-center">No Tuition Found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
    <hr>



    <script>

    </script>
    <script>
        $('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });

    </script>
@endsection
