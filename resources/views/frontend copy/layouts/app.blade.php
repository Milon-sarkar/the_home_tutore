<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="facebook-domain-verification" content="d2omiwje5ji29xcjvv9z07ligjn39b" />

    <title>{{ config('app.name', 'Tuition Media') }}</title>
    <link rel="shortcut icon" href="http://localhost:8000/backend/images/favicon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Custom Font -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.4/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/font.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('frontend/fontawesome-6.1.1-web/css/all.min.css') }}">
    <!-- Main CSS -->

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>
    <link href="{{ asset('backend/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('backend/bootstrap-toastr/toastr.min.js') }}"></script>


    <meta name="google-site-verification" content="gBNWS0hgVfiV4ixSUKyCMpKG_r886xVDa3ni1IRd0pA" />


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2WW9YPSRYK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-2WW9YPSRYK');
    </script>

    <!-- Scripts -->


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .w-35 {
            width: 35% !important;
        }
    </style>
    <meta property="og:site_name" content="{{ config('app.company_name') }}">

    <meta property="og:image" content="{{ asset('img/the_home_tutor.jpg') }}">
    <meta name="twitter:card" content="{{ asset('img/the_home_tutor.jpg') }}">
    <meta name="twitter:image" content="{{ asset('img/the_home_tutor.jpg') }}">
    <meta property="og:type" content="Get your Tuition/ Tutor. বাংলাদেশের সেরা মেধাবী শিক্ষার্থীদের টিউটর প্লাটফর্ম।" />
    <meta name="twitter:card" content="{{ asset('img/the_home_tutor.jpg') }}">
    <meta name="twitter:site" content="Get your Tuition/ Tutor. বাংলাদেশের সেরা মেধাবী শিক্ষার্থীদের টিউটর প্লাটফর্ম।">
    <meta name="twitter:creator" content="">
    <meta name="twitter:image" content="{{ asset('img/the_home_tutor.jpg') }}"><meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('index') }}">
    <meta property="og:title" content="Get your Tuition/ Tutor. বাংলাদেশের সেরা মেধাবী শিক্ষার্থীদের টিউটর প্লাটফর্ম।">
    <meta property="og:description" content="Get your Tuition/ Tutor. বাংলাদেশের সেরা মেধাবী শিক্ষার্থীদের টিউটর প্লাটফর্ম।">
    <meta property="og:image" content="{{ asset('img/the_home_tutor.jpg') }}">

    @stack('meta')
    <script src="//code.tidio.co/dx9znhuhsdgj2l1z5uptocz775x0ppf5.js" async></script>
</head>

<body>
    <div id="app">
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
            .cursor-disable{
                cursor: no-drop !important;
            }
            .cursor-pointer{
                cursor: pointer !important;
            }
            .post_card .post_card_content .content_item .icon i {
                color: #949597 !important;
            }
            .area_ul_list{
                list-style: none;
                height: 74px;
                position: absolute;
                z-index: 99;
                border: 1px solid #cec3c3;
                overflow: scroll;
                background: white;
                padding-left: 0px;
            }
            .area_ul_list li{
                padding-left: 5px;
                padding-right: 5px;
            }
            .area_ul_list li:hover{
                background: #e6e3e3;
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
        <!-- Header area start -->
        @include('frontend.include.header')
        <!-- Header area end -->


        <div style="min-height: 70vh">

            @yield('content')
        </div>


        <!-- Footer start -->
        @include('frontend.include.footer')
        <!-- Footer end -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.4/dist/js/uikit.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- tabs js -->
    <script src="{{ asset('frontend/js/jquery.tabs.min.js') }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('footer_js')


{{--    <!-- Messenger Chat Plugin Code -->--}}
{{--    <div id="fb-root"></div>--}}

{{--    <!-- Your Chat Plugin code -->--}}
{{--    <div id="fb-customer-chat" class="fb-customerchat">--}}
{{--    </div>--}}

{{--    <script>--}}
{{--        var chatbox = document.getElementById('fb-customer-chat');--}}
{{--        chatbox.setAttribute("page_id", "102206974506144");--}}
{{--        chatbox.setAttribute("attribution", "biz_inbox");--}}
{{--    </script>--}}

{{--    <!-- Your SDK code -->--}}
{{--    <script>--}}
{{--        window.fbAsyncInit = function() {--}}
{{--            FB.init({--}}
{{--                xfbml            : true,--}}
{{--                version          : 'v15.0'--}}
{{--            });--}}
{{--        };--}}

{{--        (function(d, s, id) {--}}
{{--            var js, fjs = d.getElementsByTagName(s)[0];--}}
{{--            if (d.getElementById(id)) return;--}}
{{--            js = d.createElement(s); js.id = id;--}}
{{--            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';--}}
{{--            fjs.parentNode.insertBefore(js, fjs);--}}
{{--        }(document, 'script', 'facebook-jssdk'));--}}
{{--    </script>--}}








    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "102206974506144");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v15.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

@stack('footer_js')
@stack('modal')
</body>

</html>
