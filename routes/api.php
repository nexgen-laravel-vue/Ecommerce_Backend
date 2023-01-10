<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\http\Controllers\CustomerAddController;
use App\http\Controllers\PaymentController;
use App\http\Controllers\sendMailController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//All Public and non secure URL`s
Route::get('getChildCategoryById/{id}',[CategoryController::class,'getChildCategoryById']);
Route::get('getAllBrand',[BrandController::class,'getAllBrand']);
Route::get('getAllPRoductByBrandId/{id}',[BrandController::class,'getAllPRoductByBrandId']);
Route::get('getAllParentCategory',[CategoryController::class,'getAllParentCategory']);
Route::get('getAllProduct',[ProductController::class,'getAllProduct']);
Route::get('getAllProductByChildCategoryId/{id}',[ProductController::class,'getAllProductByChildCategoryId']);
Route::get('getSignleProductById/{id}',[ProductController::class,'getSignleProductById']);
Route::put('forgotPassword',[UserController::class,'forgotPassword']);
Route::post('sendmail',[sendMailController::class,'sendmail']);


Route::group(["namespace"=>"Api"],function(){
    Route::post('login',[AuthController::class,'login']);
    Route::post('register',[AuthController::class,'register']);
    Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::get('getAllUser',[UserController::class,'getAllUser']);
    Route::delete('deleteUserById/{id}',[UserController::class,'deleteUserById']);
    Route::put('updateUserById/{id}',[UserController::class,'updateUserById']);
    Route::delete('deleteProductById/{id}',[ProductController::class,'deleteProductById']);
    Route::put('updateProductById/{id}',[ProductController::class,'updateProductById']);
    Route::post('addtoCart',[CartController::class,'addtoCart']);
    Route::delete('removeProduct/{id}',[CartController::class,'removeProduct']);
    Route::put('updateQuantity/{id}',[CartController::class,'updateQuantity']);
    Route::get('getAddressdetails/{id}',[CustomerAddController::class,'getAddressdetails']);
    Route::post('add_Address',[CustomerAddController::class,'add_Address']);
    Route::post('shopping',[PaymentController::class,'shopping']);
    });
});