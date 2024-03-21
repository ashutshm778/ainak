@extends('frontend.layouts.app')
@section('content')

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
                                <li class="ec-breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                                <li class="ec-breadcrumb-item active">About Us</li>
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
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-common-wrapper">
                    <div class="row">
                        <div class="col-md-5 ec-cms-block ec-abcms-block text-center">
                            <div class="ec-cms-block-inner">
                               <img class="a-img" src="{{asset('public/frontend/assets/images/face-shape.webp')}}" alt="about">
                            </div>
                        </div>
                        <div class="col-md-7 ec-cms-block ec-abcms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title mb-30 text-left">About Of Ainak</h3> <br>
                                <p class="pt-2">AYNAK focus to enhance people's lives by providing innovative eyewear solutions. Established in 2023,
                                    we're renowned for our stylish eyewear, friendly staff, and vibrant work environment. Our passion lies in
                                    improving vision clarity, offering a diverse selection of over 1000 trendy Eyeglasses, Sunglasses, Power
                                    Sunglasses, Contact Lenses, Reading Glasses, Computer Glasses, and more!</p>
                                <p>We seamlessly blend fashion and functionality, ensuring you never feels out of place with bulky or
                                    mundane glasses. From staying ahead of the latest eyewear trends to providing affordable and accessible
                                    eyewear, we're committed to being your go-to destination for all things vision-related. Whether you need
                                    assistance choosing the perfect pair or guidance on sizing, our dedicated team is here to support you every
                                    step of the way.</p>
                                <p>AYNAK proudly presents exclusive eyewear collections for men, women, and kids, featuring over 1000+
                                    unique designs. With a loyal customer base of 1000+, we're dedicated to ensuring you fall in love with
                                    your glasses time and time again!</p>
                                <p>With us, you can effortlessly receive your order within 48 hours, along with access to various services
                                    such as glass repairs, eye tests by appointment, consultations, and more, all listed on aynak.in. We cater to
                                    your needs both individually and through our partnership with Apnidawaa, ensuring you feel confident in
                                    trusting us to elevate your Fashionista with latest Spectacles.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Services Section Start -->
    <section class="section mission-vision pb-6">
        <h2 class="d-none">Services</h2>
        <div class="container">
            <div class="row">
                 <div class="col-md-2">
                    <img class="a-img" src="{{asset('public/frontend/assets/images/mission.png')}}" alt="Mission">
                 </div>
                 <div class="col-md-10">
                    <h4>Mission</h4>
                    <p>Our mission of #ChloUnkiAnkhoKaKhyalRakhteHai_JinhoneHmeDuniyaDekhnaSikhayaHai inspires our
                        daily endeavors, motivating us to unite, tackle challenges, and create a brighter future for all, both within
                        and beyond our AynakCrew. We champion taking risks and view failure as a mere pause, not the end of
                        the road.</p>
                 </div>
              </div>
            </div>
        </div>
    </section>


    @endsection
