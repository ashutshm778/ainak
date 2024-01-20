@extends('frontend.layouts.app')
@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    </div>
    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                @include('frontend.user_sidebar')
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Product History Details</h5>

                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card card-outline card-info">
                                        <div class="invoice p-3 mb-3">
                                            <div class="row invoice-info">
                                                <div class="col-sm-6 invoice-col">
                                                    <address>
                                                        <h4>Order Detail</h4>
                                                        <b>ID:</b> {{$order->order_id}}<br>
                                                        <b>Date:</b> {{$order->created_at->format('d-M-Y h:i A')}}<br>
                                                        <b>Status:</b>
                                                            <span class="badge bg-danger">{{ucwords($order->order_status)}}</span>
                                                    </address>
                                                </div>
                                                <div class="col-sm-6 invoice-col d-flex justify-content-end">
                                                    <address>
                                                        <h4>Customer Detail</h4>
                                                        <b>Name:</b> {{$order->customer->first_name}} {{$order->customer->last_name}}<br>
                                                        <b>Phone:</b> {{$order->customer->phone}}<br>
                                                        <b>Email:</b> {{$order->customer->email}}<br>
                                                        <b>Shipping Address:</b> {{json_decode($order->shipping_address)->address}} - {{json_decode($order->shipping_address)->pincode}} <br> {{json_decode($order->shipping_address)->city->city}} , {{json_decode($order->shipping_address)->state->state}} , {{json_decode($order->shipping_address)->country}}<br>
                                                    </address>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12 table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>S.N</th>
                                                                <th>Product Name</th>
                                                                <th>Price</th>
                                                                <th>Discount</th>
                                                                <th>Discounted Amount</th>
                                                                <th>Qty</th>
                                                                <th>Total Amount</th>
                                                                <th class="text-center">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $discount_amount = 0;
                                                                $total_final_amount = 0;
                                                                $total_lens=0;
                                                            @endphp
                                                            @foreach ($order->order_details as $key=>$order_detail)
                                                                <tr>
                                                                    <td>{{$key+1}}</td>
                                                                    <td>{{$order_detail->product->name}}<br>
                                                                        @if(!empty($order_detail->lens_name))
                                                                          {{$order_detail->lens_name}}
                                                                        @endif
                                                                    </td>
                                                                    <td>₹ {{$order_detail->mrp_price}}<br>
                                                                        @if(!empty($order_detail->lens_mrp))
                                                                        ₹   {{$order_detail->lens_mrp}}
                                                                        @endif
                                                                    </td>
                                                                    <td>₹ {{$order_detail->discounted_price}}</td>
                                                                    <td>{{$order_detail->price}}<br>
                                                                        @if(!empty($order_detail->lens_price))
                                                                        {{$order_detail->lens_price}}
                                                                        @endif
                                                                    </td>
                                                                    <td>{{$order_detail->quantity}}</td>
                                                                    <td class="d-flex justify-content-end">₹ {{$order_detail->price * $order_detail->quantity}}<br>
                                                                        @if(!empty($order_detail->lens_price))
                                                                        ₹  {{$order_detail->lens_price}}
                                                                        @endif</td>
                                                                    <td class="text-center">
                                                                            <span class="badge bg-danger">{{ucwords($order_detail->order_status)}}</span>
                                                                    </td>
                                                                    @php
                                                                        if($order_detail->order_status != 'cancel' && $order_detail->order_status != 'returned'){
                                                                            $discount_amount = ($discount_amount + $order_detail->discounted_price) * $order_detail->quantity;
                                                                            $total_final_amount = $total_final_amount + ($order_detail->price * $order_detail->quantity);
                                                                            $total_lens = $total_lens + $order_detail->lens_price;
                                                                        }
                                                                    @endphp
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8"></div>
                                                <div class="col-4">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Discount Amount:</th>
                                                                    <td class="d-flex justify-content-end">₹
                                                                        {{$discount_amount}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Total Lens:</th>
                                                                    <td class="d-flex justify-content-end">₹
                                                                        {{$total_lens}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Total Amount:</th>
                                                                    <td class="d-flex justify-content-end">₹
                                                                        {{$total_final_amount+$total_lens}}
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
    </section>
@endsection
