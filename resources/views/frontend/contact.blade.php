@extends('frontend.layouts.app')
@section('title')
   Contact
@endsection
@section('content')
    <!-- checkout item start -->

    <section class="contact-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Contact Now</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact-form">
                        <form class="row g-3" action="{{ route('contact_store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="from-group">
                                        <label for="inputPassword5" class="form-label">Name</label>
                                        <input type="text" name="name" id="inputPassword5" placeholder="Enter Your Name"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="from-group">
                                        <label for="inputPassword5" class="form-label">Email</label>
                                        <input type="email" name="email" id="inputPassword5" placeholder="Enter Your Email"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="from-group">
                                        <label for="inputPassword5" class="form-label">Phone</label>
                                        <input type="text" name="phone" id="inputPassword5" placeholder="Enter your Number"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">message</label>
                                        <textarea class="form-control" name="message" rows="3" class="form-control" placeholder="Write a Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="from-group">
                                        <button type="submit" class="view_details">send message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="map">
                        @php
                            $settings = App\Models\Setting::find('1');
                        @endphp
                        <p>{{ $settings->name }}, <br> {{ $settings->address }} </p>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.636292320302!2d90.37902357843589!3d23.724678934834216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8d078e10e37%3A0x7455c4f2a97b36c9!2s154%20China%20Bldg%20Rd%2C%20Dhaka%201205!5e0!3m2!1sen!2sbd!4v1702820399726!5m2!1sen!2sbd"
                            width="100%" height="425" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- checkout item end -->
@endsection
