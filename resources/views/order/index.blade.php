@extends('layouts.app')

@section('content')

    <div class="container">

        <div>
            ประวัติการสั่งซื้อสินค้า
        </div>

        <div class="row">
            <div class="col-6">

                <table class="table table-hover">
                    <caption>List of product</caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Order_code</th>
                        <th scope="col">Datetime</th>
                        <th scope="col">Address</th>
                        <th scope="col">Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        @if($order->order_status!='ตะกร้า')
                            <tr>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->order_datetime }}</td>
                                <td>{{ $order->address->place_name }}
                                    <br> {{ $order->address->house_no }} {{ $order->address->address }}
                                    <br> {{ $order->address->province }} {{ $order->address->postal }}
                                </td>
                                <td>{{ $order->order_status }}</td>
                            </tr>

                        @endif
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col-6">

                8


            </div>



        </div>


    </div>



@endsection
