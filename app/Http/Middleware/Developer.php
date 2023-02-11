<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Developer
{
   
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role_id == 1){
            return $next($request);
        }
        return redirect('/')->with('error',"You Entered Wrong Credential");
    }
}
