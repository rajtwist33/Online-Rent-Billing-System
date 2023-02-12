<?php

namespace App\Http\Controllers\Developer;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\RentownerDetail;
use App\Http\Controllers\Controller;
use App\Models\RenterImage;
use Illuminate\Support\Facades\Hash;

class RenterController extends Controller
{
    public function updaterenter(Request $request){
       
        User::where('id',$request->data_id)->update(  
           [
            'name'=>$request->renter_name,
            'email'=>$request->renter_email != '' ?$request->renter_email : '',
            'account'=>$request->renter_useraccount,
            'password'=>Hash::make($request->renter_password),
            'role_id'=>2,
           ]
        );
        RentownerDetail::updateOrCreate(
            [
                'user_id'=>$request->data_id,
            ],
           [
            'phone'=>$request->renter_phone,
            'address'=>$request->renter_address,
            'role_id'=>2,
           ]
        );
        $data = RenterImage::where('user_id',$request->data_id)->first();
       
        if (!empty($request->image)) {
            if( (!empty($data) && $data->image_path != '')){ 
                unlink(public_path('rentowner/uploads/'.$data->image_path));
            }
            $file =$request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.' . $extension;
            $file->move(public_path('rentowner/uploads/'), $filename);
            $data['image']= 'public/rentowner/uploads/'.$filename;
          
            RenterImage::updateOrCreate(
                [
                    'user_id'=>$request->data_id,
                ],
                [
                    'image_path' => $filename,
                    'slug'=>rand(1,9999),
                ]
        );
        }

       
        
            return redirect()->back()->with('success',' RentOwner Account Updated ');     
    }
}
