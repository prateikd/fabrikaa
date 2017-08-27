<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductBrand;
use App\Colour;
use App\Slab;
use App\Size;
use App\Category;
use Response;
use Carbon;
use App\ProductImage;
use App\Http\Requests;
use App\Productinward;
use App\Productoutward;

class InventoryController2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products=Product::where('status','=', '1')->groupBy('product_code')->groupBy('colours')->get();
       foreach($products as $product)
            {

            $product_size = array();
            $productData = Product::select('product_status','product_wt','brands','colours','sizes', 'prices','quantity','printed_sample_price','printed_sample_quantity')->where('colours', $product->colours)->where('product_code', $product->product_code)->where('status','=', '1')->distinct()->get();

            $size_ctr = 0;

                foreach ($productData as $value) {
               
                    $product_size[]=$value->getproductsize;
                    $product_size[$size_ctr]['price']=$value->prices;
                    $product_size[$size_ctr]['quantity']=$value->quantity;
                    $product_size[$size_ctr]['product_wt']=$value->product_wt;
                    $product_size[$size_ctr]['product_status']=$value->product_status;
                    $product_size[$size_ctr]['printed_sample_price']=$value->printed_sample_price;
                    $product_size[$size_ctr]['printed_sample_quantity']=$value->printed_sample_quantity;

                    $size_ctr++;
                    $brands = ProductBrand::findOrFail($value->brands);
                    $brand_name = $brands->brand_name;

                    $colours = Colour::findOrFail($value->colours);
                    $colourname = $colours->colour_name;

                   }
                    //return $product_size;
                    $product->get_size=$product_size;
                    $product->brand_name = $brand_name;
                    $product->colour_name = $colourname;
                    $product=$product->getcategory;
                  //return  $productData;
                  // $sizeData=Size::where('size_status','!=',2)->get();
                  // return  $sizeData;
                }
                $sizeData=Size::where('size_status','!=',2)->get();
           // return  $products;
           
          return view('inventory.inventory_listing',compact('sizeData','products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // return "vandana";
        $categories = [''=>'Select a Category'] + Category::where('category_status','!=',2)->lists('category_name', 'id')->all();
        $colors = [''=>'Select a Colour'] + Colour::where('colour_status','!=',2)->lists('colour_name', 'id')->all();
        $product_name = [''=>'Select a Product'] + Product::where('status','!=',2)->lists('product_name', 'product_code')->all();
        $brands = [''=>'Select a Brand'] + ProductBrand::where('brand_status','!=',2)->lists('brand_name', 'id')->all();

        // $productcode = Product::lists('product_code', 'product_code')->all();
        // $categories = [''=>'Select a Category'] + Category::lists('category_name', 'id')->all();
        // //$productcolour = [''=>'Select a Product'] + Product::lists('colours', 'colours')->all();
        // $colors = [''=>'Select a Colour'] + Colour::lists('colour_name', 'id')->all();

        $products=Product::where('status','=', '1')->groupBy('product_code')->groupBy('colours')->get();
        foreach ($products as $Product)
        {
               $product_code=$Product->product_code;
               $category_id=$Product->category_id;
               $product_colour = array();
               $product_size = array();
               $allproducts = Product::select('colours','sizes')->where('product_code', '=', $product_code)->where('status','=', '1')->distinct()->get();

              foreach ($allproducts as $product) {
               $product_colour[]=$product->getproductcolour;
               $product_size[]=$product->getproductsize;

               }
               $Product->get_color=$product_colour;
               $Product->get_size=$product_size;

              $colours = Product::select('colours')->where('product_code', '=', $product_code)->where('status','=', '1')->distinct()->first();

                $sizeData=Size::where('size_status','!=',2)->get();
                //$priceData = array();
           foreach ($sizeData as $sizeprice) {
                  $priceData=Product::where('colours',$colours->colours)->where('sizes',$sizeprice->id)->where('product_code',$product_code)->where('status','=', '1')->get();
                  $sizeprice->priceData = $priceData;
              }
           // return $sizeData;

        }
        //return $products;
        return view('inventory.add_inventory',compact('productcode','productcolour','colors','colours','products','sizeData','categories','product_name','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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

    public function Warehouse()
    {
        return view('inventory.warehouse');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products=Product::findOrFail($id);
        return view('inventory.inventory_listing',compact('products'));
    }

     public function productStatus($id)
    {
        $products=Product::findOrFail($id);
        return view('inventory.inventory_listing',compact('products'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if($request->input('changestatus'))
        {
           $product_status=$request->input('product_status');

           $product_color=$request->input('color_id');
           $product_code=$request->input('product_code');

           $size=$request->input('size_id');


            $sizeCount=count($size);


            for($i=0;$i<$sizeCount;$i++)
                {

                 //$proStatus=$product_status[$j];
                  $updatestatus=Product::where('product_code', $product_code)->where('sizes', $size[$i])->where('colours', $product_color)->where('status','=', '1')->get();
                   foreach ($updatestatus as $changeStatus) {

                            $status=Product::findOrFail($changeStatus->id);
                            $status->product_status=$product_status[$i];
                            $status->save();
             }

           }


          // return "ok";
        }
        else
        {

        //$request->input('samplequantity');
        $sizeData=Size::where('size_status','!=',2)->get();
        $productprice= $request->input('prices');
        $productsampleprice= $request->input('sampleprice');
        $productpricecount=count($productprice);
        $productqty= $request->input('quantity');
        $productWeight= $request->input('product_wt');
        $productsampleqty= $request->input('samplequantity');
        $productcode= $request->input('product_code');
        $productcolour= $request->input('colours');


       // $colourData=Colour::where('colour_name',$productcolour)->get();
        $colourData=Colour::where('id',$productcolour)->get();
        foreach ($colourData as $singleColour) {
            $colourid=$singleColour->id;
        }

        $productsize= $request->input('sizes');
        //return $productsize[1];

    //return $products=Product::where('colours', 8)->where('sizes', 5)->where('product_code', 'POLOSHIRTSCODE')->get();

        for($i=0;$i<$productpricecount;$i++)
            {
                //echo $i;
               $products=Product::where('colours', $colourid)->where('sizes', $productsize[$i])->where('product_code', $productcode)->where('status','=', '1')->get();

               foreach ($products as $updateprice) {
                $proid=$updateprice->id;
                }
                    $updatepriceqty=Product::findOrFail($proid);
                    $previousprice=$updatepriceqty->prices;
                    //$previoussampleprice=$updatepriceqty->printed_sample_price;
                    $previousquantity=$updatepriceqty->quantity;
                    //$previoussamplequantity=$updatepriceqty->printed_sample_quantity;
                    //$previouswt=$updatepriceqty->product_wt;



                    $updatepriceqty->prices=$productprice[$i];
                    //$updatepriceqty->printed_sample_price=$productsampleprice[$i];
                    $updatepriceqty->quantity=$previousquantity+$productqty[$i];
                    $updatepriceqty->product_wt=$productWeight[$i];
                    //$updatepriceqty->printed_sample_quantity=$previoussamplequantity+$productsampleqty[$i];

                    // $updatedPrice=$previousquantity+$updatepriceqty->quantity;

                    //$updatepriceqty->product_status=$request->input('product_status');
                    $updatepriceqty->save();
            }
        }
     // return "test i";
       return redirect('AR78Tqr6f/1gd34gf/h5dm6x/inventory');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);
        $products->product_sku;
        $products->product_code;
        $products->status=2;
        $products->save();
        //$products->delete();


        $product_images = ProductImage::where('product_code', $products->product_code)->where('image_status','!=',2)->get();
        foreach ($product_images as $images) {
          $images->delete();
        }

        $product_slabs = Slab::where('product_code', $products->product_code)->get();
        foreach ($product_slabs as $slabs) {
          $slabs->delete();
        }
        return redirect('AR78Tqr6f/1gd34gf/h5dm6x/inventory');
    }

     public function get_brand(Request $request)
    {

      $category_id =$request->get('category_id');
      $products = Product::select('brands')->where('category_id','=',$category_id)->where('status','=', '1')->groupBy('brands')->get();
      foreach ($products as $product) {
        $brand_data[]=$product->brands;
      }
     // return $brand_data;
      $brands=ProductBrand::whereIn('id',$brand_data)->get();
       return Response::json($brands);

    }

      public function get_productcode(Request $request)
    {

      $brand_id =$request->get('brand_id');
      $cat_id =$request->get('category');

      $products = Product::where('brands','=',$brand_id)->where('category_id','=',$cat_id)->where('status','=', '1')->groupBy('product_code')->get();

       return Response::json($products);

    }

    public function get_colorcode(Request $request)
    {

        $product_code =$request->get('product_name');
       // session()->put('product_code', $product_code);

         $productscolor = Product::where('product_code','=',$product_code)->where('status','=', '1')->groupBy('colours')->get();
         foreach ($productscolor as $color) {
             $getcolor=$color->getproductcolour;
         }

         //return $productscolor;

   //return response()->json($productscolor, $product_color);
       return Response::json($productscolor);

    }

      public function addmoreinventory(Request $request)
    {
      //  $cat_id =$request->get('cat_id');
        $productcode =$request->get('product_name');

            $html="";



             $allcolors = Product::select('colours')->where('product_code', '=', $productcode)->where('status','=', '1')->distinct()->get();

            $sizeData=Size::where('size_status','!=',2)->get();

             $html .= '<table class="table table-striped table-bordered" id="inventoryTable">';
              $html .= '<tr>';
                $html .= '<th>';
                $html .= "Color";
                $html .= '</th>';
              foreach ($sizeData as $sizeh) {
                $html .= '<th>';
                $html .= $sizeh->size_name;
                $html .= '</th>';
              }

              $html .= '</tr>';

            foreach ($allcolors as $color) {

                $colorProductSizes = Product::select('sizes', 'colours')->where('colours',$color->colours)->where('product_code',$productcode)->where('status','=', '1')->distinct()->get();
               $html .= '<tr class="tr_clone" name="coloravl[]" data-color="'. $color->colours .'" >';
               $html .= '<td>';
               $color_name=Colour::findorfail($color->colours);
               $html .= $color_name->colour_name;

               $html .= '</td>';

                $sizeArray = array();
                foreach ($colorProductSizes as $colorProductSize) {
                    $sizeArray[] = $colorProductSize->sizes;
                }

                foreach ($sizeData as $sizeD) {
                    if(in_array($sizeD->id, $sizeArray)){
                        $html .= '<td class="sizetd">';
                        $html .= '<input type="text" style="width:70px" id="title" data-size="'.$sizeD->id.'" class="'.$sizeD->id.'" name="sizeavl[]" text="title">';
                        $html .= '</td>';

                    }
                    else {
                        $html .= '<td class="sizetd">';
                        $html .= '<input type="text" style="width:70px" id="title" data-size="'.$sizeD->id.'" class="'.$sizeD->id.'" name="title" text="title" disabled>';
                        $html .= '</td>';

                    }
                }

                 $html .= '</tr>';
            }
             $html .= '</table>';

            //return $html;
           return response()->json(['addmoreinventory' => $html]);

    }

    public function add_inward(Request $request)
    {
       $colorData =$request->get('colorData');
       $qtyData =$request->get('qtyData');
       //print_r($qtyData);
       $product_code =$request->get('product_code');
       $inward_date =$request->get('inward_date');
       $inward_number =$request->get('inward_number');
       $product_type =$request->get('product_type');
       $qty_type =$request->get('qty_type');
       $vendor_name =$request->get('vendor_name');
       $transport_name =$request->get('transport_name');
       $lr_number =$request->get('lr_number');

        $inwardcode = Productinward::where('product_type','plain')->orderBy('created_at', 'desc')->first();
        if($inwardcode=="")
        {
            $auto_inward_number= "FBINPLN11"."_".'1';
        }
        else
        {
            $insertedId =substr($inwardcode->auto_inward_number,10,13);
            $i=$insertedId + 01;
            $auto_inward_number="FBINPLN11"."_".$i;
            
        }

       $i=0;
       $quantity=0;
       $size=Size::where('size_status','!=',2)->get();

        foreach ($qtyData as $qtys) {
          $j=0;
         // return $qtys;
               foreach ($qtys as $qty) {
                 //  echo $qty;
                    $sizeId=$size[$j]->id;
                    $colorId=$colorData[$i];
                    if($qty!=0)
                    {

                       $allproducts=Product::where('colours',$colorId)->where('sizes',$sizeId)->where('product_code',$product_code)->where('status','=', '1')->get();
                     foreach ($allproducts as $product) {
                         $product_id=$product->id;
                         $product_qty=$product->quantity;
                         $product_sku=$product->product_sku;
                         $product_code=$product->product_code;
                     }
                        if($qty_type=="recount"){
                        $updateqty=Product::findOrFail($product_id);
                        $updateqty->quantity=$qty;
                        $updateqty->save();
                        }else{
                        $updateqty=Product::findOrFail($product_id);
                        $updateqty->quantity=$product_qty+$qty;
                        $updateqty->save();
                        }

                         $inwarditem_insert = new Productinward;
                         $inwarditem_insert->product_id =$product_id;
                         $inwarditem_insert->product_sku =$product_sku;
                         $inwarditem_insert->product_code =$product_code;
                         $inwarditem_insert->qty =$qty;
                         $inwarditem_insert->inward_date =$inward_date;
                         $inwarditem_insert->inward_number =$inward_number;
                         $inwarditem_insert->vendor_name =$vendor_name;
                         $inwarditem_insert->transport_name =$transport_name;
                         $inwarditem_insert->lr_number =$lr_number;
                         $inwarditem_insert->qty_type =$qty_type;
                         $inwarditem_insert->color_id =$colorId;
                         $inwarditem_insert->size_id =$sizeId;
                         $inwarditem_insert->product_type =$product_type;
                         $inwarditem_insert->auto_inward_number =$auto_inward_number;
                         
                         $inwarditem_insert->save();

                    }

                $j++;
              }
          $i++;

        }
        return Response::json(['msg' => 'success']);
    }

    public function inward_listing(Request $request)
    {

          $products=Productinward::where('product_type', "plain")->groupBy('product_code')->groupBy('color_id')->groupBy('auto_inward_number')->orderBy('inward_date','asc')->get();
          $productscount= $products->count();
        foreach($products as $product)
            {

            $product_size = array();


            $productData = Productinward::select('id','product_id','size_id','color_id','qty','auto_inward_number')->where('inward_date', $product->inward_date)->
             where('auto_inward_number', $product->auto_inward_number)->where('color_id', $product->color_id)->
             where('product_code', $product->product_code)->where('product_type', "plain")->orderBy('inward_date','asc')->get();
            $size_ctr = 0;

                foreach ($productData as $value) {
                    $product_size[]=$value->getproductsize;
                    $product_size[$size_ctr]['qty']=$value->qty;

                    $size_ctr++;
                    $colours = Colour::findOrFail($value->color_id);
                    $colour_name = $colours->colour_name;

                      $getproductData=$value->getproduct;
                      $getbrandname=$getproductData->getbrandname;
                      $getcategory=$getproductData->getcategory;
               }
             // return $products;
         //return $productData;
            $product->get_size=$product_size;

             $product->getproduct = $getproductData;
             $product->getbrandname = $getbrandname;
             $product->getcategory = $getcategory;

            $product->colour_name = $colour_name;

           $sizeData=Size::where('size_status','!=',2)->get();

    }
//return $products;

            return view('inventory.inward_listing', compact('products','sizeData','productscount'));
    }

    public function inward_edit(Request $request, $id)
    {
     // echo "1";
      if($request->input('recount'))
        {

          $sizeData=Size::where('size_status','!=',2)->get();

        $inwardqty= $request->input('quantity');
        $inwardqtycount=count($inwardqty);

        $productcode= $request->input('product_code');
        $productcolour= $request->input('colours');
        $inwarddate= $request->input('inward_date');
        $inwardnumber= $request->input('inward_number');
        $colorId= $request->input('colours');
        // $sizeId= $request->input('sizes');
        $product_sku= $request->input('product_sku');
        $transport_name=$request->get('transport_name');
        $lr_number=$request->get('lr_number');
        $auto_inward_number=$request->get('auto_inward_number');
       //return "ok";

       // $colourData=Colour::where('colour_name',$productcolour)->get();
        $colourData=Colour::where('id',$productcolour)->get();
        foreach ($colourData as $singleColour) {
            $colourid=$singleColour->id;
        }

        $productsize= $request->input('sizes');


        for($i=0;$i<$inwardqtycount;$i++)
            {
                //echo $i;
              //$sizeId=$productsize[$i]->id;
               $productInward=Productinward::where('inward_date', $inwarddate)->where('color_id', $colourid)->
               where('auto_inward_number', $auto_inward_number)->where('size_id', $productsize[$i])->
               where('product_type', "plain")->where('product_code', $productcode)->get();

               foreach ($productInward as $updateqty) {
                $proid=$updateqty->id;
                $prodid=$updateqty->product_id;
                }

                 // $product=Product::where('product_sku',$product_sku)->get();
                 // foreach ($product as $updateqty1) {
                 //    $prodid=$updateqty1->id;
                 // }

                     $inwarditem_insert = new Productinward;
                     $inwarditem_insert->product_id =$prodid;
                     $inwarditem_insert->product_sku =$product_sku;
                     $inwarditem_insert->product_code =$productcode;
                     $inwarditem_insert->qty =$inwardqty[$i];
                     $inwarditem_insert->inward_date =Carbon\Carbon::now();
                     $inwarditem_insert->color_id =$colorId;
                     $inwarditem_insert->size_id =$productsize[$i];
                     $inwarditem_insert->save();

                    // $updateinwardqty=Productinward::findOrFail($proid);
                    // $previousquantity=$updateinwardqty->qty;
                    // $updateinwardqty->qty=$inwardqty[$i];
                    // $updateinwardqty->transport_name=$transport_name;
                    // $updateinwardqty->lr_number=$lr_number;
                    // $updateinwardqty->save();

                    $updateproductqty=Product::findOrFail($prodid);
                    // $previousprodqty=$updateproductqty->quantity;
                    // $minusqty=$previousprodqty-$previousquantity;
                    $plusqty=$inwardqty[$i];

                    $updateproductqty->quantity=$plusqty;
                    $updateproductqty->save();

                return redirect('/AR78Tqr6f/1gd34gf/h5dm6x/inventory-inward');
              }
          }
        else{
        //$request->input('samplequantity');

        $sizeData=Size::where('size_status','!=',2)->get();

        $inwardqty= $request->input('quantity');
        $inwardqtycount=count($inwardqty);

        $productcode= $request->input('product_code');
        $productcolour= $request->input('colours');
        $inwarddate= $request->input('inward_date');
        $inwardnumber= $request->input('inward_number');
        $product_sku= $request->input('product_sku');
        $transport_name =$request->get('transport_name');
        $lr_number =$request->get('lr_number');
        $auto_inward_number=$request->get('auto_inward_number');

       // $colourData=Colour::where('colour_name',$productcolour)->get();
        $colourData=Colour::where('id',$productcolour)->get();
        foreach ($colourData as $singleColour) {
            $colourid=$singleColour->id;
        }

        $productsize= $request->input('sizes');


        for($i=0;$i<$inwardqtycount;$i++)
            {
                //echo $i;
               $productInward=Productinward::where('inward_date', $inwarddate)->where('color_id', $colourid)->
               where('auto_inward_number', $auto_inward_number)->where('size_id', $productsize[$i])->
               where('product_type', "plain")->where('product_code', $productcode)->get();

               foreach ($productInward as $updateqty) {
                $proid=$updateqty->id;
                $prodid=$updateqty->product_id;
                }

                 // $product=Product::where('product_sku',$product_sku)->get();
                 // foreach ($product as $updateqty1) {
                 //    $prodid=$updateqty1->id;
                 // }

                    $updateinwardqty=Productinward::findOrFail($proid);
                    $previousquantity=$updateinwardqty->qty;
                    $updateinwardqty->qty=$inwardqty[$i];
                    $updateinwardqty->transport_name=$transport_name;
                    $updateinwardqty->lr_number=$lr_number;
                    $updateinwardqty->save();

                    $updateproductqty=Product::findOrFail($prodid);
                    $previousprodqty=$updateproductqty->quantity;
                    $minusqty=$previousprodqty-$previousquantity;
                    $plusqty=$minusqty+$inwardqty[$i];

                    $updateproductqty->quantity=$plusqty;
                    $updateproductqty->save();



            }

     //return "test i";
       return redirect('/AR78Tqr6f/1gd34gf/h5dm6x/inventory-inward');
      }
    }

    public function inward_delete($id)
    {
        //return $id;
        $inwardData = Productinward::find($id);
        $inwards=Productinward::where('auto_inward_number',$inwardData->auto_inward_number)->
                      where('inward_date',$inwardData->inward_date)->
                      where('color_id',$inwardData->color_id)->
                      where('product_type', "plain")->get();

            foreach ($inwards as $inward) {
                $inwardqty=$inward->qty;
                 $inwardproduct_sku=$inward->product_sku;

                $productData = Product::where('product_sku', $inwardproduct_sku)->where('status','=', '1')->get();
                   foreach ($productData as $product) {
                           $product_qty=$product->quantity;
                           $product_id=$product->id;
                   }
                  // echo "cool".$product_id;
                    $updateProduct=Product::findOrFail($product_id);
                    $updateProduct->quantity = $product_qty-$inwardqty;
                    $updateProduct->save();

            $inward->delete();
            }
        //return "ok";
        return redirect('/AR78Tqr6f/1gd34gf/h5dm6x/inventory-inward');
    }


      public function outward_listing(Request $request)
    {

          $products=Productoutward::groupBy('product_code')->groupBy('color_id')->groupBy('auto_outward_number')->orderBy('outward_date','asc')->get();
          $productscount= $products->count();
        foreach($products as $product)
            {

            $product_size = array();


            $productData = Productoutward::select('id','product_id','size_id','color_id','qty','auto_outward_number')->where('outward_date', $product->outward_date)->
             where('auto_outward_number', $product->auto_outward_number)->where('color_id', $product->color_id)->
             where('product_code', $product->product_code)->orderBy('outward_date','asc')->get();
            $size_ctr = 0;

                foreach ($productData as $value) {
                    $product_size[]=$value->getproductsize;
                    $product_size[$size_ctr]['qty']=$value->qty;

                    $size_ctr++;
                    $colours = Colour::findOrFail($value->color_id);
                    $colour_name = $colours->colour_name;

                      $getproductData=$value->getproduct;
                      $getbrandname=$getproductData->getbrandname;
                      $getcategory=$getproductData->getcategory;
               }
             // return $products;
        
            $product->get_size=$product_size;

             $product->getproduct = $getproductData;
             $product->getbrandname = $getbrandname;
             $product->getcategory = $getcategory;

            $product->colour_name = $colour_name;

           $sizeData=Size::where('size_status','!=',2)->get();

    }
//return $products;

            return view('outward.outward_listing', compact('products','sizeData','productscount'));
    }

      public function outward_create()
    {
       // return "vandana";
        $categories = [''=>'Select a Category'] + Category::where('category_status','!=',2)->lists('category_name', 'id')->all();
        $colors = [''=>'Select a Colour'] + Colour::where('colour_status','!=',2)->lists('colour_name', 'id')->all();
        $product_name = [''=>'Select a Product'] + Product::where('status','!=',2)->lists('product_name', 'product_code')->all();
        $brands = [''=>'Select a Brand'] + ProductBrand::where('brand_status','!=',2)->lists('brand_name', 'id')->all();

        // $productcode = Product::lists('product_code', 'product_code')->all();
        // $categories = [''=>'Select a Category'] + Category::lists('category_name', 'id')->all();
        // //$productcolour = [''=>'Select a Product'] + Product::lists('colours', 'colours')->all();
        // $colors = [''=>'Select a Colour'] + Colour::lists('colour_name', 'id')->all();

        $products=Product::where('status','=', '1')->groupBy('product_code')->groupBy('colours')->get();
        foreach ($products as $Product)
        {
               $product_code=$Product->product_code;
               $category_id=$Product->category_id;
               $product_colour = array();
               $allproducts = Product::select('colours')->where('product_code', '=', $product_code)->where('status','=', '1')->distinct()->get();

              foreach ($allproducts as $product) {
               $product_colour[]=$product->getproductcolour;

               }
               $Product->get_color=$product_colour;

              $colours = Product::select('colours')->where('product_code', '=', $product_code)->where('status','=', '1')->distinct()->first();

                $sizeData=Size::where('size_status','!=',2)->get();
                //$priceData = array();
           foreach ($sizeData as $sizeprice) {
                  $priceData=Product::where('colours',$colours->colours)->where('sizes',$sizeprice->id)->where('product_code',$product_code)->where('status','=', '1')->get();
                  $sizeprice->priceData = $priceData;
              }
           // return $sizeData;

        }
     
        return view('outward.add_outward',compact('productcode','productcolour','colors','colours','products','sizeData','categories','product_name','brands'));
    }

    public function add_outward(Request $request)
    {
      
       $colorData =$request->get('colorData');
       $qtyData =$request->get('qtyData');
       //print_r($qtyData);
       $product_code =$request->get('product_code');
       $outward_date =$request->get('outward_date');
       
       $sale_type =$request->get('sale_type');
      

        $outwardcode = Productoutward::orderBy('created_at', 'desc')->first();
      
        if($outwardcode=="")
        {
          $auto_outward_number= "FBOUTPLN11"."_".'1';
        }
        else
        {
           $insertedId =substr($outwardcode->auto_outward_number,11,13);
            $i=$insertedId + 01;
           $auto_outward_number="FBOUTPLN11"."_".$i; 
        }
     
       $i=0;
       $quantity=0;
       $size=Size::where('size_status','!=',2)->get();

        foreach ($qtyData as $qtys) {
          $j=0;
         // return $qtys;
               foreach ($qtys as $qty) {
                 //  echo $qty;
                    $sizeId=$size[$j]->id;
                    $colorId=$colorData[$i];
                    if($qty!=0)
                    {

                       $allproducts=Product::where('colours',$colorId)->where('sizes',$sizeId)->where('product_code',$product_code)->where('status','=', '1')->get();
                     foreach ($allproducts as $product) {
                         $product_id=$product->id;
                         $product_qty=$product->quantity;
                         $product_sku=$product->product_sku;
                         $product_code=$product->product_code;
                     }
                        if($sale_type=="offlinereturn"){
                        $updateqty=Product::findOrFail($product_id);
                        $updateqty->quantity=$product_qty+$qty;
                        $updateqty->save();
                        }else{
                        $updateqty=Product::findOrFail($product_id);
                        $updateqty->quantity=$product_qty-$qty;
                        $updateqty->save();
                        }

                         $outwarditem_insert = new Productoutward;
                         $outwarditem_insert->product_id =$product_id;
                         $outwarditem_insert->product_sku =$product_sku;
                         $outwarditem_insert->product_code =$product_code;
                         $outwarditem_insert->qty =$qty;
                         $outwarditem_insert->outward_date =$outward_date;
                         $outwarditem_insert->sale_type =$sale_type;
                         $outwarditem_insert->color_id =$colorId;
                         $outwarditem_insert->size_id =$sizeId;
                         $outwarditem_insert->auto_outward_number =$auto_outward_number;
                         
                         $outwarditem_insert->save();

                    }

                $j++;
              }
          $i++;

        }
        return Response::json(['msg' => 'success']);
    }

    public function outward_delete($id,$sale_type)
    {
        //return $id;
        $outwardData = Productoutward::find($id);
        $outwards=Productoutward::where('auto_outward_number',$outwardData->auto_outward_number)->
                      where('outward_date',$outwardData->outward_date)->
                      where('color_id',$outwardData->color_id)->get();

            foreach ($outwards as $outward) {
                $outwardqty=$outward->qty;
                 $outwardproduct_sku=$outward->product_sku;

                $productData = Product::where('product_sku', $outwardproduct_sku)->where('status','=', '1')->get();
                   foreach ($productData as $product) {
                           $product_qty=$product->quantity;
                           $product_id=$product->id;
                   }
                  // echo "cool".$product_id;
                    $updateProduct=Product::findOrFail($product_id);
                    if($sale_type=="offlinesale")
                    {
                      $updateProduct->quantity = $product_qty+$outwardqty;
                    }
                    elseif($sale_type=="offlinereturn")
                    {
                      $updateProduct->quantity = $product_qty-$outwardqty;
                    }
                    $updateProduct->save();
                  

            $outward->delete();
            }
        //return "ok";
        return redirect('/AR78Tqr6f/1gd34gf/h5dm6x/inventory-outward');
    }

    public function outward_edit(Request $request, $id)
    {
     
        //$request->input('samplequantity');

        $sizeData=Size::where('size_status','!=',2)->get();

        $outwardqty= $request->input('quantity');
        $outwardqtycount=count($outwardqty);

        $productcode= $request->input('product_code');
        $productcolour= $request->input('colours');
        $outwarddate= $request->input('outward_date');
        $product_sku= $request->input('product_sku');
        $auto_outward_number=$request->get('auto_outward_number');
        $sale_type=$request->get('sale_type');

        $colourData=Colour::where('id',$productcolour)->get();
        foreach ($colourData as $singleColour) {
            $colourid=$singleColour->id;
        }

        $productsize= $request->input('sizes');


        for($i=0;$i<$outwardqtycount;$i++)
            {
                //echo $i;
               $productOutward=Productoutward::where('outward_date', $outwarddate)->where('color_id', $colourid)->
               where('auto_outward_number', $auto_outward_number)->where('size_id', $productsize[$i])->
               where('product_code', $productcode)->get();

               foreach ($productOutward as $updateqty) {
                $proid=$updateqty->id;
                $prodid=$updateqty->product_id;
                }

                 
                    $updateoutwardqty=Productoutward::findOrFail($proid);
                    $previousquantity=$updateoutwardqty->qty;
                    $updateoutwardqty->qty=$outwardqty[$i];
                    
                    $updateoutwardqty->save();

                    $updateproductqty=Product::findOrFail($prodid);
                    $previousprodqty=$updateproductqty->quantity;  
                  
                    if($sale_type=="offlinesale")
                    {
                       $minusqty=$previousprodqty+$previousquantity;
                       $plusqty=$minusqty-$outwardqty[$i];    
                    }
                    elseif($sale_type=="offlinereturn")
                    {
                       $minusqty=$previousprodqty-$previousquantity;
                       $plusqty=$minusqty+$outwardqty[$i];  
                    }
                   

                    $updateproductqty->quantity=$plusqty;
                    $updateproductqty->save();



            }

     //return "test i";
       return redirect('/AR78Tqr6f/1gd34gf/h5dm6x/inventory-outward');
      }


    
}
