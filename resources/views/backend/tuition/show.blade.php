@extends('backend.layouts.app')

@section('content')




    <div class="row">
        @include('backend.tuition.show_components.user')
        @include('backend.tuition.show_components.basic_information_1')
        @include('backend.tuition.show_components.basic_information_2')
        @include('backend.tuition.show_components.requirement')
        @include('backend.tuition.show_components.details')
    </div>

{{--    <div class="table-responsive">--}}
{{--        <table class="table table-hover m-0 tickets-list table-actions-bar dt-responsive nowrap table-bordered" cellspacing="0" width="100%" id="datatable">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>ID</th>--}}
{{--                <th>Name</th>--}}
{{--                <th>Phone</th>--}}
{{--                <th>Action</th>--}}
{{--                <th>Whatsapp</th>--}}
{{--                <th>Address</th>--}}
{{--                <th>Institute</th>--}}
{{--                <th>Subject</th>--}}
{{--                <th>Salary</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}

{{--            <tbody>--}}
{{--            @php $tutors = \App\Models\Tutor::with('user')->whereIn('gender',$tuition->gender)->get() @endphp--}}
{{--            @forelse ($tutors as $tutor)--}}

{{--                <tr style="background: {{ (($loop->index + 1) % 2 == 1) ? '#f6f6f6' : '#CCC'  }}">--}}
{{--                    <td><b>{{ $tutor->tutor_code }}  </b></td>--}}
{{--                    <td><a href="{{ route('tutors.show', $tutor->id) }}">{{ $tutor->user->name ?? '' }}</a> </td>--}}
{{--                    <td>{{ $tutor->user->phone ?? '' }}</td>--}}
{{--                    <td>--}}
{{--                        <div class="btn-group dropdown">--}}
{{--                            <a href="javascript: void(0);" class="table-action-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>--}}
{{--                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">--}}
{{--                                <a class="dropdown-item" href="{{ route('tutor_profile',$tutor->id) }}" target="_blank"><i class="mdi mdi-information m-r-10 text-muted font-18 vertical-middle"></i>Public Link</a>--}}
{{--                                <a class="dropdown-item" href="{{ route('tutors.show',$tutor->id) }}"><i class="mdi mdi-information m-r-10 text-muted font-18 vertical-middle"></i>Details</a>--}}
{{--                                <a class="dropdown-item" href="{{ route('tutors.edit',$tutor->id) }}"><i class="mdi mdi-pencil m-r-10 text-muted font-18 vertical-middle"></i>Edit</a>--}}


{{--                                <span class="send_sms dropdown-item cursor-pointer" data-number="{{ $tutor->user->phone }}" data-sms-type="single" data-sms-receiver-name="{{ $tutor->user->name }}"><i class="mdi mdi-message m-r-10 text-muted font-18 vertical-middle"></i>Send SMS</span>--}}

{{--                                <form action="{{ route('tutors.status', $tutor->id) }}" method="get">--}}
{{--                                    @csrf--}}
{{--                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to {{ $tutor->status==1 ?'InActive':'Active' }} this Tutor?')"> <i class="mdi mdi-check-all m-r-10 text-muted font-18 vertical-middle"></i>{{ $tutor->status==1 ?'InActive':'Active' }}</button>--}}
{{--                                </form>--}}
{{--                                <form action="{{ route('tutors.destroy', $tutor->id) }}" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    @method("DELETE")--}}
{{--                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to delete this Tutor?')"> <i class="mdi mdi-delete m-r-10 text-muted font-18 vertical-middle"></i>Delete</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        @php $whatsapp = $tutor->user->whatsapp ?? '' @endphp--}}
{{--                        @if(strlen($whatsapp) > 11)--}}
{{--                            <a href="https://wa.me/{{ $tutor->user->whatsapp  ?? '' }}" target="_blank">{{ $tutor->user->whatsapp ?? '' }}</a>--}}
{{--                        @else--}}
{{--                            <a href="https://wa.me/+88{{ $tutor->user->whatsapp  ?? '' }}" target="_blank">{{ $tutor->user->whatsapp ?? '' }}</a>--}}
{{--                        @endif--}}
{{--                    </td>--}}
{{--                    <td>{{ $tutor->address }}</td>--}}
{{--                    <td>{{ $tutor->institution }} </td>--}}
{{--                    <td>{{$tutor->subject? $tutor->subject->name:'' }}</td>--}}
{{--                    <td>{{ $tutor->salary <= 0 ? 'Negotiable': $tutor->salary}}</td>--}}
{{--                </tr>--}}
{{--            @empty--}}

{{--            @endforelse--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}



    <script src="{{ asset('backend/js/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '.ckeditor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        $('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });

    </script>
@endsection
