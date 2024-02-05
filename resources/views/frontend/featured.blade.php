@foreach ($features as $feature)
@php
    $productData = $feature;
    $productprice = homePrice($feature->id);
@endphp
@include('frontend.product')
@endforeach
<a style="display:none;" id="current_page_feature" name="example1" class="btn btn-secondary rds {{ ($features->currentPage() == $features->lastPage()) ? ' disabled' : '' }}" href="{{ $features->url($features->currentPage()+1) }}"   >View More <i class="ecicon eci-chevron-right"></i></a>