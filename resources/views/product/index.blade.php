@extends('layouts.app')

@section('style')
    <style>
        .productImg {
            object-fit: cover;
            width: 200px;
            height: 150px;
        }
        th {
            text-align: center;t
        }
    </style>
@endsection

@section('content')

    <div class="container">


{{--        <div>--}}
{{--            <input class="form-control" type="text" placeholder="Search" aria-label="Search" id="searchBar" >--}}
{{--        </div>--}}
{{--        <br>--}}

{{--        @can('create', \App\Models\Post::class)--}}
{{--            <a href="{{ route('posts.create') }}">สร้างโพสต์ใหม่</a>--}}
{{--        @else--}}
{{--            <p>คุณไม่มีสิทธิ์สร้างโพสต์ใหม่</p>--}}
{{--        @endcan--}}

        @can('create',\App\Models\Product::class)
            <div class="row" style="font-size: 20px">
                <a href="{{ route('product.productCreate') }}">
                    <i class="fas fa-plus-circle fa-1x"></i> <span> เพิ่มสินค้า</span>
                </a>
            </div>
        @else
            <p>คุณไม่มีสิทธิ์สร้างโพสต์ใหม่</p>
        @endcan

{{--        @auth()--}}
{{--        <div class="row" style="font-size: 20px">--}}
{{--            <a href="{{ route('product.productCreate') }}">--}}
{{--            <i class="fas fa-plus-circle fa-1x"></i> <span> เพิ่มสินค้า</span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        @endauth--}}

        <br>

        <div class="row">
            <table class="table table-hover">
                <caption>List of product</caption>
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">รหัสสินค้า</th>
                    <th scope="col">ชื่อสินค้า</th>
                    <th scope="col">จำนวนคงเหลือ</th>
                    <th scope="col" class="text-right">ราคา</th>
                    <th scope="col">แก้ไขข้อมูล</th>
                </tr>
                </thead>
                <tbody id="product_body">
                @for($i=0; $i<$products->count(); $i++)
                    <tr>
                        <th scope="row">{{ $i+1 }}</th>
                        <td class="text-center">{{ $products[$i]->product_code }}</td>
                        <td>{{ $products[$i]->product_name }}</td>
                        <td id="td{{ $products[$i]->id }}Qty" class="text-center priceNumber">{{ $products[$i]->product_quantity }}</td>
                        <td id="product{{ $products[$i]->id }}" class="text-right priceNumber">{{ $products[$i]->product_price }}</td>
                        <td class="text-center">
                            <div class="btn btn-success"><a href="{{route('product.edit',['product' => $products[$i]->id])}}">แก้ไขข้อมูลสินค้า</a></div>
                        </td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        window.onload = function() {
            setAllPriceCommas();
        };

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function setAllPriceCommas() {
            let prices = document.getElementsByClassName('priceNumber');
            for(price of prices) {
                price.innerHTML = numberWithCommas(price.innerHTML);
            }
        }
    </script>
    <script>
        $(document).ready(function(){
            $("#searchBar").change(function () {
                let txt = $("#searchBar").val()
                console.log(txt)
            })


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
