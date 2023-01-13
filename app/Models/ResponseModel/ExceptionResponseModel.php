<?php

namespace App\Models\ResponseModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
class ExceptionResponseModel extends Model
{
    public function getExceptionResponse($e){
        $data = ['General Exception:' . $e->getMessage()];
        return response()->json([
            'statuscode'=>Response::HTTP_INTERNAL_SERVER_ERROR,
            'messgae'=>$data
        ]);
    }
}
