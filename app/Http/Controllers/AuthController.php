<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\User;
use App\Models\userrolemapping;
use App\Models\role;
use App\Models\ResponseModel\ErrorResponseModel;
use App\Models\ResponseModel\ExceptionResponseModel;
use App\Models\ResponseModel\ValidatorResponseModel;
use App\Models\ResponseModel\SuccessResponseModel;
use DB;
class AuthController extends Controller
{
    public function  register(Request $request){
        try{
            $validator= Validator::make($request->all(),[
                'firstName'=>'required',
                'lastName'=>'required',
                'email'=>'required|email',
                'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[?@$%^*-]).{6,}$/',
            ]);
            if($validator->fails()){
                return $response=(new ValidatorResponseModel)->getValidorResponse($validator);
            }
            $input=$request->all();
            $input['password']=password_hash($input['password'],PASSWORD_BCRYPT);
            $data=User::create($input);
            $userId['userId']=$data->id;
            $roleData=DB::table('userrolemappings')->insert($userId);
            $success['firstName']=$data->firstName;
            $success['lastName']=$data->lastName;
            return $response=(new SuccessResponseModel)->successResponseWithPaylod($success);
        }
        catch(\Exception $e){
            return $response=(new ExceptionResponseModel)->getExceptionResponse($e);
        }
        catch(\Error $e){
            return $response=(new ErrorResponseModel)->getErrorResponse($e);
        }     
           
    }
    public function login(Request $request){
        try{
            $user=User::where('email', $request->email)->first();
          //  $user=DB::table('users')->where('email', $request->email)->first();
            $pass_check=password_verify($request->password, $user->password);
            if ($user && $pass_check) {
                  $userid=$user->id;
                  $mappingData=DB::table('userrolemappings')->where('userId',$userid)->first();
                  $roleid=$mappingData->roleId;
                  $roleData=DB::table('roles')->where('id',$roleid)->first();
                  $roleType=$roleData->roleType;
                  $success['token']=$user->createToken('MyApp')->plainTextToken;
                // $success['token']=$user->createToken('token')->accessToken;
                  $success['firstName']=$user->firstName;
                  $success['lastName']=$user->lastName;
                  $success['phoneno']=$user->phoneno;
                  $success['email']=$user->email;
                  $success['role']=$roleType;
                  return $response=(new SuccessResponseModel)->successResponseWithPaylod($success);
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
