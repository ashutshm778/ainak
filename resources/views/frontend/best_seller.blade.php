@foreach ($best_sellers as $best_seller)
@php
    $productData = $best_seller;
    $productprice = homePrice($productData->id);
@endphp
@include('frontend.product')
@endforeach
<div class="text-center">
    <a class="btn btn-secondary rds" href="#" id="view_more_best_seller">View More <i class="ecicon eci-chevron-right"></i></a>
</div>