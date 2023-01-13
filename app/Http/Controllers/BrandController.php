<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetails;
use App\Models\ResponseModel\ErrorResponseModel;
use App\Models\ResponseModel\ExceptionResponseModel;
use App\Models\ResponseModel\AccessDeniedResponseModel;
use App\Models\ResponseModel\SuccessResponseModel;
use DB;
class BrandController extends Controller
{
    public function getAllBrand(){
        try{
            $Data=Brand::all();
            $Data=DB::table('brands')->get();
            if($Data){
                return $response=(new SuccessResponseModel)->successResponseWithPaylod($Data);
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
    public function getAllPRoductByBrandId($id){
        try{
            $Data=DB::table('product_details')->where('brandId',$id)->get();
             if($Data){
                return $response=(new SuccessResponseModel)->successResponseWithPaylod($Data);
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
