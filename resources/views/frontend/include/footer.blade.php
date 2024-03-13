<footer class="footer-area bg-cover">
    <!--start footer top area-->
    <div class="footer-top-area">
        <div class="container">
            <div class="row">
                <!--start footer widget-->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget logo">
                        <a href="#"><img src="{{ asset('frontend/img/logo.png') }}" alt="logo"></a>
                        <div class="footer-about-description">
                            <p>The Home Tutor is a Tutor and Tuition matching platform in Bangladesh. We provide qualified Tutor for student and Tuition for Tutor.</p>
                        </div>
                        <div class="follow d-flex" style="gap: 5px">
                        <h6>Follow Us :</h6>
                        <ul class="footer-social-icons logo ">
                            <li><a href="https://www.facebook.com/thehometutor24/?show_switched_toast=0&show_invite_to_follow=0&show_switched_tooltip=0&show_podcast_settings=0&show_community_review_changes=0&show_community_rollback=0&show_follower_visibility_disclosure=0"
                                    target="_blank"><i class="fab fa-facebook-f"></i></a></li>

                            {{-- <li><a href="https://thehometutor.net/pages/privacy-policy" target="_blank"><i
                                        class="fab fa-twitter"></i></a></li>
                            <li><a href="https://thehometutor.net/pages/privacy-policy" target="_blank"><i
                                        class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="https://thehometutor.net/pages/privacy-policy" target="_blank"><i
                                        class="fab fa-instagram"></i></a></li> --}}
                        </ul>
                    </div>
                    </div>
                </div>
                <!--end footer widget-->
                <!--start footer widget-->
                <div class="col-lg-4 col-md-6 links">
                    <div class="footer-widget footer-cat">
                        <h4>Important Links</h4>
                        <ul>
                            <li><a href="{{ route('index') }}"><i class="fa fa-angle-right"></i> Home</a></li>
                            <li><a href="{{ route('tutor_list') }}"><i class="fa fa-angle-right"></i> Tutor</a></li>
                            <li><a href="{{ route('tuition_list') }}"><i class="fa fa-angle-right"></i> Tuition</a></li>
                            <li><a href="{{ route('pages', 'data-privacy') }}"><i class="fa fa-angle-right"></i> Data privacy</a></li>
                            <li><a href="{{ route('pages', 'privacy-policy') }}"><i class="fa fa-angle-right"></i> Page privacy</a></li>
                        </ul>
                    </div>
                </div>
                <!--end footer widget-->
                {{-- <div class="col-lg-2 col-md-6">
                    <div class="footer-widget footer-cat">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Business</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Design</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Development</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Marketing</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Photography</a></li>
                        </ul>
                    </div>
                </div> --}}
                <!--start footer widget-->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget footer-contact">
                        <h4>Contact Us</h4>
                        <ul>
                            <li>
                                <i class="fa fa-map-marker"></i>
                                <p class="m-0">second floor, 154,china building lane, azimpur, Dhaka.</p>
                            </li>
                            <li>
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <p class="m-0">thtuserhelp@gmail.com</p>
                            </li>
                            <li>
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <a href="tel:+8801601346383" class="phone-link">
                                    <p class="m-0">+8801601346383</p>
                                </a>
                            </li>
                            <li class="p-0 info">Feel free to contact with us
                            </li>
                        </ul>
                    </div>
                </div>
                <!--end footer widget-->
            </div>
            <section>
                <div class="Download text-center">Download 'The Home Tutor' app</div>
                <div class="app d-flex">
                   <div class="play">
                    <a href="https://play.google.com/store/apps/details?id=net.thehometutor.thehometutor" target="_blank">
                       <img src="{{ asset('frontend/img/play.png') }}" class="img-fluid" alt="Play Button Image" height="100px" width="100px">
                    </a>
                   </div>
                   <div class="link">  
                           <span class="app-link">
                           <a href="https://play.google.com/store/apps/details?id=net.thehometutor.thehometutor" target="_blank"style="
                           color: #fff;
                       ">The Home Tutor on Google Play</a>
                           </span>
                   </div>
               </div>
               </section>
            <div class="Copyright">
                <p>
                    Copyright © 2022 All rights Reserved - The Home Tutor || Developed by 
                    <a href="https://www.sweepcode.info/" target="_blank"><b>Sweep Code</b></a>
                </p>
            </div>
            
        </div>
    </div>
    <!--end footer top area-->

</footer>
