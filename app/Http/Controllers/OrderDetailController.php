<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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

    public function search(Request  $request, $start=0, $end=0){

        if($request->start_datetime){
            $start = date(Carbon::parse($request->start_datetime)->toDateString());
        }
        if($request->end_datetime){
            $end = date(Carbon::parse($request->end_datetime)->addDays(1)->toDateString());
        }

        if ($start == 0){
            $start = date(Carbon::now()->endOfMonth()->subMonth()->toDateString());
            $request->start_datetime = $start;
        }
        if( $end == 0) {
            $end = date(Carbon::now()->addDays(1)->toDateString());
            $request->end_datetime = $end;
        }

        $orders = Order::whereBetween('order_datetime', [$start, $end])->get();

        $start = Carbon::parse($start)->format('d/m/Y');
        $end = Carbon::parse($end)->subDay(1)->format('d/m/Y');

        return view('home.report',[
            'orders' => $orders ,
            'start' => $start,
            'end' => $end
        ]);
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
        if (!$order) {
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->order_code = rand(000000000,999999999);
            $order->save();
        }

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
