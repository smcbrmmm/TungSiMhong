<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "order detail";
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

        $order = Order::where('order_status', '=', 'ตะกร้า')->where('user_id','=', Auth::user()->id)->first();
        $product = Product::where('id', '=', $request->product_id)->first();

        $orderDetail = OrderDetail::where('order_id', $order->id)->where('product_id', $product->id)->first();

        if ($orderDetail) {
            $orderDetail->orderdetail_quantity = $orderDetail->orderdetail_quantity + $request->qty;
            $orderDetail->save();
        } else {
            $orderDetail = new OrderDetail();
            $orderDetail->product_id = $product->id;
            $orderDetail->order_id = $order->id;
            $orderDetail->orderdetail_quantity = $request->qty;
            $orderDetail->orderdetail_price = $product->product_price;
            $orderDetail->save();
        }

        if ($orderDetail->orderdetail_quantity > $product->product_quantity) {
            $orderDetail->orderdetail_quantity = $product->product_quantity;
            $orderDetail->save();
        }


        return $orderDetail;
    }

    public function setQtyDetail(Request $request, $id) {
        $orderDetail = OrderDetail::where("id", $id)->first();
        $oldQty = $orderDetail->orderdetail_quantity;
        $orderDetail->orderdetail_quantity = $request->qty;
        $orderDetail->save();
        return response()->json([
            'orderDetail' => $orderDetail,
            'oldQty' => $oldQty
        ]);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $orderDetail = OrderDetail::where('id', $id)->first();
        $product = $orderDetail->product;
        $orderDetail->delete();
        return response()->json([
            'product' => $product,
            'orderDetail' => $orderDetail,
        ]);
    }
}
