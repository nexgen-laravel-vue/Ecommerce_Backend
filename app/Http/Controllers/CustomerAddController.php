<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AccessManagementController;
use Illuminate\Http\Request;
use App\Models\CustomerAdd;
use App\Models\User;
use App\Models\ResponseModel\ErrorResponseModel;
use App\Models\ResponseModel\ExceptionResponseModel;
use App\Models\ResponseModel\AccessDeniedResponseModel;
use App\Models\ResponseModel\SuccessResponseModel;
class CustomerAddController extends Controller
{
         public function getAddressdetails(Request $request,$id){
            try{
                $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
                if($is_LoggedIn){
                    $user_id=$is_LoggedIn;
                    $userData=DB::table('users')->where('id',$user_id)->get();
                    if($userData->isCustomer==1){
                        $Data=DB::table('customer_adds')->where('id',$id)->get();
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
        public function add_Address(Request $request){
            try{
                    $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
                    if($is_LoggedIn){
                        $user_id=$is_LoggedIn;
                        $userData=DB::table('users')->where('id',$user_id)->get();
                        if($userData->isCustomer==1){  
                        $input=$request->all();
                        $input['userId']=$user_id;
                        $data=DB::table('customer_adds')->insert($input);
                            if($data){
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

}
