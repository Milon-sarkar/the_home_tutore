
@extends('frontend.layouts.app')

@section('content')  


<div class="about">
    <div class="about_container">
        <div class="about_title">
            <h2>{{ $page_details->title }}</h2>
        </div>
        @if ( !empty($page_details->banner))
        <div class="about_feature_image">
            <img src="{{ $page_details->banner }}" alt="">
        </div>
            
        @endif
        <div class="about_content">
            {!!nl2br(str_replace(" ", " &nbsp;", $page_details->details))!!}
        </div>
    </div>
</div>

@endsection