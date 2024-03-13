@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <h2 class="header-title">Payment List</h2>
                <form action="" method="GET" class="pb-5">

                    <div class="row form-group">


                        <div class="col">
                            <input type="date" class="form-control" name="date" value="{{ $request->date }}" >
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" name="enddate" value="{{ $request->enddate }}" >
                        </div>


                        <div class="col">
                            <input type="text" placeholder="Transaction ID" class="form-control" name="transaction_id" value="{{ $request->transaction_id }}">
                        </div>

                        <div class="col">
                            <select name="payment_type" class="form-control select2">
                             @php $selected ='Selected'; @endphp
                                <option value="" @if($request->payment_type =='') {{$selected}} @endif>All</option>
                                <option @if($request->payment_type=='online') {{$selected}} @endif value="online">Online</option>
                                <option @if($request->payment_type =='cash') {{$selected}} @endif  value="cash">Cash</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="submit" class="btn btn-dark pull-right" value="Search">
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Payment Type</th>
                        <th>Status</th>
                        <th>Payment For</th>
                    </tr>

                </thead>
                <tbody>
                    @forelse($payment_list as $payment)
                        <tr>
                            <td class="text-center">{{ $loop->index + 1 }}</td>
                            <td>{{ date('d-m-Y',strtotime($payment->created_at)) }}</td>
                            <td><a href="{{ route('tutors.show', $payment->tutor_book->tutor_id ?? 0) }}">{{$payment->payment_for=='tuition_book'? $payment->tutor_book->user->name : '' }}</a></td>
                            <td>{{ $payment->transaction_id }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->payment_type }}</td>
                            <td>{{ $payment->status }}</td>
                            <td>{{ $payment->payment_for }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">No Data Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                </div>

            </div>
        </div>
    </div>
@endsection

