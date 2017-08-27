<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Colour;
use App\Size;
use App\Product;
use App\Slab;
use App\ProductSlab;
use App\Http\Requests;
use App\Http\Requests\SlabRequest;

class SlabAddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colours = Colour::all();
        $sizes = Size::all();
        //$slabs = Qtyslab::all();
        return view('product.add_slab',compact('colours','sizes','slabs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }


    public function addslab(Request $request, $id)
    {
        //return $id;
        $product_code=$id;
        $colours = Colour::all();
        $sizes = Size::all();
        //$slabs = Qtyslab::all();
        return view('product.add_slab',compact('colours','sizes','slabs','product_code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlabRequest $request)
    {
        //return "test";
        //$products=Product::where('product_sku', 'CKAM001')->get();
        $product_code=$request->get('product_code');
        $counter1 = 0;

        
        for($i=0;$i<=25;$i++)
        {
            if($i!= 0)
                {
                    
                    $lower_bond[$i] = $request->get('qty_lower_bond'.$i);
                    $upper_bond[$i] = $request->get('qty_upper_bond'.$i);
                    $discount[$i] = $request->get('discount'.$i);
                   
                }
                if($counter1 == 0)
                {   
                   //return "test";
                    $lower_bond[$i] = $request->get('qty_lower_bond'); 
                    $upper_bond[$i] = $request->get('qty_upper_bond');
                    $discount[$i] = $request->get('discount');
                   
                }           
                
            $counter1++;
        }

//return $colour;

            for($i=0;$i<=25;$i++)
            {               
                
                $slabUpdate=new Slab;
              
              if($lower_bond[$i]=="" && $upper_bond[$i]=="" && $discount[$i]=="")
                {
                  
                }
                else
                {
                  $slabUpdate->qty_lower_bond=$lower_bond[$i];
                  $slabUpdate->qty_upper_bond=$upper_bond[$i];
                  $slabUpdate->discount=$discount[$i];
                  $slabUpdate->product_code=$product_code;
                  $slabUpdate->save();
                }
            }
        // $colours = Colour::all();
        // $sizes = Size::all();
        // $slabs = Qtyslab::all();
       // return view('product.add_slab',compact('colours','sizes','slabs'));   
       return redirect('/products/detail-view/'.$product_code);    
        //return redirect('/Slab-Listing/'.$product_code);      
        //return redirect('Products');
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
        $productcode=$slabs->product_code;
      
       return view('product.add_slab',compact('slabs','productcode'));
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
        $product_code=$request->get('product_code');
        $counter1 = 0;

        
        for($i=0;$i<=25;$i++)
        {
            if($i!= 0)
                {
                    
                    $lower_bond[$i] = $request->get('qty_lower_bond'.$i);
                    $upper_bond[$i] = $request->get('qty_upper_bond'.$i);
                    $discount[$i] = $request->get('discount'.$i);
                   
                }
                if($counter1 == 0)
                {   
                   //return "test";
                    $lower_bond[$i] = $request->get('qty_lower_bond'); 
                    $upper_bond[$i] = $request->get('qty_upper_bond');
                    $discount[$i] = $request->get('discount');
                   
                }           
                
            $counter1++;
        }

//return $colour;

            for($i=0;$i<=25;$i++)
            {               
                
                $slabUpdate=Slab::findOrFail($id);
              
              if($lower_bond[$i]=="" && $upper_bond[$i]=="" && $discount[$i]=="")
                {
                  
                }
                else
                {
                  $slabUpdate->qty_lower_bond=$lower_bond[$i];
                  $slabUpdate->qty_upper_bond=$upper_bond[$i];
                  $slabUpdate->discount=$discount[$i];
                  $slabUpdate->product_code=$product_code;
                  $slabUpdate->save();
                }
            }
        // $colours = Colour::all();
        // $sizes = Size::all();
        // $slabs = Qtyslab::all();
       // return view('product.add_slab',compact('colours','sizes','slabs'));     
        return redirect('/Slab-Listing/'.$product_code);      
        //return redirect('Products');
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
        $productcode=$slabs->product_code;
        $slabs->delete();
        return redirect('/Slab-Listing/'.$productcode);  
        //return redirect('Slab-Listing'); 
    }
}
