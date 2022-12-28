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



Route::get('getChildCategoryById/{id}',[CategoryController::class,'getChildCategoryById']);
Route::get('getAllBrand',[BrandController::class,'getAllBrand']);
Route::get('getAllPRoductByBrandId/{id}',[BrandController::class,'getAllPRoductByBrandId']);
Route::get('getAllParentCategory',[CategoryController::class,'getAllParentCategory']);
Route::get('getAllProduct',[ProductController::class,'getAllProduct']);
Route::get('getAllProductByChildCategoryId/{id}',[ProductController::class,'getAllProductByChildCategoryId']);
Route::get('getSignleProductById/{id}',[ProductController::class,'getSignleProductById']);


Route::group(["namespace"=>"Api"],function(){
    Route::post('login',[AuthController::class,'login']);
    Route::post('register',[AuthController::class,'register']);
    Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::get('getAllUser',[UserController::class,'getAllUser']);
    Route::delete('deleteUserById/{id}',[UserController::class,'deleteUserById']);
    Route::put('updateUserById/{id}',[UserController::class,'updateUserById']);
    Route::delete('getDeleteProductId/{id}',[ProductController::class,'getDeleteProductId']);
    Route::post('addtoCart',[CartController::class,'addtoCart']);
    });
});