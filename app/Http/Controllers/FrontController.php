<?php

namespace App\Http\Controllers;

use Session;
use Exception;
use Carbon\Carbon;
use App\Models\Lens;
use App\Models\Order;
use App\Models\Review;
use App\Models\Customer;
use App\Models\Admin\Brnad;
use App\Models\Admin\Offer;
use App\Models\RepairGlass;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use Craftsys\Msg91\Facade\Msg91;
use App\Models\Admin\SubCategory;
use App\Models\Admin\SubSubCategory;
use App\Models\Admin\WebsiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\BusinessPersonRequest;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'slug', 'name', 'icon')->where('is_active', 1)->orderBy('top_priority', 'asc')->take(6)->get();
        $featured_categories = Category::select('id', 'name','slug')->where('is_active', 1)->where('is_feature', 1)->orderBy('priority', 'asc')->get();
       
        $features = Product::where('is_active', 1)->where('is_feature', 1)->take(12)->get();
        $best_sellers = Product::where('is_active', 1)->where('is_bestseller', 1)->take(12)->get();

        $sliders = WebsiteSetting::where('type', 'slider')->get();
        $top_banner = WebsiteSetting::where('type', 'banner')->where('position', 'top')->first();
        $mid_banner = WebsiteSetting::where('type', 'banner')->where('position', 'mid')->first();
        $bottom_banner = WebsiteSetting::where('type', 'banner')->where('position', 'bottom')->first();

        return view('frontend.index', compact('categories', 'features', 'best_sellers', 'sliders', 'top_banner', 'mid_banner', 'bottom_banner', 'featured_categories'));
    }

    public function get_trending_product(Request $request){
        $features = Product::where('is_active', 1)->where('is_trending', 1)->orderBy('id','desc')->limit(12)->paginate(4);
        return view('frontend.featured',compact('features'))->render();
    }

    public function get_new_arrival_product(Request $request){
        $new_arriavls = Product::where('is_active', 1)->where('is_new_arrival', 1)->orderBy('id','desc')->limit(12)->paginate(4);
        return view('frontend.new_arrival',compact('new_arriavls'))->render();
    }

    public function get_best_seller_product(Request $request){
        $best_sellers = Product::where('is_active', 1)->where('is_bestseller', 1)->orderBy('id','desc')->limit(12)->paginate(4);
        return view('frontend.best_seller',compact('best_sellers'))->render();
    }

    public function all_categories()
    {
        $categories = Category::select('id', 'slug', 'name', 'icon')->where('is_active', 1)->orderBy('priority', 'asc')->get();
        return view('frontend.all-categories', compact('categories'));
    }

    public function sub_categories(Request $request, $category_id)
    {
        $brand_id = $request->brand;
        $sub_categories = SubCategory::where('is_active', 1)->whereJsonContains('category_id', $category_id);
        if ($brand_id) {
            $products = Product::where('brand_id', $brand_id)->pluck('subcategory_id');
            $sub_cat_arr = [];
            foreach ($products as $product) {
                foreach ($product as $prod) {
                    array_push($sub_cat_arr, $prod);
                }
            }

            $sub_categories = $sub_categories->whereIn('id', $sub_cat_arr);
        }
        $sub_categories = $sub_categories->get();
        return view('frontend.sub-categories', compact('sub_categories', 'category_id', 'brand_id'));
    }

    public function attemptRegister(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'phone' => 'required|min:10|max:10|unique:customers,phone',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6'
        ]);

        Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'type' => 'retailer',
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);

        if (Auth::guard('customer')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            if(!empty($request->from)){
                return redirect($request->from);
            }
            if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
                return redirect()->route('usermob_sidebar')->with('success', 'You Have Successfully Login !');
             } else {
            return redirect()->route('user_profile')->with('success', 'You Have Successfully Login !');
             }
        }
    }

    public function forgotPassword(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|min:10|max:10|exists:customers',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6'
        ]);

        $customer =  Customer::where('phone', $request->phone)->first();
        $customer->password =Hash::make($request->password);
        $customer->save();
        if (Auth::guard('customer')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return redirect()->route('user_profile')->with('success', 'Your password has been changed Successfully!');
        }
     
    }

    public function businessPersonRequestSave(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'phone' => 'required|min:10|max:10',
            'type' => 'required|min:3|max:50',
            'business_name' => 'required|min:3|max:50',
        ]);

        $business_person_request = new BusinessPersonRequest;
        $business_person_request->first_name = $request->first_name;
        $business_person_request->last_name = $request->last_name;
        $business_person_request->phone = $request->phone;
        $business_person_request->type = $request->type;
        $business_person_request->business_name = $request->business_name;
        $business_person_request->save();


        return redirect()->route('business.person.request.details')->with('message', $business_person_request->id);
    }

    public function businessPersonRequestDetailSave(Request $request)
    {
        if ($request->file('gst_document')) {
            $file = $request->file('gst_document');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/gstin_documents'), $filename);
        }
        BusinessPersonRequest::where('id', $request->request_id)->update([
            'email' => $request->email,
            'brand_name' => $request->brand_name,
            'owner_name' => $request->owner_name,
            'gstin_number' => $request->gst_number,
            'gstin_document' => $filename,
            'address' => $request->address
        ]);

        return redirect()->route('index');
    }

    public function attemptLogin(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'phone' => 'required|exists:customers'
        ],
        [
            'phone.exists'=> 'Entered number is not registered.', 
        ]);
      

        $customer = Customer::where('phone', $request->phone)->orWhere('type', 'retailer')->orWhere('type', 'distributor')->orWhere('type', 'wholeseller')->first();
        if ($customer) {
            if (Auth::guard('customer')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->remember)) {
                if(!empty($request->from)){
                    return redirect($request->from);
                }
                if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
                    return redirect()->route('usermob_sidebar')->with('success', 'You Have Successfully Login !');
                 } else {
                return redirect()->route('user_profile')->with('success', 'You Have Successfully Login !');
                 }

            }else{
                $validator->getMessageBag()->add('password', 'Wrong Password');
                return back()->withErrors($validator)->withInput();
            }
        }

        return back()->with('error', 'Invalid Email or Password!');
    }

    public function attemptLogout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('index');
    }

    public function sendOtp(Request $request, $phone)
    {
        $data = Customer::where('phone', $phone)->first();
        if(empty($data)) {
            if($request->from == 'dealer'){
                $data = BusinessPersonRequest::where('phone', $phone)->first();
                if(empty($data)){
                    $phone = '91' . $phone;
                    if(env('APP_ENV') == 'local'){
                        $otp=1234;
                        Session::put('otp',$otp);
                        return 1;
                    }else{
                        $otp=rand(1111,9999);
                        Session::put('otp',$otp);
                          Msg91::sms()->to('91'.$request->phone)->flow('64a6b9d1d6fc057c15503ab2')->variable('business_name', env('APP_NAME'))->variable('otp', $otp)->send();
                        //Msg91::otp()->to($phone)->template('6114d04775025d197f1e0ad7')->send();
                        return 1;
                    }
                }else{
                    return 2;
                }
            }else{
                $phone = '91' . $phone;
                if(env('APP_ENV') == 'local'){
                    $otp=1234;
                    Session::put('otp',$otp);
                    return 1;
                }else{
                    $otp=rand(1111,9999);
                    Session::put('otp',$otp);
                      Msg91::sms()->to('91'.$request->phone)->flow('64a6b9d1d6fc057c15503ab2')->variable('business_name', env('APP_NAME'))->variable('otp', $otp)->send();
                    //Msg91::otp()->to($phone)->template('6114d04775025d197f1e0ad7')->send();
                    return 1;
                }
            }
        }else{
            return 3;
        }
    }

    public function sendForgotOtp(Request $request, $phone)
    {
        $data = Customer::where('phone', $phone)->first();
        if(!empty($data)) {
           
                $phone = '91' . $phone;
                if(env('APP_ENV') == 'local'){
                    $otp=1234;
                    Session::put('otp',$otp);
                    return 1;
                }else{
                    $otp=rand(1111,9999);
                    Session::put('otp',$otp);
                      Msg91::sms()->to('91'.$request->phone)->flow('64a6b9d1d6fc057c15503ab2')->variable('business_name', env('APP_NAME'))->variable('otp', $otp)->send();
                    //Msg91::otp()->to($phone)->template('6114d04775025d197f1e0ad7')->send();
                    return 1;
            }
        }else{
            return 3;
        }
    }

    public function verifyOtp($phone, $otp)
    {
        // $phone = '91' . $phone;
        // $ver = Msg91::otp((int)$otp)->to($phone)->verify();
        if(Session::get('otp') != $otp){
            return response()->json(['msg'=>'Wrong OTP!'], 401);
        }else{
            return 1;
        }
    }

    public function details(Request $request, $slug)
    {
        try {
            if ($request->type == 'category') {
                $cat_slug = Category::where('slug', $slug)->first();
                $category_id = $cat_slug->id;
                $sub_categories = SubCategory::where('is_active', 1)->whereJsonContains('category_id', '' . $cat_slug->id)->get();
                return view('frontend.sub-categories', compact('sub_categories', 'category_id'));
            }
            if ($request->type == 'subcategory') {
                $subcat_slug = SubCategory::where('slug', $slug)->first();
                $list = Product::whereJsonContains('subcategory_id', '' . $subcat_slug->id);
                if ($request->brand) {
                    $list = $list->where('brand_id', $request->brand);
                }
            }
            if ($request->type == 'subsubcategory') {
                $subsubcat_slug = SubSubCategory::where('slug', $slug)->first();
                $list = Product::whereJsonContains('subsubcategory_id', '' . $subsubcat_slug->id);
            }
            if ($request->type == 'product') {
                $data = Product::where('slug', $slug)->first();
                $product_attribut_array = [];
                if (is_array($data->attribute)) {
                    foreach ($data->attribute as $key => $attr) {
                        array_push($product_attribut_array, [$attr, $data->attribute_value[$key]]);
                    }
                }
                return view('frontend.product-details', compact('data', 'product_attribut_array'));
            }
            if ($request->type == 'brand') {
                $brand_id = Brnad::where('slug', $slug)->first();
                $category_ids = [];
                $lists = Product::where('brand_id', optional($brand_id)->id)->pluck('category_id');
                foreach ($lists as $datas) {
                    foreach ($datas as $da) {
                        array_push($category_ids, $da);
                    }
                }
                $categories = Category::select('id', 'slug', 'name', 'icon')->where('is_active', 1)->whereIn('id', array_values(array_unique($category_ids)))->orderBy('priority', 'asc')->get();
                return view('frontend.all-categories', compact('categories'));
            }

            $list = $list->orderBy('name', 'asc')->paginate(20)->appends(request()->query());
            return vieW('frontend.product_list', compact('list', 'slug'));
        } catch (Exception $exception) {
            abort(404);
        }
    }

    public function updateUserProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'email' => 'required|unique:customers,email,' . Auth::guard('customer')->user()->id
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = rand() . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/public/frontend/user_profile');
            $image->move($destinationPath, $name);
        } else {
            $name = Auth::guard('customer')->user()->photo;
        }
        Customer::where('id', Auth::guard('customer')->user()->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'photo' => $name
        ]);

        return back()->with('success', 'Profile Updated Successfully!');
    }

    public function get_lens(Request $request){
        $power_type=$request->power_type;
        $lenses=Lens::where('power_type', $power_type)->where('is_active',1)->get();
        return view('frontend.lens',compact('lenses'))->render();
    }

    public function check_phone(Request $request)
    {
        $phoneNumberToCheck = $request->input('phone');

        // Simulate checking against the database
        $isValidPhoneNumber = Customer::where('phone', $phoneNumberToCheck)->exists();

        return response()->json(['isValid' => $isValidPhoneNumber]);

    }

    public function user_history_detail($id){
        $order = Order::where('id',$id)->first();
        return view('frontend.user-history-details', compact('order'));
    }

    public function review_store(Request $request){

            $review = new Review;
            $review->user_id =Auth::guard('customer')->user()->id ;
            $review->name=$request->name;
            $review->email=$request->email;
            $review->product_id=$request->product_id;
            $review->comment=$request->comment;
            $review->rating = $request->rate;
            $review->save();

            return back();
    }

    public function repair_glass(Request $request){

        $repair_glass=new RepairGlass;
        $repair_glass->name=$request->name;
        $repair_glass->house_no=$request->house_no;
        $repair_glass->pincode=$request->pincode;
        $repair_glass->district=$request->district;
        $repair_glass->state=$request->state;
        $repair_glass->landmark=$request->landmark;
        $repair_glass->left_eye_lense=$request->left_eye_lense;
        $repair_glass->power_left=$request->power_left;
        $repair_glass->right_eye_lense=$request->right_eye_lense;
        $repair_glass->power_right=$request->power_right;
        

        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/repair_glass'), $filename);
        }

        $repair_glass->file=$filename;

        $repair_glass->save();
        
        return back();

    }


}
