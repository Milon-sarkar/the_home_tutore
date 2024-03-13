@extends('frontend.layouts.app')

@section('content')
    <!-- blog details start -->
    <div class="row">
        <div class="m-auto col-md-8">
            <div class="about_title text-center">
                <h1 class="text-danger" style="font-size: 180px;"><strong>401</strong></h1>
                <h2 style="font-size: 30px;" class="mb-0">Unauthorized</h2>
                <p class="text-muted"><span class="fa fa-info-circle"></span>The request was a legal request, but the server is refusing to respond to it. For use when authentication is possible but has failed or not yet been provided</p>
            </div>
            <div class="about_content text-center pt-5 w-35 m-auto">
                <ul class="list-unstyled d-flex justify-content-around">
                    <li><a href="{{ url()->previous() }}"><i class="fa fa-arrow-alt-circle-left"></i> Go Back</a></li>
                    <li class="pl-5"><a href="{{ route('home') }}"><i class="fa fa-home-alt"></i> Home</a></li>
                    @if(auth()->check())
                        @if(auth()->user()->user_type == 'admin')
                            <li class="pl-5"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Admin Dashboard</a></li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- blog details end -->
@endsection
