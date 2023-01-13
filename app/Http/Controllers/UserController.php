<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AccessManagementController;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetails;
use App\Models\User;
use App\Models\userrolemapping;
use App\Models\role;
use Illuminate\Http\JsonResponse as Resp;
use App\Models\ResponseModel\ErrorResponseModel;
use App\Models\ResponseModel\ExceptionResponseModel;
use App\Models\ResponseModel\AccessDeniedResponseModel;
use App\Models\ResponseModel\SuccessResponseModel;
use DB;
class UserController extends Controller
{
    public function getAllUser(Request $req){
        try{
            $isAdmin=(new AccessManagementController)->is_Admin($req);
            $isSuperAdmin=(new AccessManagementController)->is_SuperAdmin($req);
            $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($req);
            $userId=$is_LoggedIn;
            $roleId=1;
            $superAdminData = userrolemapping::where('roleId', $roleId)->first();
            $superAdminUserId=$superAdminData->userId;
            if($isAdmin || $isSuperAdmin){
                    $Data=User::all()->where('id','!=',$superAdminUserId);
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
    catch(\Exception $e){
        return $response=(new ExceptionResponseModel)->getExceptionResponse($e);
    }
    catch(\Error $e){
        return $response=(new ErrorResponseModel)->getErrorResponse($e);
    }
    } 
    public  function deleteUserById(Request $req,$id){
        try{
            $isAdmin=(new AccessManagementController)->is_Admin($req);
            $isSuperAdmin=(new AccessManagementController)->is_SuperAdmin($req);
            $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($req);
            $userId=$is_LoggedIn;
            if($is_LoggedIn){
                if($isAdmin || $isSuperAdmin){
                    $Data =User::find($id);
                    if($Data && $userId!=$id){
                        $Data->delete();
                        return $response=(new SuccessResponseModel)->successResponseWithPaylod($Data);
                    }
                        else{
                            return $response=(new ErrorResponseModel)->noDataFoundResponse(); 
                        }
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
    public  function updateUserById(Request $req,$id){
        try{
            $isAdmin=(new AccessManagementController)->is_Admin($req);
            $isSuperAdmin=(new AccessManagementController)->is_SuperAdmin($req);
            if($isAdmin || $isSuperAdmin){
                $input=User::find($id);
                $input->firstName=$req->firstName;
                $input->lastName=$req->lastName;
                $input->phoneno=$req->phoneno;
                $Data=$input->save();
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
        catch(\Exception $e){
            return $response=(new ExceptionResponseModel)->getExceptionResponse($e);
        }
        catch(\Error $e){
            return $response=(new ErrorResponseModel)->getErrorResponse($e);
        }
    }
    public function forgotPassword(Request $request){
        try{
            $email=$request->email;
            $password=$request->password;
            $userData=DB::table('users')->where('email',$email)->get();
            if(count($userData)>0){
                $updatedPassword=password_hash($password,PASSWORD_BCRYPT);
                DB::table('users')->where('email',$email)->update(['password' =>$updatedPassword]);
                return $response=(new  SuccessResponseModel)->successResponseWithoutPaylod();
            }
            else{
                return $response=(new ErrorResponseModel)->noDataFoundResponse(); 
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
