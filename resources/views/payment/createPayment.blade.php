@extends('layouts.app')

@section('style')
    <style>
        .slipImg{
            max-width: 311px;
            max-height: 536px;
        }

    </style>
@endsection

@section('content')

    <div class="container">
        <div>
            รหัสการสั่งซื้อ <span style="font-size: 20px"> {{$order->order_code}} </span>
        </div>

        <form action="{{ route('order.submitPayment',['id'=>$order_id])}}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="payment_datetime">วันเวลาและเวลาที่ชำระเงินตามสลิป <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="datetime-local" class="form-control @error('payment_datetime') is-invalid @enderror" id="payment_datetime" style="width: 17rem"
                       name="payment_datetime" required
                       aria-describedby="payment_datetimeHelp">
                <small id="payment_datetimeHelp" class="form-text text-muted">
                    วันเวลาและเวลาที่ชำระเงินตามสลิป จำเป็น
                </small>
                @error('payment_datetime')
                <div class="alert alert-danger" style="width: 17rem" > ไม่ได้ใส่วันและเวลาหรือวันและเวลาไม่ถูกต้อง</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="payment_amount">จำนวนเงินที่ชำระ (บาท) <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="text" class="form-control @error('payment_amount') is-invalid @enderror" id="payment_amount" style="width: 17rem"
                       name="payment_amount" required
                       aria-describedby="payment_amountHelp">
                <small id="payment_amountHelp" class="form-text text-muted">
                    จำนวนเงินที่ชำระ จำเป็น
                </small>
                @error('payment_amount')
                <div class="alert alert-danger " style="width: 17rem"> จำนวนเงินไม่ถูกต้อง </div>
                @enderror
            </div>


            <div class="form-group">
                <label for="img_slip">รูปภาพสลิป <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="file" class="form-control-file @error('img_slip') is-invalid @enderror" required style="width: 17rem"
                       id="img_slip" name="img_slip" onchange="readURL(this)">
                @error('img_slip')
                <div class="alert alert-danger" style="width: 17rem"> จำนวนเงินไม่ถูกต้อง </div>
                @enderror
            </div>


            <div>
                <img src="" alt=""
                     class="slipImg mb-2" >
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
