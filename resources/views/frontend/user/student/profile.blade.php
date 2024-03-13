@extends('frontend.layouts.app')

@section('content')
    <!-- user dashboard start -->
    <div class="dashboard_wrapper" id="myTab3">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidber_menu">
                        @include('frontend.user.student.sidebar')
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="content_wrapper">

                        <div class="tab_content active" data-tab="2">

                            <div class="order_wraps">
                                <div class="card">
                                    <div class="card-header">
                                      My Profile <span style="float: right;color: red;"
                                      class="text-right;">
                                      {{ $tutor->tutor_code??'' }}</span>
                                    </div>
                                    <div class="card-body">
                                        <form id="kt_ecommerce_settings_general_form" class="form" action="{{ route('studnt_profile_update',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf


                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <span class="required">Full Name</span>

                                                </label>
                                                <input type="text" class="form-control form-control-solid" name="name" value="{{ Auth::user()->name }}" />
                                                <input type="hidden" class="form-control form-control-solid" name="id" value="{{ Auth::user()->id }}" />
                                                <!--end::Input-->
                                            </div>
                                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-bold form-label mt-3">
                                                            <span class="required">Email</span>

                                                        </label>
                                                        <!--end::Label-->
                                                        @php
                                                            $email = auth()->user()->email;
                                                            $first_part = strtok($email, "@");
                                                        @endphp
                                                        <!--begin::Input-->
                                                        @if($first_part == auth()->user()->phone)
                                                            <input type="email" class="form-control form-control-solid" name="email" value="" required/>
                                                            <small class="text-warning fa fa-warning" style="text-transform: capitalize !important;"> Please input your email.</small>

                                                        @else
                                                            <input type="email" class="form-control form-control-solid" name="email" required value="{{ Auth::user()->email }}" />
                                                        @endif
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-bold form-label mt-3">
                                                            <span>Phone</span>

                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" class="form-control form-control-solid" name="phone" value="{{ Auth::user()->phone }}" />
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light mt-3">Update</button>
                                            </div>
                                    </form>
                            </div>
                        </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


      </div>
    <!-- user dashboard end -->
    <script src="{{ asset('backend/js/ajax_jquery.min.js') }}"></script>
    <script>
             $(document).ready(function() {
            //shipping_calculation();
            $("#wizard-picture").change(function(){
        readURL(this);
    });
        });

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

    </script>



@endsection
