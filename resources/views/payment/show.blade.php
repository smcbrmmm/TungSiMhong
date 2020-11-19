@extends('layouts.app')

@section('style')
    <style>


    </style>
@endsection

@section('content')

    <div class="container">

        <div style="font-size: 26px" class="mb-2">
            การชำระเงินของรหัสการสั่งซื้อ : {{ $payment->order->order_code }}
        </div>

        <div class="row">
            <div class="col-4">
                <div>
                    รูปภาพสลิปการชำระเงิน
                </div>
                <img src="http://127.0.0.1:8000/storage{{$payment->img_slip}}" alt="">
            </div>
            <div class="col-8">
                <div style="font-size: 20px" class="mt-3">
                    วัน/เวลาที่ทำการชำระเงิน : {{ $payment->payment_datetime }}
                </div>

                <div style="font-size: 20px">
                    จำนวนเงินที่ชำระ : {{ $payment->payment_amount }} บาท
                </div>
                <div style="font-size: 20px">
                    จำนวนเงินที่ต้องชำระ : {{ $payment->payment_amount }} บาท
                </div>

                <form action="{{ route('payment.update' , ['payment' => $payment->order->id]) }}" class="form" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-primary mb-2"> ยืนยันการชำระเงิน </button>
                </form>

                <form action="{{ route('payment.unAcceptPayment' , ['id' => $payment->order->id]) }}" class="form" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-danger"> การชำระเงินไม่ถูกต้อง </button>
                </form>

            </div>
        </div>



        </div>



@endsection

@section('script')

@endsection
