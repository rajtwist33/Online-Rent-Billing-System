<?php

namespace App\Http\Controllers\Developer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class TenantOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $title = 'Renter';
       $datas = User::where('role_id',2)->get();
        return view('developer.pages.renter.index',compact('title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        User::find($request->id)->delete();
        toast('success','Renter Account has Deleted.');
        return redirect()->back();
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
            'renter_name' => 'required',
            'renter_useraccount' => 'required|max:255',
            'renter_password' => 'required|min:6',
            'renter_confpassword' =>  'required|same:renter_password',
        ]);
      
        User::updateOrCreate(
            ['id' => $request->data_id],
           [
            'name'=>$request->renter_name,
            'account'=>$request->renter_useraccount,
            'password'=>Hash::make($request->renter_password),
            'role_id'=>2,
           ]
        );
        toast('success','New Renter Acoount Created .');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tenantowner, Request $request)
    {
        $title = "Renter";
        $datas = User::find($tenantowner)->get();
       return view('developer.pages.renter.edit',compact('datas','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tenantowner)
    {
        dd($tenantowner);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $tenantowner,Request $request)
    {
       
    }
}
