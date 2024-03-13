
@extends('frontend.layouts.app')
@section('title')
   others
@endsection
@section('content')  


<section class="detail-page section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="des-page">
                    <h2>{{ $page_details->title }}</h2>
                    <p>

                        {!!nl2br(str_replace(" ", " &nbsp;", $page_details->details))!!}
                 </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection