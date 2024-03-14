@extends('frontend.layouts.app')
@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb"></div>
    <!-- Ec breadcrumb end -->
    <div class="desk_hide">
        <a href="{{ route('usermob_sidebar') }}" class="bck-btn"><i class="ecicon eci-arrow-left"></i> Back</a>
    </div>
    <!-- Ec cart page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-cart-leftside col-lg-8 col-md-12 ">
                    <!-- cart content Start -->
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <div class="row">
                                @php
                                $sub_total_amount = 0;
                                $total_discount = 0;
                                $total_amount = 0;
                            @endphp
                            @foreach (App\Models\Cart::where('user_id', Auth::guard('customer')->user()->id)->get() as $cart)
                                @php
                                    $product_prices = homePrice($cart->product_id);
                                    $sub_total_amount =
                                        $sub_total_amount +
                                        $product_prices['s_p'] * $cart->quantity;
                                    $total_discount =
                                        ($total_discount +
                                            $product_prices['s_p'] -
                                            $product_prices['p_p']) *
                                        $cart->quantity;
                                    $total_amount =
                                        $total_amount + $product_prices['p_p'] * $cart->quantity;
                                @endphp
                                <div class="col-md-6 mb-2">
                                    <div class="cards">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="pro-contents">
                                                    <h5 style="font-size: 12px;">                                                            {{ $cart->product->name }}
                                                        @if (!empty($cart->lens_id))
                                                            <br>
                                                            Lens : {{ $cart->lens->name }}
                                                        @endif
                                                    </h5>
                                                    @php $product_prices = getProductDiscountedPrice($cart->product_id, 'retailer'); @endphp
                                                    <p style="font-size: 12px; margin-bottom: 0;">
                                                        MRP <span class="amount">₹
                                                            <del>{{ $product_prices['selling_price'] }}</del>
                                                            {{ $product_prices['product_price'] }}</span><br>
                                                        @if (!empty($cart->lens_id))
                                                            MRP <span class="amount">₹
                                                                <del>{{ $cart->lens->price }}</del>
                                                                {{ lensDiscountPrice($cart->lens->id) }} </span>
                                                        @endif
                                                    </p>
                                                    <a href="{{ route('delete.to.cart', $cart->id) }}" style="color:#ff6240;">Remove <i
                                                        class="ecicon eci-trash-o"></i></a>
                                                    {{-- <p style="font-size: 12px; margin-bottom: 0;"> Qty : 1 </p> --}}
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="pro-img">
                                                    <a href="{{ route('details', $cart->product->slug) }}?type=product">
                                                        <img class="main-image"
                                                            src="{{ asset('public/' . api_asset($cart->product->thumbnail_image)) }}"
                                                            alt="Product">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ec-cart-update-bottom">
                                                <a href="{{ route('index') }}">Continue Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-cart-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Summary</h3>

                            </div>

                            <div class="ec-sb-block-content">
                                <div class="ec-cart-summary-bottom">
                                    <div id="cart-summary-div">
                                        @include('frontend.cart_summary')
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ec-cart-update-bottom">
                                                <a class="btn btn-primary text-white"
                                                    href="{{ route('checkout') }}">Proceed to Check Out</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
