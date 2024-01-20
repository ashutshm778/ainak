<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $lens_id=0;
        if(!empty($request->lens_id)){
         $lens_id=$request->lens_id;
        }
        if($request->product_qty)
        {
            $qty = $request->product_qty;
        }
        else
        {
            $qty = 1;
        }
        Cart::updateOrCreate([
            'user_id'=>Auth::guard('customer')->user()->id,
            'product_id'=>$request->product_id,
            'lens_id'=>$lens_id,
        ],
        [
            'quantity'=>$qty
        ]);

        $cart_count=Cart::where('user_id',Auth::guard('customer')->user()->id)->get()->count();

        return ['html'=>view('frontend.cart_detail')->render(),'cart_count'=>$cart_count];
    }

    public function show(Cart $cart)
    {
        //
    }

    public function edit(Cart $cart)
    {
        //
    }

    public function update(Request $request, Cart $cart)
    {
        //
    }

    public function destroy($cart_id)
    {
        Cart::where('id',$cart_id)->delete();
        if(request()->ajax())
        {
            $cart_count=Cart::where('user_id',Auth::guard('customer')->user()->id)->get()->count();
            return ['html'=>view('frontend.cart_detail')->render(),'cart_count'=>$cart_count];
        }
        else
        {
            return back();
        }
    }

    public function changeCartQty($product_id,$qty)
    {
        Cart::updateOrCreate([
            'user_id'=>Auth::guard('customer')->user()->id,
            'product_id'=>$product_id
        ],
        [
            'quantity'=>$qty
        ]);
        $cart_detail = view('frontend.cart_detail')->render();
        $cart_summary = view('frontend.cart_summary')->render();
        return ['cart_detail'=>$cart_detail,'cart_summary'=>$cart_summary];
    }


    public function checkout(){
        $cart_count=Cart::where('user_id',Auth::guard('customer')->user()->id)->get()->count();
        if($cart_count > 0){
          return view('frontend.checkout');
        }else{
            return redirect()->route('index')->with('error', 'Cart Is Empty!');
        }
    }
}
