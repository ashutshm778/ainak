<footer class="ec-footer">
    <div class="footer-container">
        {{-- <div class="footer-offer">
            <div class="container">
                <div class="row">
                    <div class="text-center footer-off-msg">
                        <span>Win a contest! Get this limited-editon</span><span class="footer-off-text">- Free Office Chair</span><a href="#" target="_blank">View Detail</a>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="footer-top section-space-footer-p">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-3 ec-footer-news">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Our Company </h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="{{ route('about') }}"><i
                                                class="ecicon eci-chevron-right"></i> About Us</a></li>
                                    <li class="ec-footer-link"><a href="{{ route('contact') }}"><i
                                                class="ecicon eci-chevron-right"></i> Contact Us</a></li>
                                    <li class="ec-footer-link"><a href="#"><i
                                                class="ecicon eci-chevron-right"></i> Career</a></li>
                                    <li class="ec-footer-link"><a href="#"><i
                                                class="ecicon eci-chevron-right"></i> Blog</a></li>
                                    <li class="ec-footer-link"><a href="#"><i
                                                class="ecicon eci-chevron-right"></i> Our Stores</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-sm-12 col-lg-2 ec-footer-account">-->
                    <!--    <div class="ec-footer-widget">-->
                    <!--        <h4 class="ec-footer-heading">Useful Links</h4>-->
                    <!--        <div class="ec-footer-links">-->
                    <!--            <ul class="align-items-center">-->
                    <!--                <li class="ec-footer-link"><a href="#">Exporters</a></li>-->
                    <!--                <li class="ec-footer-link"><a href="#">Buy in Bulk</a></li>-->
                    <!--                <li class="ec-footer-link"><a href="#">Refer & Earn</a></li>-->
                    <!--                <li class="ec-footer-link"><a href="#">Delivery Location</a></li>-->
                    <!--                <li class="ec-footer-link"><a href="#">Sitemap</a></li>-->
                    <!--            </ul>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col-sm-12 col-lg-3 ec-footer-account">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">My Account</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="#"> <i
                                                class="ecicon eci-chevron-right"></i> Login</a></li>
                                    <li class="ec-footer-link"><a href="#"> <i
                                                class="ecicon eci-chevron-right"></i> Order History</a></li>
                                    <li class="ec-footer-link"><a href="#"> <i
                                                class="ecicon eci-chevron-right"></i> My Wishlist</a></li>
                                    <li class="ec-footer-link"><a href="{{ route('faq') }}"> <i
                                                class="ecicon eci-chevron-right"></i> FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 ec-footer-service">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Our Policies</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="{{ route('privacy_policy') }}"> <i
                                                class="ecicon eci-chevron-right"></i> Privacy Policy </a></li>
                                    <li class="ec-footer-link"><a href="{{ route('term_and_condition') }}"> <i
                                                class="ecicon eci-chevron-right"></i> Term & condition</a></li>
                                    <li class="ec-footer-link"><a href="{{ route('cancel_and_refund_policy') }}"> <i
                                                class="ecicon eci-chevron-right"></i> Cancellation Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 ec-footer-contact">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Contact</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">

                                    @php
                                        $phone = App\Models\Admin\WebsiteSetting::where('type', 'phone')->first();
                                    @endphp
                                    <li class="ec-footer-link"><span><i class="ecicon eci-phone"></i></span><a
                                            href="tel:+{{ optional($phone)->image }}">{{ optional($phone)->image }}</a>
                                    </li>
                                    @php
                                        $email = App\Models\Admin\WebsiteSetting::where('type', 'email')->first();
                                    @endphp
                                    <li class="ec-footer-link"><span><i class="ecicon eci-envelope"></i></span><a
                                            href="mailto:{{ optional($email)->image }}">{{ optional($email)->image }}</a>
                                    </li>
                                    @php
                                        $address = App\Models\Admin\WebsiteSetting::where('type', 'address')->first();
                                    @endphp
                                    <li class="ec-footer-link"><span><i
                                                class="ecicon eci-map-marker"></i></span>{{ optional($address)->image }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="footer-last">
            <div class="container">
                <div class="section-title text-left">
                    <h1>Explore the Finest Eyewear Selection Exclusively at AYNAK!</h1>
                </div>
                <p> AYNAK is your go-to destination for more than just online eyeglass shopping. Discover a premium
                    collection of eyeglasses, sunglasses, and contact lenses from leading brands all in one place. Avail
                    special
                    offers, where you can enjoy a Buy 1, Get 1 free deal.</p>
                <p>Enjoy complimentary shipping, Cash on Delivery, and instant refunds with every purchase! AYNAK
                    boasts a growing community of 1000+ customers, making it one of the rapidly growing eyeglass
                    platforms for the modern Indian consumer.</p>

                <div class="nav-style-separated">
                <ul class="desk">
                    <li>
                        <div class="section-title text-left" style="margin-bottom: 15px;">
                            <h2>Popular Searchs</h2>
                        </div>
                        <ul>
                            <li><a href="#">Eye glasses</a></li>
                            <li><a href="#">Blue cut lens</a></li>
                            <li><a href="#">Goggles</a></li>
                            <li><a href="#">Goggles for Men</a></li>
                            <li><a href="#">Mirrored sunglasses</a></li>
                            <li><a href="#">Glasses for men</a></li>
                            <li><a href="#">Transparent glasses</a></li>
                            <li><a href="#">Goggles for Women</a></li>
                            <li><a href="#">Glasses for Women</a></li>
                            <li><a href="#">Glasses frames</a></li>
                            <li><a href="#">Prescription glasses</a></li>
                            <li><a href="#">Designer eyeglasses</a></li>
                            <li><a href="#">Fashion eyewear</a></li>
                            <li><a href="#">Online eyeglasses</a></li>
                            <li><a href="#">Eyeglasses store</a></li>
                            <li><a href="#">Reading glasses</a></li>
                            <li><a href="#">Blue light glasses</a></li>
                            <li><a href="#">Polarized sunglasses</a></li>
                            <li><a href="#">Rimless glasses</a></li>
                            <li><a href="#">Vintage glasses</a></li>
                            <li><a href="#">Eyeglass lenses</a></li>
                            <li><a href="#">Fashionable spectacles</a></li>
                            <li><a href="#">Optical frames</a></li>
                            <li><a href="#">Kids' glasses</a></li>
                            <li><a href="#">Sports glasses</a></li>
                            <li><a href="#">Glasses for men/women</a></li>
                        </ul>
                    </li>
                </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8 footer-copy">
                        <div class="footer-bottom-copy ">
                            <div class="ec-copy mb-2">
                                &copy;<script>document.write(new Date().getFullYear())
                                </script> All Rights Reserved. Developed By <a href="https://www.techuptechnologies.com/" class="site-name"> Techup Technologies.</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 footer-bottom-right">
                        <div class="footer-bottom-payment d-flex justify-content-end">
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="list-inline-item"><a href="https://wa.me/+919219949495" class="prt-social-twitter" target="_blank"><i
                                        class="ecicon eci-whatsapp"></i></a></li>
                                    <li class="list-inline-item"><a href="https://www.facebook.com/people/Aynak/61554822281623/?mibextid=ZbWKwL" class="prt-social-facebook" target="_blank"><i
                                                class="ecicon eci-facebook"></i></a></li>
                                    <li class="list-inline-item"><a href="https://www.instagram.com/aynak.in/?igsh=eDgyZzA5OHVqOHRj" class="prt-social-instagram" target="_blank"><i
                                                class="ecicon eci-instagram"></i></a></li>
                                    {{-- <li class="list-inline-item"><a href="#" class="prt-social-linkedin" target="_blank"><i
                                                class="ecicon eci-linkedin"></i></a></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="ec-nav-toolbar">
    <div class="container">
        <div class="ec-nav-panel">
            {{-- <div class="ec-nav-panel-icons">
                <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle">
                    <img src="{{ asset('public/frontend/assets/images/icons/menu.svg') }}" class="svg_img header_svg"
                        alt="" />
                </a>
            </div> --}}
            <div class="ec-nav-panel-icons">
                <a href="https://wa.me/+919219949495" class="ec-header-btn" target="_blank">
                    <img src="{{ asset('public/frontend/assets/images/icons/whatsapp.svg') }}"
                        class="svg_img header_svg" alt="" />
                </a>
            </div>
            <div class="ec-nav-panel-icons">

                <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle">
                    <img src="{{ asset('public/frontend/assets/images/icons/cart.svg') }}" class="svg_img header_svg"
                        alt="" />

                    <span class="ec-cart-noti ec-header-count header_cart_count cart-count-lable">

                        @if (Auth::guard('customer')->check())
                            {{ App\Models\Cart::where('user_id', Auth::guard('customer')->user()->id)->get()->count() }}
                        @else
                            0
                        @endif
                    </span>

                </a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="{{ route('index') }}" class="ec-header-btn">
                    <img src="{{ asset('public/frontend/assets/images/icons/home.svg') }}" class="svg_img header_svg"
                        alt="icon" />
                </a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="{{ route('wishlist') }}" class="ec-header-btn ">
                    <img src="{{ asset('public/frontend/assets/images/icons/wishlist.svg') }}"
                        class="svg_img header_svg" alt="icon" />
                    <span class="ec-cart-noti ec-cart-wishlist">
                        @if (Auth::guard('customer')->check())
                            {{ App\Models\Wishlist::where('user_id', Auth::guard('customer')->user()->id)->get()->count() }}
                        @else
                            0
                        @endif
                    </span>
                </a>
            </div>
            <div class="ec-nav-panel-icons">
                @if (Auth::guard('customer')->check())
                    <a href="{{ route('usermob_sidebar') }}" class="ec-header-btn">
                        <span
                            class="nme">{{ strtoupper(mb_substr(Auth::guard('customer')->user()->first_name, 0, 1)) }}</span>
                    </a>
                @else
                    @if (featureActivation('retailer') == '1' ||
                            featureActivation('distributor') == '1' ||
                            featureActivation('wholeseller') == '1')
                        <a href="{{ route('user.login') }}" class="ec-header-btn">
                            <img src="{{ asset('public/frontend/assets/images/icons/user.svg') }}"
                                class="svg_img header_svg" alt="icon" />
                        </a>
                    @endif
                @endif
            </div>

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="appointment_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close">X</button>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="row">
                        <h3 class="bk_amt text-center">Book Appointment</h3>
                        <div class="form-group mb-3">
                            <input type="text" name="name" id="name" placeholder="Enter your name" required >
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Enter your email address" required >
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="phone_number" id="phone_number" placeholder="Enter your phone number"
                                required >
                        </div>
                        <div class="form-group mb-2">
                            <textarea name="message" id="message" placeholder="Please leave your messege here.."></textarea>
                        </div>
                        <div class="ec-offer-btn"><a href="#" class="btn btn-lg btn-primary w-100" onclick="pay_enquiry()">Pay ₹.49/-
                                Only <i class="ecicon eci-chevron-right"></i></a></div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal end -->

<div class="modal fade" id="ec_quickview_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body" id="modal_body">
            </div>
        </div>
    </div>
</div>
<div id="addtocart_toast" class="addtocart_toast">
    <div class="desc">You Have Add To Cart Successfully</div>
</div>
<div id="wishlist_toast" class="wishlist_toast">
    <div class="desc">You Have Add To Wishlist Successfully</div>
</div>

{{-- <!-- Recent Purchase Popup  -->
    <div class="recent-purchase">
        <img src="{{asset('public/frontend/assets/images/product-image/1.jpg')}}" alt="payment image">
        <div class="detail">
            <p>Someone in new just bought</p>
            <h6>stylish baby shoes</h6>
            <p>10 Minutes ago</p>
        </div>
        <a href="javascript:void(0)" class="icon-btn recent-close">×</a>
    </div>
    <!-- Recent Purchase Popup end -->

    <!-- Cart Floating Button -->
    <div class="ec-cart-float">
        <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
            <div class="header-icon"><img src="{{asset('public/frontend/assets/images/icons/cart.svg')}}" class="svg_img header_svg" alt="" /></div>
            <span class="ec-cart-count cart-count-lable">3</span>
        </a>
    </div>

<!-- Cart Floating Button end --> --}}
<script src="{{ asset('public/frontend/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/countdownTimer.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/slick.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>


{{-- @if (Route::currentRouteName() == 'search')
    <script src="{{ asset('public/frontend/assets/js/main.js') }}"></script>
@endif --}}

<script src="{{ asset('public/frontend/assets/js/demo-3.js') }}"></script>


<script src="{{ asset('/public/js/jquery.validate.min.js') }}"></script>
<script>
    $(function() {
        $('#valid_form').validate({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.ec-register-wrap').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

    function open_product_model(product_id) {
        $.get("{{ route('modal.product.detail', '') }}/" + product_id, function(data, status) {
            $('#ec_quickview_modal').modal('show');
            $('#modal_body').html(data);
            $(".qty-product-cover").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: !1,
                fade: !1,
                asNavFor: ".qty-nav-thumb"
            }), $(".qty-nav-thumb").slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: ".qty-product-cover",
                focusOnSelect: !0,
            })
            getVariantPrice();
        });
    }

    jQuery.fn.ForceNumericOnly =
        function() {
            return this.each(function() {
                $(this).keydown(function(e) {
                    var key = e.charCode || e.keyCode || 0;
                    // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
                    // home, end, period, and numpad decimal
                    return (
                        key == 8 ||
                        key == 9 ||
                        key == 13 ||
                        key == 46 ||
                        key == 110 ||
                        key == 190 ||
                        (key >= 35 && key <= 40) ||
                        (key >= 48 && key <= 57) ||
                        (key >= 96 && key <= 105));
                });
            });
        };

    $(".number_only").ForceNumericOnly();
</script>

<script>
    function getVariantPrice() {
        @if (request()->route()->getName() != 'index' && request()->route()->getName() != 'cart')
            $.ajax({
                type: "GET",
                url: '{{ route('product.get_varinat_price') }}',
                data: $('#product_detail_form').serializeArray(),
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
        @endif
    }

    function update_qty(type, product_id, range_qty, is_change) {
        var qty_id = '.qty_value_' + product_id;
        var qty_value = $(qty_id).val();
        if (type == 'plus') {
            var new_qty = parseInt(qty_value) + 1;
            if (range_qty) {
                if (new_qty <= range_qty) {
                    $('.qty_value_' + product_id).val(new_qty);
                    getVariantPrice();
                    @if (Auth::guard('customer')->check())
                        change_qty(product_id, new_qty)
                    @endif
                } else {
                    alert('Maximum Quantity Reached');
                }
            } else {
                $('.qty_value_' + product_id).val(new_qty);
                getVariantPrice();
                @if (Auth::guard('customer')->check())
                    change_qty(product_id, new_qty)
                @endif
            }
        } else {
            var new_qty = parseInt(qty_value) - 1;
            if (new_qty >= range_qty) {
                $('.qty_value_' + product_id).val(new_qty);
                getVariantPrice();
                @if (Auth::guard('customer')->check())
                    change_qty(product_id, new_qty)
                @endif
            } else {
                alert('Minimum Quantity Reached');
            }
        }
    }

    function change_qty(product_id, qty) {
        $.get("{{ route('change.cart.qty', ['', '']) }}/" + product_id + "/" + qty, function(data, status) {
            $("#addtocart_toast").addClass("show");
            setTimeout(function() {
                $("#addtocart_toast").removeClass("show")
            }, 3000);
            $('#ec-side-cart').html(data.cart_detail)
            $('#cart-summary-div').html(data.cart_summary)
            $('#cart_data').html(data.cart_data);
        });
    }

    function addtocart(product_ids, type) {
        if (type == 'flash_form') {
            form_id = '#flash_form_' + product_ids
        }
        if (type == 'new_arrival_form') {
            form_id = '#new_arrival_form_' + product_ids
        }
        if (type == 'feature_form') {
            form_id = '#feature_form_' + product_ids
        }
        if (type == 'best_seller_form') {
            form_id = '#best_seller_form_' + product_ids
        }
        if (type == 'product_model_form') {
            form_id = '#product_model_form'
        }
        if (type == 'product_detail_form') {
            form_id = '#product_detail_form'
        }
        if (type == 'featured_category_form') {
            form_id = '#featured_category_form_' + product_ids
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        var formData = new FormData($(form_id)[0]);
        $.ajax({
            type: 'POST',
            url: "{{ route('add.to.cart') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#ec-side-cart').html(data.html)
                $("#addtocart_toast").addClass("show");
                setTimeout(function() {
                    $("#addtocart_toast").removeClass("show")
                }, 3000);
                $('.header_cart_count').text(data.cart_count);
                if (type == 'new_arrival_form') {
                    location.reload();
                }
            },
            error: function(error) {
                @if (featureActivation('retailer') == '1' ||
                        featureActivation('distributor') == '1' ||
                        featureActivation('wholesaler') == '1')
                    var from_url = "{{ url()->full() }}";
                    window.location.href = "{{ route('user.login') }}?from=" + from_url;
                @endif
            }
        });
    }

    function buyNow(product_ids, type) {
        if (type == 'flash_form') {
            form_id = '#flash_form_' + product_ids
        }
        if (type == 'new_arrival_form') {
            form_id = '#new_arrival_form_' + product_ids
        }
        if (type == 'feature_form') {
            form_id = '#feature_form_' + product_ids
        }
        if (type == 'best_seller_form') {
            form_id = '#best_seller_form_' + product_ids
        }
        if (type == 'product_model_form') {
            form_id = '#product_model_form'
        }
        if (type == 'product_detail_form') {
            form_id = '#product_detail_form'
        }
        if (type == 'featured_category_form') {
            form_id = '#featured_category_form_' + product_ids
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        var formData = new FormData($(form_id)[0]);
        $.ajax({
            type: 'POST',
            url: "{{ route('add.to.cart') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#ec-side-cart').html(data.html)
                $("#addtocart_toast").addClass("show");
                setTimeout(function() {
                    $("#addtocart_toast").removeClass("show")
                }, 3000);
                $('.header_cart_count').text(data.cart_count);
                window.location.href = "{{ route('checkout') }}";
            },
            error: function(error) {
                @if (featureActivation('retailer') == '1' ||
                        featureActivation('distributor') == '1' ||
                        featureActivation('wholesaler') == '1')
                    window.location.href = "{{ route('user.login') }}";
                @endif
            }
        });
    }

    function addToWishlist(product_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('add.to.wishlist') }}",
            data: {
                product_id: product_id
            },
            success: function(data) {

                $('#wish_' + product_id).toggleClass('wishlist-heart-active');
                if ($('#wish_' + product_id).hasClass("wishlist-heart-active")) {
                    if (data.wishlist_count) {
                        $("#addtocart_toast").addClass("show");
                        $('.ec-cart-wishlist').html(data.wishlist_count);
                        $("#addtocart_toast").text("Product Added to Wishlist Successfully!");
                        setTimeout(function() {
                            $("#addtocart_toast").removeClass("show")
                        }, 3000);
                    }
                } else {
                    deleteToWishlist(product_id);
                }


            },
            error: function(error) {
                var from_url = "{{ url()->full() }}";
                window.location.href = "{{ route('user.login') }}?from=" + from_url;
            }
        });
    }

    function deleteToWishlist(product_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('delete.to.wishlist') }}",
            data: {
                product_id: product_id
            },
            success: function(data) {
                $('.ec-cart-wishlist').html(data.wishlist_count);
                var current_route = "{{ request()->route()->getName() }}";
                if (current_route == 'wishlist') {
                    location.reload();
                }
            }
        });
    }

    $('#product_detail_form input').on('change', function() {
        // getVariantPrice();
    });

    function selectVaraint(value, id) {
        $.ajax({
            type: "GET",
            url: '{{ route('product.get_selected_variant') }}',
            data: {
                color: value,
                product_group_id: id
            },
            success: function(data) {
                console.log(data);
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

    function selectVaraintAttribute(element, attr, id) {
        console.log(element.value, id);
        $.ajax({
            type: "GET",
            url: '{{ route('product.get_selected_variant') }}',
            data: {
                color: element.value,
                product_group_id: id,
                attr: attr
            },
            success: function(data) {
                $('#product_variant_div').empty();
                $('#product_variant_div').html(data);

            }
        });
    }


    function buyLens(lense_id) {

        form_id = '#product_detail_form';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        var formData = new FormData($(form_id)[0]);
        formData.append('lens_id', lense_id);
        $.ajax({
            type: 'POST',
            url: "{{ route('add.to.cart') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#ec-side-cart').html(data.html)
                $("#addtocart_toast").addClass("show");
                setTimeout(function() {
                    $("#addtocart_toast").removeClass("show")
                }, 3000);
                $('.header_cart_count').text(data.cart_count);
                window.location.href = "{{ route('checkout') }}";
            },
            error: function(error) {
                @if (featureActivation('retailer') == '1' ||
                        featureActivation('distributor') == '1' ||
                        featureActivation('wholesaler') == '1')
                    window.location.href = "{{ route('user.login') }}";
                @endif
            }
        });
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    jQuery.validator.addMethod("selectphone", function(value, element) {
        var isValid = false;

        // Check if the value matches a valid phone number pattern

        // Make an AJAX call to the server to check the phone number
        $.ajax({
            url: "{{ route('check_phone') }}", // Replace with the actual endpoint on your server
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                phone: value
            },
            async: false, // Make the call synchronous for simplicity (not recommended in production)
            success: function(response) {
                isValid = response.isValid;
            }
        });


        // Return the result of the validation
        return isValid;
    }, "Phone number not found please register");


    $(function() {

        $("form[name='login_form']").validate({

            rules: {
                phone: {
                    required: true,
                    selectphone: true
                }
            },

            messages: {
                phone: {
                    required: "Please Enter Mobile Number!",
                }
            },

            submitHandler: function(form) {
                form.submit();
            }
        });

    });

    function pay_enquiry() {
       
        var name =$('#name').val();
        var email =$('#email').val();
        var phone =$('#phone_number').val();
        var message =$('#message').val();

        if(name &&  email && phone){

            amount = 49;

            var options = {
                "key": "{{ env('RKEY') }}", // Enter the Key ID generated from the Dashboard
                "amount": amount *
                    100, // Amount is in currency subunits. Default currency is INR. Hence, 10 refers to 1000 paise
                "currency": "INR",
                "name": "Aynak",
                "description": "Order Payment",
                "image": "https://aynak.in/public/uploads/all/logo.png",
                "order_id": "", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                "handler": function(response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('payment_enquiry.rozerpay') }}",
                        data: {
                            razorpay_payment_id: response.razorpay_payment_id,
                            name:name,
                            email:email,
                            phone:phone,
                            message:message

                        },
                        success: function(data) {

                            if (data == 1) {
                                location.reload();
                            }

                        }
                    });
                },
                "prefill": {
                    "name": name,
                    "email": email,
                    "contact":phone
                },
                "theme": {
                    "color": "#EB5353"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        }else{
            alert('Please Fill Required Fields');
        }
       
    }
</script>
