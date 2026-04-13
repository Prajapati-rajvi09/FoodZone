<?php

use App\Http\Controllers\adminpanelcontroller;
use App\Http\Controllers\adminlogincontroller;
use App\Http\Controllers\CustomerPanelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AdminLoginController::class, 'login']);

Route::get('/login',[AdminLoginController::class,'login']);

Route::get('/view', function () {
    return view('view');
});

Route::get('/view1', function () {
    return view('view1');
});

Route::get('/view2', function () {
    return view('view2');
});

Route::get('/view3', function () {
    return view('view3');
});


Route::get('/register', function () {
    return view('register');
});

Route::get('/members', function () {
    return view('members');
});
 
Route::get('/login',[AdminLoginController::class,'login']);
Route::POST('/admin_check',[AdminLoginController::class,'check']);

Route::middleware(['admin_login'])->group(function() 
{
    Route::get('/adminindex',[AdminpanelController::class,'adminindex']);
    
    Route::get('/product',[AdminpanelController::class,'product']);
    Route::POST('/insertproduct',[AdminpanelController::class,'insertproduct']);
    Route::get('/deleteproduct/{id}',[AdminpanelController::class,'destroy']);
    Route::get('/editproduct/{id}',[AdminpanelController::class,'edit']);
    Route::PUT('/updateproduct/{id}',[AdminpanelController::class,'update']);

    //pincode
    Route::get('/Pincode',[AdminpanelController::class,'Pincode']);
    Route::POST('/insertPincode',[AdminpanelController::class,'insertPincode']);
    Route::get('/deletePincode/{id}',[AdminpanelController::class,'destroyPincode']);
    Route::get('/editPincode/{id}',[AdminpanelController::class,'editPincode']);
    Route::PUT('/updatePincode/{id}',[AdminpanelController::class,'updatePincode']);

    //productentry
    Route::get('/productentry',[AdminpanelController::class,'productentry']);
    Route::POST('/insertproductentry',[AdminpanelController::class,'insertproductentry']);


    Route::get('/productentryview',[AdminpanelController::class,'productentryview']);
    Route::POST('/insertproductentryview',[AdminpanelController::class,'insertproductentryview']);
    Route::get('/deleteproductentryview/{id}',[AdminpanelController::class,'destroyproductentryview']);
    Route::get('/editproductentryview/{id}',[AdminpanelController::class,'editproductentryview']);
    Route::PUT('/updateproductentryview/{id}',[AdminpanelController::class,'updateproductentryview']);

   

  

    //customerview
    Route::get('/customerview',[AdminpanelController::class,'customerview']);



    Route::get('/customerorder',[AdminpanelController::class,'customerorder']);

    Route::get('/customerorderdetail/{id}',[AdminpanelController::class,'customerorderdetail']);
    Route::get('/customerorderdetail/orderuser/{id}',[AdminpanelController::class,'process_status']);
    Route::get('/customerorderdetail/orderuser1/{id}',[AdminpanelController::class,'dispatch_status']);
    Route::get('/customerorderdetail/orderuser2/{id}',[AdminpanelController::class,'deliver_status']);



    Route::get('/customerfeedback',[AdminpanelController::class,'customerfeedback']);
});

 // register
 Route::get('/register',[AdminLoginController::class,'register']);
 Route::POST('/insertregister',[AdminLoginController::class,'insertregister']);
 Route::get('/deleteregister/{id}',[AdminpanelController::class,'destroyregister']);

 

Route::get('/admin_logout',[AdminLoginController::class,'Adminlogout']);

Route::middleware(['customer_login'])->group(function()
{

    Route::get('/customerindex',[CustomerpanelController::class,'customerindex']);
    
    
    Route::get('/profile',[CustomerpanelController::class,'profile']); 
    Route::get('/editprofile',[CustomerpanelController::class,'editprofile']);
    Route::PUT('/updateprofile',[CustomerpanelController::class,'updateprofile']);



    Route::get('changepassword',[CustomerpanelController::class,'changepassword']);  
    Route::post('changepassword',[CustomerpanelController::class,'updatepassword']); 


    Route::get('/viewproduct',[CustomerpanelController::class,'viewproduct']); 

    Route::POST('/addtocart',[CustomerpanelController::class,'addtocart']);
    Route::get('/viewdetail/{id}/{name}',[CustomerpanelController::class,'viewdetail']); 


   Route::get('/addtocart',[CustomerpanelController::class,'viewcart']); 


   Route::get('/qty',[CustomerpanelController::class,'qty']); 
   Route::get('/editqty/{id}',[CustomerpanelController::class,'editqty']);
    Route::PUT('/updateqty/{id}',[CustomerpanelController::class,'updateqty']);
    Route::get('/deleteaddtocart/{id}',[CustomerpanelController::class,'deleteaddtocart']);


   // check out
    Route::POST('/checkoutinsertdata',[CustomerpanelController::class,'checkoutinsertdata']);


    //my order
    Route::get('/myorder',[CustomerpanelController::class,'myorder']);


    Route::get('/vieworderdetail/{id}',[CustomerpanelController::class,'vieworderdetail']);
    Route::get('/bill/{id}',[CustomerpanelController::class,'bill']);

    Route::get('/vieworderdetail/orderuser/{id}',[CustomerpanelController::class,'pstatus']);



    Route::get('/feedback',[CustomerpanelController::class,'feedback']);
    Route::POST('/feedbackinsert',[CustomerpanelController::class,'feedbackinsert']);
    
});

Route::get('/customerlogout',[CustomerPanelController::class,'customerlogout']);


