<?php

namespace App\Http\Controllers\Renter;

use App\Models\Setting;
use App\Models\Renter\Room;
use App\Models\RenterImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
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
        $title = 'Room';
        $rooms = Room::where('user_id',Auth::user()->id)->latest()->get();
        return view('renter.pages.room.index',compact('title','org_name','data','rooms'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Room::where('slug',$request->data_id)->Where('user_id',Auth::user()->id)->delete();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if($request->data_id == '')
       { 
            $request->validate([
                    'room_name'=>'required',
            ]);
        }
       if($request->data_id != '')
       { 
            $request->validate([
                  
            ]);
        }
       
    $check = Room::where('user_id',Auth::user()->id)->Where('name',$request->room_name)->first();
    $check_discription = Room::where('user_id',Auth::user()->id)->Where('name',$request->description)->first();
    if($check == null)
        {
            Room::updateOrCreate(
                ['id'=>$request->data_id],
                [
                    'name' => Str::lower($request->room_name),
                    'user_id'=>Auth::user()->id,
                    'description'=>$request->description,
                    'slug' => rand(1,9999),
                ]
           );

          
           if($request->data_id != ''){
            return redirect()->route('renter.room.index')->with('success',' Room Name Updated .');
           }
           return redirect()->back()->with('success','New Room Created .');
        } 
        else if($check != null && $check_discription !== null )
        {
            return redirect()->back()->with('delete','Room name has already Exist.');
        }
       
       
        if($check_discription == null)
        {
        
            Room::updateOrCreate(
                ['id'=>$request->data_id],
                [
                    'user_id'=>Auth::user()->id,
                    'description'=>$request->description,
                    'slug' => rand(1,9999),
                ]
           );
           if($request->data_id != ''){
            return redirect()->route('renter.room.index')->with('success',' Room Name Updated .');
           }
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
    public function edit(Request $request,$room)
    {
        $org_name = Setting::first();
        $data =RenterImage::where('user_id',Auth::user()->id)->first();  
        $title = 'Room';
        $room = Room::where('slug',$room)->where('user_id',Auth::user()->id)->first();
        return view('renter.pages.room.edit',compact('title','org_name','data','room'));
   
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
