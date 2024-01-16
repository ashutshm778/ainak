<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=6597d1be3cf4bf001a6174c4&product=sop' async='async'></script>
@php
    $product_price = homePrice($data->id);
@endphp
<div class="row">
    <div class="single-pro-img single-pro-img-no-sidebar">
        <div class="single-product-scroll">
            <div class="single-product-cover">
                @php
                    $gallery_images = explode(',', $data->gallery_image);
                @endphp
                @foreach ($gallery_images as $new_key => $gallery_image)
                    <div class="single-slide zoom-image-hover">
                        <img src="{{ asset('public/' . api_asset($gallery_image)) }}">
                    </div>
                @endforeach
            </div>
            <div class="single-nav-thumb">
                @foreach ($gallery_images as $new_key => $gallery_image)
                    <div class="single-slide">
                        <img src="{{ asset('public/' . api_asset($gallery_image)) }}" class="img-responsive"
                            alt="">
                    </div>
                @endforeach
            </div>
            @if (Auth::guard('customer')->check())
                @php
                    $whistlist_data = App\Models\Wishlist::where('product_id', $data->id)
                        ->where('user_id', Auth::guard('customer')->user()->id)
                        ->first();
                @endphp
                <div class="wishlist-container wislist-positon">
                    <div class="wishlist-heart @if (!empty($whistlist_data->id)) wishlist-heart-active @endif"
                        id="wish_{{ $data->id }}" onclick="addToWishlist({{ $data->id }})"></div>
                </div>
            @else
                <div class="wishlist-container wislist-positon">
                    <div class="wishlist-heart" id="wish_{{ $data->id }}"
                        onclick="addToWishlist({{ $data->id }})"></div>
                </div>
            @endif
        </div>
    </div>
    <div class="single-pro-desc single-pro-desc-no-sidebar">
        <div class="single-pro-content">
            <h5 class="ec-single-title">{{ $data->name }}</h5>
            {{-- <div class="ec-single-rating-wrap">
                <div class="ec-single-rating">
                    <i class="ecicon eci-star fill"></i>
                    <i class="ecicon eci-star fill"></i>
                    <i class="ecicon eci-star fill"></i>
                    <i class="ecicon eci-star fill"></i>
                    <i class="ecicon eci-star-o"></i>
                </div>
                <span class="ec-read-review"><a href="#ec-spt-nav-review">Be the first to
                        review this product</a></span>
            </div> --}}
            <span class="in-stock">In Stock</span>

            <div class="ec-single-desc">{!! $data->short_description !!}</div>

            <div class="ec-single-price-stoke">
                <div class="ec-single-price">
                    @if ($product_price['selling_price'] != $product_price['product_price'])
                        <span class="new-price"><del class="discount">{{ $product_price['selling_price'] }}</del>
                            {{ $product_price['product_price'] }} <small class="discount" style="font-size: 16px;"> <i>
                                    {{$product_price['discount']}}@if($product_price['discount_type']=='percent'){{'%'}}@else {{'Rs'}} @endif OFF</i></small></span>
                    @else
                        <span class="new-price"> {{ $product_price['product_price'] }}</span>
                    @endif
                </div>
                @if ($data->sku)
                    <div class="ec-single-stoke">
                        <span class="ec-single-sku">SKU#: {{ $data->sku }}</span>
                    </div>
                @endif
            </div>

            <div class="ec-single-qty">
                <form id="product_detail_form">
                    @csrf
                    <div class="ec-pro-variation">

                        @php
                            $var_pros = App\Models\Admin\Product::where('product_group_id', $data->product_group_id)->get();
                            $attributes = [];
                            foreach ($var_pros as $products) {
                                if (is_array($products->attribute)) {
                                    foreach ($products->attribute as $attribute) {
                                        array_push($attributes, $attribute);
                                    }
                                }
                            }
                            $unique_attributes = array_unique($attributes);

                            $attributes_value = [];
                            foreach ($unique_attributes as $attr) {
                                foreach ($var_pros as $prod) {
                                    if (is_array($prod->attribute)) {
                                        foreach ($prod->attribute as $key => $p_a) {
                                            if ($p_a == $attr) {
                                                array_push($attributes_value, [$attr => $prod->attribute_value[$key]]);
                                            }
                                        }
                                    }
                                }
                            }
                        @endphp
                        <div class="ec-pro-variation-inner ec-pro-variation-size">
                            @foreach ($unique_attributes as $attr)
                                <span>{{ App\Models\Admin\Attribute::find($attr)->name }}</span>
                                <div class="ec-pro-variation-content">
                                    @php $at_array=[]; @endphp
                                    @foreach ($attributes_value as $av)
                                        @if (!empty($av[$attr]))
                                            @php array_push($at_array,$av[$attr]); @endphp
                                        @endif
                                    @endforeach
                                    <ul>
                                        @foreach (array_unique($at_array) as $key => $dv)
                                            <li
                                                @foreach ($product_attribut_array as $array_a) @if (in_array($dv, $array_a))  @if (in_array($attr, $array_a)) class="active" @endif  @endif @endforeach>
                                                <input type="radio"name="attribute_id_{{ $attr }}"
                                                    id="attribute_id_{{ $attr }}_{{ $dv }}"
                                                    value="{{ $dv }}"
                                                    onclick="getVaiantPriceData('{{ $data->product_group_id }}','{{ $attr }}','{{ $dv }}')"
                                                    @foreach ($product_attribut_array as $array_a) @if (in_array($dv, $array_a))  @if (in_array($attr, $array_a)){{ 'checked' }} @endif  @endif @endforeach>
                                                <label class="aiz-megabox"
                                                    for="attribute_id_{{ $attr }}_{{ $dv }}">
                                                    {{ $dv }}
                                                    <span class="aiz-megabox-elem">
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>


                        @php
                            $colors = App\Models\Admin\Product::where('product_group_id', $data->product_group_id)
                                ->where('colors', '!=', '')
                                ->get(['colors'])
                                ->unique('colors');
                        @endphp
                        @if (count($colors) > 0)
                            <div class="ec-pro-variation-inner ec-pro-variation-color">

                                <span>Color</span>
                                <div class="ec-pro-variation-content">
                                    <ul>
                                        @foreach ($colors as $key => $color)
                                            <li data-toggle=""
                                                data-title="{{ App\Models\Admin\Color::where('code', $color->colors)->first()->name }}">
                                                <label class="aiz-megabox" for="color_{{ $color->colors }}"
                                                    style="background: {{ $color->colors }};"
                                                    title="{{ App\Models\Admin\Color::where('code', $color->colors)->first()->name }}">

                                                    <input type="radio" name="color"
                                                        id="color_{{ $color->colors }}" value="{{ $color->colors }}"
                                                        onclick="getVaiantPriceColorData('{{ $data->product_group_id }}','{{ $color->colors }}')"
                                                        @if (!empty($data->colors)) @if ($data->colors == $color->colors) {{ 'checked' }} @endif
                                                        @endif >
                                                    <span class="aiz-megabox-elem">
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        @endif
                        @if (!empty($total_price))
                            <div class="row mb-3" id="chosen_price_div">
                                <div class="col-md-6">
                                    <span>Total Price:</span>
                                </div>
                                <div class="col-md-6">
                                    <div class="ec-single-price">
                                        <span class="new-price">
                                            {{ '₹' . $total_price }}
                                        </span>

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @php
                        if (Auth::guard('customer')->check()) {
                            $pro_cart = App\Models\Cart::where('user_id', Auth::guard('customer')->user()->id)
                                ->where('product_id', $data->id)
                                ->first();
                            if ($pro_cart) {
                                $pro_qty = $pro_cart->quantity;
                            }
                        }
                    @endphp

                    <div class="ec-single-qty">
                        {{-- <button type="button" class="btn btn-danger btn-number"
                            onclick="update_qty('minus',{{ $data->id }},{{ $product_price['min_qty'] > 0 ? $product_price['min_qty'] : 'null' }},'form')">
                            <span class="ecicon eci-minus"></span>
                        </button>
                        <input type="number" id="quantity" name="product_qty"
                            class="form-control text-center qty_value_{{ $data->id }}"
                            value="@if (!empty($pro_qty)){{ $pro_qty }}@else{{ !empty($product_quanity)?$product_quanity :'1'}}@endif"
                            min="{{ $data->retailer_min_qty }}"
                            max="{{ $product_price['max_qty'] > 0 ? $product_price['max_qty'] : 'null' }}"
                            style="width:110px; padding: 0 10px; height: 45px;" onchange="change_quantitiy_price()">
                        <button type="button" class="btn btn-danger btn-number btn-number"
                            onclick="update_qty('plus',{{ $data->id }},{{ $product_price['max_qty'] > 0 ? $product_price['max_qty'] : 'null' }},'form')">
                            <span class="ecicon eci-plus"></span>
                        </button> --}}
                        <!-- <div class="wslst">
                            <a class="text-white" title="Wishlist"  onclick="addToWishlist({{ $data->id }})">
                                <i class="ecicon eci-heart-o" style="font-size:25px;"></i>
                            </a>
                        </div>  -->
                        <input type="hidden" name="product_id" value="{{ $data->id }}">
                        <input type="hidden" name="product_group_id" value="{{ $data->product_group_id }}">
                        <div class="ec-single-cart ">
                            <button type="button" class="btn btn-primary"
                                onclick="addtocart({{ $data->id }},'product_detail_form')">
                                <i class="ecicon eci-shopping-cart"></i> &nbsp;Buy Frame Only
                            </button>
                        </div>
                        @if (Auth::guard('customer')->check())
                            <div class="ec-single-cart ">
                                <button type="button" class="btn btn-primary" data-link-action="quickview"
                                    title="Quick view" data-bs-toggle="modal" data-bs-target="#ec_quickview_modal">
                                    <i class="ecicon eci-shopping-cart"></i> Select Lens & buy now </button>
                            </div>
                        @else
                            <div class="ec-single-cart ">
                                <button type="button" class="btn btn-primary"
                                    onclick="addtocart({{ $data->id }},'product_detail_form')">
                                    <i class="ecicon eci-shopping-cart"></i> Select Lens & buy now
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- ShareThis BEGIN -->
                      <div class="sharethis-inline-share-buttons"></div>
                    <!-- ShareThis END -->
                </form>
            </div>


            {{-- <div class="ec-single-social">
                <ul class="mb-0">
                    <li class="list-inline-item facebook"><a href="#"><i class="ecicon eci-facebook"></i></a>
                    </li>
                    <li class="list-inline-item twitter"><a href="#"><i class="ecicon eci-twitter"></i></a>
                    </li>
                    <li class="list-inline-item instagram"><a href="#"><i class="ecicon eci-instagram"></i></a>
                    </li>
                    <li class="list-inline-item youtube-play"><a href="#"><i
                                class="ecicon eci-youtube-play"></i></a></li>
                    <li class="list-inline-item whatsapp"><a href="#"><i class="ecicon eci-whatsapp"></i></a>
                    </li>
                </ul>
            </div> --}}
        </div>
    </div>
</div>
@include('frontend.product_modal')
