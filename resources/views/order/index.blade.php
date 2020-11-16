@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-hover">
            <caption>List of product</caption>
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">image</th>
                <th scope="col">product code</th>
                <th scope="col">name</th>
                <th scope="col">detail</th>
                <th scope="col">ราคา</th>
                <th scope="col">จำนวน</th>
                <th scope="col">รวม</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderDetails as $orderDetail)
                <tr>
                    <th scope="row">{{ $orderDetail->id }}</th>
                    <td><img src="{{ $orderDetail->product->product_img }}" alt="{{ $orderDetail->product->product_code }}"></td>
                    <td>{{ $orderDetail->product->product_code }}</td>
                    <td>{{ $orderDetail->product->product_name }}</td>
                    <td>{{ $orderDetail->product->product_detail }}</td>
                    <td>{{ $orderDetail->orderdetail_price }}</td>
                    <td>{{ $orderDetail->orderdetail_quantity }}</td>
                    <td>{{ $orderDetail->orderdetail_quantity * $orderDetail->orderdetail_price }}</td>
                </tr>
            @endforeach
                <tr>
                    <th colspan="7">รวม</th>
                    <th>{{ $amount }}</th>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
