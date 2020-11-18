@extends('layouts.app')

@section('style')
    <style>
        .productImg {
            object-fit: cover;
            width: 200px;
            height: 150px;
        }
        td, th {
            text-align: center;
        }
    </style>
@endsection

@section('content')

    <div class="container">

        <div></div>

        @auth()
        <div class="row" style="font-size: 20px">
            <a href="{{ route('product.productCreate') }}">
            <i class="fas fa-plus-circle fa-1x"></i> <span> เพิ่มสินค้า</span>
            </a>
        </div>
        @endauth

            <br>

        <div class="row">
            <table class="table table-hover">
                <caption>List of product</caption>
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">รูปภาพสินค้า</th>
                    <th scope="col">รหัสสินค้า</th>
                    <th scope="col">ชื่อสินค้า</th>
                    <th scope="col">จำนวนสินค้า</th>
                    <th scope="col">ข้อมูลสินค้า</th>
                    <th scope="col">ราคา</th>
                    <th scope="col">แก้ไขข้อมูล</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td><img src="storage{{ $product->img }}" alt="{{ $product->product_code }}" class="productImg"></td>
                        <td>{{ $product->product_code }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td id="td{{ $product->id }}Qty">{{ $product->product_quantity }}</td>
                        <td>{{ $product->product_detail }}</td>
                        <td id="product{{ $product->id }}" >{{ $product->product_price }}</td>
                        <td>
                            <div class="btn btn-success"><a href="{{route('product.edit',['product' => $product->id])}}">แก้ไขข้อมูลสินค้า</a></div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

{{--        <div class="row">--}}
{{--            <div class="card-columns">--}}
{{--                @foreach($products as $product)--}}
{{--                    <div class="card">--}}
{{--                        <img class="card-img-top  productImg" src="storage{{ $product->img }}" alt="Card image cap">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">ชื่อสินค้า : {{ $product->product_name }}</h5>--}}
{{--                            <p class="card-text">รหัสสินค้า : {{ $product->product_code }}</p>--}}
{{--                            <p class="card-text">ราคา : {{ $product->product_price }} บาท</p>--}}
{{--                            <input onchange="inputOnChange(this, {{ $product->id }}, {{ $product->product_price }}, {{ $product->product_quantity }})" class="inputQty" type="number" id="{{ $product->id . "qty" }}" min="1" max="{{ $product->product_quantity }}" value="1">--}}
{{--                            <div>--}}
{{--                                <button type="button" class="btn btn-secondary basketBtn" id="{{ $product->id }}">--}}
{{--                                    Add to basket--}}
{{--                                </button>--}}

{{--                                <i class="fas fa-shopping-basket basketBtn" id="{{ $product->id }}"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){

           $(".basketBtn").click(function (event) {
               let tdQty = $("#td" + this.id + "Qty");
               @guest()
                   window.location.href = "../login";
               @endguest

               @auth()
                   $.ajax({
                       url: "../order_detail",
                       type:"POST",
                       data:{
                           _token: "{{ csrf_token() }}",
                           product_id: this.id,
                           qty: 1
                       },
                       success:function(response){
                           tdQty.text(response.product_quantity)
                           console.log(response);
                       },
                   });

                   let basketQty = $("#basketQty");
                   $.ajax({
                       url: "/order/basket",
                       type:"GET",
                       success:function(response){
                           basketQty.text(response)
                       }
                   });
               @endauth
           })
        });
    </script>
@endsection
