@php
    $sub_total_amount = 0;
    $total_discount = 0;
    $total_amount = 0;
    $total_lens = 0;
    $total_lens_discount=0;
@endphp
@foreach (App\Models\Cart::where('user_id', Auth::guard('customer')->user()->id)->get() as $cart)
    @php
        $product_prices = getProductDiscountedPrice($cart->product_id, 'retailer');
        $sub_total_amount = $sub_total_amount + $product_prices['selling_price'] * $cart->quantity;
        $total_discount = ($total_discount + $product_prices['selling_price'] - $product_prices['product_price']) * $cart->quantity;
        $total_amount = $total_amount + $product_prices['product_price'] * $cart->quantity;
        if(!empty($cart->lens_id)) {
            $total_lens = $total_lens + $cart->lens->price;
            $total_lens_discount = $total_lens_discount + lensDiscountPrice($cart->lens->id);
        }
    @endphp
@endforeach

<div class="ec-cart-summary">
<div>
    <span class="text-left">Item Total(F @if($total_lens > 0) + L @endif)</span>
    <span class="text-right">₹{{$sub_total_amount+$total_lens}}</span>
</div>
<div class="dscnt">
    <span class="text-left">Total Offer Discount</span>
    <span class="text-right">- ₹{{($sub_total_amount+$total_lens)-($total_amount+$total_lens_discount)}}</span>
</div>
<div>
    <span class="text-left">Net Item Total</span>
    <span class="text-right">₹{{$total_amount+$total_lens_discount}}</span>
</div>
</div>
