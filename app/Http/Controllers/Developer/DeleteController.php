<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function setting($slug){
           Setting::where('slug',$slug)->delete();
           return redirect()->back()->with('success','Organization Detail Deleted .');
    }
}
