@php
    $sub_total_amount = 0;
    $total_discount = 0;
    $total_amount = 0;
    $total_lens=0;
@endphp
@foreach (App\Models\Cart::where('user_id',Auth::guard('customer')->user()->id)->get() as $cart)
    @php
        $product_prices = getProductDiscountedPrice($cart->product_id,'retailer');
        $sub_total_amount = $sub_total_amount + $product_prices['selling_price'] * $cart->quantity;
        $total_discount = ($total_discount + $product_prices['selling_price'] - $product_prices['product_price']) * $cart->quantity;
        $total_amount = $total_amount + $product_prices['product_price'] * $cart->quantity;
        if(!empty($cart->lens_id)){
            $total_lens=$total_lens+$cart->lens->price;
        }
    @endphp
@endforeach
<div class="ec-cart-summary">
    <div>
        <span class="text-left">Sub-Total</span>
        <span class="text-right">₹{{$sub_total_amount}}</span>
    </div>
    @if($total_lens > 0)
    <div>
        <span class="text-left">Total Lens</span>
        <span class="text-right">₹{{$total_lens}}</span>
    </div>
    @endif
    <div class="ec-checkout-coupan-content w-100">
        <form class="ec-checkout-coupan-form" name="ec-checkout-coupan-form" method="post" action="#">
            <input class="ec-coupan" type="text" required="" placeholder="Enter Your Coupan Code" name="ec-coupan" value="">
            <button class="ec-coupan-btn button btn-primary" type="submit" name="subscribe" value="">Apply</button>
        </form>
    </div>
    <div>
        <span class="text-left">Discount Charges</span>
        <span class="text-right">₹{{$total_discount}}</span>
    </div>

    <div class="shipping">
        <span class="text-left">Shipping</span>
        <span class="text-right">Shipping to Uttar Pradesh</span>
    </div>

    <div class="ec-cart-summary-total">
        <span class="text-left">Total Amount</span>
        <span class="text-right">₹{{$total_amount+$total_lens}}</span>
    </div>
</div>
