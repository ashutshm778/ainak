@extends('frontend.layouts.app')
@section('content')
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb"></div>
    <div class="breadcrumb">
    <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        {{-- <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">Contact Us</h2>
                        </div> --}}
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Contact Us</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec Contact Us page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
                        <div class="row mt-3 mb-3">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="contact-info-wrapper text-center mb-30">
                        <div class="contact-info-icon">
                            <i class="ecicon eci-map-marker"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Our Location</h5>
                            <p>Varanasi, Uttar Pradesh, India(221010)</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="contact-info-wrapper text-center mb-30">
                        <div class="contact-info-icon">
                            <i class="ecicon eci-phone"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Contact us Anytime</h5>
                            <p>Mobile: <a href="tel:+91-9219949495"> +91-9219949495 </a></p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="contact-info-wrapper text-center mb-30">
                        <div class="contact-info-icon">
                            <i class="ecicon eci-envelope"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Write Some Words</h5>
                            <p><a href="mailto:aynakpvtltd@gmail.com">aynakpvtltd@gmail.com</a></p>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="ec-common-wrapper">
                    <div class="ec-contact-leftside">
                        <div class="ec_contact_map">
                            <div class="ec_map_canvas">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28856.452348002145!2d82.965800740651!3d25.302304268062574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398e3206e0b28375%3A0xcae9d908d962a4b9!2sVaranasi%2C%20Uttar%20Pradesh%20221010!5e0!3m2!1sen!2sin!4v1693562243965!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="ec-contact-rightside">
                        <div class="ec-contact-container">
                            <div class="ec-contact-form">
                                <form action="#" method="post">
                                    <span class="ec-contact-wrap">
                                        <input type="text" name="name" placeholder="Enter Name" required />
                                    </span>
                                    <span class="ec-contact-wrap">
                                        <input type="email" name="email" placeholder="Enter Email" required />
                                    </span>
                                    <span class="ec-contact-wrap">
                                        <input type="text" name="phonenumber" placeholder="Enter Phone" required />
                                    </span>
                                    <span class="ec-contact-wrap">
                                        <label>Comments/Questions*</label>
                                        <textarea name="address" placeholder="Please leave your comments here.."></textarea>
                                    </span>
                                    <span class="ec-contact-wrap ec-contact-btn">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
