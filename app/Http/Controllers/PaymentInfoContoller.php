<?php

namespace App\Http\Controllers;

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
