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


        <div class="row">
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
                    <th scope="col">เพิ่มลงตระกล้า</th>

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
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <div>

            <div class="card-columns">
                @foreach($products as $product)

                <div class="card">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title that wraps to a new line</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
                @endforeach
            </div>


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
