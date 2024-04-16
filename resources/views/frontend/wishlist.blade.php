 @extends('frontend.layouts.app')
 @section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    </div>
    <div class="desk_hide">
    <a href="{{route('usermob_sidebar')}}" class="bck-btn"><i class="ecicon eci-arrow-left"></i> Back</a>
    </div>
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-wish-rightside col-lg-12 col-md-12">
                    <div class="ec-compare-content">
                        <div class="ec-compare-inner">
                            <div class="row margin-minus-b-30">
                                @foreach (App\Models\Wishlist::where('user_id',Auth::user()->id)->orderBy('id','desc')->with('product')->get() as $wishlist)
                                    @php
                                        $wishlist_price=getProductDiscountedPrice($wishlist->product->id,'retailer');
                                    @endphp
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    <a href="{{ route('details', $wishlist->product->slug) }}?type=product" class="image">
                                                        @php
                                                            $gallery_images=explode(',',$wishlist->product->gallery_image);
                                                        @endphp
                                                        @foreach ($gallery_images as $new_key=>$gallery_image)
                                                            @if(count($gallery_images) >= 2)
                                                                @if($new_key == 0)
                                                                    <img class="main-image" src="{{asset('public/'.api_asset($gallery_image))}}" alt="Product" />
                                                                @else
                                                                    <img class="hover-image" src="{{asset('public/'.api_asset($gallery_image))}}" alt="Product" />
                                                                @endif
                                                            @else
                                                                <img class="main-image" src="{{asset('public/'.api_asset($gallery_image))}}" alt="Product" />
                                                            @endif
                                                        @endforeach
                                                    </a>
                                                    <span class="ec-com-remove ec-remove-wish"><a onclick="deleteToWishlist({{$wishlist->product->id}})">×</a></span>
                                                    @if($wishlist_price['discount'])
                                                        <span class="flags">
                                                            <span class="percentage">@if($wishlist_price['discount_type'] == 'amount') ₹{{$wishlist_price['discount']}} @else {{$wishlist_price['discount']}}% @endif OFF</span>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title"><a href="{{ route('details', $wishlist->product->slug) }}?type=product">{{$wishlist->product->name}}</a></h5>
                                                <span class="ec-price">
                                                    @if($wishlist_price['selling_price'] != $wishlist_price['product_price'])
                                                      MRP <span class="old-price">₹{{$wishlist_price['selling_price']}}</span>
                                                        <span class="new-price">₹{{$wishlist_price['product_price']}}</span>
                                                    @else
                                                      MRP <span class="new-price">₹{{$wishlist_price['product_price']}}</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 @endsection
