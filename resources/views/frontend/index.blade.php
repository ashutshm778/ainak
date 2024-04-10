@extends('frontend.layouts.app')
@section('content')
    <div class="ec-main-slider section">
        <div class="ec-slider">
            @forelse ($sliders as $slider)
                <div class="ec-slide-item">
                    <img src="{{ asset('public/' . api_asset($slider->image)) }}" class="w-100">
                </div>
            @empty
                <div class="ec-slide-item">
                    <img src="{{ asset('public/frontend/assets/images/10.jpg') }}" class="w-100">
                </div>
            @endforelse
        </div>
    </div>
    <!-- Main Slider End -->

    @php
        $brands = App\Models\Admin\Brnad::where('is_active', 1)
            ->take(4)
            ->get();
    @endphp
    @if (count($brands) < 0)
        <section class="section ec-category-section ptb-20 bg-gray">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($brands as $brand)
                        <div class="col-md-3 col-xs-6">
                            <a href="{{ route('search', $brand->slug) }}?type=brand">
                                <img class="main-image" src="{{ asset('public/' . api_asset($brand->icon)) }}"
                                    class="w-100" />
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <section class="ec-banner section pt_5">
        <div class="row">
            <div class=" col-sm-6 col-xs-6 plr">
                <div class="ec-banner-block-1">
                    <div class="banner-block">
                        <a href="{{route('search')}}?subcategory=glass-ec3cbds"><img src="{{ asset('public/frontend/assets/images/thumbnail-men.webp') }}"
                                alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-6 plr">
                <div class="ec-banner-block-1">
                    <div class="banner-block">
                        <a href="{{route('search')}}?subcategory=women-ecc567hbc"><img src="{{ asset('public/frontend/assets/images/thumbnail-women.webp') }}"
                                alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class=" col-sm-6 col-xs-6 plr">
                <div class="ec-banner-block-1 p-0">
                    <div class="banner-block">
                        <a href="{{route('search')}}?subcategory=kids-a87345fqqw"><img src="{{ asset('public/frontend/assets/images/kids.jpg') }}"
                                alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-6 plr">
                <div class="ec-banner-block-1 p-0">
                    <div class="banner-block">
                        <a href="#"><img src="{{ asset('public/frontend/assets/images/repaire.jpg') }}"
                                alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>


   
    <!--  category Section Start -->
    <section class="section ec-category-section section-space-p br-btm">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title-block">
                    <div class="section-title">
                        <h2 class="ec-title">Shop By Categories</h2>
                    </div>
                    @if (count($categories)>5)
                        <div class="section-btn">
                            <span class="ec-section-btn"><a href="{{ route('categories') }}">All Categories</a></span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-2 col-xs-4 mb-3">
                        <div class="ec_cat_inner">
                            <div class="ec-cat-image">
                                <a href="{{ route('details', $category->slug) }}?type=category"> <img
                                        src="{{ asset('public/' . api_asset($category->icon)) }}" alt="" /></a>
                            </div>
                            <div class="ec-cat-descs">
                                <a href="{{ route('details', $category->slug) }}?type=category"
                                    class="text-center">{{ $category->name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--category Section End -->

    <!-- Today Deals Item Start -->
    @php
        $flash_deals = App\Models\Admin\Offer::where('is_active', 1)
            ->where('type', 'flash_deal')
            ->whereDate('end_date_time', '>=', date('Y-m-d H:i'))
            ->with('offer_product.product')
            ->get();
    @endphp
    @if (count($flash_deals))
        @foreach ($flash_deals as $flash_key => $flash_deal)
            <section class="section ec-trend-product pt-8 ">
                <div class="container">
                    <div class="list-deal">
                        <div class="row">
                            <div class="col-md-12 section-title-block">
                                <div class="heading">
                                    <h2 class="ec-title">{{ $flash_deal->title }}</h2>
                                </div>
                                <div class="countdowntimer"><span id="demo{{ $flash_key }}"></span></div>
                              
                            </div>
                        </div>
                        <div class="row">
                            <div class="ec-trend-slider">
                                @foreach ($flash_deal->offer_product as $flash_product)
                                    @php
                                        $new_flash_price = getProductDiscountedPrice($flash_product->product_id, 'retailer');
                                    @endphp
                                    <div class="col-lg-3 col-md-6 col-sm-6 ec-product-content">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    <a href="{{ route('details', $flash_product->product->slug) }}?type=product"
                                                        class="image">
                                                        <img class="main-image"
                                                            src="{{ asset('public/' . api_asset($flash_product->product->thumbnail_image)) }}"
                                                            alt="Product" />
                                                    </a>
                                                    @php
                                                        $discount_percent = ($flash_product->product_offer_price / $flash_product->product_price) * 100;
                                                    @endphp
                                                    <span class="flags">
                                                        <span class="percentage">{{ 100 - round($discount_percent, 2) }}%
                                                            OFF</span>
                                                    </span>
                                                    <div class="ec-pro-actions">
                                                        <form id="flash_form_{{ $flash_product->product_id }}">
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $flash_product->product_id }}">
                                                            <button type="button" title="Add To Cart"
                                                                class="bg-transparent"
                                                                onclick="addtocart({{ $flash_product->product_id }},'flash_form')">
                                                                <img src="{{ asset('public/frontend/assets/images/icons/cart.svg') }}"
                                                                    class="svg_img pro_svg" alt="">
                                                            </button>
                                                        </form>
                                                        <a class="ec-btn-group quickview"
                                                            onclick="open_product_model({{ $flash_product->product_id }})"><img
                                                                src="{{ asset('public/frontend/assets/images/icons/quickview.svg') }}"
                                                                class="svg_img pro_svg" alt="" /></a>
                                                        <form action="#">
                                                        <a class="ec-btn-group wishlist" title="Wishlist">
                                                            <img src="{{ asset('public/frontend/assets/images/icons/wishlist.svg') }}" class="svg_img pro_svg" alt="" />
                                                        </a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title"><a
                                                        href="{{ route('details', $flash_product->product->slug) }}?type=product">{{ $flash_product->product->name }}</a>
                                                </h5>
                                                <span class="ec-price">
                                                    <span class="old-price">{{ $flash_product->product_price }}</span>
                                                    <span
                                                        class="new-price">{{ $flash_product->product_offer_price }}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif
    <!-- Today Deals Item end -->

    <!-- Product tab Area Start -->
    <section class="section ec-product-tab section-space-p bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title-block">
                    <div class="section-title mtt-0">
                        <h2 class="ec-title">Trending Products</h2>
                    </div>
                    <div class="section-btn mb-3">
                        <ul class="ec-pro-tab-nav nav">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                    href="#tab-pro-best-sellers">Best Sellers</a></li>
                            <li class="nav-item"><a class="nav-link " data-bs-toggle="tab"
                                    href="#tab-pro-new-arrivals">New Arrivals</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                    href="#tab-pro-special-offer">Trending</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col mb-3">
                    <div class="tab-content">
                        <!-- ec 3rd Product tab start -->
                        <div class="tab-pane fade show active" id="tab-pro-best-sellers">
                            <div class="row" id="best_seller">
                               
                            </div>
                            <div class="text-center">
                                <a class="btn btn-secondary rds" href="#" id="view_more_best_seller" onclick="best_seller_product()"  >View More <i class="ecicon eci-chevron-right"></i></a>
                            </div>
                        </div>
                        <!-- ec 3rd Product tab end -->
                        <!-- 1st Product tab start -->
                        <div class="tab-pane fade" id="tab-pro-new-arrivals">
                            <div class="row" id="new_arrival">
                                
                            </div>
                           
                             <div class="text-center">
                                <a class="btn btn-secondary rds" href="#" id="view_more_trending" onclick="new_arriavl_product()"  >View More <i class="ecicon eci-chevron-right"></i></a>
                            </div>
                          
                        </div>
                        <!-- ec 1st Product tab end -->
                        <!-- ec 2nd Product tab start -->
                        <div class="tab-pane fade" id="tab-pro-special-offer">
                            <div class="row" id="featured">
                               
                            </div>
                            <div class="text-center">
                                <a class="btn btn-secondary rds" href="#" id="view_more_featured" onclick="featured_product()"  >View More <i class="ecicon eci-chevron-right"></i></a>
                            </div>
                            
                        </div>
                        <!-- ec 2nd Product tab end -->
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- ec Product tab Area End -->

    <!--  Banner Section Start -->
    @if ($top_banner)
        <section class="section banner">
            <img src="{{ asset('public/' . api_asset($top_banner->image)) }}" class="w-100">
        </section>
    @endif
    <!-- Banner Section End -->

    <section class="section ec-trend-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title-block">
                    <div class="section-title">
                        <h2 class="ec-title">Stuck Somewhere? Try Our Guides!</h2>
                    </div>
                </div>
            </div>
            <div class="row g-5 mt--20">
                <!-- Start Category Box Layout  -->
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                    <div class="rbt-cat-box rbt-cat-box-1 text-center">
                        <div class="inner">
                            <div class="mb-2">
                                <img src="{{ asset('public/frontend/assets/images/face-guide.webp') }}"
                                    alt="Icons Images">
                            </div>
                            <div class="content">
                                <h5 class="fc-16">Eliminates Glare</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Category Box Layout  -->

                <!-- Start Category Box Layout  -->
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                    <div class="rbt-cat-box rbt-cat-box-1 text-center">
                        <div class="inner">
                            <div class="mb-2">
                                <img src="{{ asset('public/frontend/assets/images/face-shape.webp') }}"
                                    alt="Icons Images">
                            </div>
                            <div class="content">
                                <h5 class="fc-16">Eliminates Glare</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Category Box Layout  -->

                <!-- Start Category Box Layout  -->
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="rbt-cat-box rbt-cat-box-1 text-center mbb-0">
                        <div class="inner">
                            <div class="mb-2">
                                <img src="{{ asset('public/frontend/assets/images/prescription-guide.webp') }}"
                                    alt="Icons Images">
                            </div>
                            <div class="content">
                                <h5 class="fc-16">Blocks UV Light</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Category Box Layout  -->
            </div>
        </div>
    </section>

    @if (count($featured_categories))
        @foreach ($featured_categories as $fe_key => $featured_categorry)
            <!-- Trending Item Start -->
            <section class="section ec-trend-product section-space-p @if ($fe_key % 2 == 0) bg-gray @endif">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 section-title-block">
                            <div class="section-title">
                                <h2 class="ec-title">{{ $featured_categorry->name }}</h2>
                            </div>
                            <div class="section-btn">
                                <span class="ec-section-btn"><a class="btn-secondary"
                                        href="{{ route('search') }}?category={{ $featured_categorry->slug }}">View
                                        All</a></span>
                            </div>
                        </div>
                    </div>

                    <div class="ec-trend-slider">
                        @foreach (App\Models\Admin\Product::where('is_active', 1)->whereJsonContains('category_id', '' . $featured_categorry->id)->orderBy('id','desc')->take(8)->get() as $featured_category_product)
                            @php
                                $featured_category_product_price = homePrice($featured_category_product->id);
                            @endphp

                            <div class="col-lg-3 col-md-6 col-sm-6 ec-product-content">
                                <div class="ec-product-inner">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image">
                                            <a href="{{ route('details', $featured_category_product->slug) }}?type=product" class="image">
                                                <img class="main-image"
                                                    src="{{ asset('public/' . api_asset($featured_category_product->thumbnail_image)) }}"
                                                    alt="Product" />
                                            </a>
                                            @if ($featured_category_product_price['discount'])
                                                <span class="flags">
                                                    <span class="percentage">
                                                        @if ($featured_category_product_price['discount_type'] == 'amount')
                                                            ₹{{ $featured_category_product_price['discount'] }}
                                                        @else
                                                            {{ $featured_category_product_price['discount'] }} %
                                                        @endif OFF
                                                    </span>
                                                </span>
                                            @endif
                                            {{-- <div class="ec-pro-actions">
                                                   <form id="featured_category_form_{{$featured_category_product->id}}">
                                                        <input type="hidden" name="product_id" value="{{$featured_category_product->id }}">
                                                        <button type="button" title="Add To Cart" class="bg-transparent" onclick="addtocart({{$featured_category_product->id}},'featured_category_form')">
                                                            <img src="{{ asset('public/frontend/assets/images/icons/cart.svg') }}" class="svg_img pro_svg" alt="">
                                                        </button>
                                                    </form>
                                                    <a class="ec-btn-group quickview" onclick="open_product_model({{$featured_category_product->id }})"><img src="{{ asset('public/frontend/assets/images/icons/quickview.svg') }}" class="svg_img pro_svg"></a>
                                                    <form action="#">
                                                        <a class="ec-btn-group wishlist" title="Wishlist"><img src="{{ asset('public/frontend/assets/images/icons/pro_wishlist.svg') }}" class="svg_img pro_svg" alt="" onclick="addToWishlist({{$featured_category_product->id}})" /></a>
                                                    </form>
                                                </div> --}}
                                            {{-- <div class="ec-pro-actions">
                                                    <button title="Add To Cart" class=" add-to-cart"><img src="{{ asset('public/frontend/assets/images/icons/cart.svg') }}" class="svg_img pro_svg" alt="" /></button>
                                                    <a class="ec-btn-group quickview" onclick="open_product_model({{$new_arriavl->id}})"><img src="{{ asset('public/frontend/assets/images/icons/quickview.svg') }}" class="svg_img pro_svg" alt="" /></a>
                                                    <a class="ec-btn-group wishlist" title="Wishlist"><img src="{{ asset('public/frontend/assets/images/icons/pro_wishlist.svg') }}" class="svg_img pro_svg" alt="" /></a>
                                                </div> --}}
                                                @if (Auth::guard('customer')->check())
                                    @php
                                        $whistlist_data = App\Models\Wishlist::where('product_id', $featured_category_product->id)
                                            ->where('user_id', Auth::guard('customer')->user()->id)
                                            ->first();
                                    @endphp
                                    <div class="wishlist-container wislist-positon">
                                        <div class="wishlist-heart @if (!empty($whistlist_data->id)) wishlist-heart-active @endif"
                                            id="wish_{{ $featured_category_product->id }}" onclick="addToWishlist({{ $featured_category_product->id }})">
                                        </div>
                                    </div>
                                @else
                                    <div class="wishlist-container wislist-positon">
                                        <div class="wishlist-heart" id="wish_{{ $featured_category_product->id }}"
                                            onclick="addToWishlist({{ $featured_category_product->id }})"></div>
                                    </div>
                                @endif
                                        </div>
                                    </div>

                                    <div class="ec-pro-content">
                                        <h5 class="ec-pro-title"><a
                                                href="{{ route('details', $featured_category_product->slug) }}?type=product">{{ $featured_category_product->name }}</a>
                                        </h5>
                                        <span class="ec-price"> MRP
                                            @if ($featured_category_product_price['selling_price'] != $featured_category_product_price['product_price'])
                                                <span
                                                    class="old-price"> {{ $featured_category_product_price['selling_price'] }}</span>
                                                <span
                                                    class="new-price"> {{ $featured_category_product_price['product_price'] }}</span>
                                            @else
                                                <span
                                                    class="new-price"> {{ $featured_category_product_price['product_price'] }}</span>
                                            @endif
                                        </span>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- Trending Item end -->
        @endforeach
    @endif

    <section class="section ec-trend-product section-space-p bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title-block">
                    <div class="section-title">
                        <h2 class="ec-title">Our Lens Features At A Glance</h2>
                    </div>
                </div>
            </div>
            <div class="row g-5 mt--20">
                <!-- Start Category Box Layout  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <a class="rbt-cat-box rbt-cat-box-1 text-center">
                        <div class="inner">
                            <div class="icons">
                                <img src="{{ asset('public/frontend/assets/images/icon/1.png') }}" alt="Icons Images">
                            </div>
                            <div class="content">
                                <h5 class="fc-16">Blocks Blue Light</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- End Category Box Layout  -->

                <!-- Start Category Box Layout  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="rbt-cat-box rbt-cat-box-1 text-center">
                        <div class="inner">
                            <div class="icons">
                                <img src="{{ asset('public/frontend/assets/images/icon/Eliminates-Glare.png') }}"
                                    alt="Icons Images">
                            </div>
                            <div class="content">
                                <h5 class="fc-16">Eliminates Glare</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Category Box Layout  -->

                <!-- Start Category Box Layout  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="rbt-cat-box rbt-cat-box-1 text-center">
                        <div class="inner">
                            <div class="icons">
                                <img src="{{ asset('public/frontend/assets/images/icon/know_lens_img.png') }}"
                                    alt="Icons Images">
                            </div>
                            <div class="content">
                                <h5 class="fc-16">Blocks UV Light</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Category Box Layout  -->

                <!-- Start Category Box Layout  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="rbt-cat-box rbt-cat-box-1 text-center">
                        <div class="inner">
                            <div class="icons">
                                <img src="{{ asset('public/frontend/assets/images/icon/know_lens_img4.png') }}"
                                    alt="Icons Images">
                            </div>
                            <div class="content">
                                <h5 class="fc-16">Resists Scratches</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Category Box Layout  -->

                <!-- Start Category Box Layout  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="rbt-cat-box rbt-cat-box-1 text-center">
                        <div class="inner">
                            <div class="icons">
                                <img src="{{ asset('public/frontend/assets/images/icon/know_lens_img5.png') }}"
                                    alt="Icons Images">
                            </div>
                            <div class="content">
                                <h5 class="fc-16">Resists Fingerprints & Smudges</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Category Box Layout  -->

                <!-- Start Category Box Layout  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="rbt-cat-box rbt-cat-box-1 text-center">
                        <div class="inner">
                            <div class="icons">
                                <img src="{{ asset('public/frontend/assets/images/icon/know_lens_img6.png') }}"
                                    alt="Icons Images">
                            </div>
                            <div class="content">
                                <h5 class="fc-16">Repels Water & Liquids</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Category Box Layout  -->

                <!-- Start Category Box Layout  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="rbt-cat-box rbt-cat-box-1 text-center">
                        <div class="inner">
                            <div class="icons">
                                <img src="{{ asset('public/frontend/assets/images/icon/know_lens_img7.png') }}"
                                    alt="Icons Images">
                            </div>
                            <div class="content">
                                <h5 class="fc-16">Repels Dust Particles</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Category Box Layout  -->

                <!-- Start Category Box Layout  -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="rbt-cat-box rbt-cat-box-1 text-center">
                        <div class="inner">
                            <div class="icons">
                                <img src="{{ asset('public/frontend/assets/images/icon/know_lens_img8.png') }}"
                                    alt="Icons Images">
                            </div>
                            <div class="content">
                                <h5 class="fc-16">Reduces Color & Image Distortion</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Category Box Layout  -->
            </div>
        </div>
    </section>
    <!-- Banner Item Start -->
    @if ($mid_banner)
        <section class="section banner">
            <img src="{{ asset('public/' . api_asset($mid_banner->image)) }}" class="w-100">
        </section>
    @endif
    <!-- Banner Item end -->
    <!-- Other Category -->
    <section class="other-categories section-space-p pbb-0">
        <div class="container">
            <div class="row other-categories-list">
                @foreach (App\Models\Admin\Category::where('is_active', 1)->orderBy('bottom_priority', 'asc')->take(3)->get() as $bottom_category)
                    <div class="col-sm-4">
                        <div class="category-wrpr">
                            <p>{{ $bottom_category->name }}</span>
                            </p>
                            <ul class="category-list row">
                                @foreach (App\Models\Admin\SubCategory::whereJsonContains('category_id', '' . $bottom_category->id)->where('is_active', 1)->take(4)->get() as $bottom_sub_category)
                                    <li class="col-sm-4 col-xs-4">
                                        <a href="{{ route('details', $bottom_sub_category->slug) }}?type=subcategory">
                                            <img class="lazy loaded"
                                                src="{{ asset('public/' . api_asset($bottom_sub_category->image)) }}"
                                                alt="{{ $bottom_sub_category->name }}" data-was-processed="true">
                                            <span>{{ $bottom_sub_category->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('details', $bottom_category->slug) }}?type=category" class="view-link">View
                                all <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.10059 3.8772L11.1006 8.87454L6.10059 13.8719" stroke="#515151"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- End Other Category -->

    @if ($top_banner)
        <section class="section banner">
            <img src="{{ asset('public/' . api_asset($top_banner->image)) }}" class="w-100">
        </section>
    @endif

    <section class="ec-page-content section-space-p bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2 class="ec-title">FAQ</h2>
                            <p class="sub-title mb-3">Customer service management</p>
                        </div>
                    </div>
                    <div class="accordion accordion-flush" id="accordionExample">
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    1. I'd like to try on frames before buying.
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    You can explore how our frames look on you by requesting a 'Try Frames At Home' service
                                    via
                                    WhatsApp message. With this service, you can choose 5 to 10 frames for try at your home
                                    at no cost after
                                    placing an order, or charge a nominal fee of ₹99/- otherwise.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    2. How long will it take to receive my eyeglasses?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    We aim to deliver your eyeglasses within 24-48 hours of placing your order in Varanasi,
                                    and it typically
                                    takes 3 to 4 working days across India.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    3. Will any power lens fit in any frame?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Generally, most power prescriptions can be accommodated in any frame.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    4. Can I have my eyeglasses repaired?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Absolutely! We offer Repair Your Lenses for damaged glasses, depending on the severity
                                    of the damage.
                                    Simply fill the form by clicking Repair Your Lenses on our website and our team will
                                    assist you
                                    accordingly. In the event that a product is beyond repair, and you are covered under our
                                    insurance policy,
                                    we will provide you with a complimentary replacement.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    5. Are my eyeglasses protected by a warranty?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Indeed, all our glasses come with a 6 months to one-year warranty.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    6. Where should I provide my prescription details?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    You have several options for submitting your prescription details after making a
                                    purchase - you can
                                    upload a photo of your prescription, input the details manually online, or send a
                                    message/call via
                                    WhatsApp to our team.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    7. What if I don't know my prescription?
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    To determine your prescription, you can schedule an eye test appointment with Aynak for
                                    just ₹49/- per
                                    person. Our certified optometrists, equipped with latest tools, will conduct a
                                    comprehensive eye test and
                                    provide you with your prescription immediately afterward (This amount detected from your
                                    article
                                    purchasing amount).
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    8. Does Aynak handle its own deliveries?
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Yes, we have our own delivery executives in Varanasi, and for PAN India delivery, we
                                    work with various
                                    third-party delivery partners.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                    9. When is it possible to cancel my order?
                                </button>
                            </h2>
                            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    You have the option to cancel your order before it is shipped by contacting our
                                    management team via
                                    WhatsApp or simply accessing the Cancel section on Aynak.in. Please be aware that we
                                    design each lens
                                    specifically for you. Nevertheless, we provide hassle-free cancellation choices for a
                                    completely risk-free
                                    shopping experience.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingTen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                    10. How can I reach customer support?
                                </button>
                            </h2>
                            <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Our dedicated support team is always available to assist you! You can contact us via
                                    email at
                                    aynakpvtltd@gmail.com or give us a call at 9219949495. For additional information,
                                    please visit our
                                    contact us page: https://aynak.in/contact-us."
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                <img src="{{ asset('public/frontend/assets/images/faq.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <!--  services Section Start -->
    <!--<section class="section ec-offer-section">
        <img src="{{ asset('public/frontend/assets/images/appointment.jpg') }}" alt="" class="offer_bg">
        <div class="ec-offer-inner m_hide">
            <div class="row justify-content-end">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 align-self-center">
                    <div class="ec-common-wrapper glass-initial mt-3 mb-3">
                        <div class="ec-contact-leftside">
                            <div class="ec-contact-container">
                                <h2 class="ec-offer-stitle text-center bk_amt1">Book Appointment</h2>
                                <p class="text-center txt-shdw">Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry</p>
                                <div class="ec-contact-form">
                                    <form action="#" method="post">
                                        <div class="form-group mb-3">
                                            <input type="text" name="name" placeholder="Enter your name"
                                                required="">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="email" name="email" placeholder="Enter your email address"
                                                required="">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="text" name="phonenumber"
                                                placeholder="Enter your phone number" required="">
                                        </div>
                                        <div class="form-group mb-3">
                                            <textarea name="address" placeholder="Please leave your messege here.."></textarea>
                                        </div>
                                        <div class="ec-offer-btn"><a href="#" class="btn btn-lg btn-primary">Pay
                                                ₹.99/- Only <i class="ecicon eci-chevron-right"></i></a></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <!--services Section End -->

    <script>
        function trending(page){
         $.get('{{ route('get_new_arrival_product') }}', {_token:'{{ csrf_token() }}',page:page}, function(data){
                $('#new_arrival').append(data);
            });
        }
     
        function feature(page){
         $.get('{{ route('get_featured_product') }}', {_token:'{{ csrf_token() }}',page:page}, function(data){
                $('#featured').append(data);
            });
        }
     
        function seller(page){
         $.get('{{ route('get_best_seller_product') }}', {_token:'{{ csrf_token() }}',page:page}, function(data){
                $('#best_seller').append(data);
            });
        }
     
        trending(1);
        feature(1);
        seller(1);

       function new_arriavl_product(){
            event.preventDefault();
            var page = $("a[name='example']:last").attr('href').split('page=')[1];
            var current_page_trending = $("input[name='current_page_trending']:last").val();
            var last_page_trending = $("input[name='last_page_trending']:last").val();
            if(current_page_trending!=last_page_trending){
                trending(page);
            }
            if(current_page_trending==last_page_trending){
                $('#view_more_trending').hide();
            }
        }

        function featured_product(){
            event.preventDefault();
            var page = $("a[name='example12']:last").attr('href').split('page=')[1];
            var current_page_featured = $("input[name='current_page_featureds']:last").val();
            var last_page_featured = $("input[name='last_page_featureds']:last").val();
            if(current_page_featured!=last_page_featured){
                feature(page);
            }
            if(current_page_featured==last_page_featured){
                $('#view_more_featured').hide();
            }
        }

        function best_seller_product(){
            event.preventDefault();
            var page = $("a[name='example2']:last").attr('href').split('page=')[1];
            var current_page_best_seller = $("input[name='current_page_best_seller']:last").val();
            var last_page_best_seller = $("input[name='last_page_best_seller']:last").val();
            if(current_page_best_seller!=last_page_best_seller){
               seller(page);
            }
            if(current_page_best_seller==last_page_best_seller){
                $('#view_more_best_seller').hide();
            }
        }
     </script>
@endsection
