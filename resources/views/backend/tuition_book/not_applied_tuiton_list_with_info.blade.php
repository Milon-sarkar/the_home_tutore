@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <h2 class="header-title m-b-15 m-t-0 h3"></h2>
                <div class="row">
                    <?php
                    if(request()->get('not_applied')){
                        $bg = 'red';
                        $type = 'not_applied=true';
                        $data_type = 'not_applied';
                    }
                    ?>

                    <form action="" method="get" id="searching_form">
                        <input type="hidden" name="{{ $data_type }}" value="true">
                    </form>
                    <div class="row d-flex justify-content-between">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="job_id" placeholder="Tuition ID/ Job ID" class="form-control" form="searching_form" value="{{ request()->get('job_id') }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="tutor_phone" placeholder="Tutor Phone" class="form-control" form="searching_form" value="{{ request()->get('tutor_phone') }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select name="area_id" class="form-control select2" id="" form="searching_form">
                                    <option value="">Area</option>
                                    @foreach(\App\Models\Area::take(100)->get() as $area)
                                        <option value="{{ $area->id }}" {{( request()->get('area_id') == $area->id) ? 'selected' : '' }}>{{ $area->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select name="class_id" class="form-control select2" id="" form="searching_form">
                                    <option value="">Class</option>
                                    @foreach(\App\Models\Tclass::get() as $tclass)
                                        <option value="{{ $tclass->id }}" {{( request()->get('class_id') == $tclass->id) ? 'selected' : '' }}>{{ $tclass->name }}</option>
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
                                <th class="text-center">Tuition/Job ID</th>
                                <th class="text-center">Find Tutor</th>
                                <th class="text-center">Total Applied</th>
                            </tr>
                            @php $have_date = false @endphp
                            @php $default_date = null @endphp
                            @forelse($tuition_all as $tuition)
                                @php $total = $tuition->tuition_books->count() @endphp

                                @php
                                    $total_tuition = \App\Models\Tuition::select('id', 'created_at')->whereDate('created_at', $tuition->created_at)->get()->count();
                                    $date = date_format(date_create($tuition->created_at), 'd-M y');
                                @endphp

                                <tr>

                                    <td>({{ $total_tuition }}) {{ $date }}</td>

                                    <td>
                                        {{ $tuition->name }}
                                        {!!  ($tuition->tuitions_status == 2) ? '<span class="badge badge-info">Booked</span>' : '' !!}
                                    </td>
                                    <td class="text-center">{{ $tuition->job_id }}</td>
                                    <td>
                                        <a target="_blank" href="{{ route('tutors.index') }}?form_search=find_tutor&interest_institution={{ $tuition->interest_institution }}&interest_sub={{ json_encode($tuition->interest_sub) }}&interest_medium={{ json_encode($tuition->interest_medium) }}&interest_gender={{ json_encode($tuition->interest_gender) }}&tutor_faculty={{ $tuition->tutor_faculty }}&interest_class={{ json_encode($tuition->interest_class) }}">
                                            <small class="btn btn-sm btn-outline-dark">Find Tutor</small>
                                        </a>
                                    </td>
                                    <td class="text-center" style="width: 50px">
                                        <p class="badge m-0 {{ $total > 0 ? 'bg-danger' : 'bg-secondary' }}" style="font-size: 20px"> {{ $total }}</p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="25" class="text-center">No Data Found</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                    <br>



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
