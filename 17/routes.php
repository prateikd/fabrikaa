<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Route::get('/admin', function () {
// AR78Tqr6f/1gd34gf/h5dm6x/admin
Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/admin', function () {
   return view('auth.login'); 

 //   $rememberData= Auth::loginUsingId(1);
 //  Auth::user()->email;
 // //return $rememberData->email;
 // if($rememberData->email==Auth::user()->email)
 // {
 //   //return "true";
 //   return redirect('/category');  
 // }
 // else
 // {
 //  // return "false";
 //  return view('auth.login'); 
 // }
   
});

Route::get('/under-construction', function () {
   return view('under_construction'); 
});
Route::get('/misplace', function () {
   return view('mis_page'); 
});
Route::get('/check-email-verification', function () {
   return view('check_email_verification'); 
});
Route::get('/save-and-continue', function () {
   return view('save_continue'); 
});
// Route::get('/contact-Us', function () {
//    return view('contact'); 
// });
// Route::get('/login', function () {
//    dd("here");
//    return view('under_construction'); 
// });
  
Route::get('/', 'IndexController2@index');
Route::post('/', 'IndexController2@index');
Route::resource('contactus', 'IndexController2');
Route::get('/about-us', 'IndexController2@aboutpage');
Route::get('/privacy-policy', 'IndexController2@privacypage');
Route::get('/terms-of-usage', 'IndexController2@termspage');
Route::get('/faq', 'IndexController2@faqpage');
Route::resource('/Search-Product', 'CategoriesController@search');
//My account
Route::resource('/order-history', 'OrderHistoryController');
Route::resource('/myaccount', 'MyAccountController');
Route::resource('/check-inventory', 'CheckInventoryController');
Route::resource('/get_productname', 'CheckInventoryController@get_productname');
Route::post('/check/inventory', 'CheckInventoryController@chkInventory');


Route::resource('/customer/return', 'ReturnHistoryController');

Route::post('/generate_otp', 'MyAccountController@generate_otp');
Route::post('/regenerate_otp', 'MyAccountController@regenerate_otp');
Route::post('/verifyotp', 'MyAccountController@verifyotp');
//Login
// Route::get('/login', 'IndexController2@loginregister');
Route::get('/Login', 'IndexController2@loginregister');
Route::post('/Login', 'Auth\AuthController@authenticateUser');
Route::get('/register/{change?}', 'IndexController2@registeruser');
// Route::get('/Register', 'Auth\AuthController@authenticateUser');
Route::get('/logout-user', 'IndexController2@logout');
Route::get('/auth/verify/{confirmation_code}', 'Auth\AuthController@confirm');
Route::get('/thank-you-for-verification', 'ThanksController@EmailConfirm');
Route::resource('/thank-you-for-verification', 'ThanksController');

   Route::resource('/business-information', 'BusinessController');
   Route::resource('/business-document-upload', 'BusinessdocumentController');
Route::resource('/thank-you', 'ThankyouController');
//Wishlist
Route::resource('/your-wishlist', 'WishlistController');
Route::get('/Wishlist/{productid}/{categoryname}/{brandname?}', 'WishlistController@addWishlist');
Route::get('/Favoritelist/{cname}/{pname}/{psku?}', 'WishlistController@addfavorite');
Route::get('/Favorite/{pid}/{cname1}', 'WishlistController@favorite');

//Search
 Route::resource('/search', 'IndexController@product_search');

//returns order returns/order
 Route::get('/return/order/{id}', 'ReturnedOrderController@returnorder');
 Route::get('/order/information/{id}', 'OrderHistoryController@getorder');
 Route::resource('/pickup/address', 'PickupAddressController');
Route::post('/select_checked', 'ReturnedOrderController@select_checked');

//Quick View
Route::get('/Product-Detail/{cname}/{pname}/{psku}', 'CategoriesController@details');

// Route::get('/Careers', 'IndexController@careerpage');
Route::resource('/Contact-Us', 'ContactUsController');

//Sales functionality
Route::resource('/on-sale', 'OnSaleController');
// Product Brand


//Login with Facebook
Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');

//Compare
Route::post('/compareproduct', 'CompareController@compareproduct');
//Save search functionality

Route::post('/save/search', 'CompareController@saveproduct');

Route::get('/compare', 'CompareController@index');
Route::any('/savedsearch/{id}', 'CompareController@savedsearch');
Route::resource('/user/save/search', 'SaveSearchController');
Route::any('/savedsearch/{id}', 'SaveSearchController@get_saved_data');

//Product
//Route::resource('/Single-Product/{productname}', 'ProductDescriptionController@showproduct');
// Route::get('/product-description/{catname}/{productname}/{productsku}/{colourname?}', 'ProductDescriptionController@showproduct');

//Route::get('/Single-Product/{catname}/{productname}/{productsku}/{colourname}', 'ProductDescriptionController@showproduct');
Route::get('/DownLoadImages/{prodcode}', 'ProductDescriptionController@zipFileDownload');
Route::get('/download/{filename}', 'ProductDescriptionController@download');

Route::get('/get_color_image', 'ProductDescriptionController@get_color_image');
Route::get('/getcolorimage', 'ProductDescriptionController@getcolorimage');
Route::get('/addmore', 'ProductDescriptionController@addmore');

Route::post('/add_cart', 'ProductDescriptionController@add_cart');

Route::post('/add_cart1', 'ProductDescriptionController@add_cart1');

Route::resource('/view-cart', 'CartController2');

Route::post('/view-cart', 'CartController2@index');

Route::post('/delete_cart_product', 'CartController2@delete_cart_product');

//for payment intregration
Route::resource('/checkout', 'CheckoutController1');
//shipping rate calculation
Route::post('/check/shipping/rate', 'CheckoutController1@shipping_rate');

//insurance amount
Route::post('/add/insurance', 'CheckoutController1@insuranceamount');
Route::resource('/summary', 'SummaryController');
Route::post('/proceed-to-checkout', 'SummaryController@proceedToCheckout');


Route::post('/Thank-You-Order-Successful', 'ThanksController@getThankYou'); 
Route::any('/sorry-transaction-aborted', 'ThanksController@getSorry'); 
Route::any('/sorry-transaction-failure', 'ThanksController@getSorry'); 

//learn more about brand
Route::get('/brand/{brandname}', 'CompareController@aboutbrand');

Route::auth();

Route::group(['middleware' => 'auth'], function () {

   Route::get('/home', 'HomeController@index');
   

   // Route::resource('/category', 'CategoryController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/category', 'CategoryController');

   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/SubCategory', 'SubCategoryController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/products', 'ProductController3');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/product-images', 'ImageController');
   
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/slider', 'SliderController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/testimonial', 'TestimonialController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/product-brand', 'ProductBrandController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/about-section', 'AboutSectionController');
   //Route::resource('/Brands', 'BrandController');
   

   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/style', 'StyleController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/gender', 'GenderController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/fabric', 'FabricController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/weight', 'WeightController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/fabric-properties', 'FabricPropertiesController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/colours', 'ColoursController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/printing-decoration', 'PrintingDecorationController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/size', 'SizesController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/label-tag', 'LabelTagController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/side-seams', 'SideSeamsController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/price', 'PriceController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/sale', 'SaleController');

   Route::post('/products', 'CategoryController@product_update');
   Route::resource('/track/order', 'TrackOrderController');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/products/detail-view/{pcode}', 'ProductController3@detail_view');
   Route::resource('/Products-Status', 'ProductController3@status_update');
   Route::resource('/get_slab', 'ProductController3@get_slab');
   Route::resource('/get_product', 'ImageController@get_product');
   
   Route::post('/rem_checked', 'ImageController@delete_checked');
   Route::post('/delete_product', 'ImageController@delete_product');

   Route::resource('/get_color', 'ImageController@get_color');
   Route::any('/photo', 'ImageController@upload');
   Route::any('/get_session', 'ImageController@get_session');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/order', 'OrderController'); 
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/order/detail-view/{orderid}', 'OrderController@order_detail_view'); 
   Route::any('/AR78Tqr6f/1gd34gf/h5dm6x/change-order-status/{id}', 'OrderController@change_order_status');

   Route::any('/cancel_return_request/{id}', 'OrderReturnController@cancel_return_request');
   
   Route::any('/process/return/{id}', 'OrderReturnController@process_return');
   Route::any('/add/stock/{id}', 'OrderReturnController@add_stock');

   Route::resource('/colorsize', 'SaleController');
   

   Route::resource('AR78Tqr6f/1gd34gf/h5dm6x/Slab-Listing', 'SlabController');
   Route::resource('AR78Tqr6f/1gd34gf/h5dm6x/Slab-Listing', 'SlabController@slab_listing');
   
   Route::resource('AR78Tqr6f/1gd34gf/h5dm6x/inventory', 'InventoryController2');
   Route::resource('AR78Tqr6f/1gd34gf/h5dm6x/printed-inventory', 'PrintedInventoryController');
   Route::get('/productStatus/{id}', 'InventoryController2@productStatus');
   Route::resource('/get_brand', 'InventoryController2@get_brand');
   Route::resource('/get_productcode', 'InventoryController2@get_productcode');
   Route::resource('/get_colorcode', 'InventoryController2@get_colorcode');

   Route::get('AR78Tqr6f/1gd34gf/h5dm6x/inventory-inward', 'InventoryController2@inward_listing');
   Route::any('/inward_edit/{id}', 'InventoryController2@inward_edit');
   Route::any('/inward_delete/{id}', 'InventoryController2@inward_delete');


   Route::get('/addmoreinventory', 'InventoryController2@addmoreinventory');
   Route::post('/add_inward', 'InventoryController2@add_inward');

   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/inventory-outward-create', 'InventoryController2@outward_create');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/inventory-outward', 'InventoryController2@outward_listing');
   Route::post('/add_outward', 'InventoryController2@add_outward');
   Route::any('/outward_edit/{id}', 'InventoryController2@outward_edit');
   Route::any('/outward_delete/{id}/{sale_type}', 'InventoryController2@outward_delete');

   Route::get('AR78Tqr6f/1gd34gf/h5dm6x/printed-inventory-inward', 'PrintedInventoryController@printed_inward_listing');
   Route::any('/printed-inward-edit/{id}', 'PrintedInventoryController@printed_inward_edit');
   Route::any('/printed-inward-delete/{id}', 'PrintedInventoryController@printed_inward_delete');

   Route::post('/add-printed-inward', 'PrintedInventoryController@add_printed_inward');

   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/order-return-listing/', 'OrderReturnController');


   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/return/request/{orderid}', 'OrderReturnController@return_request');
   
   Route::resource('AR78Tqr6f/1gd34gf/h5dm6x/order/return/history', 'OrderReturnHistoryController');

   Route::get('AR78Tqr6f/1gd34gf/h5dm6x/invoice/{id}', 'InvoiceController@generate_invoice');
   Route::get('/sendinvoice/{id}', 'InvoiceController@sendinvoice');
  // Route::resource('/Warehouse', 'InventoryController@Warehouse');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/invoice-history', 'InvoiceController@getinvoice');
   // Route::resource('/Warehouse', 'InventoryController@Warehouse');

   //Approve and delete multiple PRODUCTS
   // Route::any('/deleteProducts', ['as'=>'deleteProducts.delete', 'uses'=>'ProductController2@delete']);
    // Route::get('/singledeleteProducts/{id}', 'ProductController2@singledeleteProducts');

    //Route::get('/singledeleteProducts/delete/{id}', ['as' => 'singledeleteProducts.get.delete', 'uses' => 'ProductController2@singledeleteProducts']);

   //Slab Section
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/slab', 'SlabAddController');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/slab/addslab', 'SlabAddController@addslab');
   Route::any('/Products/color/{id}', ['as' => 'Products.get.color', 'uses' => 'ProductController3@addcolor']);
   // Route::any('/products/{id}/addColor', 'ProductController2@addcolor');
   // Route::any('/addnewcolor/{id}', 'ProductController2@addnewcolor');
   Route::any('/AR78Tqr6f/1gd34gf/h5dm6x/products/{id}/addColor', 'CategoryController@addcolor');
   Route::any('/addnewcolor/{id}', 'CategoryController@addnewcolor');

   

   Route::resource('/color-size', 'ColorSizeController');


   Route::resource('/records', 'RecordController');

   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/client-listing', 'ClientListingController');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/client-listing/client-view/{id}', 'ClientListingController@client_view');

   Route::any('/get-client-approval/{id}', 'ClientListingController@get_client_approval');
   Route::any('/get-client-reject/{id}', 'ClientListingController@get_client_reject');

   //create admin module
   Route::resource('/new-admin-user', 'AdminUserController');

   Route::resource('/report', 'ReportController');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/plain-inward-report', 'ReportController@plain_inward_report');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/printed-inward-report', 'ReportController@printed_inward_report');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/plain-inventory-report', 'ReportController@plain_inventory_report');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/printed-inventory-report', 'ReportController@printed_inventory_report');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/client-report', 'ReportController@client_report');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/outward-report', 'ReportController@outward_report');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/order-report', 'ReportController@order_report');
   //Shipping Master 
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/shipping-zone', 'ShippingMasterController');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/shipping-zone-for-air', 'ShippingMasterController@get_air');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/shipping-zone-for-surface', 'ShippingMasterController@get_surface');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/shipping-slab', 'ShippingSlabController');
   Route::any('/AR78Tqr6f/1gd34gf/h5dm6x/shipping-slab/shipslab/{zone}/{mode}', 'ShippingSlabController@shipslab');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/shipping-slab/{zone}/{mode}', 'ShippingSlabController@shipping_slab');
   Route::get('/AR78Tqr6f/1gd34gf/h5dm6x/shipping-zone/detail-view/{zone}/{mode}', 'ShippingMasterController@detail_view');
   Route::resource('/AR78Tqr6f/1gd34gf/h5dm6x/shipping-info-listing', 'ShippingInfoController');


   
});
//Route::get('/{catname}/{productname}/{productsku}/{colourname?}', 'ProductDescriptionController@showproduct');
Route::get('/{catname}/{productname}/{productsku}/{colourname?}', 'ProductDescriptionController@showproduct');
Route::resource('/Categories', 'CategoriesController@showcat');
Route::get('/{name}', 'CategoriesController@showcat');
Route::get('/{name}/{sortBy?}', 'CategoriesController@showcat');


