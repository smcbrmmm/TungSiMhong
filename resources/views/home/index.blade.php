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
            margin-bottom: 1rem;

        }
    </style>
@endsection

@section('content')
    <div class="text-center mb-4 top">
    <span class="text-center mb-4" style="font-size: 40px  ; color: white ; background-color: grey">
        สินค้าภายในร้าน
    </span>
    </div>

    <div class="container">
        <div id="code_prod_complex">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-3">
                        <figure class="">
                            <div class="text-center" style="font-size: 24px ; color: #4a5568"> {{ $product->product_name }}</div>
                            <img class="productImg" src="storage{{ $product->img }}" alt="">
                            <div class="text-center"> รหัสสินค้า : {{ $product->product_code }}</div>
                            <div class="text-center"> ราคาสินค้า/ชิ้น : {{ $product->product_price }} บาท </div>
                            <div class="text-center">(ข้อมูลของสินค้า)</div>
                            <div class="text-center" style="color: #4a5568"> {{ $product->product_detail }} </div>
                            @auth
                            @if(Auth::user()->role=='Customer')
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary basketBtn"
                                        id="{{ $product->id }}" style="font-size: 16px"
                                        onclick="">
                                    <i class="fa fa-shopping-basket"></i>  เพิ่มใส่ตะกร้า
                                </button>
                            </div>
                            @endif
                            @endauth
                        </figure>
                        <br>

                    </div>

                @endforeach
            </div>
        </div>
    </div>
    </div>



@endsection

@section('script')
    <script>
        $("#{{ $product->id }}").click(function() {
            $(".top").animate({ scrollTop: 0 }, "slow");
        });
    </script>

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
