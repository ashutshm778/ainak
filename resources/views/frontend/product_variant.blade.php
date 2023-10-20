@php $product_price = homePrice($data->id); @endphp <div class="row">
  <div class="single-pro-img single-pro-img-no-sidebar">
    <div class="single-product-scroll">
      <div class="single-product-cover"> @php $gallery_images = explode(',', $data->gallery_image); @endphp @foreach ($gallery_images as $new_key => $gallery_image) <div class="single-slide zoom-image-hover">
          <img src="{{ asset('public/' . api_asset($gallery_image)) }}" class="img-responsive">
        </div> @endforeach </div>
      <div class="single-nav-thumb"> @foreach ($gallery_images as $new_key => $gallery_image) <div class="single-slide">
          <img src="{{ asset('public/' . api_asset($gallery_image)) }}" class="img-responsive" alt="">
        </div> @endforeach </div>
    </div>
  </div>
  <div class="single-pro-desc single-pro-desc-no-sidebar">
    <div class="single-pro-content">
      <h5 class="ec-single-title">{{ $data->name }}</h5>
      {{-- <div class="ec-single-rating-wrap">
						<div class="ec-single-rating">
							<i class="ecicon eci-star fill"></i>
							<i class="ecicon eci-star fill"></i>
							<i class="ecicon eci-star fill"></i>
							<i class="ecicon eci-star fill"></i>
							<i class="ecicon eci-star-o"></i>
						</div>
						<span class="ec-read-review">
							<a href="#ec-spt-nav-review">Be the first to
                        review this product</a>
						</span>
					</div> --}}
      <span class="in-stock">In Stock</span>
      <div class="ec-single-desc">{!! $data->description !!}</div>
      <div class="ec-single-price-stoke">
        <div class="ec-single-price"> @if ($product_price['selling_price'] != $product_price['product_price']) <span class="new-price">
            <del class="discount">{{ $product_price['selling_price'] }}</del>
            {{ $product_price['product_price'] }}
          </span> @else <span class="new-price"> {{ $product_price['product_price'] }}</span> @endif </div> @if ($data->sku) <div class="ec-single-stoke">
          <span class="ec-single-sku">SKU#: {{ $data->sku }}</span>
        </div> @endif
      </div>
      <div class="ec-pro-variation">
        <div class="ec-pro-variation-inner ec-pro-variation-size">
          <span>SIZE</span>
          <div class="ec-pro-variation-content">
            <ul>
              <li class="active">
                <span>S</span>
              </li>
              <li>
                <span>M</span>
              </li>
              <li>
                <span>L</span>
              </li>
              <li>
                <span>XL</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="ec-pro-variation-inner ec-pro-variation-color">
          <span>Color</span>
          <div class="ec-pro-variation-content">
            <ul>
              <li class="active">
                <span style="background-color:#1b4a87"></span>
              </li>
              <li>
                <span style="background-color:#5f94d6"></span>
              </li>
              <li>
                <span style="background-color:#72aea2"></span>
              </li>
              <li>
                <span style="background-color:#c79782"></span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="ec-single-qty">
        <!--<button type="button" class="btn btn-danger btn-number"-->
        <!--    onclick="update_qty('minus',{{ $data->id }},{{ $product_price['min_qty'] > 0 ? $product_price['min_qty'] : 'null' }},'form')">-->
        <!--    <span class="ecicon eci-minus"></span>-->
        <!--</button>-->
        <!--<input type="number" id="quantity" name="product_qty"-->
        <!--    class="form-control text-center qty_value_{{ $data->id }}"-->
        <!--    value="@if(!empty($pro_qty)){{ $pro_qty }}@else{{ !empty($product_quanity)?$product_quanity :'1'}}@endif"-->
        <!--    min="{{ $data->retailer_min_qty }}"-->
        <!--    max="{{ $product_price['max_qty'] > 0 ? $product_price['max_qty'] : 'null' }}"-->
        <!--    style="width:110px; padding: 0 10px; height: 45px;" onchange="change_quantitiy_price()">-->
        <!--<button type="button" class="btn btn-danger btn-number btn-number"-->
        <!--    onclick="update_qty('plus',{{ $data->id }},{{ $product_price['max_qty'] > 0 ? $product_price['max_qty'] : 'null' }},'form')">-->
        <!--    <span class="ecicon eci-plus"></span>-->
        <!--</button>-->
        <input type="hidden" name="product_id" value="{{ $data->id }}">
        <input type="hidden" name="product_group_id" value="{{ $data->product_group_id }}">
        <div class="ec-single-cart ">
          <button type="button" class="btn btn-primary" onclick="addtocart({{ $data->id }},'product_detail_form')">
            <i class="ecicon eci-shopping-cart"></i> Buy Frame Only At ₹1490 </button>
        </div>
        <div class="ec-single-cart ">
          <button type="button" class="btn btn-primary" data-link-action="quickview" title="Quick view" data-bs-toggle="modal" data-bs-target="#ec_quickview_modal">
            <i class="ecicon eci-shopping-cart"></i> Select Lens & buy now </button>
        </div>
        <!--<div class="ec-single-wishlist">-->
        <!--    <a class="ec-btn-group wishlist" title="Wishlist">-->
        <!--        <i class="ecicon eci-heart-o"></i>-->
        <!--    </a>-->
        <!--</div>-->
      </div>
      <!--<div class="ec-single-social">-->
      <!--  <ul class="mb-0">-->
      <!--    <li class="list-inline-item facebook">-->
      <!--      <a href="#">-->
      <!--        <i class="ecicon eci-facebook"></i>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li class="list-inline-item twitter">-->
      <!--      <a href="#">-->
      <!--        <i class="ecicon eci-twitter"></i>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li class="list-inline-item instagram">-->
      <!--      <a href="#">-->
      <!--        <i class="ecicon eci-instagram"></i>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li class="list-inline-item youtube-play">-->
      <!--      <a href="#">-->
      <!--        <i class="ecicon eci-youtube-play"></i>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--    <li class="list-inline-item whatsapp">-->
      <!--      <a href="#">-->
      <!--        <i class="ecicon eci-whatsapp"></i>-->
      <!--      </a>-->
      <!--    </li>-->
      <!--  </ul>-->
      <!--</div>-->
    </div>
    <div class="row mt-2">

								<div class="col-lg-4 col-md-6 col-sm-6 col-xs-4">
					<!-- START single card -->
					<div class="ec-product-tp m-0">
						<div class="ec-product-image">
							<a href="#">
								<img src="{{ asset('public/frontend/assets/images/delivery.png')}}" class="img-center" alt="" style="width:75px">
							</a>
						</div>
						<div class="ec-product-body">
							<h3 class="ec-title"><a href="#">Free Delivery</a></h3>
						</div>
					</div>
					<!-- START single card -->
				</div>
								<div class="col-lg-4 col-md-6 col-sm-6 col-xs-4">
					<!-- START single card -->
					<div class="ec-product-tp">
						<div class="ec-product-image">
							<a href="#">
								<img src="{{ asset('public/frontend/assets/images/alter.png')}}" class="img-center" alt="" style="width:75px">
							</a>
						</div>
						<div class="ec-product-body">
							<h3 class="ec-title"><a href="#">7 Days Free Return</a></h3>
						</div>
					</div>
					<!-- START single card -->
				</div>
								<div class="col-lg-4 col-md-6 col-sm-6 col-xs-4">
					<!-- START single card -->
					<div class="ec-product-tp">
						<div class="ec-product-image">
							<a href="#">
								<img src="{{ asset('public/frontend/assets/images/warranty.png')}}" class="img-center" alt="" style="width:75px">
							</a>
						</div>
						<div class="ec-product-body">
							<h3 class="ec-title"><a href="#">1 Year Warranty</a></h3>
						</div>
					</div>
					<!-- START single card -->
				</div>
			</div>
  </div>
</div>
<!--Model Start-->
<div class="modal custom-Modal fade " id="ec_quickview_modal" tabindex="-1" role="dialog" aria-modal="true">
  <div class="modal-dialog full_modal-dialog">
    <div class="modal-content">
      <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-sm-12 col-xs-12 m-auto">
            <div class="form-container">
              <h2 class="text-center form-title mb-4">Select Power Type</h2>
              <form action="#" id="power-type-form" <div class="form-group custom-Modal">
                <div>
                  <input type="radio" id="radioPowered" class="radio-custom" name="radio-group" value="powered-eyeglasses" data-type="POWERED EYEGLASSES">
                  <label for="radioPowered" data-main-category="singlevision" class="enable">
                    <div class="label-inner">
                      <div class="label-inner-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="30" viewBox="0 0 42 30" fill="none">
                          <g clip-path="url(#clip0)">
                            <rect width="40.781" height="29.453" transform="translate(0.354858 0.23822)" fill="white"></rect>
                            <path d="M15.3223 29.6911C13.7569 29.6911 12.2416 29.4417 10.8179 28.9499C9.43442 28.4719 8.13445 27.764 6.9535 26.8462C4.64982 25.0553 2.8101 22.4591 1.63355 19.3388C0.598339 16.592 0.170267 13.6149 0.428062 10.9549C0.55696 9.62587 0.849909 8.40924 1.29885 7.33836C1.76977 6.21476 2.40107 5.28159 3.17446 4.56487C4.44696 3.38596 6.59098 2.41104 9.54757 1.66758C12.1783 1.00616 15.3963 0.551666 18.8538 0.352801C25.8982 -0.0518888 32.8224 0.628576 36.9251 2.12831C39.4987 3.06916 40.8961 4.29935 41.0791 5.78443C41.3135 7.68812 40.8188 10.1086 39.6481 12.7846C38.4767 15.4626 36.7457 18.124 34.6427 20.4807C32.0526 23.3831 29.0997 25.6534 25.8656 27.2286C22.5106 28.8627 18.9633 29.6911 15.3223 29.6911ZM22.8182 1.33834C21.5208 1.33834 20.2131 1.37533 18.9168 1.44967C11.7311 1.86279 6.12519 3.32846 3.92111 5.37095C2.612 6.58392 1.75988 8.6048 1.52149 11.0611C1.27945 13.5567 1.68445 16.3587 2.6618 18.9509C3.76695 21.8819 5.484 24.3119 7.62802 25.9786C8.71376 26.8224 9.90753 27.4729 11.1767 27.9112C12.4847 28.3632 13.8796 28.5921 15.3223 28.5921C18.7952 28.5921 22.1806 27.801 25.3844 26.2408C28.4893 24.729 31.3283 22.5448 33.8228 19.7493C35.8496 17.4779 37.5158 14.9172 38.6414 12.3444C39.7177 9.88479 40.1959 7.60279 39.9883 5.91884C39.8616 4.89082 38.6718 3.93714 36.5472 3.16036C34.5735 2.43887 31.848 1.89978 28.6658 1.60166C26.7964 1.4266 24.8197 1.33834 22.8182 1.33834Z" fill="#3B4864"></path>
                          </g>
                          <defs>
                            <clipPath id="clip0">
                              <rect width="40.781" height="29.453" fill="white" transform="translate(0.354858 0.23822)"></rect>
                            </clipPath>
                          </defs>
                        </svg>
                      </div>
                      <div class="label-inner-content">
                        <p class="option-title">Single Vision/Powered Eyeglasses</p>
                        <p class="small-text">For distance or near vision.</p>
                      </div>
                    </div>
                  </label>
                </div>
                <div>
                  <input type="radio" id="radioZeroPower" class="radio-custom" name="radio-group" value="zero-power-eyeglasses" data-type="ZERO POWER EYEGLASSES">
                  <label for="radioZeroPower" data-main-category="zeropower" class="enable">
                    <div class="label-inner">
                      <div class="label-inner-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="52" height="22" viewBox="0 0 52 22" fill="none">
                          <path d="M52 7.14204H49.9462C49.5941 5.7389 48.8898 4.52794 47.9505 3.44334C46.1899 1.40314 43.6071 0.254477 40.614 0.0631806L12.3252 0C8.92107 0 5.98615 1.21184 4.04945 3.44334C3.11099 4.52794 2.40673 5.7389 2.0538 7.14204H0V8.35387H1.87774C1.76063 9.2463 1.70167 10.1396 1.70167 11.032C1.93669 17.2176 6.63144 22 12.3834 22C14.203 22 15.6115 21.8087 16.785 21.3621C18.4285 20.8522 19.7199 19.5763 20.4241 17.9819C21.1873 16.1962 22.1258 13.2627 22.713 11.1584C23.1822 9.62802 22.948 7.65099 22.0087 5.92932C20.7763 3.5697 18.7216 1.72079 16.3157 0.764309H35.6835C33.3357 1.78485 31.2819 3.50652 29.9905 5.92932C29.0512 7.71505 28.817 9.56396 29.2862 11.1584C29.9315 13.2627 30.8708 16.2602 31.5751 17.9819C32.2793 19.5123 33.5707 20.7241 35.2142 21.3621C36.3877 21.7446 37.8552 22 39.6158 22C45.3678 22 50.0625 17.2176 50.2975 11.032C50.3565 10.0755 50.2975 9.18312 50.1215 8.35387H51.941C52 8.35387 52 7.14204 52 7.14204ZM20.9523 6.6322C21.7155 8.03534 21.9497 9.56571 21.5976 10.7776C21.2455 12.0526 20.1302 15.56 19.3088 17.4729C18.7216 18.6848 17.7242 19.7044 16.4328 20.087C15.3764 20.4056 14.085 20.5969 12.3834 20.5969C7.21859 20.6609 3.11018 16.5156 2.81701 10.968C2.6999 8.35387 3.46231 6.12149 4.92977 4.33577C6.63144 2.35874 9.2732 1.27502 12.3244 1.27502C15.8465 1.27502 19.1917 3.38016 20.9523 6.6322ZM49.242 10.968C49.0069 16.5156 44.9575 20.6609 39.7337 20.6609C38.0321 20.6609 36.7407 20.4696 35.6843 20.1511C34.3929 19.7685 33.3955 18.748 32.8083 17.537C31.987 15.624 30.9306 12.1807 30.5195 10.8416C30.1674 9.62977 30.4024 8.16346 31.1648 6.69626C32.9254 3.44422 36.2706 1.40314 39.7337 1.40314C42.7858 1.40314 45.4267 2.48686 47.1284 4.46388C48.5958 6.05831 49.3001 8.35387 49.242 10.968Z" fill="#3B4864"></path>
                        </svg>
                      </div>
                      <div class="label-inner-content">
                        <p class="option-title">Zero Power Eyeglasses</p>
                        <p class="small-text">Fashion or Protection from Glare/Computer Screens etc. </p>
                      </div>
                      <p></p>
                    </div>
                  </label>
                </div>
                <div>
                  <input type="radio" id="radioBifocalProgressive" class="radio-custom" name="radio-group" value="bifocalprogressive-eyeglasses" data-type="BIFOCAL/PROGRESSIVE EYEGLASSES">
                  <label for="radioBifocalProgressive" data-main-category="bifocal" class="enable">
                    <div class="label-inner">
                      <div class="label-inner-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="33" viewBox="0 0 45 33" fill="none">
                          <g clip-path="url(#clip0)">
                            <path d="M16.9373 32.2297C15.2558 32.2297 13.6283 31.9611 12.0991 31.4314C10.6132 30.9167 9.21695 30.1543 7.94852 29.166C5.4742 27.2373 3.4982 24.4414 2.23449 21.081C1.1226 18.123 0.662819 14.9168 0.93971 12.0522C1.07816 10.6209 1.39281 9.31072 1.875 8.15748C2.3808 6.94744 3.05887 5.94249 3.88955 5.17064C5.2563 3.90104 7.55914 2.85113 10.7347 2.05048C13.5603 1.33819 17.0167 0.848727 20.7304 0.634564C28.2965 0.198744 35.7336 0.931552 40.1403 2.54665C42.9045 3.55988 44.4053 4.88469 44.602 6.48401C44.8537 8.53414 44.3223 11.1408 43.0649 14.0227C41.8067 16.9066 39.9475 19.7728 37.6888 22.3108C34.9069 25.4364 31.7352 27.8814 28.2615 29.5777C24.658 31.3376 20.848 32.2297 16.9373 32.2297ZM24.9883 1.69591C23.5948 1.69591 22.1903 1.73575 20.798 1.81581C13.0801 2.2607 7.05885 3.83912 4.69151 6.03873C3.28542 7.345 2.37018 9.52134 2.11414 12.1666C1.85416 14.8541 2.28916 17.8717 3.33891 20.6633C4.52592 23.8198 6.37016 26.4367 8.673 28.2316C9.83917 29.1403 11.1214 29.8408 12.4846 30.3129C13.8895 30.7996 15.3876 31.0461 16.9373 31.0461C20.6674 31.0461 24.3036 30.1942 27.7447 28.514C31.0796 26.8859 34.1289 24.5336 36.8081 21.5231C38.9851 19.077 40.7747 16.3193 41.9837 13.5486C43.1397 10.8998 43.6533 8.44224 43.4303 6.62876C43.2942 5.52166 42.0164 4.49462 39.7344 3.65809C37.6144 2.8811 34.687 2.30054 31.2691 1.97949C29.2613 1.79096 27.1382 1.69591 24.9883 1.69591Z" fill="#3B4864"></path>
                            <path d="M5.24133 25.0439C9.03749 20.4619 20.0464 14.1918 33.7125 25.7674" stroke="#5A5A5A" stroke-dasharray="3 3"></path>
                          </g>
                          <defs>
                            <clipPath id="clip0">
                              <rect width="43.8019" height="31.7186" fill="white" transform="translate(0.861084 0.511139)"></rect>
                            </clipPath>
                          </defs>
                        </svg>
                      </div>
                      <div class="label-inner-content">
                        <p class="option-title">Bifocal/Progressive Eyeglasses</p>
                        <p class="small-text">Distance &amp; Near vision in same lenses. </p>
                      </div>
                    </div>
                  </label>
                </div>
            </div>
            <div class="form-group text-center w-100">
              <!-- <input type="button" value="BACK" class="btn btn-default back"> -->
              <input type="button" value="CONTINUE" class="btn btn-primary">
            </div>
            </form>
          </div>
          <div class="col-md-10 col-sm-12 col-xs-12 m-auto mt-4">
            <table class="table table-bordered table-striped ">
              <tbody>
                <tr>
                  <th scope="col" class="text-center pln-ylw">Lens Features</th>
                  <th scope="col" class="text-center pln-ylw">Anti Glare Lenses </th>
                  <th scope="col" class="text-center pln-grn">Gkb Thin Blue </th>
                  <th scope="col" class="text-center pln-blu">Gkb Blue </th>
                  <th scope="col" class="text-center pln-red">Non Anti Glare </th>
                </tr>
                <tr class="text-center">
                  <th scope="row">Warranty Period</th>
                  <td>6 Month</td>
                  <td>6 Month</td>
                  <td>6 Month</td>
                   <td>6 Month</td>
                </tr>
                <tr class="text-center">
                  <th scope="row">Index/Thickness</th>
                  <td>90 days</td>
                  <td>180 days</td>
                  <td>270 days</td>
                  <td>360 days</td>
                </tr>
                <tr class="text-center">
                  <th scope="row">Power Range</th>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                </tr>
                <tr class="text-center">
                  <th scope="row">Blue Light Blocker</th>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                </tr>
                <tr class="text-center">
                  <th scope="row">Anti Scratch Coating</th>
                  <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                </tr>
                <tr class="text-center">
                  <th scope="row">Both Side Anti Glare Coating</th>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                </tr>
                <tr class="text-center">
                  <th scope="row">Both Side Anti Reflective Coating</th>
                  <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                </tr>
                <tr class="text-center">
                  <th scope="row">UV Protection </th>
                  <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                </tr>
                <tr class="text-center">
                  <th scope="row">Water and Dust Repellent</th>
                  <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
                  </td>
                </tr>
                <tr class="text-center">
                  <th scope="row">Breakage & Crack Resistant</th>
                   <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-times"></i>
                  </td>
                  <td>
                    <i class="ecicon eci-check"></i>
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
<!--End Modal-->