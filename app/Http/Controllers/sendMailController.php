<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\TestEmail;

class sendMailController extends Controller
{
    public function sendmail(Request $request){
        Mail::to('smp320@nist.edu')->send(new TestEmail());
        return " mail send successfully";
    }
}
