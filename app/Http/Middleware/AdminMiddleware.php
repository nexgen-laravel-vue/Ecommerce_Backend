<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!isset($_SERVER['HTTP_X_HARDIK'])){  
           // return Response::json(array('error'=-->'Please set custom header'));  
        }  
  
        if($_SERVER['HTTP_X_HARDIK'] != '123456'){  
            return Response::json(array('error'=>'wrong custom header'));  
        }
        return $next($request);
    }
}
