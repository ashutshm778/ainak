@foreach ($new_arriavls as $new_arriavl)
    @php
        $productData = $new_arriavl;
        $productprice = homePrice($new_arriavl->id);
    @endphp
    @include('frontend.product')
@endforeach
<div class="text-center">
    <a class="btn btn-secondary rds" href="#" id="view_more_trending">View More <i class="ecicon eci-chevron-right"></i></a>
</div>
