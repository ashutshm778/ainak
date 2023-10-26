@extends('frontend.layouts.app')
@section('content')
    <div class="ec-main-slider section">
        <div class="ec-slider">
            @forelse ($sliders as $slider)
                <div class="ec-slide-item">
                    <img src="{{asset('public/'.api_asset($slider->image))}}" class="w-100">
                </div>
            @empty
                <div class="ec-slide-item">
                    <img src="{{asset('public/frontend/assets/images/10.jpg')}}" class="w-100">
                </div>
            @endforelse
        </div>
    </div>
    <!-- Main Slider End -->

    @php
        $brands = App\Models\Admin\Brnad::where('is_active',1)->take(4)->get();
    @endphp
    @if(count($brands) < 0)
        <section class="section ec-category-section ptb-20 bg-gray">
            <div class="container-fluid">
                <div class="row">
                    @foreach ($$brands as $brand)
                        <div class="col-md-3 col-xs-6">
                            <a href="{{ route('search',$brand->slug) }}?type=brand">
                                <img class="main-image" src="{{asset('public/'.api_asset($brand->icon))}}" class="w-100" />
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
                <div class="ec-banner-block ec-banner-block-1">
                    <div class="banner-block">
                        <a href="#"><img src="{{ asset('public/frontend/assets/images/thumbnail-men.webp') }}" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-6 plr">
                <div class="ec-banner-block ec-banner-block-1">
                    <div class="banner-block">
                        <a href="#"><img src="{{ asset('public/frontend/assets/images/thumbnail-women.webp') }}" alt=""></a>
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
                    <div class="section-btn">
                        <span class="ec-section-btn"><a href="{{route('categories')}}">All Categories</a></span>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-2 col-xs-4">
                        <div class="ec_cat_inner">
                            <div class="ec-cat-image">
                                <a href="{{ route('search',$category->slug) }}?type=category"> <img src="{{asset('public/'.api_asset($category->icon))}}" alt="" /></a>
                            </div>
                            <div class="ec-cat-descs">
                                <a href="{{ route('search',$category->slug) }}?type=category" class="text-center">{{$category->name}}</a>
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
        $flash_deals=App\Models\Admin\Offer::where('is_active',1)->where('type','flash_deal')->whereDate('end_date_time', '>=', date('Y-m-d H:i'))->with('offer_product.product')->get();
    @endphp
    @if(count($flash_deals))
        @foreach ($flash_deals as $flash_key=>$flash_deal)
            <section class="section ec-trend-product pt-8 ">
                <div class="container">
                    <div class="list-deal">
                        <div class="row">
                            <div class="col-md-12 section-title-block">
                                <div class="heading">
                                    <h2 class="ec-title">{{$flash_deal->title}}</h2>
                                </div>
                                <div class="countdowntimer"><span id="demo{{$flash_key}}"></span></div>
                                <script>
                                    var countDownDate{{$flash_key}} = new Date("{{$flash_deal->end_date_time}}").getTime();
                                    var x = setInterval(function()
                                    {
                                        var now{{$flash_key}} = new Date().getTime();
                                        var distance{{$flash_key}} = countDownDate{{$flash_key}} - now{{$flash_key}};
                                        var days{{$flash_key}} = Math.floor(distance{{$flash_key}} / (1000 * 60 * 60 * 24));
                                        var hours{{$flash_key}} = Math.floor((distance{{$flash_key}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes{{$flash_key}} = Math.floor((distance{{$flash_key}} % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds{{$flash_key}} = Math.floor((distance{{$flash_key}} % (1000 * 60)) / 1000);
                                        document.getElementById("demo{{$flash_key}}").innerHTML = days{{$flash_key}} + "D. "  + hours{{$flash_key}} + "H. "+ minutes{{$flash_key}} + "M. " + seconds{{$flash_key}} + "S. ";
                                        if (distance{{$flash_key}} < 0)
                                        {
                                            clearInterval(x);
                                            document.getElementById("demo{{$flash_key}}").innerHTML = "EXPIRED";
                                        }
                                    }, 1000);
                                </script>
                            </div>
                        </div>
                        <div class="row">
                            <div class="ec-trend-slider">
                                @foreach ($flash_deal->offer_product as $flash_product)
                                @php
                                    $new_flash_price=getProductDiscountedPrice($flash_product->product_id,'retailer');
                                @endphp
                                    <div class="col-lg-3 col-md-6 col-sm-6 ec-product-content">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    <a href="{{ route('search',$flash_product->product->slug) }}?type=product" class="image">
                                                        <img class="main-image" src="{{ asset('public/'.api_asset($flash_product->product->thumbnail_image)) }}" alt="Product" />
                                                    </a>
                                                    @php
                                                        $discount_percent=$flash_product->product_offer_price/$flash_product->product_price*100;
                                                    @endphp
                                                    <span class="flags">
                                                        <span class="percentage">{{100-round($discount_percent,2)}}% OFF</span>
                                                    </span>
                                                    <div class="ec-pro-actions">
                                                        <form id="flash_form_{{$flash_product->product_id}}">
                                                            <input type="hidden" name="product_id" value="{{$flash_product->product_id }}">
                                                            <button type="button" title="Add To Cart" class="bg-transparent" onclick="addtocart({{$flash_product->product_id}},'flash_form')">
                                                                <img src="{{ asset('public/frontend/assets/images/icons/cart.svg') }}" class="svg_img pro_svg" alt="">
                                                            </button>
                                                        </form>
                                                        <a class="ec-btn-group quickview" onclick="open_product_model({{$flash_product->product_id }})"><img src="{{ asset('public/frontend/assets/images/icons/quickview.svg') }}" class="svg_img pro_svg" alt="" /></a>
                                                        <form action="#">
                                                            <a class="ec-btn-group wishlist" title="Wishlist"><img src="{{ asset('public/frontend/assets/images/icons/pro_wishlist.svg') }}" class="svg_img pro_svg" alt="" /></a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title"><a href="{{ route('search',$flash_product->product->slug) }}?type=product">{{$flash_product->product->name}}</a></h5>
                                                <span class="ec-price">
                                                        <span class="old-price">{{$flash_product->product_price}}</span>
                                                        <span class="new-price">{{$flash_product->product_offer_price}}</span>
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
                    <div class="section-title">
                        <h2 class="ec-title">Trending Products</h2>
                    </div>
                    <div class="section-btn">
                        <ul class="ec-pro-tab-nav nav">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-pro-new-arrivals">New Arrivals</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-pro-special-offer">Weekly Featured</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-pro-best-sellers">Best Sellers</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <div class="tab-content">
                        <!-- 1st Product tab start -->
                        <div class="tab-pane fade show active" id="tab-pro-new-arrivals">
                            <div class="row">
                                    @foreach ($new_arriavls as $new_arriavl)
                                        @php
                                            $productData=$new_arriavl;
                                            $productprice=homePrice($new_arriavl->id);
                                        @endphp
                                       @include('frontend.product')
                                    @endforeach
                            </div>
                        </div>
                        <!-- ec 1st Product tab end -->
                        <!-- ec 2nd Product tab start -->
                        <div class="tab-pane fade" id="tab-pro-special-offer">
                            <div class="row">
                                    @foreach ($features as $feature)
                                        @php
                                            $productData=$feature;
                                            $productprice=homePrice($feature->id);
                                        @endphp
                                       @include('frontend.product')
                                    @endforeach
                            </div>
                        </div>
                        <!-- ec 2nd Product tab end -->
                        <!-- ec 3rd Product tab start -->
                        <div class="tab-pane fade" id="tab-pro-best-sellers">
                            <div class="row">
                                    @foreach ($best_sellers as $best_seller)
                                        @php
                                            $productData=$best_seller;
                                            $productprice=homePrice($productData->id);
                                        @endphp
                                       @include('frontend.product')
                                    @endforeach
                                </div>
                        </div>
                        <!-- ec 3rd Product tab end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ec Product tab Area End -->

    <!--  Banner Section Start -->
    @if($top_banner)
        <section class="section banner">
            <a href="#"><img src="{{asset('public/'.api_asset($top_banner->image))}}" class="w-100"></a>
        </section>
    @endif
    <!-- Banner Section End -->

    <!-- Trending Item Start -->
{{-- <section class="section ec-trend-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-title-block">
                    <div class="section-title">
                        <h2 class="ec-title">Living Room Furniture</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-6 col-sm-6 col-xs-12 pb-2">
                    <div class="ec-pro">
                        <a href="{{ route('product-search') }}">
                            <img class="main-image" src="{{ asset('public/frontend/assets/images/side-img.jpg') }}"
                                alt="Product" />
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="ec-pro-image">
                                    <a href="{{ route('search','sofas-a87f') }}?type=subcategory">
                                        <img class="main-image"
                                            src="{{ asset('public/frontend/assets/images/living-furniture-2.jpg') }}"
                                            alt="Product" />
                                    </a>
                                </div>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title"><a href="{{ route('search','sofas-a87f') }}?type=subcategory">Sofas</a></h5>
                                </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="ec-pro-image">
                                    <a href="{{ route('search','sofas-a87f') }}?type=subcategory" >
                                        <img class="main-image"
                                            src="{{ asset('public/frontend/assets/images/living-furniture-3.jpg') }}"
                                            alt="Product" />
                                    </a>
                                </div>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title"><a href="{{ route('search','sofas-a87f') }}?type=subcategory">Sofa Cum Beds</a></h5>
                                </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="ec-pro-image">
                                    <a href="{{ route('search','tv-unit-c4ca') }}?type=subcategory">
                                        <img class="main-image"
                                            src="{{ asset('public/frontend/assets/images/living-furniture-4.jpg') }}"
                                            alt="Product" />
                                    </a>
                                </div>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title"><a href="{{ route('search','tv-unit-c4ca') }}?type=subcategory">TV Units</a></h5>
                                </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="ec-pro-image">
                                <a href="{{ route('search','study-&-computer-table-c81e') }}?type=subcategory">
                                    <img class="main-image"
                                        src="{{ asset('public/frontend/assets/images/living-furniture-5.jpg') }}"
                                        alt="Product" />
                                </a>
                            </div>
                            <div class="ec-pro-content">
                                <h5 class="ec-pro-title"><a href="{{ route('search','study-&-computer-table-c81e') }}?type=subcategory">Study Tables</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Trending Item end -->

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
                        <a class="rbt-cat-box rbt-cat-box-1 text-center" href="#">
                            <div class="inner">
                                <div class="mb-2">
                                    <img src="{{ asset('public/frontend/assets/images/face-guide.webp')}}" alt="Icons Images">
                                </div>
                                <div class="content">
                                    <h5 class="fc-16">Eliminates Glare</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Category Box Layout  -->

                    <!-- Start Category Box Layout  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                        <a class="rbt-cat-box rbt-cat-box-1 text-center" href="#">
                            <div class="inner">
                                <div class="mb-2">
                                    <img src="{{ asset('public/frontend/assets/images/face-shape.webp')}}" alt="Icons Images">
                                </div>
                                <div class="content">
                                    <h5 class="fc-16">Eliminates Glare</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Category Box Layout  -->

                    <!-- Start Category Box Layout  -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <a class="rbt-cat-box rbt-cat-box-1 text-center" href="#">
                            <div class="inner">
                                <div class="mb-2">
                                    <img src="{{ asset('public/frontend/assets/images/prescription-guide.webp')}}" alt="Icons Images">
                                </div>
                                <div class="content">
                                    <h5 class="fc-16">Blocks UV Light</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Category Box Layout  -->
                </div>
    </div>
    </section>

    @if(count($featured_categories))
        @foreach ($featured_categories as $fe_key=>$featured_categorry)
            <!-- Trending Item Start -->
            <section class="section ec-trend-product section-space-p @if($fe_key%2 == 0) bg-gray @endif">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 section-title-block">
                            <div class="section-title">
                                <h2 class="ec-title">{{$featured_categorry->name}}</h2>
                            </div>
                            <div class="section-btn">
                                <span class="ec-section-btn"><a class="btn-secondary" href="{{ route('product-search') }}?category_filler={{$featured_categorry->id}}">View All</a></span>
                            </div>
                        </div>
                    </div>

                        <div class="ec-trend-slider">
                            @foreach (App\Models\Admin\Product::where('is_active',1)->whereJsonContains('category_id',''.$featured_categorry->id)->take(8)->get() as $featured_category_product)
                            @php
                                $featured_category_product_price=homePrice($featured_category_product->id);
                            @endphp

                                <div class="col-lg-3 col-md-6 col-sm-6 ec-product-content">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="#" class="image">
                                                    <img class="main-image" src="{{ asset('public/'.api_asset($featured_category_product->thumbnail_image)) }}" alt="Product" />
                                                </a>
                                                @if($featured_category_product_price['discount'])
                                                    <span class="flags">
                                                        <span class="percentage">@if($featured_category_product_price['discount_type'] == 'amount') ₹{{$featured_category_product_price['discount']}} @else {{$featured_category_product_price['discount']}}% @endif OFF</span>
                                                    </span>
                                                @endif
                                                <div class="ec-pro-actions">
                                                    <form id="featured_category_form_{{$featured_category_product->id}}">
                                                        <input type="hidden" name="product_id" value="{{$featured_category_product->id }}">
                                                        <button type="button" title="Add To Cart" class="bg-transparent" onclick="addtocart({{$featured_category_product->id}},'featured_category_form')">
                                                            <img src="{{ asset('public/frontend/assets/images/icons/cart.svg') }}" class="svg_img pro_svg" alt="">
                                                        </button>
                                                    </form>
                                                    <a class="ec-btn-group quickview" onclick="open_product_model({{$featured_category_product->id }})"><img src="{{ asset('public/frontend/assets/images/icons/quickview.svg') }}" class="svg_img pro_svg"></a>
                                                    <form action="#">
                                                        <a class="ec-btn-group wishlist" title="Wishlist"><img src="{{ asset('public/frontend/assets/images/icons/pro_wishlist.svg') }}" class="svg_img pro_svg" alt="" /></a>
                                                    </form>
                                                </div>
                                                {{-- <div class="ec-pro-actions">
                                                    <button title="Add To Cart" class=" add-to-cart"><img src="{{ asset('public/frontend/assets/images/icons/cart.svg') }}" class="svg_img pro_svg" alt="" /></button>
                                                    <a class="ec-btn-group quickview" onclick="open_product_model({{$new_arriavl->id}})"><img src="{{ asset('public/frontend/assets/images/icons/quickview.svg') }}" class="svg_img pro_svg" alt="" /></a>
                                                    <a class="ec-btn-group wishlist" title="Wishlist"><img src="{{ asset('public/frontend/assets/images/icons/pro_wishlist.svg') }}" class="svg_img pro_svg" alt="" /></a>
                                                </div> --}}
                                            </div>
                                        </div>

                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title"><a href="{{ route('search',$featured_category_product->slug) }}?type=product">{{$featured_category_product->name}}</a></h5>
                                                <span class="ec-price">
                                                    @if($featured_category_product_price['selling_price'] != $featured_category_product_price['product_price'])
                                                        <span class="old-price">{{$featured_category_product_price['selling_price']}}</span>
                                                        <span class="new-price">{{$featured_category_product_price['product_price']}}</span>
                                                    @else
                                                        <span class="new-price">{{$featured_category_product_price['product_price']}}</span>
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
                        <a class="rbt-cat-box rbt-cat-box-1 text-center" href="#">
                            <div class="inner">
                                <div class="icons">
                                    <img src="{{ asset('public/frontend/assets/images/icon/1.png')}}" alt="Icons Images">
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
                        <a class="rbt-cat-box rbt-cat-box-1 text-center" href="#">
                            <div class="inner">
                                <div class="icons">
                                    <img src="{{ asset('public/frontend/assets/images/icon/Eliminates-Glare.png')}}" alt="Icons Images">
                                </div>
                                <div class="content">
                                    <h5 class="fc-16">Eliminates Glare</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Category Box Layout  -->

                    <!-- Start Category Box Layout  -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                        <a class="rbt-cat-box rbt-cat-box-1 text-center" href="#">
                            <div class="inner">
                                <div class="icons">
                                    <img src="{{ asset('public/frontend/assets/images/icon/know_lens_img.png')}}" alt="Icons Images">
                                </div>
                                <div class="content">
                                    <h5 class="fc-16">Blocks UV Light</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Category Box Layout  -->

                    <!-- Start Category Box Layout  -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                        <a class="rbt-cat-box rbt-cat-box-1 text-center" href="#">
                            <div class="inner">
                                <div class="icons">
                                    <img src="{{ asset('public/frontend/assets/images/icon/know_lens_img4.png')}}" alt="Icons Images">
                                </div>
                                <div class="content">
                                    <h5 class="fc-16">Resists Scratches</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Category Box Layout  -->

                    <!-- Start Category Box Layout  -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                        <a class="rbt-cat-box rbt-cat-box-1 text-center" href="#">
                            <div class="inner">
                                <div class="icons">
                                    <img src="{{ asset('public/frontend/assets/images/icon/know_lens_img5.png')}}" alt="Icons Images">
                                </div>
                                <div class="content">
                                    <h5 class="fc-16">Resists Fingerprints & Smudges</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Category Box Layout  -->

                    <!-- Start Category Box Layout  -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                        <a class="rbt-cat-box rbt-cat-box-1 text-center" href="#">
                            <div class="inner">
                                <div class="icons">
                                    <img src="{{ asset('public/frontend/assets/images/icon/know_lens_img6.png')}}" alt="Icons Images">
                                </div>
                                <div class="content">
                                    <h5 class="fc-16">Repels Water & Liquids</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Category Box Layout  -->

                    <!-- Start Category Box Layout  -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                        <a class="rbt-cat-box rbt-cat-box-1 text-center" href="#">
                            <div class="inner">
                                <div class="icons">
                                    <img src="{{ asset('public/frontend/assets/images/icon/know_lens_img7.png')}}" alt="Icons Images">
                                </div>
                                <div class="content">
                                    <h5 class="fc-16">Repels Dust Particles</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Category Box Layout  -->

                    <!-- Start Category Box Layout  -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                        <a class="rbt-cat-box rbt-cat-box-1 text-center" href="#">
                            <div class="inner">
                                <div class="icons">
                                    <img src="{{ asset('public/frontend/assets/images/icon/know_lens_img8.png')}}" alt="Icons Images">
                                </div>
                                <div class="content">
                                    <h5 class="fc-16">Reduces Color & Image Distortion</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End Category Box Layout  -->
                </div>
    </div>
    </section>
    <!-- Banner Item Start -->
    @if($mid_banner)
        <section class="section banner">
            <a href="#"><img src="{{asset('public/'.api_asset($mid_banner->image))}}" class="w-100"></a>
        </section>
    @endif
    <!-- Banner Item end -->
    <!-- Other Category -->
    <section class="other-categories section-space-p">
        <div class="container"> 
          <div class="row other-categories-list">
            @foreach (App\Models\Admin\Category::where('is_active',1)->orderBy('bottom_priority','asc')->take(3)->get() as $bottom_category)
                <div class="col-sm-4">
                    <div class="category-wrpr">
                    <p>{{$bottom_category->name}}</span>
                    </p>
                    <ul class="category-list row">
                        @foreach (App\Models\Admin\SubCategory::whereJsonContains('category_id',''.$bottom_category->id)->where('is_active',1)->take(4)->get() as $bottom_sub_category)
                            <li class="col-sm-4 col-xs-4">
                                <a href="{{ route('search',$bottom_sub_category->slug) }}?type=subcategory">
                                    <img class="lazy loaded" src="{{asset('public/'.api_asset($bottom_sub_category->image))}}" alt="{{$bottom_sub_category->name}}" data-was-processed="true">
                                    <span>{{$bottom_sub_category->name}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('search',$bottom_category->slug) }}?type=category" class="view-link">View all <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.10059 3.8772L11.1006 8.87454L6.10059 13.8719" stroke="#515151" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    </div>
                </div>
            @endforeach

          </div>
        </div>
      </section>
    <!-- End Other Category -->

    <!--  services Section Start -->
    <section class="section ec-offer-section">
        <img src="{{ asset('public/frontend/assets/images/appointment.jpg')}}" alt="" class="offer_bg">
        <div class="ec-offer-inner">
            <div class="row justify-content-end">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 align-self-center">
                    <div class="ec-common-wrapper glass-initial mt-3 mb-3">
                    <div class="ec-contact-leftside">
                        <div class="ec-contact-container">
                        <h2 class="ec-offer-stitle text-center">Book Appointment</h2>
                        <p class="text-center txt-shdw">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                            <div class="ec-contact-form">
                                <form action="#" method="post">
                                    <div class="form-group mb-3">
                                        <input type="text" name="name" placeholder="Enter your name" required="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="email" name="email" placeholder="Enter your email address" required="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" name="phonenumber" placeholder="Enter your phone number" required="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <textarea name="address" placeholder="Please leave your messege here.."></textarea>
                                    </div>
                                    <div class="ec-offer-btn"><a href="#" class="btn btn-lg btn-primary">Pay ₹.99/- Only <i class="ecicon eci-chevron-right"></i></a></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!--services Section End -->

@endsection

