<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
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



Route::get('getChildCategoryById/{id}',[ApiController::class,'getChildCategoryById']);
Route::get('getAllBrand',[ApiController::class,'getAllBrand']);
Route::get('getAllPRoductByBrandId/{id}',[ApiController::class,'getAllPRoductByBrandId']);
Route::get('getAllParentCategory',[ApiController::class,'getAllParentCategory']);
Route::get('getAllProduct',[ApiController::class,'getAllProduct']);

Route::group(["namespace"=>"Api"],function(){
    Route::post('login',[AuthController::class,'login']);
    Route::post('register',[AuthController::class,'register']);
    Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::get('getAllUser',[ApiController::class,'getAllUser']);
    Route::delete('deleteUserById/{id}',[ApiController::class,'deleteUserById']);
    Route::put('updateUserById/{id}',[ApiController::class,'updateUserById']);
    Route::delete('getDeleteProductId/{id}',[ApiController::class,'getDeleteProductId']);
    });

});