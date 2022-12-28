<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetails;
use App\Models\User;
use App\Models\userrolemapping;
class AccessManagementController extends Controller
{
    public function is_ValidToken(Request $req){
        $user_id=$req->user()->id;
        $user=User::find($user_id);
        if($user){
                $userid=$user->id;
                $RoleData=userrolemapping::where('userId',$userid)->orderBy('userId')->first();
                $roleId=$RoleData->roleId;
                return $roleId;
        }
        else{
                return false;
        }
    }
    public function is_Admin(Request $req){
        $data=$this->is_ValidToken($req);
        if($data){
            $roleId=$data;
            if($roleId==2){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    public function is_SuperAdmin(Request $req){
        $data=$this->is_ValidToken($req);
        if($data){
            $roleId=$data;
            if($roleId==1){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
}