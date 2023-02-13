<?php

namespace App\Http\Controllers\Developer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RentownerDetail;
use App\Http\Controllers\Controller;
use App\Models\RenterImage;
use Illuminate\Support\Facades\Hash;
use Image;
class RenterController extends Controller
{
    public function updaterenter(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:3048',
        ]);

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
            $file = Image::make($request->file('image'));
            $extension = time().'-'.$request->file('image')->getClientOriginalName();
            $filename = time().'.' . $extension;
            $destinationPathThumbnail = public_path('rentowner/uploads/');
            $file->resize(100,100);
            $file->save($destinationPathThumbnail .$filename);
          
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
