<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Alert;
class AuthenticationController extends Controller
{
    public function login(Request $request){
       
        $credentials = $request->validate([
            'account' => ['required'],
            'password' => ['required'],
           
        ]);
 
        if(auth()->attempt(array('account' => $request['account'], 'password' => $request['password']))){
            if (auth()->user()->role_id == 1) 
            {   
                $request->session()->regenerate();
                return redirect()->route('developer.dashboard.index');
            }
            else if(auth()->user()->role_id == 2)
            {
                $request->session()->regenerate();
                return redirect()->route('renter.dashboard');
            }
           
        }
        toast('Something Went Error','error');
        return back();
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
