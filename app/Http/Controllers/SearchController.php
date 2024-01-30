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

    public function search(Request $request)
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
        
        $conditions = [];

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }
       

        $products = Product::where($conditions);

        
        if($category_id != null){
            $products=$products->whereJsonContains('category_id',''.$category_id);
        }
        if($subcategory_id != null){
            $products=$products->whereJsonContains('subcategory_id',''.$subcategory_id);
        }
        if($subsubcategory_id != null){
            $products=$products->whereJsonContains('subsubcategory_id',''.$subsubcategory_id);
        }

        if($min_price != null && $max_price != null){
            $products = $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price);
        }

        if($query != null){
            $products = $products->where('name', 'like', '%'.$query.'%')->orWhere('tags', 'like', '%'.$query.'%');
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


        $products = $products->paginate(20)->appends(request()->query());
      
        $list=$products;
        return view('frontend.product_listing', compact('list','products', 'query', 'category_id', 'subcategory_id', 'subsubcategory_id', 'brand_id', 'sort_by', 'min_price', 'max_price'));
    }

    public function ajax_search(Request $request)
    {
        $search=$request->search;
        $list=Product::where('is_active','1')->where(function ($query) use ($search){
            $query->where('name','like','%'.$search.'%')->orWhere('tags','like','%'.$search.'%');
        });
        if($request->ajax()){
            $list=$list->take(7)->get();
            return vieW('frontend.layouts.search',compact('list'));
        }
    }

}
