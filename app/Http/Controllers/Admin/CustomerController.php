<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Review;
use App\Models\Enquiry;
use App\Models\Customer;
use App\Models\RepairGlass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{

    public function index(Request $request){
        $search_key = $request->search_key;
        $search_date_range = $request->search_date_range;

        $customers = Customer::where('type','retailer');

        if($search_date_range){
            $dates=explode('-',$search_date_range);
            $d1=strtotime($dates[0]);
            $d2=strtotime($dates[1]);
            $da1=date('Y-m-d',$d1);
            $da2=date('Y-m-d',$d2);
            $startDate = Carbon::createFromFormat('Y-m-d', $da1)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $da2)->endOfDay();

            $search_date_range=$dates[0].'-'.$dates[1];
            $customers = $customers->whereBetween('created_at', [$startDate, $endDate]);
        }
        if($search_key){
            $customers = $customers->where(function($query) use ($search_key){
                $query->where('first_name','like','%'.$search_key.'%')
                ->orWhere('phone',$search_key)
                ->orWhere('email','like','%'.$search_key.'%');
            });
        }

        $customers = $customers->orderBy('created_at','desc')->paginate(10);

        if($request->ajax()){
            return view('backend.customers.table',compact('customers','search_key','search_date_range'));
        }

        return view('backend.customers.index',compact('customers','search_key','search_date_range'),['page_title'=>'Customer List']);
    }


    public function all_review(Request $request){

        $reviews = Review::paginate(10);
        return view('backend.review',compact('reviews'),['page_title'=>'Reviews']);
       
    }

    public function reviewStatusUpdate(Request $request,$id,$status)
    {
        $review =  Review::find($id);
        $review->status = $status;
        $review->save();
            return 1;
    }

    public function all_enquiry(Request $request){

        $enquiries = Enquiry::paginate(10);
        return view('backend.enquiry',compact('enquiries'),['page_title'=>'All Enquiry']);
       
    }

    public function all_repair_glass_enquiry(Request $request){

        $repair_glass_enquiry = RepairGlass::paginate(10);
        return view('backend.repair_glass_enquiry',compact('repair_glass_enquiry'),['page_title'=>'Repair Glass']);
       
    }

}
