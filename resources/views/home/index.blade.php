@extends('layouts.app')

@section('style')

@endsection

@section('content')

    <div class="container">

        <div class="" style="margin-left: auto ; margin-right: auto">
            <img src="storage/imgProduct/logo.png" alt="" style="max-width: 400px ; max-height: 300px ; margin-right: auto ; margin-left: auto ;margin-top: -4rem">
        </div>

        <div class="text-center" style="font-size: 26px ; margin-top: -2rem">
            "เรามีของมากมายให้ท่านได้เลือกชมเลือกซื้อ"
        </div>
        <div class="text-center" style="font-size: 23px ;">
            สนใจเลือกชมสินค้า <a href="{{ route('product.products') }}" style="color: indianred"> คลิกเลย</a>
        </div>

        <div class="row mt-3">
            <div class="col-6">
                <div class="text-center" style="font-size: 24px ; margin-bottom: 1rem">
                    ช่องทางการติดต่อเรา
                </div>
                <div style="margin-left: 5.2rem">
                    <div style="font-size: 20px ; margin-bottom: 0.4rem ; margin-left: 7rem">
                        <i class="fab fa-facebook-f fa-1x" style="color: blue"></i> <span style="font-size: 18px"> ตั้งสี่หมง กงเต๊กตลาดพลู </span>
                    </div>
                    <div style="font-size: 20px ; margin-bottom: 0.4rem ; margin-left: 7rem">
                        <i class="fas fa-envelope fa-1x" style="color: red"></i> <span style="font-size: 18px"> tungsimhong@gmail.com </span>
                    </div>
                    <div style="font-size: 20px ; margin-bottom: 0.4rem ; margin-left: 7rem">
                        <i class="fab fa-instagram fa-1x" style="color: darkred"></i> <span style="font-size: 18px"> tungsimhongtlp </span>
                    </div>
                    <div style="font-size: 20px ; margin-bottom: 0.4rem ; margin-left: 7rem">
                        <i class="fab fa-line fa-1x" style="color: green"></i> <span style="font-size: 18px"> @tungsimhonggongtek </span>
                    </div>
                    <div style="font-size: 20px ; margin-bottom: 0.4rem ; margin-left: 7rem" >
                        <i class="fas fa-phone-alt" ></i> <span style="font-size: 18px"> 020498231 </span>
                    </div>
                    <div style="font-size: 20px ; margin-bottom: 0.4rem ; margin-left: 7rem" >
                        <i class="fas fa-map-pin" style="color:red;"></i> <span style="font-size: 18px"> 361 ถนน เทอดไท แขวง บางยี่เรือ เขตธนบุรี กรุงเทพมหานคร 10600 </span>
                    </div>





                </div>
            </div>

            <div class="col-6 ">
                <div class="" style="font-size: 24px ; margin-left: 4rem ; margin-bottom: 1rem">
                    ช่องทางการชำระเงิน
                </div>

                <div class="row">
                    <div class="col-3">
                        <div style="font-size: 20px ; margin-bottom: 0.4rem">
                            <img src="storage/imgProduct/scb-icon.png" alt=""
                                 style="max-width: 80px ; max-height: 40px ; margin-left: 4rem ; margin-top: 1rem" >
                        </div>

                        <div style="font-size: 20px ; margin-bottom: 0.4rem ; margin-top: 3rem">
                            <img src="storage/imgProduct/kasikorn.png" alt=""
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
                        <div style="font-size: 16px"> หมายเลขบัญชี : 234-423-2341</div>
                        </div>
                    </div>

                </div>








            </div>

        </div>

    </div>



@endsection

@section('script')

@endsection
