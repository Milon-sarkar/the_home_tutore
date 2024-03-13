@extends('frontend.layouts.app')
@section('content')
    <!-- user dashboard start -->
    <div class="dashboard_wrapper" id="myTab3">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidber_menu">
                        @include('frontend.user.student.sidebar')
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="content_wrapper">
                        <div class="tab_content active" data-tab="2">
                            <div class="order_wraps">
                                <div class="card">
                                    <div class="card-header">
                                      My Apply List
                                    </div>
                                    <div class="card-body">
                                        <div class="order_table table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Tutor Id</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Salary</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($my_tuition as $order)
                                                        <tr>
                                                            <td class="product_id">
                                                                <a href="{{ route('tutor_profile',$order->tutor_id) }}">
                                                                    {{ $order->tutor->tutor_code }}
                                                                </a>
                                                            </td>
                                                            <td class="product_id">
                                                                <a href="{{ route('tutor_profile',$order->tutor_id) }}">
                                                                    {{ $order->tutor->user->name }}
                                                                </a>
                                                            </td>
                                                            <td class="order_date">
                                                                <p>{{ date('d-m-Y',strtotime($order->created_at)) }}</p>
                                                            </td>
                                                            <td class="product_price">
                                                                <span class="unit_amount">{{ $order->salary }} TK.</span>
                                                            </td>
                                                            <td class="order_status" width="130px">
                                                                 <span>{{ $order->status=='0'?'Pending':'Approved' }}</span>
                                                            </td>
                                                            <td class="order_status">
                                                                <a href="{{ route('tutor_profile',$order->tutor_id) }}?id={{ $order->tuition_id }}" class="view_details" style="float: unset;margin-left: 0;">
                                                                    <i class="fa-regular fa-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="25">No Order history Found! </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- user dashboard end -->
    <script src="{{ asset('frontend/js/ajax_jquery.min.js') }}"></script>
@endsection
