<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AccessManagementController;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use App\Models\CartProduct;
class CartController extends Controller
{
        public function addtoCart(Request $request){
            $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
            $user_Id=$is_LoggedIn;
            if($is_LoggedIn){
              $Data=$request->all();
              $new_insert_array=array();
                foreach($Data as $key=>$val)
                {
                    return $val['quantity'];
                    $new_insert_array[]=array("productId"=>$val['productId'],"userId"=>$user_Id,"quantity"=>$val['quantity']);
                }
                $Data=CartProduct::insert($new_insert_array);
                return response()->json([
                    'status'=>200,
                    'payload'=>$Data,
                    'message'=>'Data inserted successfully' 
                ]);
            }
            else{
                return response()->json([
                    'status'=>401,
                    'payload'=>null,
                    'message'=>'Unable to add' 
                ]);
            }

        }
        public function removeProduct(Request $request,$id){
            $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
            if($is_LoggedIn){
                $Data=CartProduct::find($id);
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
                    'status'=>401,
                    'payload'=>null,
                    'message'=>'Unable to remove' 
                ]);
            }

        }
        public function updateQuantity(Request $request,$id){
            $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
            $user_Id=$is_LoggedIn;
            if($user_Id){
                $Data=CartProduct::find($id);
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
                    'status'=>401,
                    'payload'=>null,
                    'message'=>'Unable to Update' 
                ]);

            }
        }

}
