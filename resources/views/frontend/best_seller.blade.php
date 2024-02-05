@foreach ($best_sellers as $best_seller)
@php
    $productData = $best_seller;
    $productprice = homePrice($productData->id);
@endphp
@include('frontend.product')
@endforeach
@if($best_sellers->currentPage()==$best_sellers->lastPage())
@else
<a style="display:none;" id="current_page_best_sellers" name="example2" class="btn btn-secondary rds {{ ($best_sellers->currentPage() == $best_sellers->lastPage()) ? ' disabled' : '' }}" href="{{ $best_sellers->url($best_sellers->currentPage()+1) }}"   >View More <i class="ecicon eci-chevron-right"></i></a>
@endif