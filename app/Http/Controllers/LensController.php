<?php

namespace App\Http\Controllers;

use App\Models\Lens;
use Illuminate\Http\Request;

class LensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list=Lens::orderBy('name','asc');
        $search=$request->key;
        if(!empty($search))
        {
            $list=$list->where('name','like','%'.$search.'%');
        }

        $page=$request->page;
        $list=$list->paginate(10);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('admin.lens.index',['key='.$search.'&page='.$page])->with('success', 'Lens Deleted Successfully !!');
        }

        return view('backend.lens.index',compact('list','search'),['page_title'=>'Lens List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $key=$request->key;
        $page=$request->page;
        return view('backend.lens.create',compact('key','page'),['page_title'=>'Add Lens']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $key=$request->key;
        $page=$request->page;

        $lens=new Lens;
        $lens->power_type=$request->power_type;
        $lens->name=$request->name;
        $lens->price=$request->price;
        $lens->discount=$request->discount;
        $lens->warranty_period=$request->warranty_period;
        $lens->thickeness=$request->thickeness;
        $lens->power_range=$request->power_range;
        $lens->blue_light_blocker=$request->blue_light_blocker;
        $lens->anit_scratch_coating=$request->anit_scratch_coating;
        $lens->b_anti_glare_coating=$request->b_anti_glare_coating;
        $lens->b_anti_reflective_coating=$request->b_anti_reflective_coating;
        $lens->uv_protection=$request->uv_protection;
        $lens->water_dust_replellent=$request->water_dust_replellent;
        $lens->brekage_crack_resistance=$request->brekage_crack_resistance;
        $lens->icon=$request->icon;
        $lens->price=$request->price;
        $lens->save();

        return redirect()->route('admin.lens.index',['key='.$key.'&page='.$page])->with('success','Lens Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lens  $lens
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;
        Lens::where('id',$id)->update([
            'is_active'=>$request->is_active
        ]);
        if($request->is_active)
        {
            return redirect()->route('admin.lens.index',['key='.$key.'&page='.$page])->with('success','Lens Active!');
        }
        else
        {
            return redirect()->route('admin.lens.index',['key='.$key.'&page='.$page])->with('error','Lens Deactive!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lens  $lens
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;
        $lens=Lens::where('id',$id)->first();
        return view('backend.lens.edit',compact('lens','key','page'),['page_title'=>'Edit Lens']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lens  $lens
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;

        $lens=Lens::find($id);
        $lens->power_type=$request->power_type;
        $lens->name=$request->name;
        $lens->price=$request->price;
        $lens->discount=$request->discount;
        $lens->warranty_period=$request->warranty_period;
        $lens->thickeness=$request->thickeness;
        $lens->power_range=$request->power_range;
        $lens->blue_light_blocker=$request->blue_light_blocker;
        $lens->anit_scratch_coating=$request->anit_scratch_coating;
        $lens->b_anti_glare_coating=$request->b_anti_glare_coating;
        $lens->b_anti_reflective_coating=$request->b_anti_reflective_coating;
        $lens->uv_protection=$request->uv_protection;
        $lens->water_dust_replellent=$request->water_dust_replellent;
        $lens->brekage_crack_resistance=$request->brekage_crack_resistance;
        $lens->icon=$request->icon;
        $lens->price=$request->price;
        $lens->save();

        return redirect()->route('admin.lens.index',['key='.$key.'&page='.$page])->with('success','Lens Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lens  $lens
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lens $lens)
    {
        //
    }
}
