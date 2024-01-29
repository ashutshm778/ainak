<?php

namespace App\Http\Controllers;

use App\Models\Admin\Brnad;
use App\Models\Admin\Color;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\SubSubCategory;

class SearchController extends Controller
{

    public function productSearch(Request $request)
    {
        $search=$request->search;
        $list=Product::where('is_active','1')->where(function ($query) use ($search){
            $query->where('name','like','%'.$search.'%')->orWhere('tags','like','%'.$search.'%');
        });
        if($request->ajax()){
            $list=$list->take(7)->get();
            return vieW('frontend.layouts.search',compact('list'));
        }else{
            if($request->category_filler){
                $list=$list->whereJsonContains('category_id',''.$request->category_filler);
            }
            if($request->subcategory_filler){
                $list=$list->whereJsonContains('subcategory_id',''.$request->subcategory_filler);
            }
            if($request->subsubcategory_filler){
                $list=$list->whereJsonContains('subsubcategory_id',''.$request->subsubcategory_filler);
            }
            $list=$list->paginate(12);
            return view('frontend.product_list',compact('list'));
        }
    }
    public function productFillter(Request $request)
    {
        $condition_category=[];
        $search_category=$request->category_filler;
        if(!empty($search_category))
        {
            if(!is_array($search_category))
            {
                $search_category=json_decode($request->category_filler);
            }
            foreach($search_category as $category)
            {
                array_push($condition_category,['category_id'=>$category]);
            }
        }

        $list=Product::where(function ($query) use ($condition_category){
            foreach ($condition_category as $key=>$value)
            {
                $query->orWhereJsonContains('category_id',$value['category_id']);
            }
            });

        if($request->color_filler)
        {
            $list=$list->whereIn('colors',$request->color_filler);
        }
        if($request->discount_filler)
        {
            $list=$list->where('retailer_discount',$request->discount_filler);
        }
        if($request->price_filler)
        {
            if($request->price_filler != 'more than 100000')
            {
                $range=explode('-',$request->price_filler);
                $list=$list->whereBetween('retailer_selling_price',$range);

            }
            else
            {
                $list=$list->where('retailer_selling_price','>',100000);
            }
        }

        $sort_by = 'asc';
        $sort_type = 'name';
        if($request->sort_by == 'desc')
        {
            $sort_by = 'desc';
            $sort_type = 'name';
        }
        if($request->sort_by == 'pasc')
        {
            $sort_by = 'asc';
            $sort_type = 'retailer_selling_price';
        }
        if($request->sort_by == 'pdesc')
        {
            $sort_by = 'desc';
            $sort_type = 'retailer_selling_price';
        }

        if($request->subcat)
        {
            $subcat_slug=SubCategory::where('slug',$request->subcat)->first();
            $list=$list->whereJsonContains('subcategory_id',''.$subcat_slug->id);
        }

        if($request->brand_filler)
        {
            $list=$list->where('brand_id',$request->brand_filler);
        }

        if($request->search)
        {
            $search=$request->search;
            $list=$list->where(function ($query) use ($search){
                $query->where('name','like','%'.$search.'%')
                      ->orWhere('variant_name','like','%'.$search.'%');
            });
        }

        $list=$list->orderBy($sort_type,$sort_by)->paginate(12);

        return view('frontend.product_list_data',compact('list'));
    }

    public function n_search(Request $request)
    {
        $query = $request->q;
        $brand_id = (Brnad::where('slug', $request->brand)->first() != null) ? Brnad::where('slug', $request->brand)->first()->id : null;
        $sort_by = $request->sort_by;
        $category_id = (Category::where('slug', $request->category)->first() != null) ? Category::where('slug', $request->category)->first()->id : null;
        $subcategory_id = (SubCategory::where('slug', $request->subcategory)->first() != null) ? SubCategory::where('slug', $request->subcategory)->first()->id : null;
        $subsubcategory_id = (SubSubCategory::where('slug', $request->subsubcategory)->first() != null) ? SubSubCategory::where('slug', $request->subsubcategory)->first()->id : null;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $seller_id = $request->seller_id;
        
        $school_id=$request->school_id;
        $school_category_id=$request->school_category_id;
        $gender=$request->gender;
        $class=$request->class;

        $conditions = ['published' => 1];

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }
        if($category_id != null){
            $conditions = array_merge($conditions, ['category_id' => $category_id]);
        }
        if($subcategory_id != null){
            $conditions = array_merge($conditions, ['subcategory_id' => $subcategory_id]);
        }
        if($subsubcategory_id != null){
            $conditions = array_merge($conditions, ['subsubcategory_id' => $subsubcategory_id]);
        }
       

        $products = Product::where($conditions);

        if($min_price != null && $max_price != null){
            $products = $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price);
        }

        
      if($school_id != null){
            $products = $products->where('school_id', $school_id)->whereJsonContains('gender',$gender)->whereJsonContains('class',$class);
        }
        if($sort_by != null){
            switch ($sort_by) {
                case '1':
                    $products->orderBy('created_at', 'desc');
                    break;
                case '2':
                    $products->orderBy('created_at', 'asc');
                    break;
                case '3':
                    $products->orderBy('unit_price', 'asc');
                    break;
                case '4':
                    $products->orderBy('unit_price', 'desc');
                    break;
                default:
                    // code...
                    break;
            }
        }


        $non_paginate_products = $products->orderBy('id','desc')->get();

        //Attribute Filter

        $attributes = array();
        foreach ($non_paginate_products as $key => $product) {
            if($product->attributes != null && is_array(json_decode($product->attributes))){
                foreach (json_decode($product->attributes) as $key => $value) {
                    $flag = false;
                    $pos = 0;
                    foreach ($attributes as $key => $attribute) {
                        if($attribute['id'] == $value){
                            $flag = true;
                            $pos = $key;
                            break;
                        }
                    }
                    if(!$flag){
                        $item['id'] = $value;
                        $item['values'] = array();
                        foreach (json_decode($product->choice_options) as $key => $choice_option) {
                            if($choice_option->attribute_id == $value){
                                $item['values'] = $choice_option->values;
                                break;
                            }
                        }
                        array_push($attributes, $item);
                    }
                    else {
                        foreach (json_decode($product->choice_options) as $key => $choice_option) {
                            if($choice_option->attribute_id == $value){
                                foreach ($choice_option->values as $key => $value) {
                                    if(!in_array($value, $attributes[$pos]['values'])){
                                        array_push($attributes[$pos]['values'], $value);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $selected_attributes = array();

        foreach ($attributes as $key => $attribute) {
            if($request->has('attribute_'.$attribute['id'])){
                foreach ($request['attribute_'.$attribute['id']] as $key => $value) {
                    $str = '"'.$value.'"';
                    $products = $products->where('choice_options', 'like', '%'.$str.'%');
                }

                $item['id'] = $attribute['id'];
                $item['values'] = $request['attribute_'.$attribute['id']];
                array_push($selected_attributes, $item);
            }
        }


        //Color Filter
        $all_colors = array();

        foreach ($non_paginate_products as $key => $product) {
            if ($product->colors != null) {
                foreach (json_decode($product->colors) as $key => $color) {
                    if(!in_array($color, $all_colors)){
                        array_push($all_colors, $color);
                    }
                }
            }
        }

        $selected_color = null;

        if($request->has('color')){
            $str = '"'.$request->color.'"';
            $products = $products->where('colors', 'like', '%'.$str.'%');
            $selected_color = $request->color;
        }


        $products = $products->paginate(20)->appends(request()->query());
      

        return view('frontend.product_listing', compact('products', 'query', 'category_id', 'subcategory_id', 'subsubcategory_id', 'brand_id', 'sort_by', 'seller_id','min_price', 'max_price', 'attributes', 'selected_attributes', 'all_colors', 'selected_color'));
    }

}
