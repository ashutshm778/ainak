@extends('frontend.layouts.app')
@section('content')

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {{-- <div class="row ec_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">About Us</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                                <li class="ec-breadcrumb-item active">About Us</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div> --}}
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
                                <p class="pt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                                <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
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
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                 </div>

                <div class="col-md-2">
                    <img class="a-img" src="{{asset('public/frontend/assets/images/mission.png')}}" alt="Vision">
                </div>
                <div class="col-md-10">
                    <h4>Vision</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
               </div>
              </div>
            </div>
        </div>
    </section>


    @endsection
