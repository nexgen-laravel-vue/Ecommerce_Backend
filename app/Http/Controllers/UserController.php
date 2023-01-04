<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\AccessManagementController;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetails;
use App\Models\User;
use App\Models\userrolemapping;
class UserController extends Controller
{
    public function getAllUser(Request $req){
        $isAdmin=(new AccessManagementController)->is_Admin($req);
        $isSuperAdmin=(new AccessManagementController)->is_SuperAdmin($req);
        if($isAdmin || $isSuperAdmin){
                $Data=User::all();
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
        if($isAdmin || $isSuperAdmin){
            $Data =User::find($id);
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
}
