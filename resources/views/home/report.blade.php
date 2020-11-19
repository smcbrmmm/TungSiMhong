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

        <form action=" {{ route('order-detail.search') }}" class="form" method="Post" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-1" >
                <label for="start_datetime">ตั้งแต่วันที่ <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <span><input type="date" class="form-control" id="start_datetime"
                       name="start_datetime" required style="max-width: 20rem"
                       aria-describedby="payment_datetimeHelp">
                </span>
            </div>

            <div class="form-group " >
                <label for="end_datetime">จนถึงวันที่ <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="date" class="form-control" id="end_datetime"
                       name="end_datetime" required style="max-width: 20rem"
                       aria-describedby="payment_datetimeHelp">
                <small id="payment_datetimeHelp" class="form-text text-muted">
                    วันเวลาและเวลาที่ชำระเงินตามสลิป จำเป็น
                </small>
            </div>

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
                    <th scope="col">ยอดรวม</th>

                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    @if($order->order_status=='รอรับสินค้า' || $order->order_status=='รอส่งสินค้า' || $order->order_status=='สำเร็จ')
                        @foreach($order->orderDetails as $orderDetail)
                            <tr>
                                <th>{{ $orderDetail->product->product_code }}</th>
                                <th>{{ $orderDetail->product->product_name }}</th>
                                <th>{{ $orderDetail->order->order_datetime }}</th>
                                <th>{{ $orderDetail->orderdetail_price }}</th>
                                <th>{{ $orderDetail->orderdetail_quantity}}</th>
                                <th>{{ $orderDetail->orderdetail_quantity * $orderDetail->orderdetail_price}}</th>
                            </tr>
                        @endforeach
                    @endif

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
