<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title> The Home Tutor || @yield('title') </title>
    <!--favicon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/images/favicon.png') }}">
    <!--bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!--owl carousel css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">

    <!--magnific popup css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <!--font awesome css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <!--meanmenu css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/meanmenu.css') }}">
    <!--animate css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css') }}">
    <!--main css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/default.css') }}">
    <!--responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Add these links in the head section of your HTML document -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css">

</head>

<body>
    @include('frontend.include.header')
    <!-- Header area end -->


    <div style="min-height: 70vh">

        @yield('content')
    </div>


    <!-- Footer start -->
    @include('frontend.include.footer')
    <!--end footer-->
    <div class="scroll-area">
        <i class="fa fa-angle-up"></i>
    </div>

    <!--jQuery js-->
    <script src="{{ asset('frontend/js/jquery-3.6.4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Proper JS -->
    {{-- <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script> --}}
    <!-- Mainmenu JS -->
    <script src="{{ asset('frontend/js/meanmenu.min.js') }}"></script>
    <!-- Counterup JS -->
    <script src="{{ asset('frontend/js/counterup.min.js') }}"></script>
    <!-- Waypoints JS -->
    <script src="{{ asset('frontend/js/waypoints.js') }}"></script>
    <!-- Magnific JS -->
    <script src="{{ asset('frontend/js/magnific-popup.min.js') }}"></script>
    <!-- Carousel JS -->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('footer_js')
    @stack('modal')
</body>
<script>
    $(document).ready(function() {
        $(".select2").select2({
            placeholder: "Select Area",
            width: "resolve",
            allowClear: true,
        });
        $(".Gender").select2({
            placeholder: "Select Gender",
            width: "resolve",
            allowClear: true,
        });
        $(".Subject").select2({
            placeholder: "Select Subject",
            width: "resolve",
            allowClear: true,
        });
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    });
</script>

</html>
