@extends('layouts.header')

@section('content')
 <!-- Input Fields -->
<section id="content_wrapper">

  <!-- Start: Topbar -->
      <header id="topbar" class="alt">
        <div class="topbar-left">
          <ol class="breadcrumb">
            <li class="crumb-active">
              <a href="/AR78Tqr6f/1gd34gf/h5dm6x/products">Products</a>
            </li>
           <!--  <li class="crumb-icon">
              <a href="dashboard.html">
                <span class="glyphicon glyphicon-home"></span>
              </a>
            </li>
            <li class="crumb-link">
              <a href="index.html">Home</a>
            </li>
            <li class="crumb-trail">Add Category</li> -->
          </ol>
        </div>
        <div class="topbar-right">
          <div class="ib topbar-dropdown">
           <div class="btn-group">
            <a href="/AR78Tqr6f/1gd34gf/h5dm6x/products/create" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Add Product</a>
          </div>
            
          </div>
         
        </div>
      </header>
      <!-- End: Topbar -->
<div class="tray tray-center">
@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

<div class="tray tray-center">
          <div class="row">
            <div class="col-md-12">
            <div class="col-md-12">
              <div class="panel panel-visible" id="spy2">
                <div class="panel-heading">
                  <div class="panel-title hidden-xs">
                    <span class="glyphicon glyphicon-tasks"></span>Search Bar Filtering</div>
                </div>
                <div class="panel-body pn" >
                <!--  {{$productCount=count($products)}} -->
                <form>
                       
                      <input type="hidden" name="_method" value="delete">
                    
             
                  <table class="table table-striped table-hover" id="datatableSort" cellspacing="0" width="100%">
                    <thead>
                      <tr class="dtable">

                      <th>Created Date</th>
                      <th><input type="checkbox" name="select_all" title="Select all" id="select_all" value=""/></th>
                       <th>Category Name</th>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Brands</th>
                        <th>Colour</th>
                        <th>Size</th>
                        <th>Status</th>
                      <!--   <th>Ideally Suitable for</th> -->
                        <th>Created Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  <tbody>
                 
                    @foreach($products as $Product)
                    <?php
                       $status="";
                       $status1="";
                       $act_class="";
                       if($Product->status=='0')
                              {
                                $act_class='btn-warning';
                                $status='Inactive';
                                $status1='Active';
                              } 
                              else if($Product->status=='1') {
                                $act_class='btn-success';
                                $status='Active';
                                $status1='Inactive';
                              }     

                       ?>
                     <!--   {{$product_id=$Product->id}} -->
                      <!--  {{$product_code=$Product->product_code}} 
                       {{$product_colour=$Product->colours}} -->
                      <tr class="trdata">
                      
                      <td>{{$Product->created_at}}</td>
                     <td>
                     <input type="checkbox" name="checked_id[]" id="checkbox" class="checkbox" value="{{ $Product->id }}"/>
                      
                    
                     </td>
                        <td>{{$Product->getcategory->category_name}}</td>
                         <td>{{$Product->product_name}} </td>
                         <td>{{$Product->product_code}} </td>
                         @if($Product->brands =="")
                         <td>{{ "Not Mentioned" }} </td>
                         @else
                         <td>{{$Product->brands}} </td>
                         @endif
                         <td class="colortddata" name="colordata_id[]" value="{{ $Product->getproductcolour->id }}">{{$Product->colours}} </td>
                         <td>{{$Product->sizes}} </td>
                       
                          <td>
                                        @if($Product->status==1)
                                        {{"Active"}}
                                        @else
                                         {{"Inactive"}}
                                        @endif
                                        </td>
                          <td>{{ date('d-m-Y', strtotime($Product->created_at)) }}</td>
                        <td>
                         
                         
                          <a href="/AR78Tqr6f/1gd34gf/h5dm6x/products/{{$Product->id}}/edit"><i class="fa fa-pencil" title="Edit"></i></a>
                          

                        </td>
                       </tr>
                     @endforeach
                     <div>
                
                    
                     <!-- <button type="submit" class="btn btn-default btn-sm pull-right dtable delete" name="deleteProduct" value="deleteProduct">Delete Product</button> -->

                      
                      <button type="button" class="btn btn-default btn-sm pull-right dtable selectaction" value="active_checked">Active Checked</button>
                    
                      <button type="button" class="btn btn-default btn-sm pull-right dtable selectaction" value="inactive_checked">InActive Checked</button>
                     
                      <button type="button" class="btn btn-default btn-sm pull-right dtable selectaction" value="delete_checked">Delete Checked</button>
                      <button type="button" class="btn btn-default btn-sm pull-right dtable productaction" value="delete_product">Delete Product</button>
                      <a href="/AR78Tqr6f/1gd34gf/h5dm6x/products/{{$product_id}}/addColor" title="Add new color" class="btn btn-default btn-sm pull-right dtable selectaction">Add New Colour</a>
                      <a href="/AR78Tqr6f/1gd34gf/h5dm6x/Slab-Listing/{{$product_code}}" title="Slab-Listing" class="btn btn-default btn-sm pull-right dtable selectaction">Slab-Listing</a>
                      
                     </form>

                     
                    </tbody>
                  </table>  
                </div>
              </div>
            </div>
        </div>
  </div>
  </div>
</section>
@include('layouts.footer')     
<script>

$('body').on('click','.selectaction',function(){
  var button_value=$(this).val();
//alert(button_value);
 var productCode='{{$product_code}}';
 var productCount='{{$productCount}}';
 var productImageCount='{{$productImageCount}}';
//var productColour='{{$product_colour}}';
//alert(productColour);

    if(button_value=="active_checked")
    {
      if(productImageCount > 0)
      {
       var result = confirm("Are you sure to active the selected product?");
      }else{
        alert("Please add images of that product");
        return false;
      }
    }
    else if(button_value=="inactive_checked")
    {
       var result = confirm("Are you sure to inactive the selected product?");
    }
    else if(button_value=="delete_checked")
    {
         var result = confirm("Are you sure to delete the selected product?");
    }
    
   
    if(result){
          productData =[];
          colorData =[];
     
      $(".trdata").each(function(){
       var checkedtd=$(this).find('.checkbox:checked').attr('value');
       
       if(checkedtd!=undefined)
       {
            productData.push(checkedtd);
            var colortd=$(this).find('.colortddata').attr('value');
            colorData.push(colortd);
           
       }
       });
    
       // alert(productData);
       // alert(colorData);



       // $(".checkbox:checked").each(function(){
       //    productData.push($(this).attr('value'));
       //   // alert(productData);
       // });
       // alert(productData);
//alert(productData.length);
                if(productData.length>0)
                {

                   $.ajax({
                               type: "POST",
                               headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                               url: "{{URL::to('/rem_checked')}}",
                               dataType: "json",
                               data: {productData,button_value,productCode,colorData},
                              
                             success:function(msg){
                                 // alert(success);

                                 if(button_value=="delete_checked")
                                {
                                  if(productCount == productData.length)
                                  {
                                    window.location="{{URL::to('products')}}";
                                  }else{
                                    //alert('hi');
                                    location.reload( true );
                                  }
                                }
                                else
                                {
                                  location.reload( true );
                                  
                                }
                                
                                    
                                },error:function(){ 
                                         alert("error!!!!");
                                      }
                         }); 

                }
                else
                {
                  alert("Please select at least one record.");
                }
    

      }
});

</script> 

<script>

$('body').on('click','.productaction',function(){
 var productCode='{{$product_code}}';
 //alert(productCode);
  var result = confirm("Are you sure to delete the product?");
   
    if(result){
          
           $.ajax({
                       type: "POST",
                       headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                       url: "{{URL::to('/delete_product')}}",
                       dataType: "json",
                       data: {productCode},
                      
                     success:function(msg){
                                 // alert(success);
                                  window.location="{{URL::to('products')}}";
                                
                                    
                                },error:function(){ 
                                         alert("error!!!!");
                                      }
                 }); 

                }

});


</script> 
<script>


$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script>
@endsection