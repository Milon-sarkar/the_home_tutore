<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title> The Home Tutor || @yield('title') </title>
    {{-- <title>{{ config('app.name', 'Tuition Media') }}</title> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.ico') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.6/dist/css/uikit.min.css" />
    <!-- C3 charts css -->
    <link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" media="all" href="{{ asset('backend/sweet_alert/swal.css') }}" />

    <link href="{{ asset('backend/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/plugins/switchery/switchery.min.css') }}">
    <link href="{{ asset('backend/plugins/c3/c3.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Ap
    p css -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/metismenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('backend/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('backend/sweet_alert/swal.js') }}"></script>
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>
    <link href="{{ asset('backend/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('backend/bootstrap-toastr/toastr.min.js') }}"></script>

    {{-- <script src="{{ asset('backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{ asset('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('backend/plugins/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
        <script src="{{ asset('backend/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- fotawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/fontawesome.min.css" integrity="sha512-P9vJUXK+LyvAzj8otTOKzdfF1F3UYVl13+F8Fof8/2QNb8Twd6Vb+VD52I7+87tex9UXxnzPgWA3rH96RExA7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .position-left-sticky{
            position: sticky !important;
            background-color: #FFFFFF !important;
            border-bottom: 1px solid !important;
        }
        .position-left-sticky-2{
            position: sticky !important;
            background-color: #FFFFFF !important;
        }
        @media all and (max-width: 240px) {
            .toast-top-full-width {}
        }

        @media all and (min-width: 241px) and (max-width: 320px) {
            .toast-top-full-width {}
        }

        @media all and (min-width: 321px) and (max-width: 480px) {
            .toast-top-full-width {}
        }

        .cursor-pointer {
            cursor: pointer !important;
        }

        /*.wrapper1, .wrapper2{width: 110%; border: none 0px RED;*/
        /*    overflow-x: scroll; overflow-y:hidden;}*/
        /*.wrapper1{height: 20px; }*/
        /*.wrapper2{height: auto; }*/
        /*.div1 {width:110%; height: 20px; }*/
        /*.div2 {width: 110%; height: auto;*/
        /*    overflow: auto;}*/

        .enlarged #wrapper .left.side-menu #sidebar-menu ul > li:hover a span {
            display: inline !important;
        }

        .enlarged .side-menu .metismenu li a span{
            display: none !important;
        }
        .container-fluid > .row > .col-12 > .card-box {
            padding-left: 5px !important;
            padding-right: 5px !important;
        }
    </style>


</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">
        <style>
            .toast {
                background-color: #030303;
            }

            .toast-info {
                background-color: #3276b1;
            }

            .toast-info2 {
                background-color: #2f96b4;
            }

            .toast-error {
                background-color: #bd362f;
            }

            .toast-success {
                background-color: #51a351;
            }

            .toast-warning {
                background-color: #f89406;
            }

            a {
                text-decoration: none !important;
            }
            .list-inline li{
                display: inline;
                padding-left: 5px;
            }
        </style>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    var msg = '{{ $error }}';
                    toastr.info(msg);
                </script>
            @endforeach
        @endif

        @if (session('fail'))
            <script>
                var msg = '{{ session('fail') }}';

                toastr.error(msg);
            </script>
        @endif
        @if (session('success'))
            <script>
                var msg = '{{ session('success') }}';
                toastr.success(msg);
            </script>
        @endif
        <!-- Top Bar Start -->
        @include('backend.include.header')
        <!-- Top Bar End -->
        <!-- ========== Left Sidebar Start ========== -->
        @include('backend.include.sidebar')
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->

        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid" style="padding: 0px !important;">
{{--                    @include('backend.include.breadcrumb')--}}
                    @yield('content')
                </div> <!-- container -->
            </div> <!-- content -->

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    @stack('modals')
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.6/dist/js/uikit.min.js"></script>
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/js/popper.min.js') }}"></script><!-- Popper for Bootstrap -->
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/js/waves.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('backend/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('backend/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('backend/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
    </script>
    <!-- Counter js  -->
    <script src="{{ asset('backend/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/counterup/jquery.counterup.min.js') }}"></script>

    <!--C3 Chart-->
    <script type="text/javascript" src="{{ asset('backend/plugins/d3/d3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/c3/c3.min.js') }}"></script>
    <!--datatable-->
    <script type="text/javascript" src="{{ asset('backend/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/datatables/buttons.print.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/datatables/jszip.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/datatables/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/plugins/datatables/vfs_fonts.js') }}"></script>


    
    <!--Echart Chart-->
    <script src="{{ asset('backend/plugins/echart/echarts-all.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('backend/pages/jquery.dashboard.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('backend/js/jquery.core.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.app.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        $(document).ready(function() {

            $('.select2').select2();
        });
    </script>

    @stack('footer_js')

    <script>
        $(function(){
            $(".wrapper1").scroll(function(){
                $(".wrapper2")
                    .scrollLeft($(".wrapper1").scrollLeft());
            });
            $(".wrapper2").scroll(function(){
                $(".wrapper1")
                    .scrollLeft($(".wrapper2").scrollLeft());
            });
        });
    </script>

</body>

</html>
