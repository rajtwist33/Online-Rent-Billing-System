<?php

namespace App\Http\Controllers\Renter;


use App\Models\User;
use App\Models\Setting;
use App\Models\Renter\Room;
use App\Models\RenterImage;
use Illuminate\Http\Request;
use App\Models\Renter\Tenant;
use App\Http\Controllers\Controller;
use App\Models\Renter\TenantPayment;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
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
        $title = 'Dashboard';
        $tenant =Tenant::Where('user_id',Auth::user()->id)->count();
        $room = Room::Where('user_id',Auth::user()->id)->count();
        $total_collected = TenantPayment::Where('user_id',Auth::user()->id)->pluck('paid_amount')->sum();
        $total_advance = TenantPayment::Where('user_id',Auth::user()->id)->pluck('advance')->sum();
        $total_dues = TenantPayment::Where('user_id',Auth::user()->id)->pluck('dues')->sum();
        return view('renter.dashboard',compact('title','org_name','data','tenant','room','total_collected','total_dues','total_advance'));
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
        if($request->sidebar == 1){
            User::Where('id',Auth::user()->id)->update([
                'sidebar'=>0,
            ]);
        }
        else{
            User::Where('id',Auth::user()->id)->update([
                'sidebar'=>1,
            ]);
        }
        return redirect()->back();
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
