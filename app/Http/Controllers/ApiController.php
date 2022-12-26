<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetails;
use App\Models\User;
use App\Models\userrolemapping;
class ApiController extends Controller
{
        public function getAllParentCategory(){
            $Data=Category::where("parentId",null)->get();
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


        public function getChildCategoryById($id){
            $Data=Category::where('parentId',$id)->get();
            return $Data;
        }


        public function getAllBrand(){
            $Data=Brand::all();
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


        public function getAllPRoductByBrandId($id){
            $Data=ProductDetails::where('brandId',$id)->get();
            return $Data;
        }

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
        public function getAllUser(Request $req){
            $isAdmin=$this->is_Admin($req);
            $isSuperAdmin=$this->is_SuperAdmin($req);
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
            $isAdmin=$this->is_Admin($req);
            $isSuperAdmin=$this->is_SuperAdmin($req);
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
        public  function get(Request $req){
            $user_id=$req->user()->id;
            $user=User::find($user_id); 
            return $user; 
        }
        public  function updateUserById(Request $req,$id){
            $isAdmin=$this->is_Admin($req);
            $isSuperAdmin=$this->is_SuperAdmin($req);
            if($isAdmin || $isSuperAdmin){
                $input=User::find($id);  
                $input->firstName=$req->firstName;
                $input->lastName=$req->lastName;
                $input->email=$req->email;
                $input->password=bcrypt($req->password);
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

        public function getAllProduct(){
            $Data=ProductDetails::all();
            if($Data){
                return response()->json([
                'status'=>200,
                'payload'=>$Data,
                'message'=>'Success' 
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
        public function getDeleteProductId(Request $req,$id){
            $isAdmin=$this->is_Admin($req);
            $isSuperAdmin=$this->is_SuperAdmin($req);
            if($isAdmin || $isSuperAdmin){
                $Data=ProductDetails::find($id);
                if($Data){
                    $Data->delete();
                    return response()->json([
                        'status'=>200,
                        'payload'=>$Data,
                        'message'=>'Product Deleted successfully' 
                    ]);
                }
                    else{
                        return response()->json([
                            'status'=>500,
                            'payload'=>null,
                            'message'=>'Failed to Delete The Product' 
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
