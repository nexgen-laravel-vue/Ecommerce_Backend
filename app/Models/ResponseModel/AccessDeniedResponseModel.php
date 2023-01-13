<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
class AccessDeniedResponseModel extends Model
{
        public function  accessDeniedResponse(){
            return response()->json([
                'status'=>Response::HTTP_UNAUTHORIZED,
                'message'=>'Access Denied' 
            ]);
        }
}
