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
                <th scope="col">quantity</th>
                <th scope="col">weight</th>
                <th scope="col">detail</th>
                <th scope="col">จำนวน</th>
                <th scope="col">ราคา</th>
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
                    <td id="td{{ $product->id }}Qty">{{ $product->product_quantity }}</td>
                    <td>{{ $product->product_weight }}</td>
                    <td>{{ $product->product_detail }}</td>
                    <td>
                        <input onchange="inputOnChange(this)" class="inputQty" type="number" id="{{ $product->id . "qty" }}" name="{{ $product->id }}" min="1" max="{{ $product->product_quantity }}" value="1">
                    </td>
                    <td id="product{{ $product->id }}">{{ $product->product_price }}</td>
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
        function inputOnChange(input) {
            let price = document.getElementById("product" + input.name);
            price.innerHTML = {{ $product->product_price }} * input.value;
        }
    </script>
    <script>
        $(document).ready(function(){

           $(".basketBtn").click(function (event) {
               let tdQty = $("#td" + this.id + "Qty");
               let inputQty = $("#" + this.id + "qty");
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
                           qty: inputQty.val()
                       },
                       success:function(response){
                           tdQty.text(response.product_quantity)
                           console.log(response);
                       },
                   });
               @endauth
           })
        });
    </script>
@endsection
