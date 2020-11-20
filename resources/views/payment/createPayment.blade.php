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
        <div class="row">
            <div class="col">
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
            <div class="col ">
                <div class="" style="font-size: 24px ; margin-left: 4rem ; margin-bottom: 1rem">
                    ช่องทางการชำระเงิน
                </div>

                <div class="row">
                    <div class="col-3">
                        <div style="font-size: 20px ; margin-bottom: 0.4rem">
                            <img src="/storage/imgProduct/scb-icon.png" alt=""
                                 style="max-width: 80px ; max-height: 40px ; margin-left: 4rem ; margin-top: 1rem" >
                        </div>

                        <div style="font-size: 20px ; margin-bottom: 0.4rem ; margin-top: 3rem">
                            <img src="/storage/imgProduct/kasikorn.png" alt=""
                                 style="max-width: 80px ; max-height: 40px ; margin-left: 4rem ; margin-top: 1rem" >
                        </div>
                        <div style="font-size: 20px ; margin-bottom: 0.4rem ; margin-top: 3rem">
                            <img src="/storage/imgProduct/prompay.png" alt=""
                                 style="max-width: 80px ; max-height: 40px ; margin-left: 4rem ; margin-top: 1rem" >
                        </div>
                    </div>

                    <div class="col-5">
                        <div style="margin-left: -2rem">
                            <div style="font-size: 16px"> ธนาคารไทยพาณิชย์</div>
                            <div style="font-size: 16px"> ชื่อบัญชี : นายสมัชญ์ ช่วยบำรุง</div>
                            <div style="font-size: 16px"> หมายเลขบัญชี : 234-423-2341</div>
                        </div>
                        <br>
                        <div style="margin-left: -2rem">
                            <div style="font-size: 16px"> ธนาคารไทยพาณิชย์</div>
                            <div style="font-size: 16px"> ชื่อบัญชี : นายสมัชญ์ ช่วยบำรุง</div>
                            <div style="font-size: 16px"> หมายเลขบัญชี : 574-248-2874</div>
                        </div>
                        <br>
                        <div style="margin-left: -2rem">
                            <div style="font-size: 16px ; margin-top: 6px" > พร้อมเพย์ : 0922589093</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        {{--document.getElementById("payment_datetime").max = "{{ $today }}";--}}

        // var today = new Date();
        // var dd = today.getDate();
        // var mm = today.getMonth()+1; //January is 0!
        // var yyyy = today.getFullYear();
        // if(dd<10){
        //     dd='0'+dd
        // }
        // if(mm<10){
        //     mm='0'+mm
        // }
        // today = yyyy+'-'+mm+'-'+dd;
        // document.getElementById("payment_datetime").setAttribute("max", today);


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
