<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use App\OrderDetail;
use App\Item;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        $customer = Customer::all();
        $fullname = Customer::get()->pluck('full_name', 'id');
        $itemName = Item::get()->pluck('item_name', 'id');

        return view('orders.orders')->withOrders($orders)->withCustomers($customer)->withfullname($fullname)->withItemName($itemName);
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

        $order = new Order;

        $order->customer_id = $request->customer_id;
        $order->order_date = $request->order_date;

        $order->save();

        for($i = 0 ; $i < sizeof($request->item_name) ; $i++){
            //subtract items
            $item = Item::find($request->item_name[$i]);
            $item->quantity = $item->quantity - $request->quantity[$i];
            $item->save();

            //new Order
            $orderDetails = new OrderDetail;

            $orderDetails->order_id = $order->id;
            $orderDetails->items_id = $request->item_name[$i];
            $orderDetails->quantity = $request->quantity[$i];

            $orderDetails->save();
        }
        return redirect()->route('orders.index');
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
    public function edit($id)
    {
        
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
