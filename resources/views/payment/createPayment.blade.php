@extends('layouts.app')

@section('style')

@endsection

@section('content')

    <div class="container">
        <div>
            รหัสการสั่งซื้อ <span style="font-size: 20px"> {{$order->order_code}} </span>
        </div>

        <form action="{{route('payment.submitPayment',['id'=>$order_id])}}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="payment_datetime">วันเวลาและเวลาที่ชำระเงินตามสลิป <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="datetime-local" class="form-control" id="payment_datetime"
                       name="payment_datetime" required
                       aria-describedby="payment_datetimeHelp">
                <small id="payment_datetimeHelp" class="form-text text-muted">
                    วันเวลาและเวลาที่ชำระเงินตามสลิป is required .
                </small>
            </div>

            <div class="form-group">
                <label for="payment_amount">จำนวนเงินที่ชำระ (บาท) <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="text" class="form-control" id="payment_amount"
                       name="payment_amount" required
                       aria-describedby="payment_amountHelp">
                <small id="payment_amountHelp" class="form-text text-muted">
                    จำนวนเงินที่ชำระ is required .
                </small>
            </div>


            <div class="form-group">
                <label for="img_slip">รูปภาพสลิป <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="file" class="form-control-file" required
                       id="img_slip" name="img_slip" onchange="readURL(this)">
            </div>


            <div>
                <img src="" alt=""
                     class="slipImg">
            </div>


            <button type="submit" class="btn btn-primary">ยืนยันการชำระเงิน</button>

        </form>



    </div>


@endsection

@section('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.slipImg')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
