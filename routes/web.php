<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AuthController,DashboardController,CustomerController,OrderController};
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
    return redirect()->route('getLogin');
});

Route::get('/admin/login',[AuthController::class,'getLogin'])->name('getLogin');
Route::post('/admin/login',[AuthController::class,'postLogin'])->name('postLogin');

Route::group(['middleware'=>['is_admin']],function(){
  

    Route::get('/admin/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::resource('/admin/customers',CustomerController::class);
    Route::resource('/admin/orders',OrderController::class);
    Route::get('/admin/logout',[DashboardController::class,'logout'])->name('logout');
    
    Route::get('/admin/export/customers',[CustomerController::class,'export'])->name('export-customers');
    Route::get('/admin/export/orders',[OrderController::class,'export'])->name('export-orders');
});
