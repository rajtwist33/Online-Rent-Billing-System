<?php

namespace App\Http\Controllers\Renter;

use App\Models\User;
use App\Models\Renter\Room;
use App\Models\Setting;
use App\Models\RenterImage;
use App\Models\Renter\Electricity_Bill;
use App\Models\Renter\Electricitybillpayment;
use Illuminate\Http\Request;
use App\Models\Renter\Tenant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ElectricitybillpaymentController extends Controller
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
        $tenants = Tenant::with('tenanthasroom')->Where('user_id',Auth::user()->id)->get();
        $rooms = Room::Where('user_id',Auth::user()->id)->get();
        return view('renter.pages.electricitypayment.index',compact('title','org_name','data','datas','electricity','rooms','tenants'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
        $org_name = Setting::first(); 
        $data =RenterImage::where('user_id',Auth::user()->id)->first();
        $title = 'Electricity Payment';
        $tenants = Tenant::with('tenantimage','tenanthasroom')->Where('id',$request->tenant_id)->Where('user_id',Auth::user()->id)->first();
        $elctricity_opening_unit = Electricity_Bill::Where('user_id',Auth::user()->id)
                            ->Where('room_id',$tenants->room_id)->first();
        return view('renter.pages.electricitypayment.create',compact('org_name','data','title','tenants','elctricity_opening_unit'));
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  
    if($request->dues != null){
        $dues = $request->dues;
      
    }
    if($request->advance != null){
        $advance = $request->advance;
    
    }
      Electricitybillpayment::updateOrcreate(
        [
        'id'=>$request->data_id,
        ],
        [
        'user_id'=>Auth::user()->id,
        'room_id'=>$request->room_id,
        'tenant_id'=>$request->tenant_id,
        'opening_unit'=>$request->opening_electricity_bill,
        'closing_unit'=>$request->closing_electricity_bill,
        'total_unit'=>$request->generated_bill,
        'amount_tobe_paid'=>$request->amount_tobe_paid,
        'paid_amount'=>$request->bill_pay_amount,
        'dues_amount'=>$dues ?? null,
        'advance_amount'=>$advance ?? null,
        'slug'=>rand(1,9999),
    ]);
    Electricity_Bill::Where('user_id',Auth::user()->id)->Where('room_id',$request->room_id)->update(
        [
                'opening_unit'=>$request->closing_electricity_bill,
        ]
);

       
            return redirect()->back()->with('success',"Electricity Bill Paid Successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($electricitybill_payment)
    {
        $org_name = Setting::first(); 
        $data = RenterImage::where('user_id',Auth::user()->id)->first();
        $title ='Electricity Payment';
        $bill_history =Electricitybillpayment::With('tenant')->Where('user_id',Auth::user()->id)->Where('room_id',$electricitybill_payment)->latest()->get();
        return view('renter.pages.electricitypayment.view_history',compact('org_name','data','title','bill_history'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $electricitybill_payment
     * @return \Illuminate\Http\Response
     */
    public function edit($electricitybill_payment)
    {
        $org_name = Setting::first(); 
        $data =RenterImage::where('user_id',Auth::user()->id)->first();
        $title = 'Update Electricity Payment';
        $datas = Electricitybillpayment::With('tenant')->Where('user_id',Auth::user()->id)->Where('id',$electricitybill_payment)->first();
        return view('renter.pages.electricitypayment.edit',compact('org_name','data','title','datas'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $electricitybill_payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($electricitybill_payment)
    {
        //
    }
}
