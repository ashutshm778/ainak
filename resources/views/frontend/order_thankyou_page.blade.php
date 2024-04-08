@extends('frontend.layouts.app')
@section('content')
    <style>
        #ec-progressbar {
            overflow: hidden;
            margin: 20px -45% 20px 10%;
        }

        .table> :not(caption)>*>* {
            text-align: left;
        }
    </style>

    <section class="ec-page-content section-space-p">
        <div class="container">
            <!-- Track Order Content Start -->
            <div class="ec-trackorder-content col-md-10 m-auto">
                <div class="ec-trackorder-inner">
                    <div class="ec-trackorder-top">
                        <h2 class="ec-order-id">THANK YOU FOR YOUR ORDER!</h2>
                        <div class="ec-order-detail">
                            <div>Order Code: <span>{{ $order->order_id }}</span></div>
                        </div>
                    </div>
                    <div class="ec-trackorder-bottom">
                        <div class="ec-progress-track">
                            <ul id="ec-progressbar">
                                <li class="step0 active">
                                    <span class="ec-track-icon">
                                        <img src="{{ asset('public/frontend/assets/gif/cart.gif') }}" alt="track_order">
                                    </span>
                                    <span class="ec-progressbar-track"></span>
                                    <span class="ec-track-title">My Cart</span>
                                </li>
                                <li class="step0 active">
                                    <span class="ec-track-icon">
                                        <img src="{{ asset('public/frontend/assets/gif/map.gif') }}" alt="track_order">
                                    </span>
                                    <span class="ec-progressbar-track"></span>
                                    <span class="ec-track-title">Shipping Info</span>
                                </li>
                                <li class="step0 active">
                                    <span class="ec-track-icon">
                                        <img src="{{ asset('public/frontend/assets/gif/confirm.gif') }}" alt="track_order">
                                    </span>
                                    <span class="ec-progressbar-track"></span>
                                    <span class="ec-track-title">Confirmation</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php

                $sub_total = 0;
                $total_lens = 0;

            @endphp
                    <div class="row justify-content-center mt-3">
                        <div class="ec-shop-rightside col-lg-10">
                            <div class="ec-vendor-dashboard-card">
                                <div class="ec-vendor-card-header">
                                    <h5 class="text-center">Order Summary</h5>
                                </div>
                                <div class="ec-vendor-card-body pt-0">
                                    <div class="page-content">
                                        <div class="container px-0">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <hr class="row brc-default-l1 mx-n1 mb-4">
        
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="my-2">
                                                                <span class="text-sm text-grey-m2 align-middle"><b class="text-600">Order Code :</b> </span>
                                                                <span class="text-600 text-110 text-blue align-middle">{{ $order->order_id }}</span>
                                                            </div>
                                                            @php
                                                            $address = json_decode($order->shipping_address);
                                                        @endphp
                                                            <div class="my-2"><b class="text-600">Email: </b>{{ Auth::guard('customer')->user()->email }}</div>
                                                            <div class="my-2"><b class="text-600">Shipping Address: </b>{{ $address->address }} {{ $address->city->city }}
                                                                {{ $address->state->state }} {{ $address->country }} -
                                                                {{ $address->pincode }}</div>
                                                        </div>
                                                        <!-- /.col -->
        
                                                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                                            <hr class="d-sm-none">
                                                            <div class="text-grey-m2">
                                                                <div class="my-2"><b class="text-600">Order Date : </b> {{ $order->created_at->format('d-M-Y h:i A') }}</div>
                                                                <div class="my-2"><b class="text-600">Order Status : </b> Pending</div>
                                                                <div class="my-2"><b class="text-600">Total order amount : </b> ₹ {{ $order->grand_total }}</div>
                                                                <div class="my-2"><b class="text-600">Payment method : </b>  @if ($order->payment_type == 'cod')
                                                                    Cash On Delivery
                                                                @else
                                                                    Razorpay
                                                                @endif</div>
                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <div class="order-trackc text-center">
                                                        <div class="mb-1 mt-4">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Product</th>
                                                                                <th>Quantity</th>
                                                                                <th>MRP Price</th>
                                                                                <th>Discounted Price</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($order->order_details as $key => $order_detail)
                                                                                <tr>
                                                                                    <td>{{ $key + 1 }}</td>
                                                                                    <td>
                                                                                        <a href="{{ route('search', $order_detail->product->slug) }}?type=product"
                                                                                            target="_blank" class="text-reset">
                                                                                            {{ $order_detail->product->name }}<br>
                                                                                            @if (!empty($order_detail->lens_name))
                                                                                                Lens : {{ $order_detail->lens_name }}
                                                                                            @endif
                                                                                        </a>
                                                                                    </td>
                                                                                    <td>{{ $order_detail->quantity }}</td>
                                                                                    <td>{{ $order_detail->mrp_price }}<br>
                                                                                        @if (!empty($order_detail->lens_mrp))
                                                                                            {{ $order_detail->lens_mrp }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>₹ {{ $order_detail->price }}<br>
                                                                                        @if (!empty($order_detail->lens_price))
                                                                                            ₹ {{ $order_detail->lens_price }}
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                                @php
                        
                                                                                    $sub_total = $sub_total + $order_detail->price;
                                                                                    if (!empty($order_detail->lens_price)) {
                                                                                        $total_lens = $total_lens + $order_detail->lens_price;
                                                                                    }
                                                                                @endphp
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-4 col-md-6 ml-auto mr-0">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th>Item Total</th>
                                                                                <td class="text-right">
                                                                                    <span class="fw-600">₹ {{ $sub_total }}</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Total Lens</th>
                                                                                <td class="text-right">
                                                                                    <span class="fw-600">₹ {{ $total_lens }}</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Coupon Discount</th>
                                                                                <td class="text-right">
                                                                                    <span class="fw-600">₹ {{ $order->coupon_discount }}</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th><span class="fw-600">Total</span></th>
                                                                                <td class="text-right">
                                                                                    <strong><span>₹ {{ $order->grand_total }}</span></strong>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
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
                    </div>
                </div>
            </section>
        @endsection
