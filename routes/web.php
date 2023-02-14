<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Developer\DashboardController;
use App\Http\Controllers\Developer\DeleteController;
use App\Http\Controllers\Developer\PasswordController;
use App\Http\Controllers\Developer\RenterController;
use App\Http\Controllers\Developer\SettingController;
use App\Http\Controllers\Developer\TenantOwnerController;
use App\Http\Controllers\Renter\DashboardController as RenterDashboardController;
use Illuminate\Support\Facades\Route;


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
});

