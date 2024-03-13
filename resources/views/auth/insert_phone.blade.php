@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-capitalize">{{ __('Insert your phone number') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <form action="{{ route('insert_phone_save') }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone Number">
                                </div>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <br>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Proceed" class="btn btn-success">
                                </div>
                            </form>

                            <br>
                            <a class="menu-link text-muted" style="text-decoration: none;"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="icon-user"></i>{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
@endsection
