<?php

namespace App\Http\Controllers\Developer;

use App\Models\User;
use App\Models\Setting;
use App\Models\RenterImage;
use Illuminate\Http\Request;
use App\Models\RentownerDetail;
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
       $org_name = Setting::first();
       $datas = User::with('renterimage')->where('role_id',2)->latest()->get();
        return view('developer.pages.renter.index',compact('org_name','title','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = RenterImage::where('user_id',$request->id)->first();
       
        if(($data != '')){ 
            unlink(public_path('rentowner/uploads/'.$data->image_path));
        }
        User::find($request->id)->delete();
        
        return redirect()->back()->with('delete','Renter Account Deleted !');
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
     
        return redirect()->back()->with('success','New RentOwner Account Created');
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
        $org_name = Setting::first();
        $datas = User::with('renterdetail')->where('id',$tenantowner)->get();
        return view('developer.pages.renter.edit',compact('org_name','datas','title'));
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
