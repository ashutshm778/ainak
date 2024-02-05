@foreach ($new_arriavls as $new_arriavl)
    @php
        $productData = $new_arriavl;
        $productprice = homePrice($new_arriavl->id);
    @endphp
    @include('frontend.product')
@endforeach
<a style="display:none;" id="current_page_new_arriavl" name="example" class="btn btn-secondary rds {{ ($new_arriavls->currentPage() == $new_arriavls->lastPage()) ? ' disabled' : '' }}" href="{{ $new_arriavls->url($new_arriavls->currentPage()+1) }}"   >View More <i class="ecicon eci-chevron-right"></i></a>
<input type="hidden" name="current_page_trending" value="{{$new_arriavls->currentPage()}}" />
<input type="hidden" name="last_page_trending" value="{{$new_arriavls->lastPage()}}" />
