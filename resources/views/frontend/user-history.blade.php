@extends('frontend.layouts.app')
@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    </div>
    <div class="desk_hide">
    <a href="{{route('usermob_sidebar')}}" class="bck-btn"><i class="ecicon eci-arrow-left"></i> Back</a>
    </div>
    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12 mob_hide">
                @include('frontend.user_sidebar')
                </div>
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Product History</h5>
                            <div class="ec-header-btn">
                                <a class="btn btn-lg btn-primary" href="{{route('index')}}">Shop Now</a>
                            </div>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Order Status</th>
                                            <th scope="col">Payment Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $order_histories = App\Models\Order::where('user_id',Auth::guard('customer')->user()->id)->orderby('id','desc')->paginate(10);
                                        @endphp
                                        @foreach ($order_histories as $order_history)
                                            <tr>
                                                <th scope="row"><span>{{$order_history->order_id}}</span></th>
                                                <td><span>{{$order_history->created_at->format('d-M-Y h:i A')}}</span></td>
                                                <td><span>{{$order_history->grand_total}}</span></td>
                                                <td>
                                                    <small class="badge bg-@if($order_history->order_status=='pending')info @elseif($order_history->order_status=='confirm')success @elseif($order_history->order_status=='cancel')danger @elseif($order_history->order_status=='on_delivery')warning @endif"> {{ ucFirst($order_history->order_status) }}</small>
                                                </td>
                                                <td><small class="badge bg-@if($order_history->payment_status=='success')success @elseif($order_history->payment_status=='cancel')danger @elseif($order_history->payment_status=='pending')info @endif">{{ $order_history->payment_status }}</small></td>
                                                <td>
                                                    <span class="tbl-btn"><a class="btn btn-lg btn-primary" href="{{route('user_history_details',$order_history->id)}}">View</a></span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
