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

    public function apply_coupon_code(Request $request)
    {
        //dd($request->all());
        $coupon = Coupon::where('code', $request->code)->first();

        if ($coupon != null) {
            if (strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date) {
                if (CouponUsage::where('coupon_id', $coupon->id)->count() <= $coupon->no_of_usage) {
                    $coupon_details = json_decode($coupon->details);

                    if ($coupon->type == 'cart_base') {
                        $subtotal = 0;
                        $tax = 0;
                        $shipping = 0;
                        foreach (Cart::where('user_id',Auth::user()->id)->get() as $key => $cartItem) {
                            $subtotal += $cartItem['price'] * $cartItem['quantity'];
                            $tax += $cartItem['tax'] * $cartItem['quantity'];
                            $shipping += $cartItem['shipping'] * $cartItem['quantity'];
                        }
                        $sum = $subtotal + $tax + $shipping;

                        if ($sum >= $coupon_details->min_buy) {
                            if ($coupon->discount_type == 'percent') {
                                $coupon_discount = ($sum * $coupon->discount) / 100;
                                if ($coupon_discount > $coupon_details->max_discount) {
                                    $coupon_discount = $coupon_details->max_discount;
                                }
                            } elseif ($coupon->discount_type == 'amount') {
                                $coupon_discount = $coupon->discount;
                            }
                            $request->session()->put('coupon_id', $coupon->id);
                            $request->session()->put('coupon_discount', $coupon_discount);
                            flash(translate('Coupon has been applied'))->success();
                        }
                    } elseif ($coupon->type == 'product_base') {
                        $coupon_discount = 0;
                        foreach (Cart::where('user_id',Auth::user()->id)->get() as $key => $cartItem) {
                            foreach ($coupon_details as $key => $coupon_detail) {
                                if ($coupon_detail->product_id == $cartItem['product_id']) {
                                    if ($coupon->discount_type == 'percent') {
                                        $coupon_discount += $cartItem['price'] * $coupon->discount / 100;
                                    } elseif ($coupon->discount_type == 'amount') {
                                        $coupon_discount += $coupon->discount;
                                    }
                                }
                            }
                        }
                        $request->session()->put('coupon_id', $coupon->id);
                        $request->session()->put('coupon_discount', $coupon_discount);
                        flash(translate('Coupon has been applied'))->success();
                    }
                } else {
                    flash(translate('Coupon Maximum Limit exited !!'))->warning();
                }
            } else {
                flash(translate('Coupon expired!'))->warning();
            }
        } else {
            flash(translate('Invalid coupon!'))->warning();
        }
        return back();
    }

    public function remove_coupon_code(Request $request)
    {
        $request->session()->forget('coupon_id');
        $request->session()->forget('coupon_discount');
        return back();
    }
}
