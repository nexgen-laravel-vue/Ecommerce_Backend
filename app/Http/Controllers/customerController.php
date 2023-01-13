<?php

namespace App\Http\Controllers;
use App\Models\PaymentServise;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentServiceController;
class customerController extends Controller
{
        public function demoDependencyInjection(){
            $service= new PaymentServise();

            $customer=new PaymentServiceController();

            $customer->setPaymentService($service);

            $demoData=$customer->service->pay();
            return $demoData;
        }

        public function democonstructorDI(){
            $service= new PaymentServise();

            $customer=new PaymentServiceController($service);

            $demoData=$customer->service->pay();
            return $demoData;

        }
        
        

}
