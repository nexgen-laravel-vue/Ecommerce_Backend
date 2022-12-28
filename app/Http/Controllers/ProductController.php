<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AccessManagementController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetails;
use App\Models\User;
use App\Models\userrolemapping;

class ProductController extends Controller
{
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
    public function getAllProductByChildCategoryId($id){
        $Data=ProductDetails::where('categoryId',$id)->get();
        if($Data){
            return response()->json([
                'status'=>200,
                'payload'=>$Data,
                'message'=>'Product Details' 
            ]);
        }
        else{
            return response()->json([
                'status'=>500,
                'payload'=>null,
                'message'=>'Access Denied' 
            ]);
        }    
    }
    public function getSignleProductById($id){
        $Data=ProductDetails::where('id',$id)->get();
        if($Data){
            return response()->json([
                'status'=>200,
                'payload'=>$Data,
                'message'=>'Product Details' 
            ]);
        }
        else{
            return response()->json([
                'status'=>500,
                'payload'=>null,
                'message'=>'Access Denied' 
            ]);
        }

    }
    public function getDeleteProductId(Request $req,$id){
        $isAdmin=(new AccessManagementController)->is_Admin($req);
        $isSuperAdmin=(new AccessManagementController)->is_SuperAdmin($req);
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
