
<div class="col-md-3 col-6 brdr mb-3">
    <div class="slide-container">
        <div class="slide-header">
            <div class="wrap-additional-note">
                <img width="65" height="65"
                    src="{{ asset('public/frontend/assets/images/pres-doctor.svg')}}"
                    alt="EyeMyEye Instructions">
                <div class="additional-note-pres-upload">
                    Note: You can add your prescription after
                    placing the order.</div>
            </div>
            <img src="" alt="">
            <div class="title">
                Lens Features <span>
                </span>
            </div>
        </div>
        <div class="slide-content sidebar-featureList">
            <li class="featureList">
                <img width="20" class="feature-icon"
                    src="{{ asset('public/frontend/assets/images/lense-Warranty.svg')}}"
                    alt="Lens Warranty">
                Warranty Period
            </li>
            <li class="featureList">
                <img width="20" class="feature-icon"
                    src="{{ asset('public/frontend/assets/images/lense-index.svg')}}"
                    alt="Lenses">
                Index/Thickness
            </li>
            <li class="featureList powerElemLi">
                <img width="20" class="feature-icon"
                    src="{{ asset('public/frontend/assets/images/lense-power.svg')}}"
                    alt="Lenses">
                Power Range
            </li>
            <div class="staticFeature">
                <li class="active featureList Blue Light Blocker">
                    <img width="20" class="feature-icon"
                        src="{{ asset('public/frontend/assets/images/blue-light-blocker.svg')}}"
                        alt="blue-light-blocker">
                    <div class="icon-test-wrap"><span class="featrName">Blue Light
                            Blocker</span>
                    </div>
                </li>
                <li class="active featureList Anti Scratch Coating">
                    <img width="20" class="feature-icon"
                        src="{{ asset('public/frontend/assets/images/anti-scratch-coating.svg')}}"
                        alt="anti-scratch-coating">
                    <div class="icon-test-wrap"><span class="featrName">Anti
                            Scratch Coating</span>
                    </div>
                </li>
                <li class="active featureList Both Side Anti Glare Coating">
                    <img width="20" class="feature-icon"
                        src="{{ asset('public/frontend/assets/images/both-side-anti-glare-coating.svg')}}"
                        alt="both-side-anti-glare-coating">
                    <div class="icon-test-wrap"><span class="featrName">Both Side
                            Anti Glare Coating</span>
                    </div>
                </li>
                <li class="active featureList Both Side Anti Reflective Coating">
                    <img width="20" class="feature-icon"
                        src="{{ asset('public/frontend/assets/images/both-side-anti-reflective-coating.svg')}}"
                        alt="both-side-anti-reflective-coating">
                    <div class="icon-test-wrap"><span class="featrName">Both Side
                            Anti Reflective Coating</span>
                    </div>
                </li>
                <li class="active featureList UV Protection">
                    <img width="20" class="feature-icon"
                        src="{{ asset('public/frontend/assets/images/uv-protection.svg')}}"
                        alt="uv-protection">
                    <div class="icon-test-wrap"><span class="featrName">UV
                            Protection</span>
                    </div>
                </li>
                <li class="active featureList Water and Dust Repellent">
                    <img width="20" class="feature-icon"
                        src="{{ asset('public/frontend/assets/images/water-and-dust-repellent.svg')}}"
                        alt="water-and-dust-repellent">
                    <div class="icon-test-wrap"><span class="featrName">Water and
                            Dust Repellent</span>
                    </div>
                </li>
                <li class="active featureList Breakage &amp; Crack Resistant">
                    <img width="20" class="feature-icon"
                        src="{{ asset('public/frontend/assets/images/breakage--crack-resistant.svg')}}"
                        alt="breakage--crack-resistant">
                    <div class="icon-test-wrap"><span class="featrName">Breakage
                            &amp; Crack Resistant</span>
                    </div>
                </li>
            </div>
        </div>
        
        


        <h3 class="lens_origin_country" style="display: none;">Manufactured in
            India</h3>
    </div>
</div>

@foreach($lenses as $lens)
<div class="col-md-3 col-6 brdr mb-3">
    <div class="slide-container">
        <div class="slide-header">
            <div class="brand-logo">
                <img src="{{asset('public/'.api_asset($lens->icon))}}"
                    alt="diesel" width="100" height="27">
            </div>
            <div class="title">{{$lens->name}} </div>
            <div class="price price-modi">₹ {{$lens->price}}
            </div>
            <button class="btn btn-primary btn-ht w-100" onclick="buyLens('{{$lens->id}}')">Select This Lens </button>
            {{-- <div class="buy-one-get" style="">
                <svg xmlns="http://www.w3.org/2000/svg" width="12"
                    height="12" viewBox="0 0 12 12" fill="none">
                    <path
                        d="M11.1036 5.99984L11.7476 4.88684C11.825 4.75293 11.846 4.59377 11.8061 4.44434C11.7662 4.29491 11.6685 4.16746 11.5347 4.09001L10.4205 3.44601V2.16267C10.4205 2.00796 10.359 1.85959 10.2496 1.75019C10.1402 1.6408 9.99187 1.57934 9.83716 1.57934H8.55441L7.911 0.465757C7.83329 0.332125 7.70608 0.234468 7.55691 0.193924C7.48292 0.173866 7.40569 0.168694 7.32969 0.178708C7.25369 0.188721 7.18043 0.213721 7.11416 0.252257L6 0.896257L4.88583 0.251674C4.75185 0.174322 4.59263 0.15336 4.4432 0.193399C4.29376 0.233438 4.16635 0.331198 4.089 0.465174L3.445 1.57934H2.16225C2.00754 1.57934 1.85916 1.6408 1.74977 1.75019C1.64037 1.85959 1.57891 2.00796 1.57891 2.16267V3.44542L0.464746 4.08942C0.398265 4.12766 0.339995 4.17866 0.293284 4.23949C0.246573 4.30032 0.212341 4.36978 0.192556 4.44388C0.172771 4.51798 0.167823 4.59526 0.177995 4.67127C0.188167 4.74729 0.213259 4.82055 0.251829 4.88684L0.895829 5.99984L0.251829 7.11284C0.174823 7.24687 0.15393 7.40592 0.193705 7.55529C0.233481 7.70467 0.330699 7.83226 0.464163 7.91026L1.57833 8.55426V9.837C1.57833 9.99171 1.63979 10.1401 1.74918 10.2495C1.85858 10.3589 2.00695 10.4203 2.16166 10.4203H3.445L4.089 11.5345C4.14064 11.6228 4.21438 11.6961 4.30295 11.7472C4.39152 11.7984 4.49189 11.8256 4.59416 11.8262C4.69566 11.8262 4.79658 11.7993 4.88641 11.7474L5.99941 11.1034L7.11358 11.7474C7.24752 11.8247 7.40664 11.8456 7.55602 11.8057C7.7054 11.7658 7.83285 11.6683 7.91041 11.5345L8.55383 10.4203H9.83658C9.99129 10.4203 10.1397 10.3589 10.2491 10.2495C10.3585 10.1401 10.4199 9.99171 10.4199 9.837V8.55426L11.5341 7.91026C11.6004 7.8719 11.6586 7.82085 11.7052 7.76001C11.7519 7.69916 11.786 7.62973 11.8058 7.55567C11.8256 7.48162 11.8306 7.40439 11.8205 7.3284C11.8104 7.25242 11.7854 7.17917 11.747 7.11284L11.1036 5.99984ZM4.54108 3.07734C4.77322 3.07742 4.99582 3.16971 5.15992 3.33391C5.32401 3.49812 5.41616 3.72078 5.41608 3.95292C5.416 4.18507 5.32371 4.40767 5.15951 4.57176C4.9953 4.73586 4.77264 4.828 4.5405 4.82792C4.30835 4.82785 4.08575 4.73555 3.92166 4.57135C3.75756 4.40715 3.66542 4.18448 3.6655 3.95234C3.66557 3.7202 3.75787 3.4976 3.92207 3.3335C4.08627 3.16941 4.30894 3.07726 4.54108 3.07734ZM4.71608 8.67734L3.78275 7.97792L7.28275 3.31126L8.21608 4.01067L4.71608 8.67734ZM7.45775 8.91067C7.3428 8.91063 7.22899 8.88796 7.12281 8.84393C7.01663 8.79991 6.92016 8.7354 6.83891 8.6541C6.75766 8.57279 6.69321 8.47628 6.64926 8.37007C6.60531 8.26386 6.58271 8.15003 6.58275 8.03509C6.58278 7.92014 6.60546 7.80633 6.64949 7.70015C6.69351 7.59397 6.75801 7.4975 6.83932 7.41625C6.92063 7.335 7.01714 7.27056 7.12335 7.2266C7.22956 7.18265 7.34338 7.16005 7.45833 7.16009C7.69047 7.16017 7.91307 7.25246 8.07717 7.41666C8.24126 7.58087 8.33341 7.80353 8.33333 8.03567C8.33325 8.26781 8.24096 8.49042 8.07676 8.65451C7.91255 8.81861 7.68989 8.91075 7.45775 8.91067Z"
                        fill="#E5703C"></path>
                </svg> Get it at Rs.6433 Use code FLAT1000
            </div>
            <div class="specification-note">Top Seller</div> --}}
        </div>
        <div class="slide-content column-featureList">
            <li class="featureList">{{$lens->warranty_period}} Months</li>
            <li class="featureList">{{$lens->thickeness}}</li>
            <li class="featureList">upto +/-{{$lens->power_range}}</li>
            <li class="featureList">@if($lens->blue_light_blocker==1) <i class="ecicon eci-check"></i> @else x @endif</li>
            <li class="featureList"> @if($lens->anit_scratch_coating==1) <i class="ecicon eci-check"></i> @else x @endif</li>
            <li class="featureList"> @if($lens->b_anti_glare_coating==1) <i class="ecicon eci-check"></i> @else x @endif</li>
            <li class="featureList"> @if($lens->b_anti_reflective_coating==1) <i class="ecicon eci-check"></i> @else x @endif</li>
            <li class="featureList"> @if($lens->uv_protection==1) <i class="ecicon eci-check"></i> @else x @endif</li>
            <li class="featureList"> @if($lens->water_dust_replellent==1) <i class="ecicon eci-check"></i> @else x @endif</li>
            <li class="featureList"> @if($lens->brekage_crack_resistance==1) <i class="ecicon eci-check"></i> @else x @endif</li>
        </div>
    </div>
</div>
@endforeach
