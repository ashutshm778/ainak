@extends('backend.include.header')
@section('content')

   <style>
    .variant
    {
        background: #f7f7f7;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        margin: 0px 0 10px;
    }
   </style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.products.index')}}">Product List</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-body p-0">
                                <div class="modal-body">
                                    <form action="{{route('admin.products.store')}}" method="POST" class="form-example" id="choice_form">
                                        @csrf
                                        <input type="hidden" name="key" value="{{$key}}">
                                        <input type="hidden" name="search_category_id" value="{{$search_category}}">
                                        <input type="hidden" name="search_subcategory_id" value="{{$search_subcategory}}">
                                        <input type="hidden" name="search_subsubcategory_id" value="{{$search_subsubcategory}}">
                                        <input type="hidden" name="search_brand_id" value="{{$search_brand}}">
                                        <input type="hidden" name="page" value="{{$page}}">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="tags">Tags</label>
                                                        <input type="text" class="form-control aiz-tag-input" id="tags" name="tags[]" placeholder="Tags...">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 form_div">
                                                    <div class="form-group">
                                                        <label for="category_id">Category</label>
                                                        <select name="category_id[]" id="category_id" class="form-control select2" data-placeholder="Select Category" multiple required onchange="get_sub_categories()">
                                                            @foreach (App\Models\Admin\Category::orderBy('priority','asc')->get() as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 form_div">
                                                    <div class="form-group">
                                                        <label for="sub_category_id">SubCategory</label>
                                                        <select name="subcategory_id[]" id="subcategory_id" class="form-control select2" data-placeholder="Select SubCategory" multiple required onchange="get_sub_sub_categories()"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 form_div">
                                                    <div class="form-group">
                                                        <label for="subsubcategory_id">SubSubCategory</label>
                                                        <select name="subsubcategory_id[]" id="subsubcategory_id" class="form-control select2" data-placeholder="Select SubSubCategory" multiple></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 form_div">
                                                    <div class="form-group">
                                                        <label for="brand_id">Brand</label>
                                                        <select name="brand_id" id="brand_id" class="form-control select2" data-placeholder="Select Brand" required>
                                                            <option value="">Select Brand</option>
                                                            @foreach (App\Models\Admin\Brnad::orderBy('name','asc')->get() as $brand)
                                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 form_div">
                                                    <div class="form-group">
                                                        <label for="unit">Unit</label>
                                                        <select name="unit" class="form-control select2">
                                                            <option value="">Select Unit...</option>
                                                            @foreach (App\Models\Admin\Unit::orderBy('name','asc')->get() as $unit)
                                                                <option value="{{$unit->name}}">{{$unit->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 form_div">
                                                    <div class="form-group">
                                                        <label for="hsn_code">HSN Code</label>
                                                        <input type="text" class="form-control" id="hsn_code" name="hsn_code" placeholder="HSN Code...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="input-group">
                                                        <div class="form-group" style="width: 49%;">
                                                            <label for="tax_type">Tax Type</label>
                                                            <select name="tax_type" id="tax_type" class="form-control">
                                                                <option value="include">Include</option>
                                                                <option value="exclude">Exclude</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tax_amount">Tax Amount (%)</label>
                                                            <input type="number" step="0.01" class="form-control" id="tax_amount" name="tax_amount" value="0.00" min="0.00" placeholder="Tax Amount (%)...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form_div">
                                                    <div class="input-group">
                                                        <div class="form-group" style="width: 49%;">
                                                            <label for="shipping_type">Shipping Type</label>
                                                            <select name="shipping_type" id="shipping_type" class="form-control">
                                                                <option value="free">Free</option>
                                                                <option value="paid">Paid</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="shipping_amount">Shipping Amount</label>
                                                            <input type="number" step="0.01" class="form-control" id="shipping_amount" name="shipping_amount" value="0.00" min="0.00" placeholder="Shipping Amount...">
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                               
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="short_description">Short Description</label>
                                                        <textarea class="form-control summernote" name="short_description"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea class="form-control summernote" name="description"></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12 form_div">
                                                    <div class="form-group">
                                                        <label for="specification">Specification</label>
                                                        <textarea class="form-control summernote" name="specification"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label class="aiz-switch aiz-switch-success mb-0">
                                                            <input type="checkbox" id="color_button">
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="specification">Attribute</label>
                                                        <select class="form-control select2" name="choice_attributes[]" id="attribute" data-placeholder="Attribute" multiple></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single">
                                                <div class="row" id="single_product_price_div">
                                                    <div class="col-md-4 form_div">
                                                        <div class="form-group">
                                                            <label>Thumbnail Image</label>
                                                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                                <div class="form-control file-amount">Choose Icon</div>
                                                                <input type="hidden" name="thumbnail_image[]" class="selected-files" value="">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                                </div>
                                                            </div>
                                                            <div class="file-preview box sm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 form_div">
                                                        <div class="form-group">
                                                            <label>Gallery Image</label>
                                                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                                                <div class="form-control file-amount">Choose Icon</div>
                                                                <input type="hidden" name="gallery_image[]" class="selected-files" value="">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                                </div>
                                                            </div>
                                                            <div class="file-preview box sm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 form_div">
                                                        <div class="form-group">
                                                            <label for="video_link">Video Link</label>
                                                            <input type="text" class="form-control" name="video_link[]" placeholder="Video Link...">
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-3 form_div">
                                                        <div class="form-group">
                                                            <label for="purchase_price">Purchase Price</label>
                                                            <input type="text" class="form-control" name="purchase_price[]" placeholder="Purchase Price..." required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 form_div">
                                                        <div class="form-group">
                                                            <label for="mrp_price">Mrp Price</label>
                                                            <input type="text" class="form-control" name="mrp_price[]" placeholder="Mrp Price..." required>
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-md-6 form_div">
                                                        <div class="form-group">
                                                            <label for="barcode_id">Barcode Id</label>
                                                            <input type="text" class="form-control" name="barcode_id[]" placeholder="Barcode Id...">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form_div">
                                                        <div class="form-group">
                                                            <label for="sku">SKU</label>
                                                            <input type="text" class="form-control" name="sku[]" placeholder="SKU...">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 form_div">
                                                        <div class="form-group">
                                                            <label for="retailer_selling_price">Retailer Selling Price</label>
                                                            <input type="text" class="form-control" name="retailer_selling_price[]" value="0.00" placeholder="Selling Price...">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 form_div">
                                                        <div class="input-group">
                                                            <div class="form-group" style="width: 49%;">
                                                                <label for="retailer_discount_type">Discount Type</label>
                                                                <select name="retailer_discount_type[]" class="form-control">
                                                                    <option value="amount">Flat</option>
                                                                    <option value="percent">Percent</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="retailer_discount">Discount</label>
                                                                <input type="text" class="form-control" name="retailer_discount[]" value="0.00" min="0.00" placeholder="Discount...">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 form_div">
                                                        <div class="form-group">
                                                            <label for="retailer_min_qty">Min Qty</label>
                                                            <input type="text" class="form-control" name="retailer_min_qty[]" value="1" min="1" placeholder="Selling Price..." required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 form_div">
                                                        <div class="form-group">
                                                            <label for="retailer_max_qty">Max Qty</label>
                                                            <input type="text" class="form-control" name="retailer_max_qty[]" placeholder="Max Qty...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6 form_div"></div>
                                                <div class="col-md-6 form_div d-flex justify-content-end" id="add_button">
                                                    <div class="form-group">
                                                        <button class="btn btn-primary add_button" type="button">Add Variant</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field_wrapper">
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to Save this Product?');"><i class="fa fa-check" aria-hidden="true"></i> SAVE</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

<script src="{{ asset('public/dashboard_css/plugins/jquery/jquery.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        var x = 1; //Initial field counter is 1
        var maxField = 50; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper

        //Once add button is clicked
        $(addButton).click(function()
        {
            $('.field_wrapper').addClass('variant');
            var category_ids=$('#category_id').val();
            var name=$('#name').val();
            if(category_ids.length  == 0)
            {
                alert('Select Category');
                return false;
            }
            if(x == 1)
            {
                $('#single_product_price_div').remove();
            }
            if(!$('#color_button').is(':checked'))
            {
                var enable_color_input = 'd-none';
            }
            else
            {
                var enable_color_input = '';
            }
            var fieldHTML ='<div class="row">'+
                                '<div class="col-md-5 form_div '+enable_color_input+'">'+
                                    '<div class="form-group">'+
                                        '<label for="colors">Colors</label>'+
                                        '<select class="form-control select2 colors_input"  name="colors'+x+'" data-placeholder="Color">'+
                                            '@foreach (\App\Models\Admin\Color::orderBy('name', 'asc')->get() as $key => $color)'+
                                                '<option  value="{{ $color->code }}">{{$color->name}}</option>'+
                                            '@endforeach'+
                                        '</select>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="brck " id="attr_val_div_'+x+'" style="display: contents; width: 100%;">'+
                                '</div>'+

                                '<div class="clearfix" style="width:100%"></div>'+

                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="variant_name">Variant Name</label>'+
                                    '<input type="text" class="form-control" name="variant_name[]" value="'+name+'"placeholder="Variant Name..." required>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label>Thumbnail Image</label>'+
                                    '<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">'+
                                        '<div class="form-control file-amount">Choose Icon</div>'+
                                        '<input type="hidden" name="thumbnail_image[]" class="selected-files" value="">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="file-preview box sm">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label>Gallery Image</label>'+
                                    '<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">'+
                                        '<div class="form-control file-amount">Choose Icon</div>'+
                                        '<input type="hidden" name="gallery_image[]" class="selected-files" value="">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="file-preview box sm">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            // '<div class="col-md-2 form_div">'+
                            //     '<div class="form-group">'+
                            //        '<label for="purchase_price">Purchase Price</label>'+
                            //         '<input type="text" class="form-control" name="purchase_price[]" placeholder="Purchase Price..." required>'+
                            //     '</div>'+
                            // '</div>'+
                            // '<div class="col-md-2 form_div">'+
                            //     '<div class="form-group">'+
                            //         '<label for="mrp_price">Mrp Price</label>'+
                            //         '<input type="text" class="form-control" name="mrp_price[]" placeholder="Mrp Price..." required>'+
                            //     '</div>'+
                            // '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="barcode_id">Barcode Id</label>'+
                                    '<input type="text" class="form-control" name="barcode_id[]" placeholder="Barcode Id...">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="sku">SKU</label>'+
                                    '<input type="text" class="form-control" name="sku[]" placeholder="SKU...">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="video_link">Video Link</label>'+
                                    '<input type="text" class="form-control" name="video_link[]" placeholder="Video Link...">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="retailer_selling_price">Retailer Selling Price</label>'+
                                    '<input type="text" class="form-control" name="retailer_selling_price[]" value="0.00" placeholder="Selling Price...">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-4 form_div">'+
                                '<div class="input-group">'+
                                    '<div class="form-group" style="width: 49%;">'+
                                        '<label for="retailer_discount_type">Discount Type</label>'+
                                        '<select name="retailer_discount_type[]" class="form-control">'+
                                            '<option value="amount">Flat</option>'+
                                            '<option value="percent">Percent</option>'+
                                        '</select>'+
                                    '</div>'+
                                    '<div class="form-group">'+
                                        '<label for="retailer_discount">Discount</label>'+
                                        '<input type="text" class="form-control" name="retailer_discount[]" value="0.00" min="0.00" placeholder="Discount...">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="retailer_min_qty">Min Qty</label>'+
                                    '<input type="text" class="form-control" name="retailer_min_qty[]" value="1" min="1" placeholder="Min Qty..." required>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-2 form_div">'+
                                '<div class="form-group">'+
                                    '<label for="retailer_max_qty">Max Qty</label>'+
                                    '<input type="text" class="form-control" name="retailer_max_qty[]" placeholder="Max Qty...">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-12 form_div d-flex justify-content-center">'+
                                '<div class="form-group">'+
                                    '<button class="btn btn-danger remove_button" type="button">Remove Variant</button>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<hr id="hr_'+x+'">'//New input field html

            //Check maximum number of input fields
            if(x < maxField)
            {
                $(wrapper).append(fieldHTML); //Add field html
                $('.select2').select2();
                get_attribute_value(x)
                x++; //Increment field counter
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e)
        {
            e.preventDefault();
            $(this).closest('.row').remove(); //Remove field html
            x--; //Decrement field counter
            $('#hr_'+x).remove();
            if(x == 1)
            {
                $('.single').append('<div class="row" id="single_product_price_div">'+
                                                '<div class="col-md-4 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label>Thumbnail Image</label>'+
                                                        '<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">'+
                                                            '<div class="form-control file-amount">Choose Icon</div>'+
                                                            '<input type="hidden" name="thumbnail_image[]" class="selected-files" value="">'+
                                                            '<div class="input-group-prepend">'+
                                                                '<div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                        '<div class="file-preview box sm">'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-4 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label>Gallery Image</label>'+
                                                        '<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">'+
                                                            '<div class="form-control file-amount">Choose Icon</div>'+
                                                            '<input type="hidden" name="gallery_image[]" class="selected-files" value="">'+
                                                            '<div class="input-group-prepend">'+
                                                                '<div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                        '<div class="file-preview box sm">'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-4 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="video_link">Video Link</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="video_link[]" placeholder="Video Link...">'+
                                                   '</div>'+
                                                '</div>'+
                                            //     '<div class="col-md-3 form_div">'+
                                            //         '<div class="form-group">'+
                                            //             '<label for="purchase_price">Purchase Price</label>'+
                                            //             '<input type="text" class="form-control" name="purchase_price[]" placeholder="Purchase Price..." required>'+
                                            //         '</div>'+
                                            //     '</div>'+
                                            //    '<div class="col-md-3 form_div">'+
                                            //         '<div class="form-group">'+
                                            //             '<label for="mrp_price">Mrp Price</label>'+
                                            //             '<input type="text" class="form-control" name="mrp_price[]" placeholder="Mrp Price..." required>'+
                                            //         '</div>'+
                                            //     '</div>'+
                                                '<div class="col-md-6 form_div">'+
                                                   '<div class="form-group">'+
                                                        '<label for="barcode_id">Barcode Id</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="barcode_id[]" placeholder="Barcode Id...">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-6 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="sku">SKU</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="sku[]" placeholder="SKU...">'+
                                                   '</div>'+
                                                '</div>'+
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="retailer_selling_price">Retailer Selling Price</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="retailer_selling_price[]" placeholder="Selling Price...">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="retailer_discount_type">Retailer Discount Type</label>'+
                                                        '<select name="retailer_discount_type[]" class="form-control">'+
                                                            '<option value="amount">Flat</option>'+
                                                            '<option value="percent">Percent</option>'+
                                                        '</select>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="retailer_discount">Retailer Discount</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="retailer_discount[]" value="0.00" min="0.00" placeholder="Discount...">'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="video_link">Retailer Min Qty</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="retailer_min_qty[]" value="1" min="1" placeholder="Min Qty..." required>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col-md-2 form_div">'+
                                                    '<div class="form-group">'+
                                                        '<label for="retailer_max_qty">Retailer Max Qty</label>'+
                                                        '<input type="text" class="form-control aiz-tag-input" name="retailer_max_qty[]" placeholder="Max Qty...">'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>')
            }
        });
    });
</script>

<script>
    function get_sub_categories()
    {
        var category_ids=$('#category_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('admin.get.sub.categories.by.category')}}",
            data:{
                category_ids:category_ids
            },
            success: function(data) {
                $('#subcategory_id').empty();
                $.each(data, function(key, val) {
                    $('#subcategory_id').append("<option value=" +val.id+ ">"+val.name+"</option>");
                });
                get_attribute()
            }
        });
    }

    function get_sub_sub_categories()
    {
        var subcategory_ids=$('#subcategory_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('admin.get.sub.sub.categories.by.subcategory')}}",
            data:{
                subcategory_ids:subcategory_ids
            },
            success: function(data) {
                $('#subsubcategory_id').empty();
                $.each(data, function(key, val) {
                    $('#subsubcategory_id').append("<option value=" +val.id+ ">"+val.name+"</option>");
                });
            }
        });
    }

    function color_change(x)
    {
        if(!$('.color_button').is(':checked'))
        {
            $('.colors_input').prop('disabled', true);
        }
        else
        {
            $('.colors_input').prop('disabled', false);
        }
    }

    function get_attribute()
    {
        var category_ids=$('#category_id').val();
        $.ajax({
            type: 'GET',
            url: "{{route('admin.get.attributes.by.category','')}}/"+category_ids,
            success: function(data) {
                $('#attribute').empty();
                $.each(data, function(key, val) {
                    $('#attribute').append("<option value=" +val.id+ ">"+val.name+"</option>");
                });
            }
        });
    }
    function get_attribute_value(x)
    {
        var attr_val=$('#attribute').val();

        $.ajax({
            type: 'GET',
            url: "{{route('admin.get.attribute.value','')}}/"+attr_val,
            success: function(data) {
                $('#attr_val_div_'+x).contents().remove();
                $.each(data, function(key, val) {
                    var values='';
                    $.each(val.value, function(k, v) {
                        values+='<option>'+v+'</option>';
                    });
                    $('#attr_val_div_'+x).append('<div class="col-md-4 form_div">'+
                                                        '<div class="input-group mb-3">'+
                                                            '<div class="input-group-prepend">'+
                                                                '<label class="input-group-text" for="inputGroupSelect01">'+val.name+'</label>'+
                                                            '</div>'+
                                                            '<select class="custom-select select2" name="choice_option_'+x+'[]" required>'+
                                                                '<option value="">Choose...</option>'+
                                                                values+
                                                            '</select>'+
                                                        '</div>'+
                                                    '</div>');
                });
            }
        });

    }

</script>

