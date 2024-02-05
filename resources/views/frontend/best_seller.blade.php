@foreach ($best_sellers as $best_seller)
@php
    $productData = $best_seller;
    $productprice = homePrice($productData->id);
@endphp
@include('frontend.product')
@endforeach
<input type="hidden" name="current_page_best_seller" value="{{$best_sellers->currentPage()}}" />
<input type="hidden" name="last_page_best_seller" value="{{$best_sellers->lastPage()}}" />
<a style="display:none;" id="current_page_best_sellers" name="example2" class="btn btn-secondary rds {{ ($best_sellers->currentPage() == $best_sellers->lastPage()) ? ' disabled' : '' }}" href="{{ $best_sellers->url($best_sellers->currentPage()+1) }}"   >View More <i class="ecicon eci-chevron-right"></i></a>
