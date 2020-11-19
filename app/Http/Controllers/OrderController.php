<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\PaymentInformation;
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
        $orders = Order::where("user_id", Auth::user()->id)->where('order_status', '!=', 'ตะกร้า')->get();
        if(count($orders) == 0) {
            return view('order.index');
        }

        $orderDetails = $orders[0]->orderDetails;
        $amountPrice = 0;
        $amountWeight = 0;
        foreach ($orderDetails as $orderDetail) {
            $amountPrice += $orderDetail->orderdetail_quantity * $orderDetail->orderdetail_price;
            $amountWeight += $orderDetail->orderdetail_quantity * $orderDetail->product->product_weight;
        }

        $deliFee = 30 + ceil($amountWeight/1000)*15;

        return view('order.index', [
            'orders' => $orders,
            'orderDetails' => $orderDetails,
            'amountPrice' => $amountPrice,
            'amountWeight'=> $amountWeight,
            'deliFee' => $deliFee
        ]);
    }

    public function adminOrder(){
        $orders = Order::where('order_status', '!=', 'ตะกร้า')->get();
        if(count($orders) == 0) {
            return view('order.index_admin');
        }

        $orderDetails = $orders[0]->orderDetails;
        $amountPrice = 0;
        $amountWeight = 0;
        foreach ($orderDetails as $orderDetail) {
            $amountPrice += $orderDetail->orderdetail_quantity * $orderDetail->orderdetail_price;
            $amountWeight += $orderDetail->orderdetail_quantity * $orderDetail->product->product_weight;
        }

        $deliFee = 30 + ceil($amountWeight/1000)*15;

        return view('order.index_admin', [
            'orders' => $orders,
            'orderDetails' => $orderDetails,
            'amountPrice' => $amountPrice,
            'amountWeight'=> $amountWeight,
            'deliFee' => $deliFee
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
        $order->order_datetime = Carbon::now();
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

    public function submitPayment(Request $request,$id){
        $order = Order::where('id',$id)->first();
        $order->order_status = 'กำลังตรวจสอบการชำระเงิน';
        $order->save();

        if($request->file('img_slip')!=null) {
            $img = $request->file('img_slip');
            $input = time() . '.' . $img->getClientOriginalExtension();
            $des = public_path('storage/imgProduct/');
            $img->move($des, $input);
        }

        $payment = new PaymentInformation();
        $payment->user_id = Auth::user()->id;
        $payment->order_id = $order->id;
        $payment->payment_datetime = $request->input('payment_datetime');
        $payment->payment_amount = $request->input('payment_amount');

        if ($request->file('img_slip')!=null){
            $payment->Img_slip = '/imgProduct/'.$input;;
        }
        $payment->save();

        return redirect()->route('order.index');;
    }

    public function unAcceptPayment(Request $request, $id){
        $order = Order::where('id',$id)->first();
        $order->order_status = 'กรุณาตรวจสอบการชำระเงิน';
        $order->save();

        return redirect()->route('order.adminOrder');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::where('id',$id)->first();
        $payments = $order->payment_informations;
        $orderDetails = $order->orderDetails;
        $amountPrice = 0;
        $amountWeight = 0;
        foreach ($orderDetails as $orderDetail) {
            $amountPrice += $orderDetail->orderdetail_quantity * $orderDetail->orderdetail_price;
            $amountWeight += $orderDetail->orderdetail_quantity * $orderDetail->product->product_weight;
        }

        $deliFee = 30 + ceil($amountWeight/1000)*15;

        $amountPayment = 0;
        foreach ($payments as $payment) {
            $amountPayment += $payment->payment_amount;
        }

        return view('order.show',[
            'order' => $order,
            'payments' => $payments,
            'orderDetails' => $orderDetails,
            'amountPrice' => $amountPrice,
            'amountPayment' => $amountPayment,
            'deliFee' => $deliFee,
        ]);
    }

    public function showBasket() {
        $order = Order::where('order_status', '=', 'ตะกร้า')->where('user_id','=', Auth::user()->id)->first();
        $orderDetails = $order->orderDetails;
        $amountPrice = 0;
        $amountWeight = 0;
        foreach ($orderDetails as $orderDetail) {
            $amountPrice += $orderDetail->orderdetail_quantity * $orderDetail->orderdetail_price;
            $amountWeight += $orderDetail->orderdetail_quantity * $orderDetail->product->product_weight;
        }

        $addresses = Address::where('user_id', Auth::user()->id)->get();

        $deliFee = 30 + ceil($amountWeight/1000)*15;

        return view('order.basket', [
            'orderId' => $order->id,
            'orderDetails' => $orderDetails,
            'amountPrice' => $amountPrice,
            'amountWeight' => $amountWeight,
            'deliFee' => $deliFee,
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
        $order = Order::where('id',$id)->first();
        $order->order_status = 'รอจัดส่งสินค้า';
        $order->save();

        return redirect()->route('order.show',['order'=>$order->id]);
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
