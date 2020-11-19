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
        <div>
            รายงานยอดขาย
        </div>

        <form action="" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <span class="form-group" >
                <label for="payment_datetime">Start Date <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <span><input type="date" class="form-control" id="payment_datetime"
                       name="payment_datetime" required style="max-width: 20rem"
                       aria-describedby="payment_datetimeHelp">
                </span>
            </span>

            <span class="form-group " >
                <label for="payment_datetime">End Date <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="date" class="form-control" id="payment_datetime"
                       name="payment_datetime" required style="max-width: 20rem"
                       aria-describedby="payment_datetimeHelp">
{{--                <small id="payment_datetimeHelp" class="form-text text-muted">--}}
{{--                    วันเวลาและเวลาที่ชำระเงินตามสลิป จำเป็น--}}
{{--                </small>--}}
            </span>

            <br>
            <button type="submit" class="btn btn-primary"> ค้นหา </button>

        </form>

        <br>
        <div class="row">
            <table class="table table-hover">
                <caption></caption>
                <thead class="thead-dark">
                <tr>

                    <th scope="col">รหัสสินค้า</th>
                    <th scope="col">ชื่อสินค้า</th>
                    <th scope="col">วัน/เวลาที่ขาย</th>
                    <th scope="col">ราคาสินค้า/ชิ้น</th>
                    <th scope="col">จำนวนสินค้าที่ขายได้</th>

                </tr>
                </thead>
                <tbody>
                @foreach($orderDetails as $orderDetail)
                        <tr>
                            <th>{{ $orderDetail->product->product_code }}</th>
                            <th>{{ $orderDetail->product->product_name }}</th>
                            <th>{{ $orderDetail->order->order_datetime }}</th>
                            <th>{{ $orderDetail->orderdetail_price }}</th>
                            <th>{{ $orderDetail->orderdetail_quantity}}</th>
                        </tr>

                @endforeach
                </tbody>
            </table>
        </div>

    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.dateFilter').datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
@endsection
