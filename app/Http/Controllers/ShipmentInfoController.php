<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShipmentInfo;
use Illuminate\Http\Request;

class ShipmentInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $tracking = new ShipmentInfo();
        $tracking->order_id = $id;
        $tracking->tracking_no = $request->input('tracking_no');
        $tracking->shipment_company = $request->input('shipment_company');
        $tracking->send_time = $request->input('send_time');
        $tracking->save();

        $order = Order::where('id',$id)->first();
        $order->order_status = 'รอรับสินค้า';
        $order->save();

        return redirect()->route('order.show',['order'=>$id]);
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
