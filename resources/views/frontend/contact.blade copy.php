@extends('frontend.layouts.app')

@section('content')
   <!-- checkout item start -->

   <section class="contact_section"> 
    <div class="contact_container"> 
      <div class="row">
            <div class="col-md-6">
                <div class="contact_form">
                    <form class="row g-3" action="{{ route('contact_store') }}" method="POST">
                      @csrf
                        <div class="col-12">
                          <label for="inputname" class="form-label">Name</label>
                          <input type="text" name="name" class="form-control" id="inputname" placeholder="Your Name">
                        </div>
                        <div class="col-12">
                          <label for="inputemail" class="form-label">Email</label>
                          <input type="email" name="email" class="form-control" id="inputemail" placeholder="Your Email">
                        </div>
                        <div class="col-12">
                          <label for="phoneNumber" class="form-label">Phone</label>
                          <input type="text" name="phone" class="form-control" id="phoneNumber" placeholder="Phone Number">
                        </div> 
                        <div class="col-12">
                          <label for="inputAddress" class="form-label">Message</label> 
                          <textarea class="form-control" name="message" id="inputAddress" cols="10" rows="4" placeholder="Message..."></textarea>
                        </div> 
                        <div class="col-3"> 
                            <input type="submit" class="contact_btn btn_hover" id="phoneNumber" value="Send">
                        </div> 
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="map">
                  @php
                  $settings = App\Models\Setting::find('1');
              @endphp
                     <p>{{ $settings->name }}, <br> {{ $settings->address }} </p>  
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116834.00977788454!2d90.34928580896485!3d23.78077774450895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1655204786627!5m2!1sen!2sbd" width="100%" height="425" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div> 
            </div>
      </div>
    </div>
</section>


 
<!-- checkout item end -->
@endsection