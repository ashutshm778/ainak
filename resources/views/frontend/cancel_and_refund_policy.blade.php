@extends('frontend.layouts.app')
@section('content')
<style>
    .lst-style li{
        list-style: auto;
        margin-left: 25px;
    }
</style>
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {{-- <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Cancel & Refund Policy</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Cancel & Refund Policy</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Start Privacy & Policy page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ec-common-wrapper">
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class=" mb-3">Refund/Exchange Policy </h3> 
                                <p>The Aynak offers you the chance to return, exchange, or get a refund for products purchased on <strong> www.aynak.in</strong>, provided you meet the following conditions:</p>
                            </div>
                        </div>
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <ol class="lst-style">
                                    <li>Initiate the return, exchange, or refund request within 72 hours of receiving the products through our Website or Whatsapp Service.</li>
                                    <li>Ensure the price tag, identification tag, invoice, and original packing are intact and returned.</li>
                                    <li>The product should be unused, undamaged, and free of scratches on the glasses, the frames are not bent or twisted, and all screws and embedments are intact. Return it with the original box, instructions, and guarantee.</li>
                                    <li>Return products with the invoice; without it, the product cannot be returned.</li>
                                    <li>Properly seal the return package before sending it to the company to avoid damages. Damaged products won't be considered for return or refund.</li>
                                    <li>Our experts will examine the return product to determine whether to accept or reject it.</li>
                                    <li>The company will only accept the return after expert confirmation, and then the refund process will be initiated.</li>
                                    <li>In Exchange case, if the same product is unavailable, the company will prioritize exchanging for a similar product or initiate a refund.</li>
                                    <li>Refund amounts for eyeglasses will exclude fixed shipping charges, reverse shipping charges, COD charges if applicable, and 50% of the lens price.</li>
                                    <li>For frames, sunglasses, and computer glasses, refund amounts will exclude fixed shipping charges, reverse shipping charges, COD charges if applicable, and a fixed convenience charge.</li>
                                    <li>The refund will be initiated within 15 days after expert confirmation, deducting applicable charges.</li>
                                    <li>Request a return, refund, or exchange on our website <b>www.aynak.in</b>  or contact Customer Care at <b>9219949495</b>  or email us on <b>aynakpvtltd@gmail.com</b>  .</li>
                                    <li>The applicable refund amount will be credited to the customer's bank account.</li>
                                    <li>As mentioned earlier, you have the option to either receive a refund or opt for a voucher. If these options are not suitable, you can exchange the item for the same product. If you decide on a different product of equal or lesser value, no additional payment is required. However, if you choose a higher-priced item than the returned product, the customer will have to pay the difference between the refund amount and the price of the new product.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Privacy & Policy page -->
@endsection
