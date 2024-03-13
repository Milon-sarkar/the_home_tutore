@extends('frontend.layouts.app')
@section('content')
    <!-- user dashboard start -->
    <div class="dashboard_wrapper" id="myTab3">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidber_menu">
{{--                        <ul class="jq-tab-menu">--}}
{{--                            <li class="dashboard_title_tab " data-tab="1"><a href="{{ route('home') }}">dashboard</a>--}}
{{--                            </li>--}}
{{--                            <li class="dashboard_title_tab active" data-tab="2"><a--}}
{{--                                    href="{{ route('my_tuition_post') }}">My Tuition Post</a> </li>--}}
{{--                            <li class="dashboard_title_tab" data-tab="3"><a href="{{ route('my_apply') }}">my--}}
{{--                                    Apply List</a> </li>--}}
{{--                            <li class="dashboard_title_tab" data-tab="4"><a href="{{ route('student_profile',Auth::user()->id) }}">manage profile</a></li>--}}

{{--                            <li class="dashboard_title_tab" data-tab="3"><a href="{{ route('student_pasword_change',Auth::user()->id) }}">Password Change</a></li>--}}

{{--                            <li class="dashboard_title_tab" data-tab="5"><a class="menu-link "--}}
{{--                                    href="{{ route('logout') }}"--}}
{{--                                    onclick="event.preventDefault();--}}
{{--                                document.getElementById('logout-form').submit();">--}}
{{--                                    <i class="icon-user"></i>{{ __('Logout') }}</a>--}}
{{--                                <form id="logout-form" action="{{ route('logout') }}" method="POST"--}}
{{--                                    style="display: none;">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                        @include('frontend.user.student.sidebar')
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="content_wrapper">

                        <div class="tab_content active" data-tab="2">

                            <div class="order_wraps">
                                <div class="row">
                                    @forelse($my_tuition as $order)
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4><a style="text-decoration: none;" href="{{ route('tuition_details', $order->job_id) }}?id={{ $order->id }}">{{ $order->name }}</a></h4>
                                                <ul class="d-flex justify-content-between list-unstyled m-0 bg-white p-2" style="border-radius: 10px; border: 1px solid #999988">
                                                    <li>Job ID: {{ $order->job_id }}</li>
                                                    <li>Salary: {{ $order->salary }} BDT</li>
                                                    <li>{{ $order->status=='0'?'Pending':'Approved' }}</li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="order_table table-responsive">
                                                    @forelse ($order->tuition_books as $tuition_book)
                                                        <ul class="d-flex justify-content-between list-unstyled mb-1">
                                                            <li>Name: <a href="{{ route('tutor_profile', $tuition_book->tutor_id) }}" style="text-decoration: none;"> {{ $tuition_book->tutor->user->name ?? '' }}</a>
                                                            </li>
                                                            <li>Tutor ID: {{ $tuition_book->tutor->tutor_code ?? '' }}</li>
                                                            <li>
                                                                <span class="badge bg-muted text-dark ">
                                                                   @if($tuition_book->status == 2) Applied
                                                                    @elseif($tuition_book->status == 0) Sent for Demo
                                                                    @elseif($tuition_book->status == 1) Appointed
                                                                    @elseif($tuition_book->status == 3) Rejected
                                                                    @endif
                                                                </span>

                                                            </li>
                                                        </ul>

                                                        <ul class="list-unstyled d-flex justify-content-around">
                                                            <li>
                                                                <p style="text-transform: capitalize;" class="urgency_class cursor-pointer text-center text-info" data-id="{{ $tuition_book->id }}">View Urgency</p>
                                                            </li>
                                                            <li class="pl-2">
                                                                <a href="{{ route('tutor_profile', $tuition_book->tutor_id) }}" style="text-decoration: none;">View CV</a>
                                                            </li>
                                                        </ul>
                                                        <p id="urgency_{{ $tuition_book->id }}" style="display: none;">{{ $tuition_book->tutor_urgency }}</p>
                                                        <script>
                                                            $(document).ready(function (){
                                                                $(".urgency_class").click(function(){
                                                                    var urgency_id = $(this).data('id')
                                                                    $("#urgency_"+urgency_id).toggle()
                                                                })
                                                            })
                                                        </script>
                                                        @if($loop->last == false)
                                                            <hr>
                                                        @endif
                                                    @empty
                                                        <p>No tutor applied yet.</p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-md-12">
                                        <p>No tuition Found</p>
                                    </div>
                                    @endforelse
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
