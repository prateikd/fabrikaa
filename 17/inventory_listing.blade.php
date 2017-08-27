@extends('layouts.header')

@section('content')

 <!-- Input Fields -->
<section id="content_wrapper">

  <!-- Start: Topbar -->
      <header id="topbar" class="alt">
        <div class="topbar-left">
          <ol class="breadcrumb">
            <li class="crumb-active">
              <a href="/inventory">Inventory & Price Management</a>
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
           <!-- <a href="/inventory-outward" class="btn btn-default btn-sm dtable"><i class="fa fa-plus"></i> View/Add Outward</a> -->
           <a href="/inventory-inward" class="btn btn-default btn-sm dtable"><i class="fa fa-plus"></i> View/Add Inventory</a>
            <!-- <a href="/Inventory/create" class="btn btn-default btn-sm dtable"><i class="fa fa-plus"></i> Add Inventory</a> -->
          </div>
            
          </div>
         
        </div>
      </header>
      <!-- End: Topbar -->

<div class="tray tray-center">

          <div class="row">
            <div class="col-md-12">
            <div class="col-md-12">
              <div class="panel panel-visible" id="spy2">
                <div class="panel-heading">
                  <div class="panel-title hidden-xs">
                    <span class="glyphicon glyphicon-tasks"></span>Search Bar Filtering</div>
                </div>
                <div class="panel-body pn">
                  <table class="table table-striped table-hover " id="datatableSort" cellspacing="0" width="100%">
                    <thead>
                      <tr class="dtable">
                        <th>Created Date</th>
                        <th class="">Category</th>
                        <th class="">Product Name/Model No.</th>
                        <th class="">Product Code</th>
                        <th class="">Brand</th>
                        <th class="">Colour</th>
                        <!-- <th class="">Size</th> -->
                       
                         @foreach($sizeData as $size)
                         <th class="">{{$size->size_name}}</th>
                         @endforeach
   
                        <th class="">Product Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  <tbody>
                    @foreach($products as $Product)
                  <!--   {{$productcode=$Product->product_code}} -->
                              <tr>


                                <td>{{$Product->created_at}}</td>
                                <td class="">{{$Product->getcategory->category_name}}</td>
                                <td class="">{{$Product->product_name}}</td>
                                <td class="">{{$Product->product_code}}</td>
                                <td class="">{{$Product->brand_name}}</td>
                                <td class="">{{$Product->colour_name}}</td>
                              <!--   <td class="">{{$Product->sizes}}</td> -->

                              <?php
                                
                                 $sizeArray = array();
                                 
                                 foreach ($Product->get_size as $sizeSingle) {
                                    $sizeArray[] = $sizeSingle->id;
                                 }
                                 // print_r($sizeArray);
                              ?>
                                 

                                @foreach($sizeData as $size)

                                @if(in_array($size->id, $sizeArray))

                                <?php
                                  foreach ($Product->get_size as $sizeSingle) {
                                    if($size->id === $sizeSingle->id){
                                      $cur_price = $sizeSingle->price;
                                      $cur_qty = $sizeSingle->quantity;
                                      $cur_wt = $sizeSingle->product_wt;
                                      $proStatus=$sizeSingle->product_status;
                                      $cur_sample_qty = $sizeSingle->printed_sample_quantity;
                                      $cur_sample_price = $sizeSingle->printed_sample_price;
                                      break;
                                    }
                                  }
                                ?>

                                {!! Form::model($Product->id, ['method' => 'PATCH','class'=>'form-horizontal ','action' => ['InventoryController2@update', $Product->id]]) !!}
                                 <td class="">
                                  @if($cur_price==0)
                                    <!-- {{$price="Price"}} -->
                                   @else                                
                                  <!--   {{$price=$cur_price}} -->
                                   @endif
                                   
                                      @if($cur_price=="0")
                                        <input type="text" style="width:77px" name="prices[]"  placeholder="Price"  value="">
                                        @else
                                        <input type="text" style="width:77px" name="prices[]"  placeholder="Price"  value="{{$price}}">

                                        @endif

                                         @if($proStatus==2)
                                          <input type="text" style="width:77px" name="quantity[]"  placeholder="Quantity" value="Out of stock" disabled="">
                                          @elseif($proStatus==1)
                                          <input type="text" style="width:77px" name="quantity[]"  placeholder="Quantity" value="Coming Soon" disabled="">
                                          @else
                                           <input type="text" style="width:77px" name="quantity[]"  placeholder="Quantity" value="{{$cur_qty}}" disabled="">
                                           @endif
                                       <!-- <a data-type="text" href="#">{{$cur_qty}}</a> -->
                                       @if($cur_wt=="0.00")
                                        <input type="text" style="width:77px" name="product_wt[]"  font-size="10px;" placeholder="Weight(In gms)" value="">
                                        @else
                                      
                                        <input type="text" style="width:77px" name="product_wt[]"  placeholder="Weight" value="{{$cur_wt}}">
                                        @endif
                                        <input type="hidden" style="width:77px" name="product_code"  placeholder="Product Code" value="{{$Product->product_code}}">
                                        <input type="hidden" style="width:77px" name="colours"  placeholder="Colours" value="{{$Product->colours}}">
                                         
                                        <input type="hidden" style="width:77px" name="sizes[]"  placeholder="Size" value="{{$size->id}}">
                                       <!--  <input type="text" style="width:70px" name="sampleprice[]"  placeholder="Printed Sample Price" title="Printed Sample Price" value="{{$cur_sample_price}}">
                                        <input type="text" style="width:70px" name="samplequantity[]"  placeholder="Printed Sample Quantity" title="Printed Sample Quantity" value="">{{$cur_sample_qty}}  -->                                             
                                       </td>
                                @else
                                 
                                      <td class="">
                                        <input type="text" style="width:70px" name="prices[]"  placeholder="NA" disabled="" >
                                        <input type="text" style="width:70px" name="quantity[]"  placeholder="NA" disabled="">
                                        <input type="text" style="width:70px" name="product_wt[]"  placeholder="NA" disabled="">
                                        <input type="hidden" style="width:70px" name="product_code"  placeholder="Price" disabled="">
                                        <input type="hidden" style="width:70px" name="colours"  placeholder="Price" disabled="">
                                        <input type="hidden" style="width:70px" name="sizes[]"  placeholder="Size"  disabled="">
                                       <!--  <input type="text" style="width:70px" name="sampleprice[]"  placeholder="Printed Sample Price" title="Printed Sample Price" disabled="" >
                                        <input type="text" style="width:70px" name="samplequantity[]"  placeholder="Printed Sample Quantity" title="Printed Sample Quantity" disabled=""> -->
                                       </td>

                                    @endif
                                    
                                  @endforeach
                                 
                                   <td>
                                   <a data-toggle="modal" role="button" href="{{ URL::to('inventory/'.$Product->id.'/edit') }}" class="btn btn-default" data-target="#myModal-{{$Product->id}}"><i class="icon-pencil">Update Status</i></a>
                                   <button type="submit" class="btn btn-sm mt0 btn-filled pull-left" value="Add" name="add"> Update </button>
                                    {!! Form::close()!!} 
                                   </td>

                               <div class="modal fade" id="myModal-{{$Product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                              <h4 class="modal-title" id="myModalLabel">Change Status</h4>
                                          </div>


                                         {!! Form::model($Product->id, ['method' => 'PATCH','class'=>'form-horizontal ','action' => ['InventoryController2@update', $Product->id]]) !!}
                                          <br>
                                          <div class="form-group">
                                              <div class="row">
                                              <div class="panel panel-warning panel-border top mt10 mb25">
                                        <div class="panel-heading">
                                            <span class="panel-title">Change Status</span>
                                        </div>
                                        <div class="panel-body bg-light dark">
                                            <div class="admin-form">
                                            <div class="section row mb10">
                                                   <div class="col-md-3">
                                                       Category Name:
                                                    </div>
                                                    <div class="col-md-9">
                                                       {{$Product->getcategory->category_name}}
                                                   </div>
                                                </div>
                                                <div class="section row mb10">
                                                   <div class="col-md-3">
                                                       Product Name:
                                                    </div>
                                                    <div class="col-md-9">
                                                        {{$Product->product_name}}
                                                   </div>
                                                </div>
                                                <div class="section row mb10">
                                                   <div class="col-md-3">
                                                       Product Code:
                                                    </div>
                                                    <div class="col-md-9">
                                                        {{$Product->product_code}}
                                                   </div>
                                                </div>
                                                    <div class="section row mb10">
                                                   <div class="col-md-3">
                                                       Product Brand:
                                                    </div>
                                                    <div class="col-md-9">
                                                        {{$Product->brand_name}}
                                                   </div>
                                                </div>    
                                                 <div class="section row mb10">
                                                   <div class="col-md-3">
                                                       Product Colour:
                                                    </div>
                                                    <div class="col-md-9">
                                                        {{$Product->colour_name}}
                                                   </div>
                                                </div>  

                                                 <div class="section row mb10">
                                                   
                                                   @foreach ($Product->get_size as $sizeSingle)

                                                    <div class="col-md-9" style="margin-bottom:15px">
                                                       <div class="col-md-12" style="margin-bottom:15px"> {{$sizeSingle->size_name}} : </div>
                                                      <input type="hidden" name="product_code" value="{{$Product->product_code}}">
                                                        <input type="hidden" name="size_id[]" value="{{$sizeSingle->id}}">

                                                        <input type="hidden" name="color_id" value="{{$Product->colours}}">
                                                         
                                                          <select name="product_status[]" id="{{$sizeSingle->id}}" class="form-control" style="width: 150px;float:left;margin-right: 15px;">
                                                                <option value="">Select Status</option>
                                                                <option value="0" <?php if ($sizeSingle->product_status === '0') echo ' selected="selected"' ?>>Available</option>
                                                                <option value="1" <?php if ($sizeSingle->product_status === '1') echo ' selected="selected"' ?>>Coming Soon</option>
                                                                <option value="2" <?php if ($sizeSingle->product_status === '2') echo ' selected="selected"' ?>>Out Of Stock</option>
                                                            </select>
                                                               
                                                        <div>
                                                          

                                                        </div>
                                                            
                                                   </div>
                                                   @endforeach
                                                   <button type="submit" class="btn btn-sm mt0 btn-filled pull-left " value="changestatus" name="changestatus"> Update </button>
                                                </div>                                     
                                            </div>
                                        </div>
                                    </div>
                                          </div>

                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                                          </div>
                                      </div>
                                       {!! Form::close() !!}
                                  </div>
                              </div>
                            </div>
                                   <!-- <a href="/productStatus/{{$Product->id}}" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i> Change Status</a> -->
                                  
                                   <!--  <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 top-bottom-margin">
                                        <div class="form-group ">
                                      <select name="product_status" id="product_status" class="form-control" style="width: inherit;">
                                      <option value="">Select Status</option>
                                            <option value="0" <?php if ($Product->product_status === '0') echo ' selected="selected"' ?>>Available</option>
                                            <option value="1" <?php if ($Product->product_status === '1') echo ' selected="selected"' ?>>Coming Soon</option>
                                            <option value="2" <?php if ($Product->product_status === '2') echo ' selected="selected"' ?>>Out Of Stock</option>
                                          </select>
                                         </div>
                                        </div> -->
                                  
                               
                                    <td>
                                       
                                          {!! Form::open(['route' =>['inventory.destroy',$Product->id], 'method' => 'DELETE','style'=>'display: inline-block;']) !!}
                                            {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit'])}}
                                          {!! Form::close() !!}
                                       </td>
                                 </tr>
                            @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
  </div>
  </div>
</section>
<!-- model for approve client -->


@include('layouts.footer')    
<script>
$(function() {
    // $('#myModal').modal('show');
});
</script>
@endsection