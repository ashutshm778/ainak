@foreach ($features as $feature)
@php
    $productData = $feature;
    $productprice = homePrice($feature->id);
@endphp
@include('frontend.product')
@endforeach
<div class="text-center">
    <a class="btn btn-secondary rds" href="#" id="view_more_feature">View More <i class="ecicon eci-chevron-right"></i></a>
</div>