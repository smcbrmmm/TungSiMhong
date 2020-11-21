@extends('layouts.app')

@section('style')
    <style>
        tr {
            text-align: center;
        }
    </style>
@endsection

@section('content')

    <div class="container">

        <div style="font-size: 24px">
            ประวัติการสั่งซื้อสินค้า ADMIN
        </div>
        <br>

        <div class="row">
            <div class="col-8">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">รหัสการสั่งซื้อ</th>
                        <th scope="col">วัน/เดือน/ปี</th>
                        <th scope="col">เวลา</th>
                        <th scope="col">สถานะ</th>

                    </tr>
                    </thead>
                    <tbody>
                    @isset($orders)
                        @foreach($orders as $order)
                            <tr class="trOder" onclick="orderOnClick(this, {{ $order->orderDetails }})">
                                <td><a href="{{ route('order.show',['order'=>$order->id]) }}">{{ $order->order_code }}</a></td>
                                <td>{{ \Carbon\Carbon::parse($order->order_datetime)->format('d/m/Y')}}</td>
                                <td>{{ \Carbon\Carbon::parse($order->order_datetime)->format('h:i A')}}</td>
                                @if($order->order_status == "รอจัดส่งสินค้า" || $order->order_status == "กำลังตรวจสอบการชำระเงิน")
                                    <td style="color: blue" class="text-left">{{ $order->order_status }}</td>
                                @elseif($order->order_status == "รอรับสินค้า" || $order->order_status == "สำเร็จ")
                                    <td style="color: darkgreen" class="text-left">{{ $order->order_status }}</td>
                                @else
                                    <td style="color: red" class="text-left">{{ $order->order_status }}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>

            </div>
            <div class="col-4"></div>
        </div>
    </div>
@endsection

@section('script')

@endsection
