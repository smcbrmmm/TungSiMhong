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
        if($request->file('img_slip')!=null) {
            $img = $request->file('img_slip');
            $input = time() . '.' . $img->getClientOriginalExtension();
            $des = public_path('storage/imgProduct/');
            $img->move($des, $input);
        }

        $payment = new PaymentInformation();
        $payment->user_id = Auth::user()->id;
        $payment->order_id = 1;
        $payment->payment_datetime = $request->input('payment_datetime');
        $payment->payment_amount = $request->input('payment_amount');

        if ($request->file('img_slip')!=null){
            $payment->Img_slip = '/imgProduct/'.$input;;
        }
        $payment->save();

        return redirect()->route('product.index');
    }

    public function submitPayment(Request $request,$id){
        $order = Order::where('id',$id)->first();
        $order->order_status = 'กำลังตรวจสอบหลักฐานการชำระเงิน';
        $order->save();

        if($request->file('img_slip')!=null) {
            $img = $request->file('img_slip');
            $input = time() . '.' . $img->getClientOriginalExtension();
            $des = public_path('storage/imgProduct/');
            $img->move($des, $input);
        }

        $payment = new PaymentInformation();
        $payment->user_id = Auth::user()->id;
        $payment->order_id = 1;
        $payment->payment_datetime = $request->input('payment_datetime');
        $payment->payment_amount = $request->input('payment_amount');

        if ($request->file('img_slip')!=null){
            $payment->Img_slip = '/imgProduct/'.$input;;
        }
        $payment->save();


        return redirect()->route('order.index');;
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

    public function createPayment($id){
        return view('payment.createPayment',[
           'order_id' => $id
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
