@extends('layouts.app')

@section('content')

    <div class="container">
{{--        <div class="row">--}}
{{--            <div class="col-8">--}}
{{--                <table class="table table-hover">--}}
{{--                    <caption>List of product in basket</caption>--}}
{{--                    <thead class="thead-dark">--}}
{{--                    <tr>--}}
{{--                        <th scope="col">#</th>--}}
{{--                        <th scope="col">image</th>--}}
{{--                        <th scope="col">product code</th>--}}
{{--                        <th scope="col">name</th>--}}
{{--                        <th scope="col">ราคาต่อชิ้น</th>--}}
{{--                        <th scope="col">จำนวน</th>--}}
{{--                        <th scope="col">รวม</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($orders as $orderDetail)--}}
{{--                        <tr>--}}
{{--                            <th scope="row">{{ $orderDetail->id }}</th>--}}
{{--                            <td><img src="/storage/{{ $orderDetail->product->img }}" alt="{{ $orderDetail->product->product_code }}" class="productImg"></td>--}}
{{--                            <td>{{ $orderDetail->product->product_code }}</td>--}}
{{--                            <td>{{ $orderDetail->product->product_name }}</td>--}}
{{--                            <td>{{ $orderDetail->orderdetail_price }}</td>--}}
{{--                            <td>--}}
{{--                                <input disabled onchange="inputOnChange(this, {{ $orderDetail->id }}, {{ $orderDetail->product->product_price }})" class="inputQty" type="number" id="{{ $orderDetail->product->id . "qty" }}"--}}
{{--                                       min="1" max="{{ $orderDetail->product->product_quantity }}" value="{{ $orderDetail->orderdetail_quantity }}">--}}
{{--                            </td>--}}
{{--                            <td id="product{{ $orderDetail->id }}" class="amountPrice">{{ $orderDetail->product->product_price }}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    <tr>--}}
{{--                        <th colspan="6">รวม</th>--}}
{{--                        <th id="amountPrice">{{ $amount }}</th>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}



@endsection
