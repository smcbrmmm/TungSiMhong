<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentInformation;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentInfoContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = PaymentInformation::all();
        return view('payment.index', [
           'payments' => $payments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment.create');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = PaymentInformation::find($id);
        $order = $payment->order;
        $amountWeight = 0;
        $amountPrice = 0;
        foreach ($order->orderDetails as $orderDetail) {
            $amountWeight += $orderDetail->orderdetail_quantity * $orderDetail->product->product_weight;
            $amountPrice += $orderDetail->orderdetail_quantity * $orderDetail->orderdetail_price;
        }
        $amountAll = 30 + ceil($amountWeight/1000)*15;
        $amountAll += $amountPrice;

        return view('payment.show',[
           'payment' => $payment,
            'order' => $order,
            'amountAll' => $amountAll
        ]);
    }

    public function createPayment($id){
        $order = Order::where('id',$id)->first();
        return view('payment.createPayment',[
           'order_id' => $id,
            'order' => $order
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
        $payment = PaymentInformation::where('id', $id)->first();
        $payment->payment_amount = $request->amount;
        $payment->save();

        return redirect()->route('order.show',['order'=>$payment->order->id]);
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
