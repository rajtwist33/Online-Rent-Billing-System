<?php

namespace App\Http\Controllers\Renter;

use App\Models\User;
use App\Models\Setting;
use App\Models\RenterImage;
use Illuminate\Http\Request;
use App\Models\RentownerDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class ProfileController extends Controller
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
        return view('renter.pages.profile.index',compact('title','org_name','data','datas'));
   
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
        User::where('id',Auth::user()->id)->update(  
            [
             'name'=>$request->renter_name,
             'email'=>$request->renter_email != '' ?$request->renter_email : '',
            ]
         );
         RentownerDetail::updateOrCreate(
             [
                 'user_id'=>Auth::user()->id,
             ],
            [
             'phone'=>$request->renter_phone,
             'address'=>$request->renter_address,
             'role_id'=>2,
            ]
         );
         $data = RenterImage::where('user_id',Auth::user()->id)->first();
        
         if (!empty($request->image)) {
         $this->validate($request, [
             'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:3048',
         ]);
             if( (!empty($data) && $data->image_path != '')){ 
                 unlink(public_path('rentowner/uploads/'.$data->image_path));
             }
             $file = Image::make($request->file('image'));
             $extension = time().'-'.$request->file('image')->getClientOriginalName();
             $filename = time().'.' . $extension;
             $destinationPathThumbnail = public_path('rentowner/uploads/');
             $file->resize(100,100);
             $file->save($destinationPathThumbnail .$filename);
           
             RenterImage::updateOrCreate(
                 [
                     'user_id'=>Auth::user()->id,
                 ],
                 [
                     'image_path' => $filename,
                     'slug'=>rand(1,9999),
                 ]
         );
         }
 
         return redirect()->back()->with('success',' Profile  Updated. ');     
     
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
