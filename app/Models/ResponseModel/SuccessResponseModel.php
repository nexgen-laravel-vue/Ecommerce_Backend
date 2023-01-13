<?php

namespace App\Models\ResponseModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
class SuccessResponseModel extends Model
{
            public function successResponseWithPaylod($Data){
                return response()->json([
                    'status'=>Response::HTTP_OK,
                    'payload'=>$Data,
                    'message'=>'Success' 
                    ]);
            }
            public function successResponseWithoutPaylod(){
                return response()->json([
                    'status'=>Response::HTTP_OK,
                    'message'=>'Success' 
                    ]);
            }
}
