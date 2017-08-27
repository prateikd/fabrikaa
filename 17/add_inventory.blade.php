@extends('layouts.header')

@section('content')
 <!-- Input Fields -->
<section id="content_wrapper">

 <!-- Start: Topbar -->
      <header id="topbar" class="alt">
        <div class="topbar-left">
          <ol class="breadcrumb">
            <li class="crumb-active">
              <a href="/Category">Add Inventory</a>
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
       
      </header>
      <!-- End: Topbar -->
             
     <div id="content" class="col-md-10 col-md-offset-3">
        <div class="row">

          <div class="col-md-8">

            <!-- Input Fields -->
            <div class="panel">
              <div class="panel-heading">
                <span class="panel-title">Add Inventory</span>
              </div>
              <div class="panel-body">

           {!! Form::open(['class'=>'form-horizontal']) !!}
           <!-- <form method="POST" action="/" accept-charset="UTF-8" name="inventortform" class="form-horizontal"> -->

           <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Date <span class="mad-red">*</span></label>
                    <div class="col-lg-8">
                      <div class="">
                        
                        {!! Form::text('inward_date', null, array('class' => 'form-control inward_date', 'id'=>'datepicker','placeholder'=>'Date')) !!}
                      </div>

                    </div>
                  </div>

                   <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Quantity Type <span class="mad-red">*</span></label>
                    <div class="col-lg-8">
                      <div class="">
                        
                          <select name="qty_type" id="qty_type" class="form-control" style="width: 100%;">
                            <option value="">Select Count</option>
                                  <option value="fresh">Fresh Quantity</option>
                                  <option value="recount">Recount Quantity</option>
                            </select>
                      </div>
                  </div>
                  </div>


                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Vendor Name </label>
                    <div class="col-lg-8">
                      <div class="">
                        
                        {!! Form::text('vendor_name', null, array('class' => 'form-control vendor_name','placeholder'=>'Vendor Name')) !!}
                      </div>
                  </div>
                  </div>

                   <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Purchase Order no. </label>
                    <div class="col-lg-8">
                      <div class="">
                        
                        {!! Form::text('inward_number', null, array('class' => 'form-control inward_number','placeholder'=>'Purchase Order no.')) !!}
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Transport Name </label>
                    <div class="col-lg-8">
                      <div class="">
                        
                        {!! Form::text('transport_name', null, array('class' => 'form-control transport_name','placeholder'=>'Transport Name')) !!}
                      </div>
                  </div>
                  </div>

                   <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">LR No.</label>
                    <div class="col-lg-8">
                      <div class="">
                        
                        {!! Form::text('lr_number', null, array('class' => 'form-control lr_number','placeholder'=>'LR No.')) !!}
                      </div>
                    </div>
                  </div>

                 

                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Category Name <span class="mad-red">*</span></label>
                    <div class="col-lg-8">
                      <div class="">
                        {!! Form::select('category_id', $categories, null, array('class' => 'form-control','id'=>'category_id')) !!}
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Brand Name <span class="mad-red">*</span></label>
                    <div class="col-lg-8">
                      <div class="">
                        {!! Form::select('brand_id', $brands, null, array('class' => 'form-control','id'=>'brand_id')) !!}
                      </div>
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Product Name/Model No.<span class="mad-red">*</span></label>
                    <div class="col-lg-8">
                      <div class="">
                        
                       {!! Form::select('product_name', $product_name, null, array('class' => 'form-control','id'=>'product_name')) !!}
                      </div>
                    </div>
                  </div>
                 
                <!--  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Product Code</label>
                    <div class="col-lg-8">
                      <div class="">
                      <span id="product_code">-</span> 
                       <input type="hidden" value="" name="product_code">
                      </div>

                       
                    </div>
                  </div> -->

            
                 
                   <div class="form-group">
                   <table class="table table-striped table-bordered" id="inventoryTable">
                    
                   </table>
                  
                   
                    </div>

                    <div class="form-group">
                   <div class="col-lg-8">
                      <div class="">
                    <button type="button" class="add-inward btn btn-primary">Save</button>
                       
                     
                       <a href="{{ url('/inventory-inward') }}" class="btn btn-danger">Cancel</a>
                      </div>
                    </div>
                                       
                    </div>
                 {!! Form::close()!!}  
                  </div>

                    

                            
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
@include('layouts.footer')     
 
<script>
$(document).ready(function () {
   // $('.inventoryTable').hide();
    //$('#pcode').hide();
});

$('#product_name').on('change',function(e){
      // alert("vandana"); 
    
         var cat_id = $("select#category_id option:selected").attr('value');
         var product_name = $("select#product_name option:selected").attr('value');  
        
          $('#product_code').show();

          $("#product_code").text(product_name);

        $.get('/addmoreinventory?product_name=' + product_name, function(data){
        $('#inventoryTable').replaceWith(data.addmoreinventory);
      });
});

      $('#category_id').on('change',function(e){
        
        var cat_id = $("select#category_id option:selected").attr('value');
       
        $.get('/get_brand?category_id=' + cat_id, function(data){
         $('#brand_id').empty();
         $('#brand_id').append("<option value=''>Select Brand</option>");
          $.each(data,function(pendingpayments, ProdObj){
           console.log(ProdObj);
          $('#brand_id').append("<option value='"+ ProdObj.id +"'>" + ProdObj.brand_name + "</option>");
    });

  });

});

      $('#brand_id').on('change',function(e){
        
        var brand_id = $("select#brand_id option:selected").attr('value');
        var cat_id = $("select#category_id option:selected").attr('value');
        //alert(cat_id);
        $.get('/get_productcode?brand_id=' + brand_id +'&category='+ cat_id, function(data){
         $('#product_name').empty();
         $('#product_name').append("<option value=''>Select Product</option>");
          $.each(data,function(pendingpayments, ProdObj){
           console.log(ProdObj);
          $('#product_name').append("<option value='"+ ProdObj.product_code +"'>" + ProdObj.product_name + "</option>");
    });

  });

});


        $('.add-inward').on('click', function(e){
      e.preventDefault();
      var inward_date=$(".inward_date").val();
      //alert(inward_date);
      var inward_number=$(".inward_number").val();
      var qty_type=$("select#qty_type option:selected").attr('value');
      //alert(qty_type);
      var vendor_name=$(".vendor_name").val();
      var transport_name=$(".transport_name").val();
      var lr_number=$(".lr_number").val();
      var cat_id = $("select#category_id option:selected").attr('value');
      var product_code = $("select#product_name option:selected").attr('value');  
      var brand_id = $("select#brand_id option:selected").attr('value');
      var product_type="plain";
     // alert(product_code);
     
      if(inward_date=="" || brand_id=="" || cat_id=="" || product_code=="" || qty_type=="")
      {
        alert("Please enter all red mark fields.");
      }
      else
      {
      var qtyData = new Array(1);
       colorData =[];
      
      var counter = 0;
      $('.tr_clone').each(function(){
        qtyData[counter] = [];
        var colorIdData = $(this).data("color");
        $(this).find('.sizetd').each(function(){
          var sizeId = $(this).find('input').data("size");
          var qty= $(this).find('input').val();
          if(qty=="")
          {
            inputqty=0;
          }
          else
          {
            inputqty= $(this).find('input').val();
          }

           qtyData[counter].push(inputqty);

        });
        colorData.push(colorIdData);
        counter++;
      });
        // alert(colorData);
        // alert(qtyData);    
        // console.log(colorData);
        // console.log(sizeData);
      $.ajax({
               type: "POST",
               headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
               url: "{{URL::to('/add_inward')}}",
               dataType: "json",
               data: {colorData,qtyData,product_code,inward_date,inward_number,product_type,vendor_name,transport_name,lr_number,qty_type},
              
             success:function(msg){
              window.location="{{URL::to('inventory-inward')}}";
                
                    
                },error:function(){ 
                          alert("error!!!!");
                      }
         }); 

        }

    });

</script>   
 
<script type="text/javascript">
$('.submit').on('click', function() {
    
    var cnt=0;
      var select = document.getElementById("product_name");
      //alert(select);
      
    });

</script>
@endsection
