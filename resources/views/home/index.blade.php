@extends('layouts.app')

@section('style')
    <style>
        .productImg {
            object-fit: cover;
            width: 200px;
            height: 150px;
            object-position: right;
            margin-left: auto;
            margin-right: auto;
            margin-top: 1rem;
        }
    </style>
@endsection

@section('content')

    <div class="container">

        <div style="font-size: 24px"> สินค้าในร้าน</div>

            <div class="card-columns">
                @foreach($products as $product)

                <div class="card">
                    <img class="card-img-top productImg" src="storage{{ $product->img }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">ชื่อสินค้า : {{ $product->product_name }}</h5>
                        <p class="card-text"> ข้อมูลสินค้า : {{ $product->product_detail }}</p>
                        <p> ราคาสินค้า/ชิ้น : {{ $product->product_price }} บาท</p>
                        <button type="button" class="btn btn-secondary basketBtn" id="{{ $product->id }}">
                            เพิ่มใส่ตะกร้า
                        </button>
                    </div>
                </div>
                @endforeach
            </div>


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
