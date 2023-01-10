<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AccessManagementController;
use App\Models\CartProduct;
use App\Models\User;
use App\Models\cart_product;
use App\Models\order;
use App\Models\payment;
use App\Models\order_item;
use DB;
class PaymentController extends Controller
{
    public function shopping(Request $request){
        try{
        $is_LoggedIn=(new AccessManagementController)->is_LoggedIn($request);
        if($is_LoggedIn){
            $user_id=$is_LoggedIn;
            $userData=User::find($user_id);
            if($userData->isCustomer==1){
                    $logging=array();
                    DB::table('cart_products')->where('userId',$user_id)->update(['is_paid' => 1]);
                    $logging['steps-1']='All product Details are updated unpaid to paid in cart table';

                    $paymentInput=$request->all();
                    $paymentInput['payment_amount']=$paymentInput['payment_amount'];
                    $paymentInput['payment_ref']=$paymentInput['payment_ref'];
                    $paymentData=payment::create($paymentInput);
                    $logging['steps-2']='Payment Details are inserted into payment table';

                    $orderInput['userId']=$user_id;
                    $orderData=order::create($orderInput);
                    $logging['steps-3']='order id generated  and inserted into order table';

                    $lastPaymentRecord=DB::table('payments')->latest()->first();
                    $lastOrderRecord=DB::table('orders')->latest()->first();
                    DB::table('payments')->where('id',$lastPaymentRecord->id)->update(['orderId' => $lastOrderRecord->id]);
                    $logging['steps-4']='Generated orderid mapped with the payment table';


                    $CartData=DB::table('cart_products')->where('userId',$user_id)->where('is_paid',1)->get();
                    $new_insert_array=array();
                    foreach($CartData as $key=>$val)
                    {
                        $new_insert_array[]=array("orderId"=>$lastOrderRecord->id,"productId"=>$val->productId,"userId"=>$user_id,"quantity"=>$val->quantity,"selling_price"=>$val->selling_price,"Actual_price"=>$val->Actual_price,"promocode"=>$val->promocode,"created_date"=>$val->created_date,"created_by"=>$val->created_by);                        
                    }
                    $Data=order_item::insert($new_insert_array);
                    $logging['steps-5']='Paid cart records are inserted into the order_item_table';

                    DB::table('cart_products')->where('userId',$user_id)->where('is_paid',1)->delete();
                    $logging['steps-6']='Paid cart records are deleted from the cart table';
                    return response()->json([
                        'status'=>200,
                        'payload'=>$logging,
                        'message'=>'Success' 
                    ]);
            
            }
            else{
                return response()->json([
                    'status'=>401,
                    'payload'=>null,
                    'message'=>'Not a customer' 
                ]);
    
            }

        }
        else{
            return response()->json([
                'status'=>401,
                'payload'=>null,
                'message'=>'Not allow for the payment page' 
            ]);

        }
    }
    catch(Exception $e){
        return response()->json([
            'status'=>500,
            'payload'=>null,
            'message'=>$e 
        ]);
    }
    }
}
