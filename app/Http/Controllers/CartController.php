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
            if($is_LoggedIn){
              $Data=$request->all();
              $new_insert_array=array();
                foreach($Data as $key=>$val)
                {
                    $new_insert_array[]=array("productId"=>$val['productId'],"userId"=>$val['userId'],"quantity"=>$val['quantity']);
                }
                CartProduct::insert($new_insert_array);
                return response()->json([
                    'status'=>200,
                    'payload'=>"data",
                    'message'=>'Data inserted successfully' 
                ]);
            }
            else{
                return response()->json([
                    'status'=>401,
                    'payload'=>null,
                    'message'=>'Access Denied' 
                ]);
            }

        }
}
