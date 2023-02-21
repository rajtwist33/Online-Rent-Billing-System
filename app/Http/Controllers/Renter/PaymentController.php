<?php

namespace App\Http\Controllers\Renter;

use App\Models\Setting;
use App\Models\RenterImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Renter\Tenant;
use App\Models\Renter\TenantPayment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
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
        $title = 'Payment';
        $payments = TenantPayment::With('tenant')->Where('user_id',Auth::user()->id)->latest()->get();
        return view('renter.pages.payment.index',compact('org_name','data','title','payments'));
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
        $title = 'Payment';
        $tenants = Tenant::with('tenantimage','tenanthasroom')->Where('id',$request->tenant_id)->Where('user_id',Auth::user()->id)->first();
        return view('renter.pages.payment.addpayment',compact('org_name','data','title','tenants'));
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     if($request->advance_payment != ''){
        TenantPayment::Where('slug',$request->advance_payment)->Where('user_id',Auth::user()->id)
        ->update([
            'advance'=> null,
        ]);
        return redirect()->back()->with('success','Advance Amount Cleared.');
     }
        $request->validate([
            'paid_amount'=>'required',
            'paid_date'=>'required',
       ]);
       if($request->data_id == ''){
        TenantPayment::create(
            [
            'tenant_id'=>$request->tenant_id,
            'user_id' =>Auth::user()->id,
            'paid_date'=>$request->paid_date,
            'paid_amount' =>$request->paid_amount,
            'dues' =>$request->dues,
            'advance' =>$request->advance,
            'slug'=>rand(1,9999),
            ],
            );
        }
       if($request->data_id != ''){
             $paid_amount = ($request->paid_amount + $request->dues);
                if($paid_amount == $request->tenant_fee)
                {  
                    TenantPayment::Where('id',$request->data_id)->Where('user_id',Auth::user()->id)
                        ->update(
                        [
                        'tenant_id'=>$request->tenant_id,
                        'user_id' =>Auth::user()->id,
                        'paid_date'=>$request->paid_date,
                        'paid_amount' =>$paid_amount,
                        'dues'=>null,
                        'advance' =>null,
                        'slug'=>rand(1,9999),
                        ],
                    );
                }
                if($paid_amount < $request->tenant_fee)
                {
                        $dues = $request->tenant_fee - $paid_amount;
                       
                    TenantPayment::Where('id',$request->data_id)->Where('user_id',Auth::user()->id)
                        ->update(
                        [
                        'tenant_id'=>$request->tenant_id,
                        'user_id' =>Auth::user()->id,
                        'paid_date'=>$request->paid_date,
                        'paid_amount' =>$paid_amount,
                        'dues'=>$dues,
                        'advance' =>$request->advance,
                        'slug'=>rand(1,9999),
                        ],
                    );
                }
                if($paid_amount > $request->tenant_fee)
                {
                        $advance =   $paid_amount - $request->tenant_fee ;
                    TenantPayment::Where('id',$request->data_id)->Where('user_id',Auth::user()->id)
                        ->update(
                        [
                        'tenant_id'=>$request->tenant_id,
                        'user_id' =>Auth::user()->id,
                        'paid_date'=>$request->paid_date,
                        'paid_amount' =>$paid_amount,
                        'dues'=>null,
                        'advance' =>$advance,
                        'slug'=>rand(1,9999),
                        ],
                    );
                }
             
       }
       
            if($request->data_id != ''){
                return redirect()->route('renter.payment.index')->with('success','Dues Cleared');
            }
            else{
                return redirect()->route('renter.payment.index')->with('success','Payment Added');

            }
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
    public function edit($payment)
    {
        $org_name = Setting::first(); 
        $data =RenterImage::where('user_id',Auth::user()->id)->first();
        $title = 'Payment';
        $payments = TenantPayment::With('tenant')->Where('slug',$payment)->Where('user_id',Auth::user()->id)->first();
    
        return view('renter.pages.payment.editpayment',compact('org_name','data','title','payments'));
  
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
