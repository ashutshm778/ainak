<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Cart;
use Razorpay\Api\Api;
use App\Models\Enquiry;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use App\Models\Admin\CouponUsage;
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
        $lens_id = 0;
        if (!empty($request->lens_id)) {
            $lens_id = $request->lens_id;
        }
        if ($request->product_qty) {
            $qty = $request->product_qty;
        } else {
            $qty = 1;
        }
        Cart::updateOrCreate(
            [
                'user_id' => Auth::guard('customer')->user()->id,
                'product_id' => $request->product_id,
                'lens_id' => $lens_id,
            ],
            [
                'quantity' => $qty
            ]
        );

        $cart_count = Cart::where('user_id', Auth::guard('customer')->user()->id)->get()->count();

        return ['html' => view('frontend.cart_detail')->render(), 'cart_count' => $cart_count];
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
        Cart::where('id', $cart_id)->delete();
        if (request()->ajax()) {
            $cart_count = Cart::where('user_id', Auth::guard('customer')->user()->id)->get()->count();
            return ['html' => view('frontend.cart_detail')->render(), 'cart_count' => $cart_count];
        } else {
            return back();
        }
    }

    public function changeCartQty($product_id, $qty)
    {
        Cart::updateOrCreate(
            [
                'user_id' => Auth::guard('customer')->user()->id,
                'product_id' => $product_id
            ],
            [
                'quantity' => $qty
            ]
        );
        $cart_detail = view('frontend.cart_detail')->render();
        $cart_summary = view('frontend.cart_summary')->render();
        return ['cart_detail' => $cart_detail, 'cart_summary' => $cart_summary];
    }


    public function checkout()
    {
        $cart_count = Cart::where('user_id', Auth::guard('customer')->user()->id)->get()->count();
        if ($cart_count > 0) {
            return view('frontend.checkout');
        } else {
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

                    if ($coupon->type == 'total_order_amount') {
                        $subtotal = 0;
                        $lens = 0;
                        $shipping = 0;
                        foreach (Cart::where('user_id', Auth::user()->id)->get() as $key => $cartItem) {

                            $product_prices = getProductDiscountedPrice($cartItem->product_id, 'retailer');

                            $subtotal +=  $product_prices['product_price'] * $cartItem->quantity;
                            if (!empty($cartItem->lens_id)) {
                                $lens += lensDiscountPrice($cartItem->lens->id);
                            }
                            $shipping += 0;
                        }
                        $sum = $subtotal + $lens + $shipping;

                        if ($sum >= $coupon->minimum_order_value) {
                            if ($coupon->discount_type == 'percent') {
                                $coupon_discount = ($sum * $coupon->discount) / 100;
                                if ($coupon_discount > $coupon->maximum_discount_amount) {
                                    $coupon_discount = $coupon->maximum_discount_amount;
                                }
                            } elseif ($coupon->discount_type == 'amount') {
                                $coupon_discount = $coupon->discount;
                            }
                            $request->session()->put('coupon_id', $coupon->id);
                            $request->session()->put('coupon_discount', $coupon_discount);
                            return back()->with('success', 'Coupon has been applied!');
                        }
                    } elseif ($coupon->type == 'product_base') {
                        $coupon_details = explode(",", $coupon->product_ids);
                        $coupon_discount = 0;
                        foreach (Cart::where('user_id', Auth::user()->id)->get() as $key => $cartItem) {
                            $product_prices = getProductDiscountedPrice($cartItem->product_id, 'retailer');
                            if (in_array($cartItem->product_id, $coupon_details)) {
                                if ($coupon->discount_type == 'percent') {
                                    $coupon_discount += $product_prices['product_price'] * $coupon->discount / 100;
                                } elseif ($coupon->discount_type == 'amount') {
                                    $coupon_discount += $coupon->discount;
                                }
                            }
                        }
                        $request->session()->put('coupon_id', $coupon->id);
                        $request->session()->put('coupon_discount', $coupon_discount);
                        return back()->with('success', 'Coupon has been applied!');
                    }
                } else {
                    return back()->with('error', 'Coupon Maximum Limit exited!');
                }
            } else {
                return back()->with('error', 'Coupon expired!');
            }
        } else {
            return back()->with('error', 'Invalid coupon!');
        }
        return back();
    }

    public function remove_coupon_code(Request $request)
    {
        $request->session()->forget('coupon_id');
        $request->session()->forget('coupon_discount');
        return back()->with('success', 'Coupon has been removed!');
    }

    public function pay_success(Request $request)
    {
        $sub_total_amount = 0;
        $total_discount = 0;
        $total_amount = 0;
        $total_lens = 0;
        $total_lens_discount = 0;
        $coupon_discount = 0;
        if (Session::get('coupon_discount') > 0) {
            $coupon_discount = Session::get('coupon_discount');
        }

        foreach (Cart::where('user_id', Auth::guard('customer')->user()->id)->get() as $cart) {

            $product_prices = getProductDiscountedPrice($cart->product_id, 'retailer');
            $sub_total_amount = $sub_total_amount + $product_prices['selling_price'] * $cart->quantity;
            $total_discount = ($total_discount + $product_prices['selling_price'] - $product_prices['product_price']) * $cart->quantity;
            $total_amount = $total_amount + $product_prices['product_price'] * $cart->quantity;
            if (!empty($cart->lens_id)) {
                $total_lens = $total_lens + $cart->lens->price;
                $total_lens_discount = $total_lens_discount + lensDiscountPrice($cart->lens->id);
            }
        }
        $total_order_amount=$total_amount + $total_lens_discount - $coupon_discount;
        $input = $request->all();
        $api = new Api(env('RKEY'), env('RSECRET'));

        $payment = $api->payment->fetch($request->razorpay_payment_id);

        if (count($input)  && !empty($request->razorpay_payment_id)) {
            $payment_detalis = null;
            try {
                $response = $api->payment->fetch($request->razorpay_payment_id)->capture(array('amount' => $payment['amount']));
                if($response['amount']/100 == $total_order_amount){
                 $payment_detalis = json_encode(array('id' => $response['id'], 'method' => $response['method'], 'amount' => $response['amount']/100, 'currency' => $response['currency']));
                 $request->merge(['payment_detalis' => $payment_detalis]);
                 $order = new OrderController;
                 $order->store($request);
                 return 1;
                }
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }

        return 0;
      
    }

    public function payment_enquiry(Request $request)
    {
       
        $input = $request->all();
        $api = new Api(env('RKEY'), env('RSECRET'));

        $payment = $api->payment->fetch($request->razorpay_payment_id);

        if (count($input)  && !empty($request->razorpay_payment_id)) {
            $payment_detalis = null;
            try {
                $response = $api->payment->fetch($request->razorpay_payment_id)->capture(array('amount' => $payment['amount']));
                if($response['amount']/100 == 49){
                 $payment_detalis = json_encode(array('id' => $response['id'], 'method' => $response['method'], 'amount' => $response['amount']/100, 'currency' => $response['currency']));

                 $enquiry = new Enquiry;
                 $enquiry->name=$request->name;
                 $enquiry->email=$request->email;
                 $enquiry->phone=$request->phone;
                 $enquiry->message=$request->message;
                 $enquiry->payment_detail=$payment_detalis;
                 $enquiry->save();

                 return 1;
                }
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }

        return 0;
      
    }
}
