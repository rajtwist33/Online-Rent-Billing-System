<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Renter\RoomController;
use App\Http\Controllers\Renter\TenantController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Renter\PaymentController;
use App\Http\Controllers\Renter\ProfileController;
use App\Http\Controllers\Developer\RenterController;
use App\Http\Controllers\Developer\SettingController;
use App\Http\Controllers\Developer\PasswordController;
use App\Http\Controllers\Developer\DashboardController;
use App\Http\Controllers\Developer\TenantOwnerController;
use App\Http\Controllers\Renter\PasswordChangeController;
use App\Http\Controllers\Renter\ElectricityBillController;
use App\Http\Controllers\Renter\ElectricitybillpaymentController;
use App\Http\Controllers\Renter\DashboardController as RenterDashboardController;


Route::get('/', function () {
    return view('home');
})->name('login');
Route::post('/authenticate',[AuthenticationController::class,'login'])->name('authenticate');
Route::get('/logout',[AuthenticationController::class,'logout'])->name('logout');

Route::group(['prefix'=>'developer','as'=>'developer.','middleware' => (['auth', 'user-access:1'])],function(){
        Route::resource('/dashboard',DashboardController::class);
        Route::resource('/tenantowner',TenantOwnerController::class);
        Route::resource('/setting',SettingController::class);
        Route::resource('/password_change',PasswordController::class);
        Route::post('/tenantowner/update/',[RenterController::class,'updaterenter'])->name('updaterenter');
});

Route::group(['prefix'=>'renter','as'=>'renter.','middleware' =>(['auth', 'user-access:2'])],function(){
        Route::resource('/dashboard',RenterDashboardController::class);
        Route::resource('/profile',ProfileController::class);
        Route::resource('/room',RoomController::class);
        Route::resource('/tenant',TenantController::class);
        Route::resource('/change_password',PasswordChangeController::class);
        Route::resource('/payment',PaymentController::class);
        Route::resource('/electricitybill',ElectricityBillController::class);
        Route::resource('/electricitybill_payment',ElectricitybillpaymentController::class);
});

