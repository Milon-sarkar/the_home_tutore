@extends('frontend.layouts.app')
@section('title')
Login
@endsection
@section('content')
<!-- father registration start -->
<section class="login_registration">
    <div class="container">
        <div class="row d-flex justify-content-center">
            {{-- <div class="col-md-6"> --}}
            {{-- <div class="image_area"> --}}
            {{-- <img src="{{ asset('frontend/images/login.png') }}" alt="login registration"> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            <div class="col-md-6">
                <div class="input_area">
                    <div class="input_header">
                        <h4 class="subtitle_with_link">Don’t have an account?
                            <a href="{{ route('registration') }}?register_type=tutor">Register</a>
                        </h4>
                    </div>
                    <ul class="nav nav-pills nav-fill mb-5">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Login with OTP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('auth.password') }}">Login with Password</a>
                        </li>
                    </ul>
                    <div class="field_area">

                        <form method="post" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            {{-- <div class="mb-3"> --}}
                            {{-- <label for="email" class="form-label">E-mail</label> --}}
                            {{-- <input type="email" class="form-control @error('email') is-invalid @enderror" --}}
                            {{-- name="email" id="email" value="{{ old('email') }}" --}}
                            {{-- aria-describedby="emailHelp" required placeholder="example@mail.com"> --}}
                            {{-- @error('email') --}}
                            {{-- <span class="invalid-feedback" role="alert"> --}}
                            {{-- <strong>{{ $message }}</strong> --}}
                            {{-- </span> --}}
                            {{-- @enderror --}}
                            {{-- </div> --}}
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" aria-describedby="emailHelp" required placeholder="018********">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @if (isset($admin))
                            @if ($admin == true)
                            <input type="hidden" value="admin" name="user_type">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" required id="password" placeholder="*********">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @endif
                            @endif


                            <button type="submit" class="btn btn-primary submit">Login</button>
                            {{-- <button type="submit" class="sign_with_google"> <img
                                        src="{{ asset('frontend/images/google.png') }}" alt=""><span>Sign up with
                                Google</span></button> --}}
                        </form>

                        {{-- @include('auth.social_login') --}}

                        <!-- <form method="post" action="{{ route('auth.password') }}">
                            <a href="{{ route('auth.password') }}" style="text-align: center;color:#AC1558">
                                <h6>Login with Password</h6>
                            </a>
                        </form> -->


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Father registration end -->
@endsection
