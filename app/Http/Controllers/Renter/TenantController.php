<?php

namespace App\Http\Controllers\Renter;

use App\Models\Setting;
use App\Models\Renter\Room;
use App\Models\RenterImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Renter\Tenant;
use App\Models\Renter\TenantImage;
use Illuminate\Support\Facades\Auth;
use Image;
class TenantController extends Controller
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
        $title = 'Tenant';
        $tenants = Tenant::with('tenantimage','tenanthasroom')->where('user_id',Auth::user()->id)->latest()->get();
        return view('renter.pages.tenant.index',compact('title','org_name','data','tenants'));

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
        $title = 'Room-Tenant';
        $room = Room::where('id',$request->data_id)->first();
        return view('renter.pages.tenant.create',compact('title','org_name','data','room'));

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
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'fee'=>'required',
            'room_id'=>'required',
            'total_resident'=>'required',
            'occupation'=>'required',     
       ]);

       $tenant = Tenant::updateOrcreate(
            [ 'id'=>$request->data_id
            ],
            [
                'name'=>$request->name,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'parent_name'=>$request->parent_name,
                'parent_number'=>$request->parent_number,
                'fee'=>$request->fee,
                'room_id'=>$request->room_id,
                'total_resident'=>$request->total_resident,
                'occupation'=>$request->occupation,
                'user_id'=>Auth::user()->id,
                'description'=>$request->description,
                'slug'=>rand(1,9999),

            ]
       );

       Room::Where('id',$request->room_id)->Where('user_id',Auth::user()->id)->update([
            'status'=>1,
       ]);
     
       if($request->old_room != ''){
        Room::Where('id',$request->old_room)->Where('user_id',Auth::user()->id)->update(
            [
                'status'=>0,
            ]
            );
         }

       if (!empty($request->image)) {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:3048',
        ]);
            $data =TenantImage::Where('tenant_id',$request->data_id)->Where('user_id',Auth::user()->id)->first();
            if( (!empty($data) && $data->image_path != '')){ 
                unlink(public_path('tenant/uploads/'.$data->image_path));
            }
            $file = Image::make($request->file('image'));
            $extension = time().'-'.$request->file('image')->getClientOriginalName();
            $filename = time().'.' . $extension;
            $destinationPathThumbnail = public_path('tenant/uploads/');
            $file->resize(100,100);
            $file->save($destinationPathThumbnail .$filename);
          
            TenantImage::updateOrCreate(
                [
                    'user_id'=>$request->data_id,
                ],
                [
                    'user_id'=>Auth::user()->id,
                    'tenant_id' => $tenant->id,
                    'image_path' => $filename,
                    'slug'=>rand(1,9999),
                ]
        );
        }
       if($request->data_id){
        return redirect()->route('renter.tenant.index')->with('success','Tenant Information Update.');
       }
       else{
        return redirect()->route('renter.tenant.index')->with('success','New Tenant Added into the Room.');

       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $tenant)
    {
        $org_name = Setting::first();
        $data =RenterImage::where('user_id',Auth::user()->id)->first();  
        $title = 'Tenant-Detail';
        $tenants = Tenant::with('tenantimage','tenanthasroom')->Where('slug',$tenant)->Where('user_id',Auth::user()->id)->first();
        return view('renter.pages.tenant.view',compact('title','org_name','data','tenants'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tenant)
    {
        $org_name = Setting::first();
        $data =RenterImage::where('user_id',Auth::user()->id)->first();  
        $title = 'Tenant-Edit';
        $rooms = Room::Where('user_id',Auth::user()->id)->Where('status',0)->get();
        $tenants = Tenant::with('tenantimage','tenanthasroom')->Where('slug',$tenant)->Where('user_id',Auth::user()->id)->first();
        return view('renter.pages.tenant.edit',compact('title','org_name','data','tenants','rooms'));

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
    public function destroy(Request $request,$tenant)
    {
        $data = Tenant::with('tenantimage','tenanthasroom')->Where('slug',$tenant)->Where('user_id',Auth::user()->id)->first();
        if(($data->tenantimage != '')){ 
            unlink(public_path('tenant/uploads/'.$data->tenantimage->image_path));
        }
        $demo = Room::Where('slug',$data->tenanthasroom->slug)->update(
            [
                'status'=>0,
            ]
        );
       Tenant::where('slug',$tenant)->delete();
       return redirect()->back()->with('success','Tenant Deleted');
    }
}
