<?php

namespace App\Http\Controllers\Renter;

use App\Models\User;
use App\Models\Setting;
use App\Models\Renter\Room;
use App\Models\RenterImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Renter\Electricity_Bill;

class ElectricityBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $org_name = Setting::first();
        $data =RenterImage::where('user_id',Auth::user()->id)->first();  
        $title = 'Profile';
        $datas = User::with('renterdetail','renterimage')->where('id',Auth::user()->id)->get();
        $electricity = Electricity_Bill::With('room')->Where('user_id',Auth::user()->id)->get();
        $rooms = Room::Where('user_id',Auth::user()->id)->get();
        return view('renter.pages.electricity.index',compact('title','org_name','data','datas','electricity','rooms'));
   
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
       
        Electricity_Bill::updateOrcreate(
            ['id'=> $request->data_id],
            [
                'room_id'=>$request->room_id,
                'user_id'=>Auth::user()->id,
                'opening_unit'=>$request->opening_unit,
                'slug'=>rand(1,9999),
            ]
            );
            if($request->data_id != ''){
                return redirect()->route('renter.electricitybill.index')->with('success','Electricity Bill Updated');

            }
            else{
                return redirect()->back()->with('success','New Openinig Bill Created');

            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($electricitybill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($electricitybill)
    {
        $org_name = Setting::first();
        $data =RenterImage::where('user_id',Auth::user()->id)->first();  
        $title = 'Profile';
        $datas = User::with('renterdetail','renterimage')->where('id',Auth::user()->id)->get();
        $electricity = Electricity_Bill::With('room')->Where('user_id',Auth::user()->id)->Where('slug',$electricitybill)->first();
        $rooms = Room::Where('user_id',Auth::user()->id)->get();
        return view('renter.pages.electricity.edit',compact('title','org_name','data','datas','electricity','rooms'));
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $electricitybill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($electricitybill)
    {
       Electricity_Bill::Where('slug',$electricitybill)->Where('user_id',Auth::user()->id)->delete();
            return redirect()->back()->with('success','ElectircityBill Record Deleted');
    }
}
