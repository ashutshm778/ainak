@extends('frontend.layouts.app')
@section('content')
    <style>
        .ec-register-wrapper {
            max-width: 934px;
            margin: 0 auto 0;
        }
        hr:not([size]) {
            height: 1px;
            border-bottom: 1px solid;
            margin-left: 10px;
            margin-right: 34px;
            width: 97%;
        }
    </style>
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    </div>
    <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <!-- <div class="col-md-6 col-4">
                                <h2 class="ec-breadcrumb-title">About Us</h2>
                            </div> -->
                        <div class="col-md-6 col-8">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">Repair your eyeglasses</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec About Us page -->
    <section class="ec-page-content section-space-p mb-3 rs-login">
        <div class="container">
            <div class="row">
                <div class="col-md-10 m-auto">
                    <h3 class="text-center">Fill your lense details</h3> <hr><br>
                    <!-- Login Form -->
                    <div class="noticed">
                        <div class="main-part">
                            <div class="method-account">
                                <form method="post" action="" enctype="multipart/form-data"> 
                                    <div class="row clearfix">
                                        <!-- Form Group -->
                                        <div class="col-lg-12">
                                            <div class="form-group floating-label mb-25">
                                                <input type="text" name="name" value="" placeholder="Full Name"
                                                    required="">
                                                <label for="text-placeholder">Name *</label>
                                            </div>
                                        </div>
                                        <h5 style="text-align: left;">Address</h5><hr/>
                                        <div class="col-lg-6">
                                            <div class="form-group floating-label mb-25">
                                                <input type="text" name="house_no" value=""
                                                    placeholder="House No." required="">
                                                <label for="text-placeholder">House No.*</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group floating-label mb-25">
                                                <input type="text" name="pincode" value=""
                                                    placeholder="Enter Your 6 Digit Pincode"
                                                    onkeypress="if(this.value.length==6) return false;" required="">
                                                <label for="text-placeholder">Pincode *</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group floating-label mb-25">
                                                <select class="form-select" id="city" name="district" value=""
                                                    required="">
                                                    <option value="">Select City</option>
                                                    <option value="Varanasi">Varanasi </option>
                                                    <option value="Lucknow">Lucknow</option>
                                                    <option value="Prayagraj">Prayagraj</option>
                                                    <option value="Kanpur">Kanpur</option>
                                                    <option value="Mughalsarai">Mughalsarai</option>
                                                    <option value="Mirzapur">Mirzapur</option>
                                                    <option value="Jaunpur">Jaunpur</option>
                                                    <option value="Gazipur">Gazipur</option>
                                                    <option value="Azamgarh">Azamgarh</option>
                                                </select>
                                                <label for="text-placeholder">City *</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group floating-label mb-25">
                                                <select class="form-select" id="state" name="state" value=""
                                                    required="">
                                                    <option value="">Select State</option>
                                                    <option value="UP">UP </option>
                                                </select>
                                                <label for="text-placeholder">State *</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group floating-label mb-25">
                                                <input type="text" name="landmark" value="" placeholder="Landmark"
                                                    required="">
                                                <label for="text-placeholder">Landmark *</label>
                                            </div>
                                        </div>
                                        <h5 style="text-align: left;">Your power detail</h5><hr/>
                                        <div class="col-lg-6">
                                            <div class="form-group floating-label mb-25">
                                                <input type="text" name="left_eye_lense" value="" placeholder="Left eye lense"
                                                    required="">
                                                <label for="text-placeholder">Left eye lense *</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group floating-label mb-25">
                                                <input type="text" name="power_left" value="" placeholder="Power Left"
                                                    required="">
                                                <label for="text-placeholder">Power Left *</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group floating-label mb-25">
                                                <input type="text" name="right_eye_lense" value="" placeholder="Right eye lense"
                                                    required="">
                                                <label for="text-placeholder">Right eye lense *</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group floating-label mb-25">
                                                <input type="text" name="power_right" value="" placeholder="Power Right "
                                                    required="">
                                                <label for="text-placeholder">Power Right *</label>
                                            </div>
                                        </div>
                                        <h5 style="text-align: left;">OR</h5><hr/>
                                        <div class="col-lg-12 mt-2">
                                            <div class="form-group floating-label mb-25">
                                                <input type="file" name="profile_img"
                                                    accept="image/png, image/jpg, image/jpeg" required="">
                                                <label for="text-placeholder">Upload your Prescription *</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <div class="form-group floating-label mb-25">
                                                <select class="form-select" id="city" name="district" value=""
                                                    required="">
                                                    <option value="">Glass Types</option>
                                                    <option value="1">1 </option>
                                                    <option value="2">2</option>
                                                </select>
                                                <label for="text-placeholder">Glass Types *</label>
                                            </div>
                                        </div>
                                        <span class="ec-contact-wrap ec-contact-btn mt-3">
                                            <button class="btn btn-primary" type="submit">Book your Pickup</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
