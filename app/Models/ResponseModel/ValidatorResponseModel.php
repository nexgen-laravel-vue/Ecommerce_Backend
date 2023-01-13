<?php

namespace App\Models\ResponseModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Validator;
class ValidatorResponseModel extends Model
{
    public function getValidorResponse($validator){
            return response()->json($validator->errors(),Response::HTTP_BAD_REQUEST);
    }
}
