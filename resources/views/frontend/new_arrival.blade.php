@foreach ($new_arriavls as $new_arriavl)
    @php
        $productData = $new_arriavl;
        $productprice = homePrice($new_arriavl->id);
    @endphp
    @include('frontend.product')
@endforeach
<input type="hidden" name="current_page_new_arriavl" value="{{$new_arriavls->currentPage() }}" />


