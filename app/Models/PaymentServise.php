<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentServise extends Model
{
        public function pay():string{
            return "Your transaction successfull";
        }
}
