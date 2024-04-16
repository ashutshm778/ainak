@extends('frontend.layouts.app')
@section('content')
    <style>
        .badge {
            padding: 3px 5px;
        }

        .accordion-body p {
            margin-bottom: 0;
        }
    </style>
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb"></div>
    <div class="desk_hide">
        <a href="{{ route('usermob_sidebar') }}" class="bck-btn"><i class="ecicon eci-arrow-left"></i> Back</a>
    </div>
    <section class="ec-page-content checkout_page section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-checkout-leftside col-lg-8 col-md-12 ">
                    <div class="ec-checkout-content">
                        <div class="ec-checkout-inner">
                            <div class="ec-checkout-wrap margin-bottom-30">
                                <div class="ec-checkout-block ec-check-bill">
                                    <h3 class="ec-checkout-title">Billing Details</h3>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item ec-faq-block">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    Address
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="ec-bl-block-content">
                                                        <span class="ec-bill-option">
                                                            @foreach (App\Models\CustomerAddress::where('user_id', Auth::guard('customer')->user()->id)->get() as $add_key => $customer_address)
                                                                <div class="address">
                                                                    <input type="radio"
                                                                        id="address_select_{{ $add_key + 1 }}"
                                                                        value="{{ $customer_address->id }}"
                                                                        name="address_select" checked>
                                                                    <label
                                                                        for="address_select_{{ $add_key + 1 }}"><b>{{ $customer_address->name }}</b></label>
                                                                    <p>{{ $customer_address->address }}
                                                                        {{ App\Models\Admin\City::where('id', $customer_address->city)->first()->city }}
                                                                        {{ App\Models\Admin\State::where('id', $customer_address->state)->first()->state }}
                                                                        {{ $customer_address->country }}
                                                                        {{ $customer_address->pincode }}</p>
                                                                </div>
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item ec-faq-block">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    <i class="ecicon eci-plus"></i> &nbsp; Add New Address
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="ec-bl-block-content">
                                                        <div class="ec-check-bill-form">
                                                            <form action="{{ route('store.customer.address') }}"
                                                                method="post">
                                                                @csrf
                                                                <span class="ec-bill-wrap ec-bill-half">
                                                                    <label>Your Name*</label>
                                                                    <input type="text" name="name" id="name"
                                                                        placeholder="Enter your Name" required>
                                                                </span>
                                                                <span class="ec-bill-wrap ec-bill-half">
                                                                    <label>Your Phone Number*</label>
                                                                    <input type="text" name="phone" id="phone"
                                                                        placeholder="Enter your Phone Number" required>
                                                                </span>
                                                                <span class="ec-bill-wrap ec-bill-half">
                                                                    <label>Zip code *</label>
                                                                    <input type="text" name="pincode" id="pincode"
                                                                        placeholder="Post Code" onchange="get_address()"
                                                                        required>
                                                                </span>
                                                                <span class="ec-bill-wrap ec-bill-half">
                                                                    <label>City *</label>
                                                                    <input type="text" name="city" id="city"
                                                                        placeholder="Enter your City" readonly required>
                                                                </span>
                                                                <span class="ec-bill-wrap ec-bill-half">
                                                                    <label>State *</label>
                                                                    <input type="text" name="state" id="state"
                                                                        placeholder="Enter your State" readonly required>
                                                                </span>
                                                                <span class="ec-bill-wrap ec-bill-half">
                                                                    <label>Country *</label>
                                                                    <input type="text" name="country" id="country"
                                                                        placeholder="Enter your Country" readonly required>
                                                                </span>
                                                                <span class="ec-bill-wrap">
                                                                    <label>Address</label>
                                                                    <textarea placeholder="Address" name="address" id="address" required></textarea>
                                                                </span>
                                                                <span class="ec-bill-wrap mt-2">
                                                                    <button class="btn btn-primary">Save And Deliver
                                                                        Here</button>
                                                                </span>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        <div class="accordion-item ec-faq-block">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="true"
                    aria-controls="collapseThree"> Order Summary </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse show"
                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="ec-bl-block-content">
                        <div class="row">
                            @foreach (App\Models\Cart::where('user_id', Auth::guard('customer')->user()->id)->get() as $cart)
                                @php
                                    $product_prices = getProductDiscountedPrice(
                                        $cart->product_id,
                                        'retailer',
                                    );
                                @endphp
                                <div class="col-md-6 mb-2">
                                    <div class="cards">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="pro-img">
                                                    <a href="#">
                                                        <img class="main-image"
                                                            src="{{ asset('public/' . api_asset($cart->product->thumbnail_image)) }}"
                                                            class="w-100"
                                                            alt="Product" />
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="pro-contents">
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a8052d1 (new update)
                                                    <h5><a href="#">{{ $cart->product->name }}</a>
                                                            <a href="{{ route('delete.to.cart', $cart->id) }}" class="rmve">
                                                                <i class="ecicon eci-trash-o"></i>
                                                            </a>
<<<<<<< HEAD
=======
                                                    <h5><a
                                                            href="#">{{ $cart->product->name }}</a>
>>>>>>> 81cdf0d (new update)
=======
>>>>>>> a8052d1 (new update)
                                                    </h5>
                                                    <span class="ec-price">
                                                        @if ($product_prices['selling_price'] > $product_prices['product_price'])
                                                            MRP <del>₹
                                                                {{ $product_prices['selling_price'] }}</del>
                                                            <span> ₹
                                                                {{ $product_prices['product_price'] }}</span>
                                                        @else
                                                            <span> ₹
                                                                {{ $product_prices['product_price'] }}
                                                            </span>
                                                        @endif
<<<<<<< HEAD
<<<<<<< HEAD
=======
                                                        <a href="{{ route('delete.to.cart', $cart->id) }}"
                                                            class="rmve">
                                                            <i
                                                                class="ecicon eci-trash-o"></i></a>
>>>>>>> 81cdf0d (new update)
=======
>>>>>>> a8052d1 (new update)
                                                        <small
                                                            class="prcnt">({{ $product_prices['discount'] }}
                                                            @if ($product_prices['discount_type'] == 'percent')
                                                                {{ '%' }}
                                                            @else
                                                                {{ 'Rs' }}
                                                            @endif
                                                            OFF)</small>
                                                    </span>
                                                    @if (!empty($cart->lens_id))
                                                        <br>
                                                        <p> Lens :
                                                            {{ $cart->lens->name }} </p>
                                                        <span>
                                                            @if ($cart->lens->discount > 0)
                                                                MRP <del>₹
                                                                    {{ $cart->lens->price }}</del>
                                                                ₹
                                                                {{ lensDiscountPrice($cart->lens->id) }}
                                                            @else₹
                                                                {{ $cart->lens->price }}
                                                            @endif
                                                            @if($cart->lens->discount > 0)
                                                            <small
                                                                class="prcnt">({{ $cart->lens->discount }}%
                                                                Off)</small>
                                                                @endif
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cards-footer">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h6>Upload Prescription</h6>
                                                </div>
                                                <div class="col-6">
                                                    <input type="file" class="inpt-cls"
                                                        name="lens_prescription_{{ $cart->id }}"
                                                        id="fileInput_{{ $cart->id }}"
                                                        onchange="uploadFile('{{ $cart->id }}')" />
                                                </div>
                                            </div>
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
</div>
</div>
</div>
</div>
</div>
                <div class="ec-checkout-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Coupan</h3>
                            </div>
                            @php
                                $sub_total_amount = 0;
                                $total_discount = 0;
                                $total_amount = 0;
                                $total_lens = 0;
                                $total_lens_discount = 0;
                                $coupon_discount = 0;
                                if (Session::get('coupon_discount') > 0) {
                                    $coupon_discount = Session::get('coupon_discount');
                                }
                            @endphp
                            @foreach (App\Models\Cart::where('user_id', Auth::guard('customer')->user()->id)->get() as $cart)
                                @php
                                    $product_prices = getProductDiscountedPrice($cart->product_id, 'retailer');
                                    $sub_total_amount =
                                        $sub_total_amount + $product_prices['selling_price'] * $cart->quantity;
                                    $total_discount =
                                        ($total_discount +
                                            $product_prices['selling_price'] -
                                            $product_prices['product_price']) *
                                        $cart->quantity;
                                    $total_amount = $total_amount + $product_prices['product_price'] * $cart->quantity;
                                    if (!empty($cart->lens_id)) {
                                        $total_lens = $total_lens + $cart->lens->price;
                                        $total_lens_discount =
                                            $total_lens_discount + lensDiscountPrice($cart->lens->id);
                                    }
                                @endphp
                            @endforeach
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <div id="addtocart_toast" class="addtocart_toast">
                                <div class="desc">Coupon Copy Successfully</div>
                            </div>
                            <div class="ec-sb-block-content">
                                @if (Session::has('coupon_discount'))
                                    <div class="ec-checkout-coupan-content w-100 mb-3">
                                        <form class="ec-checkout-coupan-form" name="ec-checkout-coupan-form"
                                            method="POST" action="{{ route('checkout.remove_coupon_code') }}">
                                            @csrf
                                            <input class="ec-coupan" type="text" name="code"
                                                value="{{ App\Models\Admin\Coupon::find(Session::get('coupon_id'))->code }}">
                                            <button class="ec-coupan-btn button btn-primary" type="submit"
                                                value="">Change</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="ec-checkout-coupan-content w-100 mb-4">
                                        <form class="ec-checkout-coupan-form" name="ec-checkout-coupan-form"
                                            method="POST" action="{{ route('checkout.apply_coupon_code') }}">
                                            @csrf
                                            <input class="ec-coupan" type="text" required=""
                                                placeholder="Enter Your Coupan Code" id="coupon_coupon_code"
                                                name="code" value="">
                                            <button class="ec-coupan-btn button btn-primary" type="submit"
                                                value="">Apply</button>
                                        </form>
                                        <a href="#" style="float:right; font-size:12px;" data-bs-toggle="modal" data-bs-target="#exampleModal"> View Coupan Details</a>
                                    </div>
                                @endif
                                <div class="side">
                                    <div class="card-header">
                                        <h55 class="mb-0">Suggested Coupon</h5>
                                    </div>
                                    <ul class="coupon">
                                        <div class="form-group">
                                            @foreach (App\Models\Admin\Coupon::get() as $coupon)
                                                <li id="coupon_{{ $coupon->id }}">
                                                    {{ $coupon->code }}
                                                    <form method="POST"
                                                        action="{{ route('checkout.apply_coupon_code') }}">
                                                        @csrf
                                                        <input type="hidden" name="code"
                                                            value="{{ $coupon->code }}">
                                                        <button type="submit" class="code">Apply </button>
                                                    </form>

                                                </li>
                                            @endforeach
                                        </div>
                                    </ul>
                                </div>
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Summery</h3>
                                </div>
                                <div class="ec-checkout-summary">
                                    <div>
                                        <span class="text-left">Item Total(F @if ($total_lens > 0)
                                                + L
                                            @endif)</span>
                                        <span class="text-right">₹{{ $sub_total_amount + $total_lens }}</span>
                                    </div>
                                    <div class="dscnt">
                                        <span class="text-left">Total Offer Discount</span>
                                        <span class="text-right">-
                                            ₹{{ $sub_total_amount + $total_lens - ($total_amount + $total_lens_discount) }}</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Net Item Total</span>
                                        <span class="text-right">₹{{ $total_amount + $total_lens_discount }}</span>
                                    </div>
                                    @if (Session::has('coupon_discount'))
                                        <div class="dscnt">
                                            <span class="text-left">Coupon
                                                ({{ App\Models\Admin\Coupon::find(Session::get('coupon_id'))->code }})
                                            </span>
                                            <span class="text-right">- ₹{{ Session::get('coupon_discount') }}</span>
                                        </div>
                                    @endif
                                    <div class="ec-checkout-summary-total">
                                        <span class="text-left">Total Payable</span>
                                        <span class="text-right"> <span class="badge badge-success"
                                                style="font-size: 10px;">You saved
                                                Rs.{{ $sub_total_amount + $total_lens - ($total_amount + $total_lens_discount) + $coupon_discount }}/-</span>
                                            ₹{{ $total_amount + $total_lens_discount - $coupon_discount }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ec-sidebar-wrap ec-check-pay-img-wrap">
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Payment Method</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-check-pay-img-inner">
                                    <div class="ec-check-pay-img">
                                        <img src="{{ asset('public/frontend/assets/images/icons/payment1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="{{ asset('public/frontend/assets/images/icons/payment2.png') }}"
                                            alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="{{ asset('public/frontend/assets/images/icons/payment3.png') }}"
                                            alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="{{ asset('public/frontend/assets/images/icons/payment4.png') }}"
                                            alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="{{ asset('public/frontend/assets/images/icons/payment5.png') }}"
                                            alt="">
                                    </div>
                                    <div class="ec-check-pay-img">
                                        <img src="{{ asset('public/frontend/assets/images/icons/payment6.png') }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="ec-sb-block-content">
                                <div><button onclick="make_order('razorpay')"
                                        class="btn btn-lg btn-primary w-100 mb-3">Pay to Online <i
                                            class="ecicon eci-chevron-right"></i></a></div>
                                <div><button onclick="make_order('COD')" class="btn btn-lg btn-info w-100">Place COD Order
                                        <i class="ecicon eci-chevron-right"></i></button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal Start-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Coupan Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <div class="offer-item-wrap">
                    <div class="cntr" aria-hidden="true">
                        <div class="cntr-strp--mid"><div>
                            <div class="ttl-wrpr">
                                <span class="xtra--ttl">NEW10</span><span class="item--ttl">Get ₹60 OFF</span>
                            </div>
                            <div class="item--dscrptn">Get 30% off up to ₹60 on orders of ₹200 or more</div>
                        </div>
                    </div>
                </div>
                <div class="btm--lnk">
                    <span class="btm--lnk__tnc">T&amp;C</span><span class="btm--lnk__aply">APPLY</span>
                </div>
            </div>
            <div class="mb-3">
                <div class="offer-item-wrap">
                    <div class="cntr" aria-hidden="true">
                        <div class="cntr-strp--mid"><div>
                            <div class="ttl-wrpr">
                                <span class="xtra--ttl">NEW10</span><span class="item--ttl">Get ₹60 OFF</span>
                            </div>
                            <div class="item--dscrptn">Get 30% off up to ₹60 on orders of ₹200 or more</div>
                        </div>
                    </div>
                </div>
                <div class="btm--lnk">
                    <span class="btm--lnk__tnc">T&amp;C</span><span class="btm--lnk__aply">APPLY</span>
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
{{-- Model End --}}
@endsection



<script>
    document.addEventListener("contextmenu", (e) => {
        e.preventDefault();
    }, false);

    document.addEventListener("keydown", (e) => {
        if (e.ctrlKey || e.keyCode == 123) {
            e.stopPropagation();
            e.preventDefault();
        }
    });
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    function get_address() {
        var pincode = $('#pincode').val()
        $.get("{{ route('get.address.by.pincode', '') }}" + "/" + pincode, function(data) {
            if (data) {
                $('#city').val(data.city.city)
                $('#state').val(data.state.state)
                $('#country').val(data.country.country)
            } else {
                $('#pincode').val('');
                $('#city').val('')
                $('#state').val('')
                $('#country').val('')
                $('#id').val('')
                alert('You have Enter Wrong Pincode!')
            }
        }).fail(function() {
            alert('You have Enter Wrong Pincode!')
        });
    }

    function make_order(type) {
        var shipping_address_id = $('input[name="address_select"]:checked').val();
        if (shipping_address_id) {
            if (type == 'COD') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('customer.store.order') }}",
                    data: {
                        shipping_address_id: shipping_address_id,
                        payment_type: type,
                    },
                    success: function(data) {
                        window.location.href = "{{ route('order.summary') }}";
                    }
                });
            }
            if (type == 'razorpay') {

                amount = "{{ $total_amount + $total_lens_discount - $coupon_discount }}";

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
                            url: "{{ route('payment.rozerpay') }}",
                            data: {
                                razorpay_payment_id: response.razorpay_payment_id,
                                shipping_address_id: shipping_address_id,
                                payment_type: type,
                            },
                            success: function(data) {
                                if (data == 1) {
                                    window.location.href = "{{ route('order.summary') }}";
                                }
                                if (data == 0) {
                                    location.reload();
                                }

                            }
                        });
                    },
                    "prefill": {
                        "name": "{{ Auth::guard('customer')->user()->first_name }}",
                        "email": "{{ Auth::guard('customer')->user()->email }}",
                        "contact": "{{ Auth::guard('customer')->user()->phone }}"
                    },
                    "theme": {
                        "color": "#EB5353"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            }

        } else {
            alert('Please Add Address');
        }
    }

    function CopyToClipboard(containerid) {
        var coupon = $('#' + containerid).text();
        $('#coupon_coupon_code').empty();
        $('#coupon_coupon_code').val(coupon);
        $("#addtocart_toast").addClass("show");
        setTimeout(function() {
            $("#addtocart_toast").removeClass("show")
        }, 3000);
    }


    function uploadFile(id) {
        var formData = new FormData();
        var file = document.getElementById("fileInput_" + id).files[0];
        formData.append("file", file);
        formData.append("cart_id", id);
        // Send AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('add.cart_file_upload') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("File uploaded successfully!");
            },
            error: function(xhr, status, error) {
                console.error("Error occurred while uploading file:", error);
            }
        });
    }
</script>
