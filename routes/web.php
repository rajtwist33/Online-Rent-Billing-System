<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Developer\DashboardController;
use App\Http\Controllers\Developer\RenterController;
use App\Http\Controllers\Developer\TenantOwnerController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::post('/authenticate',[AuthenticationController::class,'login'])->name('authenticate');
Route::get('/logout',[AuthenticationController::class,'logout'])->name('logout');

Route::group(['prefix'=>'developer','as'=>'developer.','middleware' => 'developer'],function(){
        Route::resource('/dashboard',DashboardController::class);
        Route::resource('/tenantowner',TenantOwnerController::class);
        Route::post('/tenantowner/update/',[RenterController::class,'updaterenter'])->name('updaterenter');
});

Route::group(['prefix'=>'renter','as'=>'renter.','middleware' => 'renter'],function(){
        Route::get('/dashboard',function(){
            return view('renter.layouts.dashboard');
        })->name('dashboard');
});

