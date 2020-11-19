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

        <form method='post' action=''>
            Start Date     <input type="date" name="begin"
                                  placeholder="dd-mm-yyyy" value=""
                                  min="1997-01-01" max="2030-12-31">

            End Date     <input type="date" name="begin"
                                placeholder="dd-mm-yyyy" value=""
                                min="1997-01-01" max="2030-12-31">

            <input type='submit' name='but_search' value='Search'>
        </form>

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
