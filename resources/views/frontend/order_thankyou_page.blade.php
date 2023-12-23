@extends('frontend.layouts.app')
@section('content')
<style>
    #ec-progressbar {
        overflow: hidden;
        margin: 20px -32% 20px 10%;
    }
</style>

<div class="ec-trackorder-content col-md-12">
    <div class="ec-trackorder-inner">
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

    $sub_total=0;
    $total_lens=0;

@endphp
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="order-trackc text-center">
                        <h3>THANK YOU FOR YOUR ORDER!</h3>
                        <h4>Order Code: <span class="text-danger">{{$order->order_id}}</span></h4>
                        <p>A copy of your order summary has been sent to <b>{{Auth::guard('customer')->user()->email}}</b></p>
                        <div class="mb-4">
                            <u><h5>Order Summary</h5></u>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="w-50 fw-600"><b>Order Code:</b></td>
                                                <td>{{$order->order_id}}</td>
                                            </tr>
                                            @php
                                                $address = json_decode($order->shipping_address);
                                            @endphp
                                            <tr>
                                                <td class="w-50 fw-600"><b>Name:</b></td>
                                                <td>{{$address->name}}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-50 fw-600"><b>Email:</b></td>
                                                <td>{{Auth::guard('customer')->user()->email}}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-50 fw-600"><b>Shipping Address:</b></td>
                                                <td>{{$address->address}} {{$address->city->city}} {{$address->state->state}} {{$address->country}} - {{$address->pincode}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="w-50 fw-600"><b>Order Date:</b></td>
                                                <td>{{$order->created_at->format('d-M-Y h:i A')}}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-50 fw-600"><b>Order Status:</b></td>
                                                <td>Pending</td>
                                            </tr>
                                            <tr>
                                                <td class="w-50 fw-600"><b>Total order amount:</b></td>
                                                <td>₹ {{$order->grand_total}}</td>
                                            </tr>
                                            <tr>
                                                <td class="w-50 fw-600"><b>Payment method:</b></td>
                                                <td>
                                                    @if($order->payment_type == 'cod')
                                                        Cash On Delivery
                                                    @else
                                                        Razorpay
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">

                                </div>
                            </div>
                            <u><h5>Order Details</h5></u>
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
                                            @foreach ($order->order_details as $key=>$order_detail)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>
                                                        <a href="{{ route('search',$order_detail->product->slug) }}?type=product" target="_blank" class="text-reset">
                                                            {{$order_detail->product->name}}<br>
                                                            @if(!empty($order_detail->lens_name))
                                                            Lens : {{$order_detail->lens_name}}
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>{{$order_detail->quantity}}</td>
                                                    <td>{{$order_detail->mrp_price}}<br>
                                                        @if(!empty($order_detail->lens_mrp))
                                                        {{$order_detail->lens_mrp}}
                                                        @endif
                                                    </td>
                                                    <td>₹ {{$order_detail->price}}<br>
                                                        @if(!empty($order_detail->lens_price))
                                                        ₹ {{$order_detail->lens_price}}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @php
                                                
                                                  $sub_total=$sub_total+$order_detail->price;
                                                    if(!empty($order_detail->lens_price)){
                                                        $total_lens=$total_lens+$order_detail->lens_price;
                                                    }
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-5 col-md-6 ml-auto mr-0">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Product Subtotal</th>
                                                <td class="text-right">
                                                    <span class="fw-600">₹ {{$sub_total}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Total Lens</th>
                                                <td class="text-right">
                                                    <span class="fw-600">₹ {{$total_lens}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><span class="fw-600">TOTAL</span></th>
                                                <td class="text-right">
                                                    <strong><span>₹ {{$order->grand_total}}</span></strong>
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
    </section>
@endsection
