(function ($) {
    "use strict";

    $(document).ready(function () {

        /*---------------------------------------------------
            mainmenu
        ----------------------------------------------------*/
        $('.mainmenu').meanmenu({
            meanMenuContainer: '.mobile-menu',
            meanScreenWidth: '1199',
        });

        $(".sidebar-toggle-btn").on("click", function () {
            $(".sidebar-wrap").addClass("sidebar-opened");
//            $(".body-overlay").addClass("opened");
        });
        $(".sidebar-close-btn").on("click", function () {
            $(".sidebar-wrap").removeClass("sidebar-opened");
//            $(".body-overlay").removeClass("opened");
        });

        //===== Sticky
        $(window).on('scroll', function(event) {    
            var scroll = $(window).scrollTop();
            if (scroll < 350) {
                $(".header-bottom").removeClass("sticky");
            } else{
                $(".header-bottom").addClass("sticky");
            }
        });
           
        /*---------------------------------------------------
            slider carousel
        ----------------------------------------------------*/
         ///banner
        var $full = $('.slider-area-full');
        if($full.length > 0){
            $(document).ready(function(){
                $(".slider-area-full").owlCarousel({
                    loop:true,
                    center:true,
                    smartSpeed: 450,
                    autoplaySpeed:3000,
                    items:1,
                    autoplay: true,
                    nav:false,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                });
            });
        }

         
 });
    /*---------------------------------------------------
        sticky header
    ----------------------------------------------------*/
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $(".header-area").removeClass("sticky");
        } else {
            $(".header-area").addClass("sticky");
        }
    });


    /*---------------------------------------------------
        preloader
    ----------------------------------------------------*/
    $(window).on('load', function () {
        $('.preloader').fadeOut(500);
    });

     /*---------------------------------------------------
                magnific popUp
        ----------------------------------------------------*/
        $('.technology-video a').magnificPopup({
            type: 'iframe',
        });



    // Scroll Area
    var $scroll = $('.scroll-area');
    if($scroll.length > 0){
        $(document).ready(function(){
            $('.scroll-area').click(function(){
                $('html').animate({
                    'scrollTop' : 0,
                },700);
                return false;
            });
            $(window).on('scroll',function(){
                var a = $(window).scrollTop();
                if(a>400){
                    $('.scroll-area').slideDown(300);
                }else{
                    $('.scroll-area').slideUp(200);
                }
            });
        });
    }




}(jQuery));
