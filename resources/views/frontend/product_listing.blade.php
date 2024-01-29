@extends('frontend.layouts.app')
@section('content')

<div class="breadcrumb-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item opacity-50">
                     <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
                  </li>
                  @if(!isset($category_id) && !isset($subcategory_id) && !isset($subsubcategory_id))
                  <li class="breadcrumb-item fw-600  text-dark">
                     <a class="text-reset" href="{{ route('products') }}">"{{ translate('All Categories')}}"</a>
                  </li>
                  @else
                  <li class="breadcrumb-item opacity-50">
                     <a class="text-reset" href="{{ route('products') }}">{{ translate('All Categories')}}</a>
                  </li>
                  @endif
                  @if(isset($category_id))
                  <li class="text-dark fw-600 breadcrumb-item">
                     <a class="text-reset" href="{{ route('products.category', \App\Category::find($category_id)->slug) }}">"{{ \App\Category::find($category_id)->getTranslation('name') }}"</a>
                  </li>
                  @endif
                  @if(isset($subcategory_id))
                  <li class="breadcrumb-item opacity-50">
                     <a class="text-reset" href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}">{{ \App\SubCategory::find($subcategory_id)->category->getTranslation('name') }}</a>
                  </li>
                  <li class="text-dark fw-600 breadcrumb-item">
                     <a class="text-reset" href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}">"{{ \App\SubCategory::find($subcategory_id)->getTranslation('name') }}"</a>
                  </li>
                  @endif
                  @if(isset($subsubcategory_id))
                  <li class="breadcrumb-item opacity-50">
                     <a class="text-reset" href="{{ route('products.category', \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->slug) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->getTranslation('name') }}</a>
                  </li>
                  <li class="breadcrumb-item opacity-50">
                     <a class="text-reset" href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}">{{ \App\SubsubCategory::find($subsubcategory_id)->subcategory->getTranslation('name') }}</a>
                  </li>
                  <li class="text-dark fw-600 breadcrumb-item">
                     <a class="text-reset" href="{{ route('products.subsubcategory', \App\SubSubCategory::find($subsubcategory_id)->slug) }}">"{{ \App\SubSubCategory::find($subsubcategory_id)->getTranslation('name') }}"</a>
                  </li>
                  @endif
               </ul>
            </div>
        </div>
    </div>
</div>

<section class="product">
   <div class="container-fluid sm-px-0">
      <form class="" id="search-form" action="{{ route('search') }}" method="GET">
         <div class="row">
            <div class="side col-xl-3">
               <div class="aiz-filter-sidebar collapse-sidebar-wrap sidebar-xl sidebar-right z-1035">
                  <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".aiz-filter-sidebar" data-same=".filter-sidebar-thumb"></div>
                  <div class="collapse-sidebar c-scrollbar-light text-left">
                     <div class="d-flex d-xl-none justify-content-between align-items-center pl-3 border-bottom">
                        <h3 class="h6 mb-0 fw-600">{{ translate('Filters') }}</h3>
                        <button type="button" class="btn btn-sm p-2 filter-sidebar-thumb" data-toggle="class-toggle" data-target=".aiz-filter-sidebar" type="button">
                        <i class="las la-times la-2x"></i>
                        </button>
                     </div>
                     <div class="vertical-filters-filters">
                        <div class="sidetit">
                           {{ translate('Categories')}}
                        </div>
                        <div class="pt-3">
                           <ul class="list-unstyled">
                              @if(!isset($category_id) && !isset($category_id) && !isset($subcategory_id) && !isset($subsubcategory_id))
                              @foreach(\App\Category::all() as $category)
                              <li class="mb-2 ml-2">
                                 <a class="text-reset fs-14" href="{{ route('products.category', $category->slug) }}">{{ $category->getTranslation('name') }}</a>
                              </li>
                              @endforeach
                              @endif
                              @if(isset($category_id))
                              <li class="mb-2">
                                 <a class="text-reset fs-14 fw-600" href="{{ route('products') }}">
                                 <i class="las la-angle-left"></i>
                                 {{ translate('All Categories')}}
                                 </a>
                              </li>
                              <li class="mb-2">
                                 <a class="text-reset fs-14 fw-600" href="{{ route('products.category', \App\Category::find($category_id)->slug) }}">
                                 <i class="las la-angle-left"></i>
                                 {{  translate(\App\Category::find($category_id)->getTranslation('name')) }}
                                 </a>
                              </li>
                              @foreach (\App\Category::find($category_id)->subcategories as $key2 => $subcategory)
                              <li class="ml-4 mb-2">
                                 <a class="text-reset fs-14" href="{{ route('products.subcategory', $subcategory->slug) }}">{{ $subcategory->getTranslation('name') }}</a>
                              </li>
                              @endforeach
                              @endif
                              @if(isset($subcategory_id))
                              <li class="mb-2">
                                 <a class="text-reset fs-14 fw-600" href="{{ route('products') }}">
                                 <i class="las la-angle-left"></i>
                                 {{ translate('All Categories')}}
                                 </a>
                              </li>
                              <li class="mb-2">
                                 <a class="text-reset fs-14 fw-600" href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}">
                                 <i class="las la-angle-left"></i>
                                 {{ \App\SubCategory::find($subcategory_id)->category->getTranslation('name') }}
                                 </a>
                              </li>
                              <li class="mb-2">
                                 <a class="text-reset fs-14 fw-600" href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}">
                                 <i class="las la-angle-left"></i>
                                 {{  \App\SubCategory::find($subcategory_id)->getTranslation('name') }}
                                 </a>
                              </li>
                              @foreach (\App\SubCategory::find($subcategory_id)->subsubcategories as $key3 => $subsubcategory)
                              <li class="ml-4 mb-2">
                                 <a class="text-reset fs-14" href="{{ route('products.subsubcategory', $subsubcategory->slug) }}">{{  $subsubcategory->getTranslation('name') }}</a>
                              </li>
                              @endforeach
                              @endif
                              @if(isset($subsubcategory_id))
                              <li class="mb-2">
                                 <a class="text-reset fs-14 fw-600" href="{{ route('products') }}">
                                 <i class="las la-angle-left"></i>
                                 {{ translate('All Categories')}}
                                 </a>
                              </li>
                              <li class="mb-2">
                                 <a class="text-reset fs-14 fw-600" href="{{ route('products.category', \App\SubsubCategory::find($subsubcategory_id)->subcategory->category->slug) }}">
                                 <i class="las la-angle-left"></i>
                                 {{  \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->getTranslation('name') }}
                                 </a>
                              </li>
                              <li class="mb-2">
                                 <a class="text-reset fs-14 fw-600" href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}">
                                 <i class="las la-angle-left"></i>
                                 {{  \App\SubsubCategory::find($subsubcategory_id)->subcategory->getTranslation('name') }}
                                 </a>
                              </li>
                              <li class="ml-4 mb-2">
                                 <a class="text-reset fs-14" href="{{ route('products.subsubcategory', \App\SubsubCategory::find($subsubcategory_id)->slug) }}">{{  \App\SubsubCategory::find($subsubcategory_id)->getTranslation('name') }}</a>
                              </li>
                              @endif
                           </ul>
                        </div>
                     </div>
                    
                     <div class="vertical-filters-filters">
                        <div class="sidetit">
                           {{ translate('Price range')}}
                        </div>
                        <div class="p-3">
                           <div class="aiz-range-slider">
                              <div
                                 id="input-slider-range"
                                 data-range-value-min="@if(count(\App\Product::query()->get()) < 1) 0 @else {{ filter_products(\App\Product::query())->get()->min('unit_price') }} @endif"
                                 data-range-value-max="@if(count(\App\Product::query()->get()) < 1) 0 @else {{ filter_products(\App\Product::query())->get()->max('unit_price') }} @endif"
                                 ></div>
                              <div class="row mt-2">
                                 <div class="col-6">
                                    <span class="range-slider-value value-low fs-14 fw-600 opacity-70"
                                    @if (isset($min_price))
                                    data-range-value-low="{{ $min_price }}"
                                    @elseif($products->min('unit_price') > 0)
                                    data-range-value-low="{{ $products->min('unit_price') }}"
                                    @else
                                    data-range-value-low="0"
                                    @endif
                                    id="input-slider-range-value-low"
                                    ></span>
                                 </div>
                                 <div class="col-6 text-right">
                                    <span class="range-slider-value value-high fs-14 fw-600 opacity-70"
                                    @if (isset($max_price))
                                    data-range-value-high="{{ $max_price }}"
                                    @elseif($products->max('unit_price') > 0)
                                    data-range-value-high="{{ $products->max('unit_price') }}"
                                    @else
                                    data-range-value-high="0"
                                    @endif
                                    id="input-slider-range-value-high"
                                    ></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-9">
            
               @isset($category_id)
               <input type="hidden" name="category" value="{{ \App\Category::find($category_id)->slug }}">
               @endisset
               @isset($subcategory_id)
               <input type="hidden" name="subcategory" value="{{ \App\SubCategory::find($subcategory_id)->slug }}">
               @endisset
               @isset($subsubcategory_id)
               <input type="hidden" name="subsubcategory" value="{{ \App\SubSubCategory::find($subsubcategory_id)->slug }}">
               @endisset
              
                    
               <div class="sort-by">
                  <div class="d-flex">
                     <div class="form-group w-200px d-md-block">
                        <label class="mb-0 opacity-50">{{ translate('Sort by')}}</label>
                        <select class="form-control form-control-sm aiz-selectpicker" name="sort_by" onchange="filter()">
                        <option value="1" @isset($sort_by) @if ($sort_by == '1') selected @endif @endisset>{{ translate('Newest')}}</option>
                        <option value="2" @isset($sort_by) @if ($sort_by == '2') selected @endif @endisset>{{ translate('Oldest')}}</option>
                        <option value="3" @isset($sort_by) @if ($sort_by == '3') selected @endif @endisset>{{ translate('Price low to high')}}</option>
                        <option value="4" @isset($sort_by) @if ($sort_by == '4') selected @endif @endisset>{{ translate('Price high to low')}}</option>
                        </select>
                     </div>
                   
                     
                     <div class="d-xl-none ml-auto ml-md-3 mr-0 form-group align-self-end">
                        <button type="button" class="btn btn-icon p-0" data-toggle="class-toggle" data-target=".aiz-filter-sidebar">
                        <i class="la la-filter la-2x"></i>
                        </button>
                     </div>
                  </div>
               </div>
             
               <input type="hidden" name="min_price" value="">
               <input type="hidden" name="max_price" value="">
               <div >
               <div class="row gutters-5 row-cols-xxl-3 row-cols-xl-3 row-cols-lg-4 row-cols-md-3 row-cols-2 ">
                    <div class="shop-pro-content" id="product_list_data">
                        @include('frontend.product_list_data')
                    </div>
                 </div>
               </div>
               
                 
              
            </div>
         </div>
      </form>
   </div>
</section>


@endsection

