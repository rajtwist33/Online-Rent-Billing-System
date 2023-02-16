<?php

namespace App\Http\Controllers\Developer;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Password Change';
        $data = User::where('role_id',1)->first();
        $org_name = Setting::first();
        return view('developer.passwordchange.index',compact('title','data','org_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'current_password'=>['required', new MatchOldPassword],
            'new_pass' => 'required|min:6',
            'conf_pass' => 'required|same:new_pass',
            
        ]);
  
        User::updateOrCreate(
            ['id' =>Auth::user()->id],
           [ 
            'account'=>$request->account,
            'password'=>Hash::make($request->new_pass),
            'role_id'=>1,
           ]
        );
    
        return redirect()->route('login')->with('success','Developer Password Changed Suceesfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
