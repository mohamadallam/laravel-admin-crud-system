<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
class DashboardController extends Controller
{
    public function dashboard(){
        $data=[
            'title'=>'Dashboard',
            'customers_count'=>Customer::all()->count(),
            'orders_count'=>Order::all()->count(),
        ];
        return view('admin.dashboard',$data);
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('getLogin')->with('success','You have been successfully logged out');
    }
}
