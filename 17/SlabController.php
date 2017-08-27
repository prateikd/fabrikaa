<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slab;
use App\Size;
USE App\Weight;
use App\Product;
use App\Category;
use DB;
use App\Http\Requests;
use App\Http\Requests\SlabRequest;

class SlabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $slabs=Slab::all();
        foreach($slabs as $Slab)
        {
           $slabname=$Slab->getsize;
        }

        foreach($slabs as $ProductName)
        {
           $Productname=$ProductName->getprodname;
        }
        //return $slabs;
        return view('slab.slab_listing', compact('slabs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('slab.add_slab');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlabRequest $request)
    {
        // return "test";
        $slabs = new Slab;
        $slabs->qty_lower_bond = $request->input('qty_lower_bond');
        $slabs->qty_upper_bond = $request->input('qty_upper_bond');
       
        $slabs->save();
       
        return redirect('Slab-Listing'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $slabs=Slab::findOrFail($id);
       
       return view('product.add_slab',compact('slabs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlabRequest $request, $id)
    {
        // $slabs=Slab::findOrFail($id);
       
        // $slabs->qty_lower_bond = $request->input('qty_lower_bond');
        // $slabs->qty_upper_bond = $request->input('qty_upper_bond');
        // $slabs->save();
        
        // return redirect('Slab-Listing'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slabs = Slab::find($id);
        $slabs->delete();
        return redirect('Slab-Listing'); 
    }


    public function slab_listing($id)
    {
        //return $id;
        $slabs = Slab::where('product_code',$id)->get();
       
        return view('slab.slab_listing', compact('slabs'));
    }


}
