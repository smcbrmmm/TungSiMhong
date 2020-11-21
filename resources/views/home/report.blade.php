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
        <div style="font-size: 24px">
            รายงานยอดขาย [ {{ $start }} ถึง {{ $end }} ]
        </div>
        <br>

        <div class="row">
            <div class="col-3">
                <label for="start_datetime">ตั้งแต่วันที่ <i style="color: indianred" class="fas fa-star-of-life"></i></label>
            </div>
            <div class="col">
                <label for="end_datetime">จนถึงวันที่ <i style="color: indianred" class="fas fa-star-of-life"></i></label>
            </div>
        </div>

        <form action=" {{ route('order-detail.search') }}" class="form" method="Post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-3">
                    <div class="form-group mb-1" >
                        <input type="date" class="form-control" id="start_datetime"
                                     name="start_datetime" required style="max-width: 20rem"
                                     aria-describedby="payment_datetimeHelp">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group " >
                        <input type="date" class="form-control" id="end_datetime"
                               name="end_datetime" required style="max-width: 20rem"
                               aria-describedby="payment_datetimeHelp">
                    </div>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary"> ค้นหา </button>

                </div>
            </div>
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
                    <th scope="col" class="text-right">ยอดรวม</th>

                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    @if($order->order_status=='รอรับสินค้า' || $order->order_status=='รอส่งสินค้า' || $order->order_status=='สำเร็จ')
                        @foreach($order->orderDetails as $orderDetail)
                            <tr>
                                <th>{{ $orderDetail->product->product_code }}</th>
                                <td class="text-left">{{ $orderDetail->product->product_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($orderDetail->order->order_datetime)->format('d/m/Y')}}
                                {{ \Carbon\Carbon::parse($orderDetail->order->order_datetime)->format('h:i A')}}</td>
                                <td>{{ $orderDetail->orderdetail_price }}</td>
                                <td style="padding-left: 8rem">{{ $orderDetail->orderdetail_quantity}}</td>

                                <td class="text-right priceNumber">{{ $orderDetail->orderdetail_quantity * $orderDetail->orderdetail_price}}</td>
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
        window.onload = function() {
            setAllPriceCommas();
        };

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function setAllPriceCommas() {
            let prices = document.getElementsByClassName('priceNumber');
            for(price of prices) {
                price.innerHTML = numberWithCommas(price.innerHTML);
            }
        }
    </script>
    <script>
        $(document).ready(function(){
            $('.dateFilter').datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
@endsection
