@extends('backend.layouts.app')

@section('content')

<div class="row">



    <div class="col-xl-3 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
            <i class="mdi mdi-account-multiple widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">SMS Balance</p>

                <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ json_decode(get_balance())->balance ?? '' }}</span></h2>
                <p class="m-0">Per SMS 0.25 BDT</p>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-xl-3 col-sm-6">
        @php $applied_book_tuition = \App\Models\TuitionBook::where('status','2')->count() @endphp
        <div class="card-box widget-box-two widget-two-custom">
            <i class="mdi mdi-account-multiple widget-two-icon {{ $applied_book_tuition > 0 ? 'text-danger' : '' }}"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Applied Pending</p>

                <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ $applied_book_tuition }}</span></h2>
                <p class="m-0">--</p>
            </div>
        </div>
    </div><!-- end col -->
    @php $pending_tuition_book = \App\Models\TuitionBook::where('status','0')->count() @endphp
    <div class="col-xl-3 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
            <i class="mdi mdi-account-multiple widget-two-icon {{ $pending_tuition_book > 0 ? 'text-danger' : '' }}"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Pending Tuition</p>

                <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ $pending_tuition_book }}</span></h2>
                <p class="m-0">--</p>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-xl-3 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
            <i class="mdi mdi-auto-fix widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Tuition Booked</p>
                <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span>{{ App\Models\TuitionBook::where('status','1')->count(); }} </h2>
                <p class="m-0">In {{ App\Models\Tuition::count(); }}</p>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xl-3 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
            <i class="mdi mdi-account-multiple widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Tuition</p>
                <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ App\Models\Tuition::count(); }}</span></h2>
                <p class="m-0">In {{ App\Models\Tuition::count(); }}</p>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-xl-3 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
            <i class="mdi mdi-account-multiple widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Active Tuition</p>
                <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ App\Models\Tuition::where('status','1')->count(); }}</span></h2>
                <p class="m-0">In {{ App\Models\Tuition::count(); }}</p>
            </div>
        </div>
    </div><!-- end col -->
</div>



<div class="row">
    <div class="col-xl-3 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
            <i class="mdi mdi-account-multiple widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Available Tutors</p>
                <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ App\Models\Tutor::where('status','1')->count(); }}</span></h2>
                <p class="m-0">In {{ App\Models\Tutor::count(); }}</p>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-xl-3 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
            <i class="mdi mdi-account-multiple widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-bold text-danger font-secondary text-overflow" title="Statistics">Inactive Tutors</p>
                <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ App\Models\Tutor::where('status','!=','1')->count(); }}</span></h2>
                <p class="m-0">In {{ App\Models\Tutor::count(); }}</p>
            </div>
        </div>
    </div><!-- end col -->
</div>



<div class="row">
    <div class="col-xl-3 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
            <i class="mdi mdi-currency-usd widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Users</p>
                <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ App\Models\User::count(); }}</span></h2>
                <p class="m-0">{{ date('d-m-Y') }}</p>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-xl-3 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
            <i class="mdi mdi-account-multiple widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Admin</p>
                <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ App\Models\User::where('status','1')->where('user_type', 'admin')->count(); }}</span></h2>
                <p class="m-0">In {{ App\Models\User::count(); }}</p>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-xl-3 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
            <i class="mdi mdi-account-multiple widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Guardians</p>
                <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ App\Models\User::where('status','1')->where('user_type', 'guardian')->count(); }}</span></h2>
                <p class="m-0">In {{ App\Models\User::count(); }}</p>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-xl-3 col-sm-6">
        <div class="card-box widget-box-two widget-two-custom">
            <i class="mdi mdi-account-multiple widget-two-icon"></i>
            <div class="wigdet-two-content">
                <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Students</p>
                <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">{{ App\Models\User::where('status','1')->where('user_type', 'student')->count(); }}</span></h2>
                <p class="m-0">In {{ App\Models\User::count(); }}</p>
            </div>
        </div>
    </div><!-- end col -->

  <!-- end col -->


</div>
<!-- end row -->

<div class="row">
    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4"> Earnings</h4>

                <div class="row">
                    <div class="col-4">
                        <div class="text-center mt-4">
                            <h5>{{ \App\Models\Payment::where('status','Completed')->sum('amount') }}</h5>
                            <p class="mb-2 text-truncate">Total Earning</p>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-4">
                        <div class="text-center mt-4">
                            <h5>{{ \App\Models\Payment::where('status','Completed')->whereBetween('created_at', [Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->sum('amount') }}</h5>
                            <p class="mb-2 text-truncate">Last Week</p>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-4">
                        <div class="text-center mt-4">
                            <h5>{{ \App\Models\Payment::where('status','Completed')->whereMonth('created_at',Carbon\Carbon::now()->month)->sum('amount') }}</h5>
                            <p class="mb-2 text-truncate">Last Month</p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
            </div>
        </div><!-- end card -->
    </div>
    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-body">

                <script src="//interactive.guim.co.uk/libs/iframe-messenger/iframeMessenger.js"></script>
                <script>
                    var iframeMessenger = require("iframe-messenger")
                    iframeMessenger.enableAutoResize();
                </script>
            </div>
        </div>
    </div>

</div>


<div class="row d-none">
    <div class="col-xl-4">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Revenue Comparison</h4>

            <div class="text-center">
                <h5 class="font-normal text-muted">You have to pay</h5>
                <h3 class="m-b-30"><i class="mdi mdi-arrow-up-bold-hexagon-outline text-success"></i> 25643 <small>USD</small></h3>
            </div>

            <div class="chart-container">
                <div class="" style="height:280px" id="platform_type_dates_donut"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Visitors Overview</h4>

            <div class="text-center">
                <h5 class="font-normal text-muted">You have to pay</h5>
                <h3 class="m-b-30"><i class="mdi mdi-arrow-down-bold-hexagon-outline text-danger"></i> 5623 <small>USD</small></h3>
            </div>

            <div class="chart-container">
                <div class="" style="height:280px" id="user_type_bar"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Goal Completion</h4>

            <div class="text-center">
                <h5 class="font-normal text-muted">You have to pay</h5>
                <h3 class="m-b-30"><i class="mdi mdi-arrow-up-bold-hexagon-outline text-success"></i> 12548 <small>USD</small></h3>
            </div>

            <div class="chart-container">
                <div class="chart has-fixed-height" style="height:280px" id="page_views_today"></div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->


<div class="row d-none">

    <div class="col-xl-6 col-lg-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Recent Candidates</b></h4>
            <p class="text-muted font-14 m-b-20">
                Your awesome text goes here.
            </p>

            <div class="table-responsive">
                <table class="table table-hover m-0 table-actions-bar">

                    <thead>
                    <tr>
                        <th>
                            <div class="btn-group dropdown">
                                <button type="button" class="btn btn-secondary btn-xs dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Dropdown link</a>
                                    <a class="dropdown-item" href="#">Dropdown link</a>
                                </div>
                            </div>
                        </th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Job Timing</th>
                        <th>Salary</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <img src="assets/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                        </td>

                        <td>
                            <h5 class="m-b-0 m-t-0 font-600">Tomaslau</h5>
                            <p class="m-b-0"><small>Web Designer</small></p>
                        </td>

                        <td>
                            <i class="mdi mdi-map-marker text-primary"></i> New York
                        </td>

                        <td>
                            <i class="mdi mdi-clock text-success"></i> Full Time
                        </td>

                        <td>
                            <i class="mdi mdi-currency-usd text-warning"></i> 3265
                        </td>

                        <td>
                            <a href="#" class="table-action-btn"><i class="mdi mdi-pencil"></i></a>
                            <a href="#" class="table-action-btn"><i class="mdi mdi-close"></i></a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <img src="assets/images/users/avatar-3.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                        </td>

                        <td>
                            <h5 class="m-b-0 m-t-0 font-600">Erwin E. Brown</h5>
                            <p class="m-b-0"><small>Programmer</small></p>
                        </td>

                        <td>
                            <i class="mdi mdi-map-marker text-primary"></i> California
                        </td>

                        <td>
                            <i class="mdi mdi-clock text-success"></i> Part Time
                        </td>

                        <td>
                            <i class="mdi mdi-currency-usd text-warning"></i> 1365
                        </td>

                        <td>
                            <a href="#" class="table-action-btn"><i class="mdi mdi-pencil"></i></a>
                            <a href="#" class="table-action-btn"><i class="mdi mdi-close"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="assets/images/users/avatar-4.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                        </td>

                        <td>
                            <h5 class="m-b-0 m-t-0 font-600">Margeret V. Ligon</h5>
                            <p class="m-b-0"><small>Web Designer</small></p>
                        </td>

                        <td>
                            <i class="mdi mdi-map-marker text-primary"></i> New York
                        </td>

                        <td>
                            <i class="mdi mdi-clock text-success"></i> Full Time
                        </td>

                        <td>
                            <i class="mdi mdi-currency-usd text-warning"></i> 115248
                        </td>

                        <td>
                            <a href="#" class="table-action-btn"><i class="mdi mdi-pencil"></i></a>
                            <a href="#" class="table-action-btn"><i class="mdi mdi-close"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="assets/images/users/avatar-5.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                        </td>

                        <td>
                            <h5 class="m-b-0 m-t-0 font-600">Jose D. Delacruz</h5>
                            <p class="m-b-0"><small>Web Developer</small></p>
                        </td>

                        <td>
                            <i class="mdi mdi-map-marker text-primary"></i> New York
                        </td>

                        <td>
                            <i class="mdi mdi-clock text-success"></i> Part Time
                        </td>

                        <td>
                            <i class="mdi mdi-currency-usd text-warning"></i> 2451
                        </td>

                        <td>
                            <a href="#" class="table-action-btn"><i class="mdi mdi-pencil"></i></a>
                            <a href="#" class="table-action-btn"><i class="mdi mdi-close"></i></a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <img src="assets/images/users/avatar-8.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                        </td>

                        <td>
                            <h5 class="m-b-0 m-t-0 font-600">Luke J. Sain</h5>
                            <p class="m-b-0"><small>Web Designer</small></p>
                        </td>

                        <td>
                            <i class="mdi mdi-map-marker text-primary"></i> Australia
                        </td>

                        <td>
                            <i class="mdi mdi-clock text-success"></i> Part Time
                        </td>

                        <td>
                            <i class="mdi mdi-currency-usd text-warning"></i> 3265
                        </td>

                        <td>
                            <a href="#" class="table-action-btn"><i class="mdi mdi-pencil"></i></a>
                            <a href="#" class="table-action-btn"><i class="mdi mdi-close"></i></a>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- end col -->

    <div class="col-xl-3 col-lg-6">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Total Unique Visitors</h4>

            <div class="widget-chart text-center">

                <div id="donut-chart" style="height: 270px;"></div>

                <div class="row text-center m-t-30">
                    <div class="col-6">
                        <h3 data-plugin="counterup">1,507</h3>
                        <p class="text-muted m-b-5">Visitors Male</p>
                    </div>
                    <div class="col-6">
                        <h3 data-plugin="counterup">854</h3>
                        <p class="text-muted m-b-5">Visitors Female</p>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="col-xl-3 col-lg-6">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Number of Transactions</h4>

            <div class="widget-chart text-center">

                <div id="pie-chart" style="height: 270px;"></div>

                <div class="row text-center m-t-30">
                    <div class="col-6">
                        <h3 data-plugin="counterup">2,854</h3>
                        <p class="text-muted m-b-5">Payment Done</p>
                    </div>
                    <div class="col-6">
                        <h3 data-plugin="counterup">22</h3>
                        <p class="text-muted m-b-5">Payment Due</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<!--- end row -->
@endsection
