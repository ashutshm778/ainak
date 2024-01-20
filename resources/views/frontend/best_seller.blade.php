@foreach ($best_sellers as $best_seller)
@php
    $productData = $best_seller;
    $productprice = homePrice($productData->id);
@endphp
@include('frontend.product')
@endforeach