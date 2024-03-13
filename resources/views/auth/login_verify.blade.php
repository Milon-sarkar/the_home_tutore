@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Phone Number') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="jq-tab-menu">
                                <li class="dashboard_title_tab active">
                                    <a class="text-muted" style="text-decoration: none;"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                        <i class="icon-user"></i>{{ __('Logout') }}</a>

                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8">
                            <form action="{{ route('phone_verification.verify') }}" method="post">
                                @csrf
                                <input type="hidden" name="phone" value="{{ $phone }}">

                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone_otp" placeholder="OTP Code">
                                </div>
                                @error('phone_otp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <br>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Verify" class="btn btn-success">
                                </div>

                            </form>

                            <hr>

                            @if (session('phone_otp_resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A new OTP has been sent to your phone number.'. auth()->user()->phone ?? '') }}
                                </div>
                                @php \Illuminate\Support\Facades\Session::put('phone_otp_resent',false) @endphp
                            @endif

                            {{ __('Before proceeding, please check your Inbox/Spam for a verification link.') }}
                            {{ __('If you did not receive the otp') }},
                            <form class="d-inline" method="POST" action="{{ route('phone_verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                            </form>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
@endsection
