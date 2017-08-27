@extends('layouts.header') @section('content')
<!-- Input Fields -->
<section id="content_wrapper">

    <!-- Start: Topbar -->
    <header id="topbar" class="alt">
        <div class="topbar-left">
            <ol class="breadcrumb">
                <li class="crumb-active">
                   Products
                    <!-- <span style="color:red">Note:- You can feature only 6 categories.</span> -->
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
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="panel panel-visible" id="spy2">

                        <div class="panel-body pn">
                            <table class="table table-striped table-hover" id="datatableSort" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Created Date</th>
                                        <th>Product Name</th>
                                        <th>No. of SKU's</th>
                                        <th>Status</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productList as $product)
                                    <tr>
                                        <td>{{$product->created_at}}</td>
                                        <td><a href="/AR78Tqr6f/1gd34gf/h5dm6x/products/detail-view/{{$product->product_code}}">{{$product->product_name}}</a></td>
                                        <td>{{$product->no_of_sku}}</td>
                                        <td>
                                        @if($product->status==1)
                                        {{"Active"}}
                                        @else
                                         {{"Inactive"}}
                                        @endif
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
@include('layouts.footer')
<script>
    $(".delete").on("submit", function() {
        return confirm("Do you really want to delete the data? Please note that once deleted, Related data will be and it can't be recovered.");
    });
</script>
@endsection
