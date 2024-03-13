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
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="tab_content active" data-tab="2">

                            <div class="order_wraps">
                                <div class="card">
                                    <div class="card-header">
                                        {{ $tutor->tutor_code ?? '' }}</span>
                                    </div>
                                    <div class="card-body">
                                        <form id="kt_ecommerce_settings_general_form" class="form"
                                            action="{{ route('store', Auth::user()->id) }}" method="POST">
                                            @csrf
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <span class="required">Guardian Opinion</span>
                                                </label>
                                                <!--begin::Textarea-->
                                                <textarea class="form-control form-control-solid" name="opinion"></textarea>
                                                <!--end::Textarea-->
                                                <input type="hidden" class="form-control form-control-solid" name="id"
                                                    value="{{ Auth::user()->id }}" />
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light mt-3">Update</button>
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
            $("#wizard-picture").change(function() {
                readURL(this);
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
