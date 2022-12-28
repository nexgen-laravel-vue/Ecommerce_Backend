<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetails;
use App\Models\User;
use App\Models\userrolemapping;
class BrandController extends Controller
{
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
}
