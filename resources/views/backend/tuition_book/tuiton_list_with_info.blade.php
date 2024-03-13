@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h2 class="header-title m-b-15 m-t-0 h3"></h2>
                <div class="row">
                    <?php
                        if($status == 0){
                            $data_type = 'pending_book';
                            $type = 'pending_book=true';
                            $bg = 'c5fff3';
                        }
                        elseif ($status == 2){
                            $data_type = 'applied_book';
                            $type = 'applied_book=true';
                            $bg = '7ff0d9';
                        }
                        elseif ($status == 1){
                            $data_type = 'booked_tuition';
                            $type = 'booked_tuition=true';
                            $bg = 'd1eee8';
                        }
                        elseif ($status == 3){
                            $data_type = 'rejected';
                            $type = 'rejected=true';
                            $bg = 'd1eee8';
                        }
                        else{
                            $data_type = 'pending_book';
                            $type = 'pending_book=true';
                            $bg = 'c5fff3';
                        }

                        if(request()->get('not_applied')){
                            $bg = 'red';
                            $type = 'not_applied=true';
                        }
                    ?>

                        <form action="" method="get" id="searching_form">
                            <input type="hidden" name="{{ $data_type }}" value="true">
                        </form>
                    <div class="row d-flex justify-content-between">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="job_id" placeholder="Tuition ID/ Job ID" class="form-control" form="searching_form">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="tutor_phone" placeholder="Tutor Phone/ Incomplete" class="form-control" form="searching_form">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select name="area_id" class="form-control select2" id="" form="searching_form">
                                    <option value="">Area</option>
                                    @foreach(\App\Models\Area::get() as $area)
                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select name="class_id" class="form-control select2" id="" form="searching_form">
                                    <option value="">Incomplete</option>
                                    @foreach(\App\Models\Tclass::get() as $tclass)
                                        <option value="{{ $tclass->id }}">{{ $tclass->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="guardian_phone" placeholder="Guardian Phone" class="form-control" form="searching_form">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-secondary" form="searching_form"><i class="fa fa-search"></i></button>
                                <a href="{{ route('tuition_book.index') }}?{{ $type }}"  class="btn btn-outline-danger"><i class="fa fa-times"></i></a>
                            </div>
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
                                <th class="text-center">Tuition ID</th>
                                @if(request()->get('applied_book'))
                                <th class="text-center">Find Tutor</th>
                                <th class="text-center">Total Applied</th>
                                <th class="text-center">Assigned to Pending</th>
                                @endif
                                @if(request()->get('pending_book'))
                                    <th class="text-center">Assigned to Pending</th>
                                @endif
                                @if(!request()->get('not_applied'))
                                <th class="text-center">Action</th>
                                @endif
                            </tr>
                            @php $have_date = false @endphp
                            @php $default_date = null @endphp
                            @forelse($tuition_all as $tuition)
                                @php $total = $tuition->tuition_books->count() @endphp

                                        @if(request()->get('applied_book'))

{{--                                        যখন টিউশন ‘অ্যাপ্লায়েড হয়ে থাকবে, তখন যতজন পেন্ডিং এ পাঠানো হয়েছে, তাদের ডাটাও যেন আসে--}}
{{--                                        পরবর্তীতে তাদের পাশাপাশি রাখা হবে।--}}
                                            @php $total = $tuition->tuition_books->where('status', 2)->count() @endphp
                                            @php $total_send_to_pending = $tuition->tuition_books->where('status', 0)->count() @endphp
{{--                                            @if($total < 1)--}}
{{--                                                @continue--}}
{{--                                            @endif--}}
                                        @endif
                                        @if(request()->get('pending_book'))
                                            @if($total < 1)
                                                @continue
                                            @endif
                                            @php $total_send_to_pending = $tuition->tuition_books->where('status', 0)->count() @endphp
                                        @endif
                                        @if(request()->get('booked_tuition'))
                                            @if($total < 1)
                                                @continue
                                            @endif
                                        @endif
                                        @if(request()->get('pending_charge'))
                                            @if($total < 1) @continue @endif
                                            @if($tuition->tuition_books)
                                                @if($tuition->tuition_books->where('status', 1)->first()->payment_status == 'Completed') @continue @endif
                                            @endif
                                        @endif
                                        @if(request()->get('not_applied'))
                                            @if($total > 0)
                                                @continue
                                            @endif
                                        @endif
                                        @if(request()->get('rejected'))
                                            @if($total > 0)
                                                @continue
                                            @endif
                                        @endif



                            @php
                                $total_tuition = \App\Models\Tuition::whereDate('created_at', $tuition->created_at)->get()->count();
                                $date = date_format(date_create($tuition->created_at), 'd-M y');
                            @endphp
{{--                            @if($have_date == false AND $default_date == $date)--}}
{{--                                @php--}}
{{--                                    $have_date = true;--}}
{{--                                    $default_date = $date;--}}
{{--                                @endphp--}}
{{--                            @else--}}
{{--                                @php--}}
{{--                                    $have_date = true;--}}
{{--                                    $default_date = $date;--}}
{{--                                @endphp--}}
{{--                            @endif--}}

{{--                            @if($have_date)--}}
{{--                                <tr>--}}
{{--                                    <td colspan="25">{{ $date }}</td>--}}
{{--                                </tr>--}}
{{--                            @endif--}}


                                <tr>

                                    <td>({{ $total_tuition }}) {{ $date }}</td>

                                    <td>
                                        {{ $tuition->name }}
                                        {!!  (\App\Models\TuitionBook::where('tuition_id', $tuition->id)->where('status', 1)->first()) ? '<span class="badge badge-info">Booked</span>' : '' !!}
                                    </td>
                                    <td class="text-center">{{ $tuition->job_id }}</td>
                                    @if(request()->get('applied_book'))
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
                                    @endif
                                    @if(request()->get('pending_book'))
                                        <td style="width: 100px" class="text-center">
                                            <p class="badge m-0 {{ $total > 0 ? 'bg-success' : 'bg-secondary' }}" style="font-size: 20px"> {{ $total_send_to_pending }}</p>
                                        </td>
                                    @endif
                                    @if(!request()->get('not_applied'))
                                    <td class="text-center">
                                        <a href="{{ route('tuition_book.index') }}?application_details=true&{{ $type }}&tuition_id={{ $tuition->id }}" class="btn btn-outline-success btn-sm">Details</a>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                            <tr>
                                <td colspan="25" class="text-center">No Data Found</td>
                            </tr>
                            @endforelse
                        </table>
                    </div>
                        <br>
                         {{ $tuition_all->appends(Request::except('branch_report'))->links() }}

{{--                    @foreach($tuition_all as $tuition)--}}
{{--                        @if($tuition->tuition_books == null)--}}
{{--                            @continue--}}
{{--                        @endif--}}
{{--                    <div class="col-md-3">--}}
{{--                        <div class="card p-2 bg-light">--}}
{{--                            <div class="text-center d-flex justify-content-center align-items-center" style="min-height: 150px; background-color: #{{ $bg }} !important">--}}
{{--                                <h3 class="p-2">{{ $tuition->name }}</h3>--}}
{{--                            </div>--}}
{{--                            <div class="text-center d-flex justify-content-center align-items-center bg-dark" style="min-height: 50px;">--}}
{{--                                <h5 class="p-2 text-light">Job ID- {{ $tuition->job_id }}</h5>--}}
{{--                            </div>--}}
{{--                            <hr>--}}
{{--                            <div class="row text-center">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    @php $total = $tuition->tuition_books->count() @endphp--}}
{{--                                   <p class="badge m-0 {{ $total > 0 ? 'bg-danger' : 'bg-secondary' }}" style="font-size: 20px"> {{ $total }}</p>--}}
{{--                                    <p class="m-0 text-muted">Applied</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}

{{--                                    <a href="{{ route('tuition_book.index') }}?application_details=true&{{ $type }}&tuition_id={{ $tuition->id }}" class="btn btn-outline-success btn-lg">Details</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endforeach--}}

                </div>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').dataTable();
        });
    </script>

@endsection
