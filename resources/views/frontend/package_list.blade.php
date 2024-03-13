@extends('frontend.layouts.app')
@section('title')
   Package List
@endsection
@section('content')
<section class="detail-page section-padding">
    <div class="container">
        <div class="section_title">
            <h4 class="subtitle">Expand your experience today</h4>
            <h2 class="title">Buy a best Price package</h2>
        </div>
        <div class="row">
            @foreach($packages as $package)
            <div class="col-lg-12">
                <div class="des-page">
                    <h2>{{ $package->title }}</h2>
                    <div class="plan_price">
                        <span>{{ $package->price }} /{{ $package->duration == 1 ? 'Month' : $package->duration." Months" }}</span>
                    </div>
                    <p class="plan_description">{{ shortText($package->description, 120) }}</p>
                    <table class="table">
                        @forelse($premium_package_items as $premium_package_item)
                            <tr>
                                <td>
                                    <label for="{{ $premium_package_item->id.'_item_edit' }}" class="cursor-pointer">{{ $premium_package_item->name }}</label>
                                </td>
                                <td class="text-center specification_item">
                                    @php
                                        $is_enable_arr = (array) $package->selected_items;
                                        $is_enable = in_array($premium_package_item->id, $is_enable_arr);
                                    @endphp
                                    @if($is_enable)
                                        <spam class="fa fa-check-circle text-success"></spam>
                                    @else
                                        <spam class="fa fa-times text-muted"></spam>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="25"></td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
