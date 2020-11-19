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
        p {
            max-width: 40ch;
        }
    </style>
@endsection

@section('content')
    <div class="text-center mb-4 top">
    <span class="text-center mb-4" style="font-size: 40px ; color: #4a5568 ">
        สินค้าภายในร้าน
    </span>
    </div>

    <div class="container">
        <div id="code_prod_complex">
            <div class="row">
                @foreach($products as $product)

                    <div class="card  col-md-4 mb-2" style="max-width: 28rem" >
                        <img class="card-img-top mx-auto mt-3" src="storage{{ $product->img }}" style="max-width: 200px ; max-height: 200px" alt="Card image cap">
                        <div class="card-body ">
                            <div style="font-size: 24px"> {{ $product->product_name }}</div>
                            <div class=""> รหัสสินค้า : {{ $product->product_code }}</div>
                            <div class=""> ราคาสินค้า/ชิ้น : {{ $product->product_price }} บาท </div>
                            <div class="">ข้อมูลของสินค้า : </div>
                            <div class="">
                                <p> {{ $product->product_detail }} </p>
                            </div>
                        </div>

                        @if(Auth::user() && Auth::user()->role=='Customer')
                            <div class="card-footer bg-transparent ">
                                @auth
                                    @if(Auth::user()->role=='Customer')
                                        @if($product->product_quantity > 0)
                                            <div class="text-center">
                                                <button type="button" class="btn btn-success basketBtn"
                                                        id="{{ $product->id }}" style="font-size: 16px"
                                                        onclick="">
                                                    <i class="fa fa-shopping-basket"></i>  เพิ่มใส่ตะกร้า
                                                </button>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <button type="button" class="btn btn-secondary basketBtn"
                                                        id="{{ $product->id }}###" style="font-size: 16px"
                                                        onclick="">
                                                    สินค้าหมดชั่วคราว
                                                </button>
                                            </div>
                                        @endif
                                    @endif
                                @endauth
                            </div>
                        @endauth
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
