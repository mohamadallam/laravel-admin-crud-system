<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\ExportCustomer;
use Maatwebsite\Excel\Facades\Excel;
class CustomerController extends Controller
{

    public function index(Request $request){
        $search =  $request->input('q');
        if($search!=""){
            $customers = Customer::where(function ($query) use ($search){
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('address', 'like', '%'.$search.'%')
                    ->orWhere('mobile', 'like', '%'.$search.'%');
            })
            ->paginate(2);
            $customers->appends(['q' => $search]);
        }
        else{
            $customers = Customer::paginate(10);
        }
        $data=[
            'title'=>'Customers',
            'customers'=>$customers,
            'q' => $search
        ];
        return view('admin.customers.index',$data);
    }
    public function create()
    {
        return view('admin.customers.create');
    }
 
   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:customers,name',
            'address' => 'required',
            'mobile' => 'required|unique:customers,mobile',
        ]);
        Customer::create($request->all());
        return redirect('/admin/customers')->with('flash_message', 'customer Addedd!');  
    }
 
    
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('admin.customers.show')->with('customers', $customer);
    }
 
    
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('admin.customers.edit')->with('customer', $customer);
    }
 
  
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'mobile' => 'required',
        ]);
        $customer->update($request->all());
        return redirect('/admin/customers')->with('flash_message', 'customer Updated!');  
    }
 
   
    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect('/admin/customers')->with('flash_message', 'customer deleted!');  
    }
    public function export(Request $request){
        return Excel::download(new ExportCustomer, 'customers.xlsx');
    }
}