@extends('layouts.app')

@section('style')
    <style>
        .productImg {
            object-fit: cover;
            width: 100px;
            height: 100px;
            max-width: 100px;
        }
    </style>
@endsection

@section('content')

    <div class="container">


        <div>
            <a href="{{ route('product.create') }}">
            <i class="fas fa-plus-circle fa-1x"></i> <span> เพิ่มสินค้า</span>
            </a>
        </div>


        <table class="table table-hover">
            <caption>List of product</caption>
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">image</th>
                <th scope="col">product code</th>
                <th scope="col">name</th>
                <th scope="col">quantity</th>
                <th scope="col">detail</th>
                <th scope="col">ราคา</th>
                <th scope="col">เพิ่มลงตระกล้า</th>
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
                        <button type="button" class="btn btn-secondary basketBtn" id="{{ $product->id }}">
                            Add to basket
                        </button>
                    </td>
                    <td>
                        <div class="btn btn-success"><a href="{{route('product.edit',['product' => $product->id])}}">แก้ไขข้อมูลสินค้า</a></div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
