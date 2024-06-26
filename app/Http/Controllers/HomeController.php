<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.dashboard',['page_title'=>'Dashboard']);
    }

    public function apply_discount(Request $request){
        Product::where('id','>',0)->update(['retailer_discount' => $request->discount]);
        return back();
    }

   
}
