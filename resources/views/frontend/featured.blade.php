@foreach ($features as $feature)
@php
    $productData = $feature;
    $productprice = homePrice($feature->id);
@endphp
@include('frontend.product')
@endforeach