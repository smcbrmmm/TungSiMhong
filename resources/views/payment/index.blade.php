@extends('layouts.app')

@section('style')
    <style>
        td, th {
            text-align: center;
        }


    </style>
@endsection

@section('content')

    <div class="container">

        <div style="font-size: 24px" class="mb-3">
            ประวัติการชำระเงิน
        </div>

            <div class="row">
                <table class="table table-hover">
                    <caption>List of Payment</caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">รหัสการสั่งซื้อ</th>
                        <th scope="col">สถานะสินค้า</th>
                        <th scope="col">วัน/เวลาที่ชำระเงิน</th>
                        <th scope="col">จำนวนเงินที่ชำระ (บาท)</th>



                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        @if($payment->order->order_status == 'กรุณาตรวจสอบการชำระเงิน' || $payment->order->order_status == 'กำลังตรวจสอบการชำระเงิน')
                        <tr>
                            <th>{{ $payment->id }}</th>
                            <th>{{ $payment->order->order_code }}</th>
                            <th>{{ $payment->order->order_status }}</th>
                            <th>{{ $payment->payment_datetime }}</th>
                            <th>{{ $payment->payment_amount }}</th>
                            <th>
                                <a href="{{ route('payment.show',['payment'=>$payment->id]) }}"> ดูข้อมูลเพิ่มเติม </a>
                            </th>
{{--                            <td id="td{{ $product->id }}Qty">{{ $product->product_quantity }}</td>--}}
{{--                            <td>{{ $product->product_detail }}</td>--}}
{{--                            <td id="product{{ $product->id }}" >{{ $product->product_price }}</td>--}}
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>


    </div>



@endsection

@section('script')

@endsection
