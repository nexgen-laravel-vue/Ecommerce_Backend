<?php
namespace App\Http\Controllers;
use Illuminate\Http\Response;
use App\Http\Controllers\AccessManagementController;
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
class ProductController extends Controller
{
    public function getAllProduct(){
        try{
                $Data=DB::table('product_details')->get();
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
    public function getAllProductByChildCategoryId($id){
        try{
            $Data=DB::table('product_details')->where('categoryId',$id)->get();
            if($Data){
                $response=(new SuccessResponseModel)->successResponseWithPaylod($Data);
                return $response;
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
    public function getSignleProductById($id){
        try{
            $Data=DB::table('product_details')->where('id',$id)->get();
            if($Data){
                return $response=(new SuccessResponseModel)->successResponseWithPaylod($Data);
            }
            else{
                return $response=(new ErrorResponseModel)->noDataFoundResponse();  
            }
        }
        catch(\Exception $e){
            $response=(new ExceptionResponseModel)->getExceptionResponse($e);
            return $response;

        }
        catch(\Error $e){
            $response=(new ErrorResponseModel)->getErrorResponse($e);
            return $response;
        }

    }
    public function deleteProductById(Request $req,$id){
        try{
                    $isAdmin=(new AccessManagementController)->is_Admin($req);
                    $isSuperAdmin=(new AccessManagementController)->is_SuperAdmin($req);
                    if($isAdmin || $isSuperAdmin){
                        $Data=DB::table('product_details')->where('id',$id)->get();
                        if($Data){
                            $Data->delete();
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
    public function updateProductById(Request $req,$id){
        try{
            $isAdmin=(new AccessManagementController)->is_Admin($req);
            $isSuperAdmin=(new AccessManagementController)->is_SuperAdmin($req);
            if($isAdmin || $isSuperAdmin){
                $Data=DB::table('product_details')->where('id',$id)->get();
                $Data->productName=$req->productName;
                $Data->productDescription=$req->productDescription; 
                $Data->product_img=$req->product_img;
                $Data=$Data->save();
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
}
