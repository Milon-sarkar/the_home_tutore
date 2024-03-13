@extends('frontend.layouts.app')
@section('content')
    <!-- user dashboard start -->
    <div class="dashboard_wrapper pt-md-4 pt-2" id="myTab3">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('frontend.user.tutor.sidebar')
                </div>
                <div class="col-md-9">


                    <div class="content_wrapper">
                        <h2 class="bg-white py-2 px-3">Tutor Dashboard</h2>
                        <div class="tab_content active" data-tab="1">
                            @if ($tutor->area_id == '')
                            <div class="">
{{--                                <div class="alert alert-danger d-flex align-items-center">--}}
{{--                                    <a class="alert-link ml-2 pl-3" href="{{ route('profile',Auth::user()->id) }}">Please Complete Your Profile. Click to complete</a>--}}
{{--                                </div>--}}
                            </div>
                            @endif


                                <div class="row">
                                    @forelse($my_tuition as $order)
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header text-light bg-{{ $order->status=='1'?'success':'primary' }} text-center">
                                                    <a href="{{ route('tuition_details',$order->tuition->job_id ?? '0') }}?id={{ $order->tuition->id ?? '0' }}" target="_blank">
                                                        <h4 class="card-title mb-0 text-light">{{ $order->tuition->name ?? '' }}</h4>
                                                        <p class="text-light mb-0">Tuition ID- {{ $order->tuition->job_id ?? '' }}</p>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    @if($order->status == 1)
                                                        <p class="text-warning text-center" style="font-size: 25px">
                                                            <span class="d-block"><strong>Congratulations</strong></span>
                                                            <span style="font-size: 15px">আপনাকে টিউশন দেয়া হয়েছে।</span>
                                                        </p>
                                                    @endif

                                                        <p style="text-align: justify">
                                                            @if($order->status == '2')
                                                                @php $tuition_pending = \App\Models\TuitionBook::where('tuition_id', $order->tuition_id)->where('status', '0')->first() @endphp
                                                                @if($tuition_pending)
                                                                    এই টিউশনে  <a href="{{ route('tutor_profile', ['id' =>$tuition_pending->tutor->id ?? '0'] ) }}" target="_blank">{{ $tuition_pending->user->name ?? '' }}</a> কে অভিবাবক ডেমো ক্লাসের জন্য নির্ধারণ করেছেন। যদি ক্যান্সেল হয়, আপনার সাথে যোগাযোগ করা হবে। দ্রুত টিউশন পেতে নতুন নতুন টিউশনে আবেদন করুন।
                                                                @endif
                                                            @endif
                                                            @if($order->status == '3')
                                                                 এই <a href="{{ route('tuition_details', ['tuition_id' =>$order->tuition->job_id  ?? '0'] ) }}?id={{ $order->tuition->id ?? '' }}" target="_blank">{{ $order->tuition->job_id ?? '' }}</a> টিউশনে গার্ডিয়ান আপনাকে নিয়োগ না করায় আমরা আন্তরিকভাবে দুঃখিত,দ্রুত টিউশন পেতে নতুন নতুন টিউশনে আবেদন করুন।
                                                            @endif
                                                        </p>

                                                        <style>
                                                            td{
                                                                vertical-align: middle !important;
                                                            }
                                                        </style>
                                                        <hr>

                                                    <table class="table">
                                                        <tr>
                                                            <td>Salary</td>
                                                            <td>{{ $order->salary }} TK.</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status</td>
                                                            <td>
{{--                                                                {{ $order->status=='1'?'Booked':'Pending' }}--}}
                                                                @if($order->status == '1')
                                                                    Booked
                                                                @elseif($order->status == '2')
                                                                    Applied
                                                                @elseif($order->status == '0')
                                                                    Pending
                                                                @elseif($order->status == '3')
                                                                    Rejected
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @if($order->status== '1' OR $order->status == '0')
                                                        <tr>
                                                            <td>অভিভাবকের নাম</td>
                                                            <td>{{ $order->tuition->user->name ?? '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>অভিভাবকের ফোন নাম্বার</td>
                                                            <td>
                                                                <span class="d-block"><a href="callto: {{ $order->tuition->phone ?? '' }}">{{ $order->tuition->phone ?? '' }}</a></span>
                                                                <a href="callto: {{ $order->tuition->user->phone ?? '' }}">{{ $order->tuition->user->phone ?? '' }}</a>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        <tr>
                                                            <td>Date</td>
                                                            <td>{{ date('d-m-Y',strtotime($order->created_at)) }}</td>
                                                        </tr>
                                                    </table>
                                                        <span class="d-block text-center">
                                                        <a href="{{ route('tuition_details',$order->tuition->job_id ?? 0) }}?id={{ $order->tuition->id ?? 0 }}" class="btn btn-{{ $order->status=='1'?'success':'primary' }}" target="_blank">View More</a>
                                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center">No Tuition Found</div>
                                    @endforelse
                                </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>


      </div>
    <!-- user dashboard end -->

        <script type="text/javascript">
            window.addEventListener("scroll", function(){
                var header = document.querySelector("nav");
                header.classList.toggle("sticky", window.scrollY > 0);
            })
        </script>
@endsection
