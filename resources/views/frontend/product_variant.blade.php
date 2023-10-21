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
@include('frontend.product_modal')