<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductBrand;
use App\Style;
use App\Fabric;
use App\Gender;
use App\Weight;
use App\FabricProperties;
use App\Size;
use App\PrintingDecoration;
use App\LabelTag;
use App\SideSeams;
use App\Slab;
use App\Sale;
use App\Colour;
use DB;
use App\Price;
use Session;
use App\Category;
use App\Product;
use App\Http\Requests;
use Illuminate\Http\UploadedFile;
use App\ProductImage;
use App\Http\Requests\ProductRequest;
use Response;
class ProductController3 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //return "vandana";
        $productList=Product::where('status','!=',2)->groupBy('product_code')->get();
       foreach ($productList as $product) {
          $no_of_sku=Product::where('product_code',$product->product_code)->where('status','!=',2)->count();
         $product->no_of_sku=$no_of_sku;
       }
       //return $productList;
        return view('product.listing_product',compact('productList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories = [''=>'Select a Category'] + Category::where('category_status','!=',2)->lists('category_name', 'id')->all();
        $brands = [''=>'Select a Brand'] + ProductBrand::where('brand_status','!=',2)->lists('brand_name', 'id')->all();
        $styles = [''=>'Select a Style'] + Style::where('style_status','!=',2)->lists('name', 'id')->all();
        $genders = [''=>'Select a Gender'] + Gender::where('gender_status','!=',2)->lists('gender', 'id')->all();
        $fabrics = [''=>'Select a Fabric'] + Fabric::where('fabric_status','!=',2)->lists('fabric_name', 'id')->all();
        $weights = [''=>'Select a Weight'] + Weight::where('weight_status','!=',2)->orderBy('weight')->lists('weight', 'id')->all();
        $fabricproperties = FabricProperties::where('fabricprop_status','!=',2)->lists('property_name', 'id')->all();
        $colours = [''=>'Select a Colour'] + Colour::where('colour_status','!=',2)->lists('colour_name', 'id')->all();
        $printingdecoration = PrintingDecoration::where('printingdeco_status','!=',2)->lists('name', 'id')->all();
        $sizes = Size::where('size_status','!=',2)->lists('size_name', 'id')->all();
        //Neck Label means LabelTag
        $labeltag = [''=>'Select a LabelTag'] + LabelTag::where('labeltags_status','!=',2)->lists('tag_name', 'id')->all();
        $sideseams = [''=>'Select a SideSeams'] + SideSeams::where('side_status','!=',2)->lists('name', 'id')->all();
        $sales =[''=>'Select a LabelTag'] + Sale::where('sale_status','!=',2)->lists('sale_name', 'id')->all();
       // $prices = Slab::lists('price', 'id')->all();
        // $slabs = DB::table('slabs as u')
        //         ->selectRaw('CONCAT(u.qty_lower_bond, "-", u.qty_upper_bond, " (", (u.price),") " ) as slab ,  u.id')
        //         ->lists('slab', 'u.id');

        
        return view('product.add_product', compact('categories','brands','styles','genders','fabrics','weights','fabricproperties','colours','printingdecoration','sizes','labeltag','sideseams','prices','sales','slabs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        
        $featured_product = $request->input('featured_product') ? true : false;
        $feature_product=(integer)$featured_product;     

        // $select_slabs = $request->input('slabs') ? true : false;
        // $product_slabs=(integer)$select_slabs;   

        $colours = $request->input('colours');
        $inserted_colours = $request->input('colours');
        $Colourcount=count($colours);
        $sizes = $request->input('sizes');
        $Sizecount=count($sizes);    
        $k=0;
        $file = $request->file('product_image');                
         if($request->hasFile('product_image')){
                $destination_path = 'productimg/';
                $filename = str_random(6).'_'.$file->getClientOriginalName();
                $file->move($destination_path, $filename);
                
            }

         $file1 = $request->file('product_sheet');                
         if($request->hasFile('product_sheet')){
                $destination_path1 = 'productimg/';
                $filename1 = str_random(6).'_'.$file1->getClientOriginalName();
                $file1->move($destination_path1, $filename1);
                
            }

        $file2 = $request->file('product_size_image');                
         if($request->hasFile('product_size_image')){
                $destination_path2 = 'productimg/';
                $filename2 = str_random(6).'_'.$file2->getClientOriginalName();
                $file2->move($destination_path2, $filename2);
                
            }

        $file3 = $request->file('product_guide_image');                
         if($request->hasFile('product_guide_image')){
                $destination_path3 = 'productimg/';
                $filename3 = str_random(6).'_'.$file3->getClientOriginalName();
                $file3->move($destination_path3, $filename3);
            }

        $file4 = $request->file('product_sample_image');                
         if($request->hasFile('product_sample_image')){
                $destination_path4 = 'productimg/';
                $filename4 = str_random(6).'_'.$file4->getClientOriginalName();
                $file4->move($destination_path4, $filename4);
            }

            for($i=0;$i<$Colourcount;$i++)
                {

                    for($j=0;$j<$Sizecount;$j++)
                    {
                        $productdata = Product::orderBy('id', 'desc')->first(); 
                     //   echo $inserted_colours;
                        $products = new Product;
                        $products->category_id = $request->input('category_id');
                        $products->product_name = $request->input('product_name');
                       // $products->product_sku = $request->input('product_sku');
                        $products->product_code = $request->input('product_code');
                        //Product sub heading means Product Tagline
                        $products->product_subheading = $request->input('product_subheading');
                        $products->brands = $request->input('brands');
                        $products->styles = $request->input('styles');
                        $products->genders = $request->input('genders');
                        $products->fabrics = $request->input('fabrics');
                        $products->weights = $request->input('weights');
                        $products->colours = $colours[$i];
                        $products->sizes = $sizes[$j];
                        $products->labeltag = $request->input('labeltag');
                        $products->sideseams = $request->input('sideseams');
                        $products->sales = $request->input('sales');
                       // $products->order_sample_price = $request->input('order_sample_price');
                        $products->product_position = $request->input('product_position');


                         //Product SKU 
                         if($productdata=="")
                            {
                                                  
                                $incrementId=str_pad(1,2,"0",STR_PAD_LEFT);
                                $category=Category::findOrFail($products->category_id);

                                $category_name=substr($category->category_name,0,3);

                                $product_name=substr($products->product_name,0,4);

                                $colours=Colour::findOrFail($colours);
                                $product_colours=substr($colours->colour_name,0,1);

                                $sizes = Size::findOrFail($sizes[$j]);
                                $size_name = substr($sizes->size_name,0,1);

                                $products->product_sku = strtoupper($category_name.$product_name.$product_colours.$size_name.$incrementId); 
                                
                            }
                            else
                            {
                             //  echo "vandana";
                                $insertedId =substr($productdata->product_sku,9,10);
                              // echo "bhilare";
                                $k=$insertedId + 01;
                                $category=Category::findOrFail($products->category_id);
                                $category_name=substr($category->category_name,0,3);

                                 $color=Colour::findOrFail($inserted_colours);
                                 $product_colours=substr($color->colour_name,0,1);

                                $product_name=substr($products->product_name,0,4);

                                $sizes1 = Size::findOrFail($sizes[$j]);
                                $size_name = substr($sizes1->size_name,0,1);
                                

                                $products->product_sku = strtoupper($category_name.$product_name.$product_colours.$size_name.$k); 
                              //  $products->product_sku = strtoupper($category_name.$product_name.$product_colours.$k); 
                            }
                                                
                        //Product sku end

                       

                        if($request->input('fabricproperties')!="")
                             {
                                 $products->fabricproperties = implode(',', $request->input('fabricproperties'));
                             }
                            
                        if($request->input('printingdecoration')!="")
                         {
                             $products->printingdecoration = implode(',', $request->input('printingdecoration'));
                             
                         }
                           
                        // $products->purpose = $request->input('purpose');
                        $products->sizing = $request->input('sizing');
                        $products->description = $request->input('description');
                        $products->tech_specification = $request->input('tech_specification');

                        if($featured_product==1)
                        {
                            $products->featured_product = 1;
                        }
                        else
                        {
                             $products->featured_product = 0;
                        }

                      
                        
                        //upload the image // 
                        $products->product_image = $destination_path . $filename;
                        $products->product_sheet = $destination_path1. $filename1;
                        $products->product_size_image = $destination_path2 . $filename2;
                        $products->product_guide_image = $destination_path3 . $filename3;
                        $products->product_sample_image = $destination_path4 . $filename4;
                        $products->status = 0;
                        $products->product_status=0;
                        $products->save();      
                     }  
                     
                }
                //return "cool";
              
         // return redirect('color-size');   
        $last_inserted_id=DB::getPdo()->lastInsertId();
        $products=Product::findOrFail($last_inserted_id);
        $productcode=$products->product_code;
          

     return redirect('/AR78Tqr6f/1gd34gf/h5dm6x/slab/addslab/'.$productcode);  
       //return view('product.add_slab', compact('products','productcode'));     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products=Product::findOrFail($id);
        
        return view('product.product_view', compact('products'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return "test";
        $products=Product::findOrFail($id);
        $fabricpro_id = explode(',', $products->fabricproperties);
        $printdeco_id = explode(',', $products->printingdecoration);
        $size_id = explode(',', $products->sizes);
        
        $categories = [''=>'Select a Category'] + Category::where('category_status','!=',2)->lists('category_name', 'id')->all();
        $brands = [''=>'Select a Brand'] + ProductBrand::where('brand_status','!=',2)->lists('brand_name', 'id')->all();
        $styles = [''=>'Select a Style'] + Style::where('style_status','!=',2)->lists('name', 'id')->all();
        $genders = [''=>'Select a Gender'] + Gender::where('gender_status','!=',2)->lists('gender', 'id')->all();
        $fabrics = [''=>'Select a Fabric'] + Fabric::where('fabric_status','!=',2)->lists('fabric_name', 'id')->all();
        $weights = [''=>'Select a Weight'] + Weight::where('weight_status','!=',2)->lists('weight', 'id')->all();
        $fabricproperties = FabricProperties::where('fabricprop_status','!=',2)->pluck('property_name', 'id')->all();
        $colours = [''=>'Select a Colour'] + Colour::where('colour_status','!=',2)->lists('colour_name', 'id')->all();
        $printingdecoration = PrintingDecoration::where('printingdeco_status','!=',2)->lists('name', 'id')->all();
        $sizes = Size::where('size_status','!=',2)->lists('size_name', 'id')->all();
        //Neck Label means LabelTag
        $labeltag = [''=>'Select a LabelTag'] + LabelTag::where('labeltags_status','!=',2)->lists('tag_name', 'id')->all();
        $sideseams = [''=>'Select a SideSeams'] + SideSeams::where('side_status','!=',2)->lists('name', 'id')->all();
        $sales =[''=>'Select a LabelTag'] + Sale::where('sale_status','!=',2)->lists('sale_name', 'id')->all();
        $prices = Price::lists('prices', 'id')->all();
        // $sales = Sale::lists('sale_name', 'id')->all();
        // $slabs = DB::table('slabs as u')
        //         ->selectRaw('CONCAT(u.qty_lower_bond, "-", u.qty_upper_bond, " (", (u.price),") " ) as slab ,  u.id')
        //         ->lists('slab', 'u.id');

        return view('product.add_product', compact('fabricpro_id','printdeco_id','size_id','colour_id','categories','brands','styles','genders','fabrics','weights','slabs','fabricproperties','colours','printingdecoration','sizes','labeltag','sideseams','prices','sales','products'));
        
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
       //return "test 123";
        $pcode=$request->input('product_code');
        $featured_product = $request->input('featured_product') ? true : false;
        $feature_product=(integer)$featured_product;   

        $productdata = Product::orderBy('id', 'desc')->first(); 
        // $select_slabs = $request->input('slabs') ? true : false;
        // $product_slabs=(integer)$select_slabs;       

        $colours = $request->input('colours');
        $inserted_colours = $request->input('colours');
        $Colourcount=count($colours);
        $sizes = $request->input('sizes');
        $Sizecount=count($sizes);   
        $k=0;
        // $products=Product::findOrFail($id);
        $file = $request->file('product_image');                
        if($request->hasFile('product_image')){
                $destination_path = 'productimg/';
                $filename = str_random(6).'_'.$file->getClientOriginalName();
                $file->move($destination_path, $filename);
                
            }

        $file1 = $request->file('product_sheet');                
         if($request->hasFile('product_sheet')){
                $destination_path1 = 'productimg/';
                $filename1 = str_random(6).'_'.$file1->getClientOriginalName();
                $file1->move($destination_path1, $filename1);
                
            }

         $file2 = $request->file('product_size_image');                
         if($request->hasFile('product_size_image')){
                $destination_path2 = 'productimg/';
                $filename2 = str_random(6).'_'.$file2->getClientOriginalName();
                $file2->move($destination_path2, $filename2);
                
            }

        $file3 = $request->file('product_guide_image');                
         if($request->hasFile('product_guide_image')){
                $destination_path3 = 'productimg/';
                $filename3 = str_random(6).'_'.$file3->getClientOriginalName();
                $file3->move($destination_path3, $filename3);
            }

        $file4 = $request->file('product_sample_image');                
         if($request->hasFile('product_sample_image')){
                $destination_path4 = 'productimg/';
                $filename4 = str_random(6).'_'.$file4->getClientOriginalName();
                $file4->move($destination_path4, $filename4);
            }
        
        // for($i=0;$i<$Colourcount;$i++)
        //         {

        //             for($j=0;$j<$Sizecount;$j++)
        //             {

                       //  $size_exist=Product::where('colours',$colours)->where('sizes',$sizes[$j])->where('product_code',$pcode)->where('status','!=', '2')->get();
                       //  $sizeExistCount=count($size_exist);

                       //  if($sizeExistCount==1)
                       //   {
                       //      //return "test for same size";

                       //      $sizes = Size::findOrFail($sizes[$j]);
                       //      $size_name = $sizes->size_name;
                       //      Session::flash('sizeexistmsg', $size_name . ' size is already exist for that color!');

                         
                       //   return redirect()->route('products.edit', $productdata->id);
                           
                       //  }
                       // else
                       // {

                        $products=Product::findOrFail($id);
                        $products->category_id = $request->input('category_id');
                        $products->product_name = $request->input('product_name');
                       // $products->product_sku = $request->input('product_sku');
                        $products->product_code = $request->input('product_code');
                        //Product sub heading means Product Tagline
                        $products->product_subheading = $request->input('product_subheading');
                        $products->brands = $request->input('brands');
                        $products->styles = $request->input('styles');
                        $products->genders = $request->input('genders');
                        $products->fabrics = $request->input('fabrics');
                        $products->weights = $request->input('weights');
                        //$products->colours = $colours;

                       
                        //$products->sizes = $sizes[$j];
                        
                        $products->labeltag = $request->input('labeltag');
                        $products->sideseams = $request->input('sideseams');
                        $products->sales = $request->input('sales');
                        //$products->order_sample_price = $request->input('order_sample_price');
                        $products->product_position = $request->input('product_position');
                        
                        

                        if($request->input('fabricproperties')!="")
                             {
                                 $products->fabricproperties = implode(',', $request->input('fabricproperties'));
                             }
                            
                            if($request->input('printingdecoration')!="")
                             {
                                 $products->printingdecoration = implode(',', $request->input('printingdecoration'));
                                 
                             }
                           
                        // $products->purpose = $request->input('purpose');
                        $products->sizing = $request->input('sizing');
                        $products->description = $request->input('description');
                        $products->tech_specification = $request->input('tech_specification');

                        if($featured_product==1)
                        {
                            $products->featured_product = 1;
                        }
                        else
                        {
                             $products->featured_product = 0;
                        }

                        //upload the image //
                        if($request->hasFile('product_image')){
                            $products->product_image = $destination_path . $filename;
                        }
                        //upload the Product Sheet //
                        if($request->hasFile('product_sheet')){
                            $products->product_sheet = $destination_path1 . $filename1;
                        }
                      
                        //upload the Product Size Chart Image //
                        if($request->hasFile('product_size_image')){
                            $products->product_size_image = $destination_path2 . $filename2;
                        }

                         //upload the Product Size Guide Image //
                        if($request->hasFile('product_guide_image')){
                            $products->product_guide_image = $destination_path3 . $filename3;
                        }
                         //upload the Product Sample Printed Image //
                        if($request->hasFile('product_sample_image')){
                            $products->product_sample_image = $destination_path4 . $filename4;
                        }

                        $products->save();     
                //     }
                // }
            //}
               $productupdated=Product::findOrFail($id);
               $productImageEdit=Product::where('product_code',$pcode)->where('status','!=',2)->get();
               foreach ($productImageEdit as $imageEdit) {
                   $imageEdit->product_image=$productupdated->product_image;
                   $imageEdit->product_guide_image=$productupdated->product_guide_image;
                   $imageEdit->product_sample_image=$productupdated->product_sample_image;
                   $imageEdit->product_name=$productupdated->product_name;
                   $imageEdit->product_code=$productupdated->product_code;
                   $imageEdit->product_sheet=$productupdated->product_sheet;
                   $imageEdit->product_size_image=$productupdated->product_size_image;
                   $imageEdit->product_subheading = $productupdated->product_subheading;
                   $imageEdit->sizing = $productupdated->sizing;
                   $imageEdit->description = $productupdated->description;
                   $imageEdit->tech_specification = $productupdated->tech_specification;
                   if($featured_product==1)
                    {
                        $imageEdit->featured_product = 1;
                    }
                    else
                    {
                         $imageEdit->featured_product = 0;
                    }
                    $imageEdit->brands = $productupdated->brands;
                    $imageEdit->styles = $productupdated->styles;
                    $imageEdit->genders = $productupdated->genders;
                    $imageEdit->fabrics = $productupdated->fabrics;
                    $imageEdit->weights = $productupdated->weights;
                    $imageEdit->labeltag = $productupdated->labeltag;
                    $imageEdit->sideseams = $productupdated->sideseams;
                    $imageEdit->sales = $productupdated->sales;
                    $imageEdit->product_position = $productupdated->product_position;
                    if($productupdated->fabricproperties!="")
                     {
                         $imageEdit->fabricproperties = $productupdated->fabricproperties;
                     }
                    
                    if($productupdated->printingdecoration!="")
                     {
                         $imageEdit->printingdecoration = $productupdated->printingdecoration;
                         
                     }

                    $imageEdit->save();  

               }
        // $last_inserted_id=DB::getPdo()->lastInsertId();
        // $products=Product::findOrFail($last_inserted_id);
        // $productcode=$products->product_code;
        //return view('product.add_slab', compact('productcode'));  
       return redirect('/products/detail-view/'.$pcode);    
   }
    // return redirect('Products');    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //return $id;
        $products = Product::find($id);
        $products->product_sku;
        $products->product_code;
        $products->delete();
        
        $product_images = ProductImage::where('product_code', $products->product_code)->get();
        foreach ($product_images as $images) {
          $images->delete();
        }
      
        $product_slabs = Slab::where('product_code', $products->product_code)->get();
        foreach ($product_slabs as $slabs) {
          $slabs->delete();
        }
        return redirect('/products/detail-view/'.$products->product_code);  
     
            
        
       // return redirect('Products'); 
    }

    public function delete_checked(Request $request)
    {
        //echo "hello";
      $productCode =$request->get('productCode');
      $all_product = Product::where('product_code', $productCode)->where('status','!=',2)->get();
      $all_product_count=count($all_product);

      $productData =$request->get('productData');
      $checked_count=count($productData);
      $colorData =$request->get('colorData');
   //  print_r($colorData);
     $button_value =$request->get('button_value');
      
     
                if($button_value=="delete_checked")
                {
                     for($i=0;$i<$checked_count;$i++){    
                        $products = Product::find($productData[$i]);
                        //$products->product_code;
                          $products->status=2;
                          $products->save();
                        //$products->delete();

                       $productexistcnt=Product::where('product_code',$productCode)->where('colours',$colorData[$i])->where('status','!=',2)->count();
                       if($productexistcnt<1)     
                       {
                        $product_images = ProductImage::where('color_id',$colorData[$i])->where('product_code', $products->product_code)->get();
                        foreach ($product_images as $images) {
                            $images->delete();
                           
                        }
                       }
                   }
                }
                if($button_value=="active_checked")
                {
                    //echo "active";
                    for($i=0;$i<$checked_count;$i++){    
                        $products = Product::find($productData[$i]);
                        $products->status=1;
                        $products->save();
                    }
                }
                if($button_value=="inactive_checked")
                {
                    // echo "inactive";
                    for($i=0;$i<$checked_count;$i++){    
                        $products = Product::find($productData[$i]);
                        $products->status=0;
                        $products->save();
                    }
                }
        //return "vandana";
        return Response::json(['msg' => 'success']);
    }
    public function get_slab(Request $request)
    {

      $size =$request->get('size');
      $products = Product::where('category_id','=',$size)->where('status','!=',2)->get();
       return Response::json($products);
    //     Response::json($city);
    }

    public function status_update($id)
    {
        //return $id;
        $products = Product::findOrFail($id);
        

        $product_status = Product::where('product_code', $products->product_code)->where('status','!=',2)->get();
        foreach ($product_status as $value) 
        {
            
            $value->status = 1;
            $value->save();     
        }
        return redirect('/products/detail-view/'.$products->product_code);  
      //  return redirect('Products'); 
    }


    

   
     public function detail_view($pcode)
    {
       
        $products=Product::where('product_code',$pcode)->where('status','!=',2)->get();

        $productImage=ProductImage::where('product_code',$pcode)->where('image_status','!=',2)->get();
        $productImageCount=count($productImage);
           foreach($products as $product)
            {
             $product=$product->getcategory;
            }
            foreach($products as $product)
            {
             $getproductcolour=$product->getproductcolour;
             
            }

            
            foreach($products as $productdetails)
            {
                $brand_id =$productdetails->brands;
                $style_id = explode(',', $productdetails->styles);
                $gender_id = explode(',', $productdetails->genders);
                $fabric_id = explode(',', $productdetails->fabrics);
                $weight_id = explode(',', $productdetails->weights);
                $fabricpro_id = explode(',', $productdetails->fabricproperties);
                $colour_id = explode(',', $productdetails->colours);
                $printdeco_id = explode(',', $productdetails->printingdecoration);
                $size_id = explode(',', $productdetails->sizes);
                $labeltag_id = explode(',', $productdetails->labeltag);
                $sideseam_id = explode(',', $productdetails->sideseams);
                $sale_id = explode(',', $productdetails->sales);

                 $brands = ProductBrand::findOrFail($brand_id);
                 $brand_name = $brands->brand_name;
                 $productdetails->brands = $brand_name;

               

                $colour_name = array();
                foreach($colour_id as $Colour) {
                            $colours = Colour::findOrFail($Colour);
                            $colour_name = $colours->colour_name;
                         }
                 $productdetails->colours = $colour_name;


               
                $size_name = array();
                foreach($size_id as $Sizes) {
                            $sizes = Size::findOrFail($Sizes);
                            $size_name = $sizes->size_name;
                         }
                  $productdetails->sizes = $size_name;

              
            }

    // return $products;
        return view('product.product_listing', compact('productImageCount','products','fabricpro_id','printdeco_id'));
    }



    
}



              

       