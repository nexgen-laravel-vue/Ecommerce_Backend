<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\User;
use App\Models\userrolemapping;
use App\Models\role;
class AuthController extends Controller
{
    public function  register(Request $request){
            $validator= Validator::make($request->all(),[
                'firstName'=>'required',
                'lastName'=>'required',
                'email'=>'required|email',
                'password'=>'required'
            ]);
            if($validator->fails()){
                $response=[
                    'success'=>false,
                    'message'=>$validator->errors()
                ];
                return response()->json($response,400);
            }
            $input=$request->all();
           // $input['password']=bcrypt($input['password']);
            $input['password']=password_hash($input['password'],PASSWORD_BCRYPT);
            $data=User::create($input);
            $userId['userId']=$data->id;
            $roleData=userrolemapping::create($userId);
            $success['firstName']=$data->firstName;
            $success['lastName']=$data->lastName;
            return response()->json([
                'status'=>200,
                'payload'=>$success,
                'message'=>'User registration successfully' 
            ]);
           
    }
    public function login(Request $request){
        $user=User::where('email', $request->email)->first();
        $pass_check=password_verify($request->password, $user->password);
        if ($user && $pass_check) {
              $userid=$user->id;
              $mappingData=userrolemapping::where('userId',$userid)->first();
              $roleid=$mappingData->roleId;
              $roleData=role::where('id',$roleid)->first();
              $roleType=$roleData->roleType;
              $success['token']=$user->createToken('MyApp')->plainTextToken;
              $success['firstName']=$user->firstName;
              $success['lastName']=$user->lastName;
              $success['role']=$roleType;
            return response()->json([
                'status'=>200,
                'payload'=>$success,
                'message'=>'User Login successfully' 
            ]);
        }
        else{
            return response()->json([
                'status'=>500,
                'payload'=>null,
                'message'=>'Failed To Login' 
             ]);
        }


    }
}
