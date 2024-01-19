@extends('frontend.layouts.app')
@section('content')

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb"></div>
    <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                   <div class="row ec_breadcrumb_inner">
                        {{-- <div class="col-md-6 col-sm-12">
                            <h2 class="ec-breadcrumb-title">FAQ</h2>
                        </div> --}}
                        <div class="col-md-6 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list">
                                <li class="ec-breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="ec-breadcrumb-item active">FAQ</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec FAQ page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">FAQ</h2>
                        <h2 class="ec-title">FAQ</h2>
                        <p class="sub-title mb-3">Customer service management</p>
                    </div>
                </div>
                <div class="ec-faq-wrapper">
                    <div class="accordion accordion-flush" id="accordionExample">
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    1. How Do I Change My Billing Information?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Morbi non dui tristique, porttitor tellus vitae, dapibus risus. Suspendisse eros erat,
                                    rhoncus sit amet lobortis vel, lacinia fermentum tortor. Sed nec pellentesque urna.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    2. How Does Payment System Work?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Morbi non dui tristique, porttitor tellus vitae, dapibus risus. Suspendisse eros erat,
                                    rhoncus sit amet lobortis vel, lacinia fermentum tortor. Sed nec pellentesque urna.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    3. How Do I Cancel My Account?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Morbi non dui tristique, porttitor tellus vitae, dapibus risus. Suspendisse eros erat,
                                    rhoncus sit amet lobortis vel, lacinia fermentum tortor. Sed nec pellentesque urna.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    4. How Do I Cancel My Account?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Morbi non dui tristique, porttitor tellus vitae, dapibus risus. Suspendisse eros erat,
                                    rhoncus sit amet lobortis vel, lacinia fermentum tortor. Sed nec pellentesque urna.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    5. How Do I Cancel My Account?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Morbi non dui tristique, porttitor tellus vitae, dapibus risus. Suspendisse eros erat,
                                    rhoncus sit amet lobortis vel, lacinia fermentum tortor. Sed nec pellentesque urna.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection
