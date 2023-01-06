<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AccessManagementController;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use App\Models\cart_product;
use App\Models\User;
use DB;
use Illuminate\Support\Str;
class CartController extends Controller
{
        public function removeProduct(Request $request,$id){
            $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
            if($is_LoggedIn){
                $user_id=$is_LoggedIn;
                $userData=User::find($user_id);
                if($userData->isCustomer==1){
                    $Data=cart_product::find($id);
                    if($Data){
                        $Data->delete();
                        return response()->json([
                            'status'=>200,
                            'payload'=>$Data,
                            'message'=>'Data Deleted successfully' 
                        ]);
                    }
                        else{
                            return response()->json([
                                'status'=>500,
                                'payload'=>null,
                                'message'=>'Failed to Delete The data' 
                            ]);
                        }
                }
                else{
                    return response()->json([
                        'status'=>500,
                        'payload'=>null,
                        'message'=>'Not a customer' 
                    ]);

                }
            }
            else{
                return response()->json([
                    'status'=>401,
                    'payload'=>null,
                    'message'=>'Unable to remove' 
                ]);
            }

        }
        public function updateQuantity(Request $request,$id){
            $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
            if($is_LoggedIn){
                $user_id=$is_LoggedIn;
                $userData=User::find($user_id);
                if($userData->isCustomer==1){
                    $Data=cart_product::find($id);
                    $Data->quantity=$request->quantity;
                    $Data=$Data->save();
                    if($Data){
                        return response()->json([
                            'status'=>200,
                            'payload'=>$Data,
                            'message'=>'Quantity Updated  successfully' 
                        ]);
                    }
                    else{
                        return response()->json([
                            'status'=>500,
                            'payload'=>null,
                            'message'=>'Failed to Update  The data' 
                        ]);
                    }
                }
                else{
                    return response()->json([
                        'status'=>500,
                        'payload'=>null,
                        'message'=>'Not a customer' 
                    ]);

                }
            }
            else{
                return response()->json([
                    'status'=>401,
                    'payload'=>null,
                    'message'=>'Unable to Update' 
                ]);

            }
        }
        public function addtoCart(Request $request){
            $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
            if($is_LoggedIn){
                $user_Id=$is_LoggedIn;
                $userData=User::find($user_Id);
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
                            $productData=ProductDetails::where('id',$productId)->first();
                            $oldStock_qunatity=$productData->product_stock;
                            if($quantity<$oldStock_qunatity){
                                $selling_price=$val['selling_price'];
                                $Actual_price=$val['Actual_price'];
                                $promocode=$val['promocode'];
                                $promocodeLength = Str::length($promocode);
                                //return $promocodeLength;
                                //return gettype($promocode);
                                if($promocodeLength==0){
                                    $promocode="null";
                                }
                                else{
                                    $storedData= DB::select("CALL get_Update_Insert($productId,$quantity,$id,$selling_price,$Actual_price,'$promocode')"); 
                                }
                                // return $promocode;
                            }
                            else{
                                return response()->json([
                                    'status'=>500,
                                    'payload'=>null,
                                    'message'=>'quantity is higher than stock qunatity' 
                                ]);
                            }
                       }
                       return response()->json([
                        'status'=>200,
                        'payload'=>"Success",
                        'message'=>'Quantity Updated and inserted  successfully' 
                    ]);
                }
                
        }

}
