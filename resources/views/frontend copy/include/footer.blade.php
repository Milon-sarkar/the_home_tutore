<div class="footer bg-white">
    <div class="container">
        <div class="footer_top">
            <div class="row">
                <div class="col-lg-3 col-md-6 ">
                    <div class="footer_intro">
                        @php
                            $settings = App\Models\Setting::find('1');
                        @endphp

                        @php
                        $pages = App\Models\Page::where('title', 'Like',"%about us%")->first();
                       @endphp
                    @if(!empty($pages))
                    @php
                     $detailsaaa =\Illuminate\Support\Str::limit($pages->details,120)

                    @endphp
                     {!!nl2br(str_replace(" ", " &nbsp;", $detailsaaa))!!}
                       @endif
                        <div class="social_links">
                            <ul>
                                <li class="facebook"><a href="{{  $settings->facebook }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li class="twitter"><a href="{{  $settings->linkedin }}" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
                                <li class="instagram"><a href="{{  $settings->instagram }}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                <li class="twitter"><a href="{{  $settings->twitter }}" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 ">
                    <div class="important_links">
                        <div class="link_title">
                            <h3>Important links</h3>
                        </div>
                        <ul>
                            @if($settings->link != null)
                                @php
                                    $links =  json_decode($settings->link);
                                @endphp
                                @forelse ($links as $link)

                                    <li><a target="_blank" href="{{ $link['link'] }}">{{ $link['name'] }}</a></li>
                                @empty

                                @endforelse

                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 ">
                    <div class="pages">
                        <div class="pages_title">
                            <h3>Pages</h3>
                        </div>
                        <ul>
                            @php
                            $pages = App\Models\Page::get();
                            @endphp

                            @forelse ($pages as $page)
                            <li><a href="{{ route('pages',$page->slug) }}">{{ $page->title }}</a></li>
                            @empty

                            @endforelse


                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 ">
                    <div class="contact_us">
                       <div class="contact_title">
                           <h3>Contact us</h3>
                       </div>
                       <div class="contact_item">
                           <a href="tel:{{  $settings->phone }}">{{  $settings->phone }}</a>
                           <a href="mailto:{{  $settings->email }}">{{  $settings->email }}</a>
                       </div>
                    </div>
               </div>
            </div>
        </div>
        <div class="copyright_area">
            <p>Copyright &copy; 2021 All rights Reserved - Tuition Media || Developed by <a target="_blunk" href="https://innovainst.com/">INNOVA INSTITUTE</a></p>
{{--            <p><a href="{{ route('admin') }}">Manage</a></p>--}}
        </div>
    </div>
</div>
