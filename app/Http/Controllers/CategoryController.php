<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetails;
use App\Models\User;
use App\Models\userrolemapping;
class CategoryController extends Controller
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
}
