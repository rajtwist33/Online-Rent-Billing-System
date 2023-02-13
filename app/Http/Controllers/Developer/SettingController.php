<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Image;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Setting";
        $org_name = Setting::first();
        $data =Setting::first();
        return view('developer.setting.index',compact('org_name','title','data'));
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
       
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required|max:30',
            'email' =>  'required',
        ]);
        $data = Setting::where('slug',$request->data_id)->first();
        if (!empty($request->image)) {
            if( (!empty($data) && $data->image != '')){ 
                unlink(public_path('settings/uploads/'.$data->image));
            }
            $file = Image::make($request->file('image'));
            $extension = time().'-'.$request->file('image')->getClientOriginalName();
            $filename = time().'.' . $extension;
            $destinationPathThumbnail = public_path('settings/uploads/');
            $file->resize(50,50);
            $file->save($destinationPathThumbnail .$filename);
        
            Setting::updateOrCreate(
            ['slug' => $request->data_id],
           [
            'organization_name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'email'=>$request->email,
            'image'=>$filename,
            'slug'=>rand(1,9999),
           ]
        );
    }
    else if(empty($request->image)) {
    Setting::updateOrCreate(
        ['slug' => $request->data_id],
       [
        'organization_name'=>$request->name,
        'phone'=>$request->phone,
        'address'=>$request->address,
        'email'=>$request->email,
        'slug'=>rand(1,9999),
       ]
    );
    }   
     if($request->data_id != '')
     {
        return redirect()->route('developer.setting.index')->with('success','Organization Detail Updated');
     }
     else
     {
        return redirect()->route('developer.setting.index')->with('success','Organization Detail Added');
     }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($setting)
    {
        $data = Setting::where('id',$setting)->first();
        if( (!empty($data) && $data->image != '')){
            unlink(public_path('settings/uploads/'.$data->image));
            Setting::where('id',$setting)->delete();
        }
        Setting::where('id',$setting)->delete();
        return redirect()->back()->with('success','Organization Detail Deleted .');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($setting)
    {
        $title = 'Setting-Edit';
        $org_name = Setting::first();
        $data = Setting::where('slug',$setting)->first();
        return view('developer.setting.edit',compact('org_name','data','title'));
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
