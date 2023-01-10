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
use DB;
class UserController extends Controller
{
    public function getAllUser(Request $req){
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
                    'status'=>404,
                    'payload'=>null,
                    'message'=>'Access Denied' 
                ]);
            }
    } 
    public  function deleteUserById(Request $req,$id){
        $isAdmin=(new AccessManagementController)->is_Admin($req);
        $isSuperAdmin=(new AccessManagementController)->is_SuperAdmin($req);
        $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($req);
        $userId=$is_LoggedIn;
        if($is_LoggedIn){
            if($isAdmin || $isSuperAdmin){
                $Data =User::find($id);
                if($Data && $userId!=$id){
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
        }
        else{
          
            return response()->json([
                'status'=>404,
                'payload'=>null,
                'message'=>'Access Denied' 
            ]);
        }
    }
    public  function updateUserById(Request $req,$id){
        $isAdmin=(new AccessManagementController)->is_Admin($req);
        $isSuperAdmin=(new AccessManagementController)->is_SuperAdmin($req);
        if($isAdmin || $isSuperAdmin){
            $input=User::find($id);
            $input->firstName=$req->firstName;
            $input->lastName=$req->lastName;
            $input->phoneno=$req->phoneno;
            $Data=$input->save();
            if($Data){
                return response()->json([
                    'status'=>200,
                    'payload'=>$Data,
                    'message'=>'Data Updated  successfully' 
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
                    'status'=>404,
                    'payload'=>null,
                    'message'=>'Access Denied' 
                ]);
            }
    }
    public function forgotPassword(Request $request){
        $email=$request->email;
        $password=$request->password;
        $userData=DB::table('users')->where('email',$email)->get();
       // $pass$userData[0]->password;
        if(count($userData)>0){
            $updatedPassword=password_hash($password,PASSWORD_BCRYPT);
            DB::table('users')->where('email',$email)->update(['password' =>$updatedPassword]);
            return "Success";

           
        }
        else{
            return response()->json([
                'status'=>500,
                'payload'=>null,
                'message'=>'Enter Correct Email' 
            ]);
        }
    }
}
