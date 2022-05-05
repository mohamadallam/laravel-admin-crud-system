<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Exports\ExportOrder;
use Maatwebsite\Excel\Facades\Excel;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search =  $request->input('q');
        if($search!=""){
            $orders = Order::with('customer')->where(function ($query) use ($search){
                $query->where('customer_id', 'like', '%'.$search.'%')
                    ->orWhere('total_price', 'like', '%'.$search.'%');
            })
            ->paginate(2);
            $orders->appends(['q' => $search]);
        }
        else{
            $orders = Order::paginate(10);
        }
        $data=[
            'title'=>'Orders',
            'orders'=>$orders,
            'q' => $search
        ];
        return view('admin.orders.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.orders.create');
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
            'customer_id' => 'required|exists:customers,id',
            'total_price' => 'required',
            'description' => '',
        ]);
      
        Order::create($request->all());

        return redirect('/admin/orders')->with('flash_message', 'Order Addedd!');  
    }

 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id)->with('customer')->first();
        return view('admin.orders.show')->with('order', $order);
    }
    // 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id)->with('customer')->first();
        return view('admin.orders.edit')->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_price' => 'required',
            'description' => '',
        ]);
        $order->update($request->all());
        return redirect('/admin/orders')->with('flash_message', 'order Updated!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect('/admin/orders')->with('flash_message', 'order deleted!');  
    }
    public function export(Request $request){
        return Excel::download(new ExportOrder, 'orders.xlsx');
    }
}
