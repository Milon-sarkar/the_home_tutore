@extends('frontend.layouts.app')
@section('title')
    Login with Password
@endsection
@section('content')
    <!-- father registration start -->
    <section class="login_registration">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="input_area">
                        <div class="input_header">
                            <!-- <h2 class="title">Login With Password</h2> -->
                            <h4 class="subtitle_with_link">Don’t have an account?
                                <a href="{{ route('registration') }}?register_type=tutor">Register</a>
                            </h4>
                        </div>
                        <div class="field_area">
                        <ul class="nav nav-pills nav-fill mb-5">
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('login') }}">Login with OTP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Login with Password</a>
                        </li>
                    </ul>
                            <form method="post" action="{{ route('auth.loginwithPassword') }}">
                                {{ csrf_field() }}
                                <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" id="phone" value="{{ old('phone') }}"
                                            aria-describedby="emailHelp" required placeholder="01********">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="password" value="{{ old('password') }}"
                                        aria-describedby="emailHelp" required placeholder="018********">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                                <button type="submit" class="btn btn-primary submit">Login</button>
                                {{-- <button type="submit" class="sign_with_google"> <img
                                        src="{{ asset('frontend/images/google.png') }}" alt=""><span>Sign up with
                                        Google</span></button> --}}
                            </form>

                            {{--                            @include('auth.social_login') --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Father registration end -->
@endsection
