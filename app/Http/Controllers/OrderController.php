<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Carbon\Carbon;
use DateTime;
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
        $orders = Order::where("user_id", Auth::user()->id)->get();

        return view('order.index', ['orders' => $orders]);
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
        $address = Address::where('id', $request->userAddress)->first();
        $order = Order::where('id', $id)->first();
        $order->order_datetime = Carbon::now();
        $order->order_datetime = $order->order_datetime->toDayDateTimeString();
        $order->order_status = 'รอยืนยันการชำระเงิน';
        $order->address_id = $request->userAddress;
        $order->save();

        if (Auth::user()) {
            $order = Order::where('order_status', '=', 'ตะกร้า')->where('user_id', '=', Auth::user()->id)->get();
            if (count($order) == 0) {
                $order = new Order();
                $order->user_id = Auth::user()->id;
                $order->order_code = rand(000000000,999999999);;
                $order->order_status='ตะกร้า';
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
