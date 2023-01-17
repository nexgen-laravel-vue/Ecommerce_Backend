<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetails;
use App\Models\User;
use App\Models\userrolemapping;
use App\Models\ResponseModel\ErrorResponseModel;
use App\Models\ResponseModel\ExceptionResponseModel;
use App\Models\ResponseModel\AccessDeniedResponseModel;
use App\Models\ResponseModel\SuccessResponseModel;
use DB;
class CategoryController extends Controller
{
    public function getAllParentCategory(){
        try{
            $Data=DB::table('categories')->where("parentId",null)->get();
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
    public function getChildCategoryById($id){
        try{
            $Data=DB::table('categories')->where('parentId',$id)->get();
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
    public function getAllParentCategoryName(){
        try{
            $Data=DB::table('categories')->select('categoryName','id')->where("parentId",null)->get();
            return $Data;
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
