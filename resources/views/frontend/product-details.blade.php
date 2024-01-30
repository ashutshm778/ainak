@extends('frontend.layouts.app')
@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb"></div>
    <div class="breadcrumb">
    <div class="container">
            <div class="row">
                <div class="col-12">
                     <div class="row ec_breadcrumb_inner">
                        <div class="col-md-12 col-sm-12">
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">{{App\Models\Admin\Category::where('id',$data->category_id[0])->first()->name}}</li>
                                <li class="ec-breadcrumb-item active">{{App\Models\Admin\SubCategory::where('id',$data->subcategory_id[0])->first()->name}}</li>
                                <li class="ec-breadcrumb-item active">{{$data->name}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Sart Single product -->

    <section class="ec-page-content section-space-p">

        <div class="container">
            <div class="row">
                <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">

                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner" id="product_variant_div">
                            @include('frontend.product_variant')
                        </div>
                    </div>
                    <!--Single product content End -->

                    <!-- Single product tab start -->
                    <div class="ec-single-pro-tab">
                        <div class="ec-single-pro-tab-wrapper">
                            <div class="ec-single-pro-tab-nav">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-details"
                                            role="tablist">Detail</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-info"
                                            role="tablist">More Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-review"
                                            role="tablist">Reviews</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content  ec-single-pro-tab-content">
                                <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                    <div class="ec-single-pro-tab-desc">
                                        {!! $data->description !!}
                                    </div>
                                </div>
                                <div id="ec-spt-nav-info" class="tab-pane fade">
                                    <div class="ec-single-pro-tab-moreinfo">
                                        {!! $data->specification !!}
                                    </div>
                                </div>
                                <div id="ec-spt-nav-review" class="tab-pane fade">
                                    <div class="row">
                                        <div class="ec-ratting-content">
                                            <div class="ec-ratting-form">
                                                @php $reviews=App\Models\Review::where('product_id',$data->id)->where('status',1)->get(); @endphp
                                                @foreach($reviews as $review)
                                                <div class="ec-t-review-wrapper">
                                                    <div class="ec-t-review-item">
                                                        <div class="ec-t-review-avtar">
                                                            <img src="@if($review->customer->photo){{asset('public/public/frontend/user_profile/'.$review->customer->photo)}}@else {{asset('public/frontend/assets/images/profile.jpeg')}} @endif"
                                                                alt="" />
                                                        </div>
                                                        <div class="ec-t-review-content">
                                                            <div class="ec-t-review-top">
                                                                <div class="ec-t-review-name">{{$review->name}}</div>
                                                                <div class="ec-t-review-rating">
                                                                    @for($i=0;$i<$review->rating;$i++)
                                                                    <i class="ecicon eci-star fill"></i>
                                                                    @endfor
                                                                   
                                                                </div>
                                                            </div>
                                                            <div class="ec-t-review-bottom">
                                                                <p>{{$review->comment}} </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                @endforeach
                                                @if (Auth::guard('customer')->check())
                                                <form action="{{route('review.store')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$data->id}}" />
                                                    <div class="row">
                                                        <div class="col-lg-6 col-6">
                                                           <div class="listing-widget-mail mb-3">
                                                              <div class="content">
                                                                 <h3>Please Rate Us</h3>
                                                                 <span>Your Review Is Valuable For Us.</span>
                                                              </div>
                                                           </div>
                                                        </div>
                                                        <div class="col-lg-6 col-6 text-right">
                                                           <div class="feedback">
                                                              <div class="rate">
                                                              <input type="radio" id="star5" name="rate" value="5" required/>
                                                              <label for="star5" title="text">5 stars</label>
                                                              <input type="radio" id="star4" name="rate" value="4" required/>
                                                              <label for="star4" title="text">4 stars</label>
                                                              <input type="radio" id="star3" name="rate" value="3" required/>
                                                              <label for="star3" title="text">3 stars</label>
                                                              <input type="radio" id="star2" name="rate" value="2" required/>
                                                              <label for="star2" title="text">2 stars</label>
                                                              <input type="radio" id="star1" name="rate" value="1" required/>
                                                              <label for="star1" title="text">1 star</label>
                                                          </div>
                                                           </div>
                                                        </div>
                                                     </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="ec-ratting-input">
                                                                <input  placeholder="Name" name="name" type="text" value="{{optional(Auth::guard('customer')->user())->first_name}}" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="ec-ratting-input">
                                                                <input  placeholder="Email*" name="email" type="email" value="{{optional(Auth::guard('customer')->user())->email}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ec-ratting-input form-submit">
                                                        <textarea  placeholder="Enter Your Comment" name="comment"></textarea>
                                                        <button class="btn btn-primary" type="submit"
                                                            value="Submit">Submit</button>
                                                    </div>
                                                </form>
                                                @else
                                                <a type="button" class="btn btn-primary" href="{{ route('user.login') }}?from={{url()->full()}}" >
                                                 Login For Review</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details description area end -->
                </div>

            </div>
        </div>

    </section>
    <!-- End Single product -->

    <!-- Related Product Start -->
    <section class="section ec-releted-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Related products</h2>
                        <h2 class="ec-title">Related products</h2>
                        <p class="sub-title"></p>
                    </div>
                </div>
            </div>
            <div class="row margin-minus-b-30">
                <!-- Related Product Content -->
                {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="#" class="image">
                                    <img class="main-image"
                                        src="{{ asset('public/frontend/assets/images/product-image/22_1.jpg') }}"
                                        alt="Product" />
                                    <img class="hover-image"
                                        src="{{ asset('public/frontend/assets/images/product-image/22_2.jpg') }}"
                                        alt="Product" />
                                </a>
                                <span class="percentage">0%</span>
                                <div class="ec-pro-actions">
                                    <a class="ec-btn-group wishlist" title="Wishlist"><img
                                            src="{{ asset('public/frontend/assets/images/icons/wishlist.svg') }}"
                                            class="svg_img pro_svg" alt="" /></a>
                                </div>
                            </div>
                        </div>
                        <div class="ec-pro-content">
                            <h5 class="ec-pro-title"><a href="#">Modern tabel for living
                                    room</a></h5>
                            <div class="ec-pro-rating">
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star fill"></i>
                                <i class="ecicon eci-star"></i>
                            </div>
                            <div class="ec-pro-list-desc">...</div>
                            <span class="ec-price">
                                <span class="old-price">0.00</span>
                                <span class="new-price">0.00</span>
                            </span>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <script src="{{ asset('public/frontend/assets/js/zoom-image.js') }}"></script>
    <script type="text/javascript">
        if (window.innerWidth > 768) {
            $('.imgBox').imgZoom({
                boxWidth: 500,
                boxHeight: 500,
                marginLeft: 5,
                origin: 'data-origin'
            });
        }

        $(document).ready(function() {
            $('.show-small-img').click(function() {
                $('#show-img').attr('data-origin', $(this).attr('src'));
            });
        });

        function getVaiantPriceData(product_group_id,attribute_id,attribute_value){
            var quanity=$('#quantity').val();
            $.ajax({
                type: "GET",
                url: '{{ route('product.get_varinat_price_data') }}',
                data: {
                    product_group_id:product_group_id,
                    attribute_id:attribute_id,
                    attribute_value:attribute_value,
                    product_qty:quanity
                },
                success: function(data) {

                        $('#product_variant_div').empty();
                        $('#product_variant_div').html(data);
                        $(".single-product-cover").slick({
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                arrows: !1,
                                fade: !1,
                                asNavFor: ".single-nav-thumb"
                            }),
                            $(".single-nav-thumb").slick({
                                slidesToShow: 4,
                                slidesToScroll: 1,
                                asNavFor: ".single-product-cover",
                                focusOnSelect: !0,
                            })
                }
            });
        }

        function getVaiantPriceColorData(product_group_id,color){
            var quanity=$('#quantity').val();
            $.ajax({
                type: "GET",
                url: '{{ route('product.get_varinat_price_data') }}',
                data: {
                    product_group_id:product_group_id,
                    color:color,
                    product_qty:quanity
                },
                success: function(data) {

                        $('#product_variant_div').empty();
                        $('#product_variant_div').html(data);
                        $(".single-product-cover").slick({
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                arrows: !1,
                                fade: !1,
                                asNavFor: ".single-nav-thumb"
                            }),
                            $(".single-nav-thumb").slick({
                                slidesToShow: 4,
                                slidesToScroll: 1,
                                asNavFor: ".single-product-cover",
                                focusOnSelect: !0,
                            })
                }
            });
        }


       


        function select_lens(power_type){
            $.ajax({
                type: "GET",
                url: '{{ route('product.get_lens') }}',
                data: {
                    power_type:power_type,
                },
                success: function(data) {
                        $('#step-3').empty();
                        $('#step-3').html(data);
                }
            });
        }
        
        function open_product_m(){
            $('#ec_quickview_modal').modal('show');
            select_lens('Single Vision/Powered Eyeglasses');
        }


        $(document).ready(function() {
            getVariantPrice();
        });
    </script>

    {{-- <script src="{{asset('public/frontend/assets/js/zoom-main.js')}}"></script> --}}

    </section>
@endsection
