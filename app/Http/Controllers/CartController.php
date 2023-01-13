<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AccessManagementController;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use App\Models\cart_product;
use App\Models\User;
use DB;
use App\Models\ResponseModel\ErrorResponseModel;
use App\Models\ResponseModel\ExceptionResponseModel;
use App\Models\ResponseModel\AccessDeniedResponseModel;
use App\Models\ResponseModel\SuccessResponseModel;
use Illuminate\Support\Str;
class CartController extends Controller
{
        public function removeProduct(Request $request,$id){
            try{
                $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
                if($is_LoggedIn){
                    $user_id=$is_LoggedIn;
                    $userData=DB::table('users')->where('id',$user_id)->get();
                    if($userData->isCustomer==1){
                        $Data=DB::table('cart_products')->where('id',$id)->get();
                     //   $Data=cart_product::find($id);
                        if($Data){
                            $Data->delete();
                            return $response=(new SuccessResponseModel)->successResponseWithPaylod($Data);
                        }
                        else{
                            return $response=(new ErrorResponseModel)->noDataFoundResponse(); 
                        }
                    }
                    else{
                        return $response=(new AccessDeniedResponseModel)->accessDeniedResponse(); 
                    }
                }
                else{
                    return $response=(new AccessDeniedResponseModel)->accessDeniedResponse(); 
                }
            }
            catch(\Exception $e){
                return $response=(new ExceptionResponseModel)->getExceptionResponse($e);
            }
            catch(\Error $e){
                return $response=(new ErrorResponseModel)->getErrorResponse($e);
            } 

        }
        public function updateQuantity(Request $request,$id){
            try{
                $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
                if($is_LoggedIn){
                    $user_id=$is_LoggedIn;
                    $userData=DB::table('users')->where('id',$user_id)->get();
                   // $userData=User::find($user_id);
                    if($userData->isCustomer==1){
                        $Data=DB::table('cart_products')->where('id',$id)->get();
                      //  $Data=cart_product::find($id);
                        $Data->quantity=$request->quantity;
                        $Data=$Data->save();
                        if($Data){
                            return $response=(new SuccessResponseModel)->successResponseWithPaylod($Data);
                        }
                        else{
                            return $response=(new ErrorResponseModel)->noDataFoundResponse(); 
                        }
                    }
                    else{
                        return $response=(new AccessDeniedResponseModel)->accessDeniedResponse(); 
                    }
                }
                else{
                    return $response=(new AccessDeniedResponseModel)->accessDeniedResponse(); 
                }
            }
            catch(\Exception $e){
                return $response=(new ExceptionResponseModel)->getExceptionResponse($e);
            }
            catch(\Error $e){
                return $response=(new ErrorResponseModel)->getErrorResponse($e);
            } 
        }
        public function addtoCart(Request $request){
            try{
                $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
                if($is_LoggedIn){
                    $user_Id=$is_LoggedIn;
                    $userData=DB::table('users')->where('id',$user_id)->get();
                        if($userData){
                            $userData->isCustomer=1;
                            $updateUserData=$userData->save();
                        }
                        $Data=$request->all();
                           foreach($Data as $key=>$val)
                           {
                                $id=$user_Id;
                                $productId=$val['productId'];
                                $quantity=$val['quantity'];
                                $productData=DB::table('product_details')->where('id',$productId)->first();
                                $oldStock_qunatity=$productData->product_stock;
                                if($quantity<$oldStock_qunatity){
                                    $selling_price=$val['selling_price'];
                                    $Actual_price=$val['Actual_price'];
                                    $promocode=$val['promocode'];
                                    $promocodeLength = Str::length($promocode);
                                    if($promocodeLength==0){
                                        $promocode="null";
                                    }
                                    else{
                                        $storedData= DB::select("CALL get_Update_Insert($productId,$quantity,$id,$selling_price,$Actual_price,'$promocode')"); 
                                    }
                                }
                                else{
                                    return response()->json([
                                        'status'=>500,
                                        'payload'=>null,
                                        'message'=>'quantity is higher than stock qunatity' 
                                    ]);
                                }
                           }
                           return $response=(new SuccessResponseModel)->successResponseWithPaylod($Data);
                    }
            }
            catch(\Exception $e){
                return $response=(new ExceptionResponseModel)->getExceptionResponse($e);
            }
            catch(\Error $e){
                return $response=(new ErrorResponseModel)->getErrorResponse($e);
            } 
                
        }

}
