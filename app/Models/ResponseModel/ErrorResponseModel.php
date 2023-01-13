<?php

namespace App\Models\ResponseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
class ErrorResponseModel extends Model
{
   public function getErrorResponse($e){
            $data = ['General Error:' . $e->getMessage()];
            return response()->json([
               'statuscode'=>Response::HTTP_INTERNAL_SERVER_ERROR,
               'messgae'=>$data
           ]); 
   }
   public function noDataFoundResponse(){
      return response()->json([
                 'status'=>Response::HTTP_UNAUTHORIZED ,
                  'message'=>'NO Data Found' 
              ]);
   }
}
