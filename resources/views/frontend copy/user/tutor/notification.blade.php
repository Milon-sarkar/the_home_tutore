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
                        <h2 class="bg-white py-2 px-3">Notification</h2>
                        <div class="tab_content active" data-tab="1">



                            <div class="accordion" id="accordionExample">

                                @forelse($notifications as $notification)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading_{{ $notification->id }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $notification->id }}" aria-expanded="true" aria-controls="collapse_{{ $notification->id }}">
                                            {{ $notification->notification_title }}
                                        </button>
                                    </h2>
                                    <div id="collapse_{{ $notification->id }}" class="accordion-collapse collapse" aria-labelledby="heading_{{ $notification->id }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            {{ $notification->notification_body }}
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <p class="text-center">No Notification Found</p>
                                @endforelse

                            </div>
                            <br>

                            {{ $notifications->links() }}

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
