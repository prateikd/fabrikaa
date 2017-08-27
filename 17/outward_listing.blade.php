@extends('layouts.header')

@section('content')
 <!-- Input Fields -->
<section id="content_wrapper">

  <!-- Start: Topbar -->
      <header id="topbar" class="alt">
        <div class="topbar-left">
          <ol class="breadcrumb">
            <li class="crumb-active">
              <a href="/AR78Tqr6f/1gd34gf/h5dm6x/inventory">Outward Management</a>
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
           
            <a href="/AR78Tqr6f/1gd34gf/h5dm6x/inventory-outward-create" class="btn btn-default btn-sm dtable"><i class="fa fa-plus"></i> Manage Outward</a>
          </div>
            
          </div>
         
        </div>
      </header>
      <!-- End: Topbar -->

@if($productscount>0)
<div class="tray tray-center">

          <div class="row">
            <div class="col-md-12">
            <div class="col-md-12">
              <div class="panel panel-visible" id="spy2">
                
                <div class="panel-body pn">
                  <table class="table table-striped table-hover " id="datatable" cellspacing="0" width="100%">
                    <thead>
                      <tr class="dtable">
                       
                        <th class="">Outward Date</th>
                        <td>Type</td>
                        <th class="">Category</th>
                        <th class="">Brand Name</th>
                        <th class="">Product Name/Model No.</th>
                        <th class="">Colour</th>
                       <!--  <th class="">Fitting/Style</th> -->
                       
                       
                         @foreach($sizeData as $size)
                         <th class="">{{$size->size_name}}</th>
                         @endforeach
                         
                           <td>Action</td>
   
                        
                      </tr>
                    </thead>
                  <tbody>
                    @foreach($products as $Product)
               
                              <tr>
                               
                                  <td>{{$Product->outward_date}}</td>
                                  <td>{{$Product->sale_type}}</td>                    
                                  <td>{{$Product->getcategory->category_name}}</td>
                                  <td>{{$Product->getbrandname->brand_name}}</td>
                                  <td>{{$Product->getproduct->product_name}}</td>
                                  <td>{{$Product->colour_name}}</td>
                                 
                                  
                                
                              <?php
                                
                                 $sizeArray = array();
                                 
                                 foreach ($Product->get_size as $sizeSingle) {
                                    $sizeArray[] = $sizeSingle->id;
                                   // print_r($sizeArray);
                                    //exit();
                                 }
                                 //print_r($sizeArray);
                              ?>
                                 
                               @foreach($sizeData as $size)

                                @if(in_array($size->id, $sizeArray))

                               <?php
                                  foreach ($Product->get_size as $sizeSingle) {
                                    if($size->id === $sizeSingle->id){

                                      $cur_qty = $sizeSingle->qty;
                                     
                                      break;
                                    }
                                  }
                                ?>
                                
                                {!! Form::model($Product->id, ['method' => 'PATCH','class'=>'form-horizontal ','action' => ['InventoryController2@outward_edit', $Product->id]]) !!}
                                <td class="">

                                    <input type="text" style="width:70px" name="quantity[]"  placeholder="Quantity" value="{{$cur_qty}}">
                                    <input type="hidden" style="width:70px" name="product_code"  placeholder="Price" value="{{$Product->product_code}}">
                                    <input type="hidden" style="width:70px" name="colours"  placeholder="Price" value="{{$Product->color_id}}">
                                    <input type="hidden" style="width:70px" name="sizes[]"  placeholder="Size"  value="{{$size->id}}">
                                    <input type="hidden" style="width:70px" name="outward_date"  placeholder="Colours" value="{{$Product->outward_date}}">
                                    <input type="hidden" style="width:70px" name="product_sku"  placeholder="Colours" value="{{$Product->product_sku}}">
                                    <input type="hidden" style="width:70px" name="auto_outward_number" value="{{$Product->auto_outward_number}}">
                                     <input type="hidden" style="width:70px" name="sale_type" value="{{$Product->sale_type}}">
                                  
                                </td>
                                @else
                                    <td class="">
                                       <input type="text" style="width:70px" name="quantity[]"  placeholder="NA" disabled="">
                                    </td>

                                    @endif
                                    
                                  @endforeach
                                  
                                <td>
                                  <button type="submit" class="btn btn-sm mt0 btn-filled pull-left" value="Add" name="add"> Update </button>
                                  <a href="/AR78Tqr6f/1gd34gf/h5dm6x/outward_delete/{{$Product->id}}/{{$Product->sale_type}}"><i class="fa fa-trash"></i></a>
                                  <!-- <a data-toggle="modal" role="button" href="{{ URL::to('inward_edit/'.$Product->id.'/edit') }}" class="btn btn-default" data-target="#myModal-{{$Product->id}}"><i class="icon-pencil">Recount</i></a> -->
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
  @else
  {{"No data to show"}}
  @endif
</section>
@include('layouts.footer')    
<!-- Xedit JS -->
  <script src="/vendor/plugins/moment/moment.min.js"></script>
 <!-- Dependency -->
  <script src="/vendor/plugins/xeditable/js/bootstrap-editable.min.js"></script>
  <script src="/vendor/plugins/xeditable/inputs/address/address.js"></script>
  <script src="/vendor/plugins/xeditable/inputs/typeaheadjs/lib/typeahead.js"></script>
  <script src="/vendor/plugins/xeditable/inputs/typeaheadjs/typeaheadjs.js"></script>

@endsection



