<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\TestEmail;
use Illuminate\Http\Response;
use DB;
use App\Models\ResponseModel\ErrorResponseModel;
use App\Models\ResponseModel\ExceptionResponseModel;
use App\Models\ResponseModel\ValidatorResponseModel;
use App\Models\ResponseModel\SuccessResponseModel;
use Validator;
use App\Models\User;

class sendMailController extends Controller
{
    public function sendmail(Request $request){
        try{
                $validator= Validator::make($request->all(),[
                    'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                ]);
                if($validator->fails()){
                    return $response=(new ValidatorResponseModel)->getValidorResponse($validator);
                }
                $email=$request->email;
                $userData=DB::table('users')->where('email',$email)->get();
                if(count($userData)>0){
                    $name=$userData[0]->firstName;
                    Mail::to($email)->send(new TestEmail($name));
                    return $response=(new  SuccessResponseModel)->successResponseWithoutPaylod();
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
