<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

    public function store(Request $request)
    {
        Wishlist::updateOrCreate([
            'user_id'=>Auth::guard('customer')->user()->id,
            'product_id'=>$request->product_id
        ]);

        $wishlist_count=Wishlist::where('user_id',Auth::guard('customer')->user()->id)->get()->count();

        return ['wishlist_count'=>$wishlist_count];
    }

    public function delete(Request $request)
    {
        Wishlist::where('user_id',Auth::guard('customer')->user()->id)->where('product_id',$request->product_id)->delete();
    }

}
