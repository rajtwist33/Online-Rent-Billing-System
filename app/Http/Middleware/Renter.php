<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Renter
{
   
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role_id == 2){
            return $next($request);
        }
        return redirect('/')->with('error',"You Entered Wrong Credential");
    }
}
