<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AccessManagementController;
use Illuminate\Http\Request;
use App\Models\CustomerAdd;
use App\Models\User;
class CustomerAddController extends Controller
{
         public function getAddressdetails(Request $request,$id){
            $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
            if($is_LoggedIn){
                $user_id=$is_LoggedIn;
                $userData=User::find($user_id);
                if($userData->isCustomer==1){
                    $Data =CustomerAdd::find($id);
                    if($Data){
                        return response()->json([
                            'status'=>200,
                            'payload'=>$Data,
                            'message'=>'Data extracted successfully' 
                            ]);
                    }
                    else{
                        return response()->json([
                            'status'=>500,
                            'payload'=>null,
                            'message'=>'Failed' 
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
                        'message'=>'Not a Customer' 
                    ]);
                }
         }
        public function add_Address(Request $request){
            $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
            if($is_LoggedIn){
                $user_id=$is_LoggedIn;
                $userData=User::find($user_id);
                if($userData->isCustomer==1){
                $input=$request->all();
                $data=CustomerAdd::create($input);
                    if($data){
                        return response()->json([
                            'status'=>200,
                            'payload'=>$data,
                            'message'=>'Address Added successfully' 
                        ]);
                    }
                    else{
                        return response()->json([
                            'status'=>400,
                            'payload'=>null,
                            'message'=>'Unable to  Add the address' 
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
                    'message'=>'Not a Customer' 
                ]);
            }
        }

}
