@extends('layouts.app')

@section('style')
    <style>
        .productImg {
            object-fit: cover;
            width: 100px;
            height: 100px;
            max-width: 100px;
        }
        td, th {
            text-align: center;
        }
        .orderSelected {
            background-color: #718096;
            color: white;
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
            <div class="col">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">รหัสการสั่งซื้อ</th>
                        <th scope="col">วันและเวลาในการสั่ง</th>
                        <th scope="col">สถานะ</th>

                    </tr>
                    </thead>
                    <tbody>
                    @isset($orders)
                        @foreach($orders as $order)
                            <tr class="trOder" onclick="orderOnClick(this, {{ $order->orderDetails }})">
                                <td><a href="{{ route('order.show',['order'=>$order->id]) }}">{{ $order->order_code }}</a></td>
                                <td>{{ $order->order_datetime }}</td>
                                @if($order->order_status == "รอจัดส่งสินค้า" || $order->order_status == "กำลังตรวจสอบการชำระเงิน")
                                    <td style="color: blue">{{ $order->order_status }}</td>
                                @elseif($order->order_status == "รอรับสินค้า" || $order->order_status == "สำเร็จ")
                                    <td style="color: darkgreen">{{ $order->order_status }}</td>
                                @else
                                    <td style="color: indianred">{{ $order->order_status }}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
