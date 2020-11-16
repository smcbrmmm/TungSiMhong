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
                <th scope="col">price</th>
                <th scope="col">quantity</th>
                <th scope="col">weight</th>
                <th scope="col">detail</th>
                <th scope="col">จำนวน</th>
                <th scope="col">เพิ่มลงตระกล้า</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td><img src="storage{{ $product->img }}" alt="{{ $product->product_code }}" style="max-width: 200px ; max-height: 200px"></td>
                    <td>{{ $product->product_code }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_price }}</td>
                    <td>{{ $product->product_quantity }}</td>
                    <td>{{ $product->product_weight }}</td>
                    <td>{{ $product->product_detail }}</td>
                    <td>
                        <input type="number" id="{{ $product->id . "qty" }}" name="quantity" min="1" max="{{ $product->product_quantity }}" value="1">
                    </td>
                    <td>
                        <button type="button" class="btn btn-secondary basketBtn" id="{{ $product->id }}">
                            Add to basket
                        </button>
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
           @guest()
               window.location.href = "../login";
           @endguest

           @auth()
               let qty = $("#" + this.id + "qty").val();
               $.ajax({
                   url: "../order/store",
                   type:"POST",
                   data:{
                       user_id:{{ Auth::user()->name }},
                       mobile_number:mobile_number,
                       message:message,
                   },
                   success:function(response){
                       console.log(response);

                   },
               });
           @endauth
           })
        });
    </script>
@endsection
