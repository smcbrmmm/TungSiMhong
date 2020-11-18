<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where("user_id", Auth::user()->id)->where('order_status', '!=', 'ตะกร้า')->get();
        if(count($orders) == 0) {
            return view('order.index');
        }

        $orderDetails = $orders[0]->orderDetails;
        $amount = 0;
        foreach ($orderDetails as $orderDetail) {
            $amount += $orderDetail->orderdetail_quantity * $orderDetail->orderdetail_price;
        }

        return view('order.index', [
            'orders' => $orders,
            'orderDetails' => $orderDetails,
            'amount' => $amount,
        ]);
    }

    public function basketQty() {
        $order = Order::where('order_status', '=', 'ตะกร้า')->where('user_id','=', Auth::user()->id)->first();

        return count($order->orderDetails);
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

    }
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function submitOrder(Request $request, $id) {
        $order = Order::where('id', $id)->first();
        $order->order_datetime = new \DateTime();
        $order->order_status = 'รอการชำระเงิน';
        $order->address_id = $request->userAddress;
        $order->order_code = rand(000000000,999999999);
        $order->save();

        foreach ($order->orderDetails as $orderDetail) {
            $product = $orderDetail->product;
            $product->product_quantity = $product->product_quantity - $orderDetail->orderdetail_quantity;
            $product->save();
        }

        if (Auth::user()) {
            $order = Order::where('order_status', '=', 'ตะกร้า')->where('user_id', '=', Auth::user()->id)->get();
            if (count($order) == 0) {
                $order = new Order();
                $order->user_id = Auth::user()->id;
                $order->order_status = 'ตะกร้า';
                $order->order_code = rand(000000000,999999999);
                $order->save();
            }
        }

        return redirect()->route('order.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    public function showBasket() {
        $order = Order::where('order_status', '=', 'ตะกร้า')->where('user_id','=', Auth::user()->id)->first();
        $orderDetails = $order->orderDetails;
        $amount = 0;
        foreach ($orderDetails as $orderDetail) {
            $amount += $orderDetail->orderdetail_quantity * $orderDetail->orderdetail_price;
        }

        $addresses = Address::where('user_id', Auth::user()->id)->get();

        return view('order.basket', [
            'orderId' => $order->id,
            'orderDetails' => $orderDetails,
            'amount' => $amount,
            'addresses' => $addresses
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
