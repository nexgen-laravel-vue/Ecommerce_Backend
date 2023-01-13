<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentServise;
class PaymentServiceController extends Controller
{
        public PaymentServise $service;

        public function __construct(PaymentServise $service){
            $this->service=$service;
        }
        public function setPaymentService(PaymentServise $service){
            $this->service=$service;
        }
}
