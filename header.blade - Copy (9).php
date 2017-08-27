<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="author" content="SemiColonWeb" />
	@yield('og')
	@yield('tog')
	<!-- Stylesheets
	============================================= -->

	<!-- Favicon -->
  	<link rel="shortcut icon" href="/fevicon-icon_15x15.png">
 
  
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="/assets/admin-tools/admin-forms/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="/assets/admin-tools/admin-forms/css/style.css" type="text/css" />
	<link rel="stylesheet" href="/assets/css/style.css" type="text/css" />
	<link rel="stylesheet" href="/assets/admin-tools/admin-forms/css/dark.css" type="text/css" />
	<link rel="stylesheet" href="/assets/admin-tools/admin-forms/css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="/assets/admin-tools/admin-forms/css/animate.css" type="text/css" />
	<link rel="stylesheet" href="/assets/admin-tools/admin-forms/css/magnific-popup.css" type="text/css" />
	<!-- <link rel="stylesheet" type="text/css" href="/assets/admin-tools/admin-forms/css/custom.css"> -->
	<link rel="stylesheet" href="/assets/admin-tools/admin-forms/css/responsive.css" type="text/css" />
	<link rel="stylesheet" href="/assets/admin-tools/admin-forms/css/swiper.css" type="text/css" />

	<link href="/assets/fonts/font-awesome/font-awesome.css" rel="stylesheet">

	<!-- Include Cloud Zoom CSS -->
    <link href="/assets/admin-tools/admin-forms/css/cloudzoom.css" type="text/css" rel="stylesheet" />
    <!-- Include Thumbelina CSS -->
    <link href="/assets/admin-tools/admin-forms/css/thumbelina.css" type="text/css" rel="stylesheet" />
	
    <link rel="stylesheet" type="text/css" href="/assets/admin-tools/admin-forms/css/xzoom.css" media="all" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

	<link rel="stylesheet" href="/sweetalert2-master/dist/sweetalert2.min.css" type="text/css" />
	<!--
	<link rel="stylesheet" type="text/css" href="/assets/admin-tools/admin-forms/js/jquery.productColorizer.css" />
	<link href="http://fonts.googleapis.com/css?family=Asap:400,700" rel="stylesheet" type="text/css" /> -->


	<!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->
	<link rel="stylesheet" type="text/css" href="/assets/admin-tools/admin-forms/include/rs-plugin/css/settings.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/assets/admin-tools/admin-forms/include/rs-plugin/css/layers.css">
	<link rel="stylesheet" type="text/css" href="/assets/admin-tools/admin-forms/include/rs-plugin/css/navigation.css">

	<!-- Document Title
	============================================= -->
	<title>Fabrikaa | Home</title>

	<style>

		.revo-slider-emphasis-text {
			font-size: 40px;
			font-weight: 700;
			letter-spacing: 1px;
			font-family: 'Raleway', sans-serif;
			padding: 15px 20px;
			border-top: 2px solid #FFF;
			border-bottom: 2px solid #FFF;
		}

		.revo-slider-desc-text {
			font-size: 20px;
			font-family: 'Lato', sans-serif;
			width: 650px;
			text-align: center;
			line-height: 1.5;
		}

		.revo-slider-caps-text {
			font-size: 16px;
			font-weight: 400;
			letter-spacing: 3px;
			font-family: 'Raleway', sans-serif;
		}

		.tp-video-play-button { display: none !important; }

		.tp-caption { white-space: nowrap; }
		.top-links-2 a{
			color: #eb0028 !important;
		}
		.top-links-2 a:hover{
			color: #666 !important;
		}
		.top-links li:hover {
 		   background: none !important;
		}
		.modal-close{
			position: inherit;
		    font-size: 14px;
		    width: auto;
		    padding: 0px 16px;
		}
		#loading{
		    width:100%;
		    height:100%;
		    position:fixed;
		    z-index:9999;
		    background:url("/assets/images/spinner.gif") no-repeat center center rgba(192,192,192,0.5)
		}
		#wrapper{
		    display: none;
		}

		/*body {
		  display: none;
		}*/
	</style>

</head>
	
<body class="stretched no-transition" id="body">
<!-- {{Session::get('redirecturl')}} -->
	<!-- Document Wrapper
	============================================= -->
	<div id="loading">
	</div>
	<div id="wrapper" class="clearfix top-bar-head">

		<!-- Top Bar
		============================================= -->
		<div id="top-bar" class="top-bar-header">
		
			<div class="container-fluid clearfix">

				<div class="col_half nobottommargin xs-col-half">
					<div class="top-links" style="float: left!important;">
						<ul>
							<li><a href="callto:+91-9780-333-666" style="font-size: 16px; font-weight:600;"><strong><i class="fa fa-phone"></i> +91-9780-333-666</strong></a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-6 hidden-xs nobottommargin col-sm-6"> <!-- top-bar-section -->
					<div class="top-links top-links-2 headerli pull-right">
						<ul>
						<li><a href="/under-construction">Sell with us</a></li>
						<li><a href="under-construction">Customer Service</a></li>
						<li><a href="/under-construction">Track Order</a></li> 
						<!-- @if(Auth::user())
						<li><a href="return/order">RETURNED ORDERS</a></li> 
						@else
						<li><a href="{{ url('/Login') }}">RETURNED ORDERS</a></li> 
						@endif -->
						</ul>
					</div>
				</div>

				<div class="col_half col_last fright nobottommargin xs-col-half" style="padding: 0;">

					<!-- Top Links
					============================================= -->
					<div class="top-links pull-right">
						<ul>
							<li>
							@if (Auth::guest())

								<div id="top-cart1">
									<a href="#" id="top-cart-trigger1">
										<p class="account headerp">Hello, Sign-In</p>
										<p class="account"><b>Manage Account</b></p>
									</a>
									<div class="top-cart-content">
										<div class="top-cart-title1">
											<div class="col-md-12 text-center">
												<a href="{{ url('/Login') }}"><button class="button button-3d button-small nomargin " style="width: 100%;">Sign-In</button></a>
											</div>
											<div class="a-divider a-divider-break a-spacing-small a-spacing-top-small"><h5>or</h5></div>
											<div class="col-md-12  note text-center"> New to Fabrikaa.com? </div>
											<div class="col-md-12 text-center">
												<a href="/register"><button class="button button-3d button-small nomargin " style="width: 100%;">Register</button></a>
											</div>

											<div class="col-md-12" style="margin-top:10px;">

													<p class="account-1"><a href="#" class="listing">Your Account</a></p>

													<p class="account-1"><a href="#" class="listing">Your Orders</a></p>
													 @if (Auth::guest())
													 <p class="account-1"><a href="/Login" class="listing">Your Wish List</a></p>
													 @else
													<p class="account-1"><a href="/Your-Wishlist" class="listing">Your Wish List</a></p>
													@endif

											</div>
										</div>

										<!-- <div class="col-md-6">
										<a href="/checkout"><button class="button button-3d button-small nomargin ">Checkout</button></a>
										</div> -->
									</div>
								</div>


							<!-- <a href="/Login-Register">Sign-In</a> -->
							@elseif(Auth::user()->confirmed == 0)
								<div id="top-cart1">
									<a href="#" id="top-cart-trigger1">
										<p class="account headerp">Hello, Sign-In</p>
										<p class="account"><b>Manage Account</b></p>
									</a>
									<div class="top-cart-content">
										<div class="top-cart-title1">
											<div class="col-md-12 text-center">
												<a href="/Login">
													<button class="button button-3d button-small nomargin " style="width: 100%;">Sign-In</button>
												</a>
											</div>
											<div class="a-divider a-divider-break a-spacing-small a-spacing-top-small"><h5>or</h5></div>
											<div class="col-md-12  note text-center"> New to Fabrikaa.com? </div>
											<div class="col-md-12 text-center">
												<a href="/register"><button class="button button-3d button-small nomargin " style="width: 100%;">Register</button></a>
											</div>

											<div class="col-md-12" style="margin-top:10px;">

												<p class="account-1"><a href="#" class="listing">Your Account</a></p>

												<p class="account-1"><a href="#" class="listing">Your Orders</a></p>
												 @if (Auth::guest())
												 <p class="account-1"><a href="/Login" class="listing">Your Wish List</a></p>
												 @else
												<p class="account-1"><a href="/Your-Wishlist" class="listing">Your Wish List</a></p>
												@endif

											</div>
										</div>

											<!-- <div class="col-md-6">
											<a href="/checkout"><button class="button button-3d button-small nomargin ">Checkout</button></a>
											</div> -->
									</div>
								</div>
							<!-- </li> -->
								
						 	@elseif(Auth::user()->confirmed == 1 && Auth::user()->status =="pending")

								<div id="top-cart1">
									<a href="#" id="top-cart-trigger1">
									    <p class="account">Hello, Guest</p>
										<p class="account"><b>Manage Account</b>
										</p>
									</a>
									<div class="top-cart-content" style="height: auto;padding-bottom: 14px;">
										<div class="top-cart-title1">
											<div class="col-md-12 text-center">
												<a href="{{ url('/logout') }}"><button class="button button-3d button-small nomargin logout-extra-small" style="width: 100%;">Logout</button></a>
											</div>
										</div>											
									</div>
								</div>
								</li>

							@else
							<li class="has-dropdown">
							          <a href="#">
							            <!-- <img src="/assets/img/avatars/1.jpg" alt="avatar" class="mw30 br64"> -->
							         <!--  {{ Session::get('Orderid') }} -->
							        <?php 
							        					$name=Auth::user()->name; 
		            									$fname=explode(' ', $name, 2); 
		            									$firstname=$fname[0];
							            ?>
							            <span class="pl15">Hello, {{$firstname}}</span>

							          </a>
							          <ul class="subnav">
							                <li >
								              <a href="/myaccount" class="animated animated-short fadeInUp">
								                <span class="fa fa-bell"></span> My Account </a>
								            </li>
								            <li >
								              <a href="/order-history" class="animated animated-short fadeInUp">
								                <span class="fa fa-gear"></span> Order History </a>
								            </li>
								            <li >
								              <a href="/customer/return" class="animated animated-short fadeInUp">
								                <span class="fa fa-gear"></span> Return History </a>
								            </li>
								            
								            <li >
								                <a href="/your-wishlist" class="animated animated-short fadeInUp">
								                <span class="fa fa-heart-o"></span> Wishlist ({{$wishlistCount}})</a>
								            </li>
								            <li >
								           
							               		<a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
							               		 
								            		{{session()->forget('Auth::user()->id')}}
							               </li>
			            			  </ul>
			            		</li>
			            	 @endif
						</ul>
					</div><!-- .top-links end -->

				</div>
				   <!--/.col_half col_last fright nobottommargin-->
			</div>

		</div><!-- #top-bar end -->

		<!-- Header
		============================================= -->
		<header id="header" >

			<div id="header-wrap">

				<div class="container clearfix">

					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

					
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="col-lg-2 col-md-2 col-sm-3  col-xs-6">							
								<div id="logo" style="margin-right: 0px!important;">
									<a href="/" class="standard-logo" data-dark-logo="/assets/images/Logo_200x51.png"><img src="/assets/images/Logo_200x51.png" alt="Fabrikaa Logo"></a>
									<a href="/" class="retina-logo margin-left-20" data-dark-logo="/assets/images/Logo_200x51.png"><img src="/assets/images/Logo_200x51.png" alt="Fabrikaa Logo"></a>
								</div>
							</div>
							<div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 pull-right margin-top-10">
								<div id="top-cart">
								
									<?php 

										// echo "<pre>";
										// print_r($orderitemsCartCount)or die("asz");
										// die;

									?>				
								
								
									@if(Auth::check())
									

										@if($orderitemsCartCount == 0)
											<a href="/view-cart" title="No items in your cart"><i class="icon-shopping-cart"></i><span>{{"0"}}</span></a>			

										@else

											<a href="/view-cart"><i class="icon-shopping-cart"></i><span>{{$orderitemsCartCount}}</span></a>
										@endif
									@elseif(Auth::guest())

											<a href="/Login"><i class="icon-shopping-cart"></i><span>{{"0"}}</span></a>
									@endif

									<div class="top-cart-content">
										<div class="top-cart-title">
											<h4>Shopping Cart</h4>
										</div>
										@if($orderProductCount==0)

											Your Cart is empty.

										@else
											<div class="top-cart-items">
												<!-- <div class="top-cart-item clearfix">
													<div class="top-cart-item-image">
														<a href="#"><img src="/assets/images/shop/small/1.jpg" alt="Blue Round-Neck Tshirt" /></a>
													</div>
													<div class="top-cart-item-desc">
														<a href="#">Blue Round-Neck Tshirt</a>
														<span class="top-cart-item-price">$19.99</span>
														<span class="top-cart-item-quantity">x 2</span>
													</div>
												</div> -->

												<table class="table cart">
													<thead>
														<tr>
															<!-- <th class="cart-product-thumbnail">&nbsp;</th> -->
															<th class="cart-product-name">Product</th>
															<!-- <th class="cart-product-quantity">Color</th>
															<th class="cart-product-subtotal">Size</th> -->
															<!-- <th class="cart-product-quantity">Price</th> -->
															<th class="cart-qty">Qty</th>
															<!-- <th class="cart-product-quantity">Dis.</th>
															<th class="cart-product-quantity">Dis. Price</th> -->
															<th class="cart-product-subtotal">Total Price</th>
															<th class="cart-product-vat">VAT Discount(%)</th>
															<th class="cart-product-cst">VAT/CST</th>
															<th class="cart-product-amount">Total Amount</th>

														</tr>
													</thead>
													<tbody>
														<?php
															$doneProducts = array();
															?>
															<!-- {{$subtotal=0}} -->

															@foreach($orderitemsbucket as $items)
															<?php
															if (! in_array($items->product_id, $doneProducts)) {
														?>
														<tr class="cart_item">

															<!-- <td class="">
															@if($items->productimage=="")
																<a href="#"><img style="height: 8%;width: 97%;" src="product_img/no_logo.png" alt="Pink Printed Dress"></a>

															@else
																<a href="#"><img style="height: 8%;width: 97%;" src="{{$items->productimage->product_image}}" alt="Pink Printed Dress"></a>
															@endif
															</td> -->


															<td class="cart-product-name">
															<a href="#">{{$items->getproduct->product_name}}</a>
															</td>


															<!-- 
															<td class="cart-product-quantity">
																@foreach($orderitemsbucket as $itemDiscount)
																
																	@if(($items->getproduct->getproductcolour->colour_name == $itemDiscount->getproduct->getproductcolour->colour_name) && ($items->product_code == $itemDiscount->product_code))
																		@if($itemDiscount->size_id=="" && $itemDiscount->color_id=="")
																		<span class="qty">{{$itemDiscount->discount}}</span><br>
																		@else
																		<span class="qty">{{$itemDiscount->eachDiscount}}</span><br>
																		@endif
																	@endif
																@endforeach
															</td> -->


															<td class="cart-product-qty">
															@foreach($orderitemsbucket as $itemForQty)
																@if(($items->getproduct->getproductcolour->colour_name == $itemForQty->getproduct->getproductcolour->colour_name) && ($items->product_code == $itemForQty->product_code))
																	<span class="">{{$itemForQty->qty}}</span><br>
																@endif
															@endforeach
															</td>

														
															<td class="cart-product-subtotal">
															@foreach($orderitemsbucket as $itemDiscountedTotal)
																@if(($items->getproduct->getproductcolour->colour_name == $itemDiscountedTotal->getproduct->getproductcolour->colour_name)&& ($items->product_code == $itemDiscountedTotal	->product_code))
																	<span class="">{{$itemDiscountedTotal->discountedTotalUnitPrice}}</span><br>
																@endif
															@endforeach
															</td>

															<td class="cart-product-vat">
																@foreach($orderitemsbucket as $itemVat)
																	@if(($items->getproduct->getproductcolour->colour_name == $itemVat->getproduct->getproductcolour->colour_name) && ($items->product_sku == $itemVat->product_sku))
																		<span class="">{{$itemVat->vat}}</span><br>
																	@endif
																@endforeach
															</td>

															<td class="cart-product-cst">
																@foreach($orderitemsbucket as $itemVatPrice)
																	@if(($items->getproduct->getproductcolour->colour_name == $itemVatPrice->getproduct->getproductcolour->colour_name) && ($items->product_sku == $itemVatPrice->product_sku))
																		<span class="">{{$itemVatPrice->vatPrice}}</span><br>
																	@endif
																@endforeach
															</td>

															<td class="cart-product-amount">
															<!-- {{$total=0}} -->
																@foreach($orderitemsbucket as $itemVatDiscountPrice)
																	@if(($items->getproduct->getproductcolour->colour_name == $itemVatDiscountPrice->getproduct->getproductcolour->colour_name)&& ($items->product_sku == $itemVatDiscountPrice->product_sku))
																		<span class="">{{$itemVatDiscountPrice->discountedTotalVatPrice}}</span><br>
																		<!-- {{$total=$total+$itemVatDiscountPrice->discountedTotalVatPrice}} -->
																		<!-- {{$subtotal=$subtotal+$itemVatDiscountPrice->discountedTotalVatPrice}} -->
																	@endif
																@endforeach
															</td>

														</tr>
														<?php
														}
														?>
														@endforeach

													</tbody>

												</table>

											</div>

											<div class="top-cart-action clearfix">
												<span class="fleft top-checkout-price">Total : INR {{$subtotal}}</span>
											</div>
											<div class="col-md-6 ">
												<a href="/view-cart"><button class="button button-3d button-small nomargin ">View Cart</button></a>
											</div>
											<div class="col-md-6">
												<a href="/checkout"><button class="button button-3d button-small nomargin ">Checkout</button></a>
											</div>
										@endif
									</div>
								</div>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-8 col-xs-10">
								<nav id="primary-menu">
									<ul class="search-bar-header">

										<form class="navbar-form navbar-left nobottommargin" role="search" action="/search">
											<div class="panel-menu">
											    <div class="input-group input-hero input-hero-sm">

											    	<!-- <input type="text" class="form-control" name="search_product" id="search_product" placeholder="Enter search terms.."> -->
											        <div id="the-basics">
														<input class="typeahead form-control" name="search" id="search" type="text" placeholder="Enter search terms..." required>
													</div>
											        <span class="input-group-btn">
											        	<button type="submit" class="btn btn-default-sm " value="Place Order" style="height:34px;"><i class="fa fa-search"></i></button>
											        </span>
											    </div>
											</div>
									    </form>
									</ul>
									<ul>
							            <li>
							                <a href="#"><div>Products</div></a>
							                <ul class="sub-menu">
							                @foreach($categoryname as $category)
							                    <li>
							                    	<a href="/{{$category->category_name}}">
							                    		<div>{{$category->category_name}}</div>
							                    	</a>
													<!--
								                    	<ul class="sub-menu">
								                    		<li><a href="#"><div>Sale</div></a></li>
								                    		<li><a href="#"><div>Sale</div></a></li>
								                    	</ul> 
								                    -->
							                    </li>
							                   @endforeach
							                </ul>
							            </li>
										<li><a href="/under-construction">Marketing Resources</a></li>
										<li><a href="/check-inventory"><div>Check Inventory</div></a></li>
										<li><a href="/on-sale"><div>Sale</div></a></li>
										<li class="visible-xs"><a href="/under-construction"><div>Sell with us</div></a></li>
										<li class="visible-xs"><a href="/under-construction"><div>Customer Service</div></a></li>
										<li class="visible-xs"><a href="/under-construction"><div>Track Order</div></a></li>
									</ul>
								</nav>
							</div>


						</div>
					</div>

					
				</div>

			</div>

		</header><!-- #header end -->

@yield('content')
