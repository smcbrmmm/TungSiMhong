@extends('layouts.app')

@section('style')
    <style>
        .productImg {
            object-fit: cover;
            width: 100px;
            height: 100px;
            max-width: 100px;
        }
        td, th {
            text-align: center;
        }
        .orderSelected {
            background-color: #718096;
            color: white;
        }
    </style>
@endsection

@section('content')

    <div class="container">

        <div>
            ประวัติการสั่งซื้อสินค้า
        </div>

        <div class="row">
            <div class="col-6">
                <table class="table">
                    <caption>List of product</caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Order_code</th>
                        <th scope="col">Datetime</th>
                        <th scope="col">Status</th>
                        <th scope="col">แจ้งหลักฐาน</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        @if($order->order_status!='ตะกร้า')
                        @if($order == $orders[0])
                            <tr class="orderSelected trOder" onclick="orderOnClick(this, {{ $order->orderDetails }})">
                        @else
                            <tr class="trOder" onclick="orderOnClick(this, {{ $order->orderDetails }})">
                        @endif
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->order_datetime }}</td>
                                <td>{{ $order->order_status }}</td>
                                <td>
                                    <a href="{{route('payment.createPayment',['id'=>$order->id])}}">
                                        <span class="btn btn-success" >แจ้งหลักฐาน </span>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col-6">
                <table class="table" id="detailTable">
                    <caption>List of product in basket</caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="thCenter">#</th>
                        <th scope="col" class="thCenter">image</th>
                        <th scope="col" class="thCenter">product code</th>
                        <th scope="col" class="thCenter">name</th>
                        <th scope="col" class="thCenter">ราคาต่อชิ้น</th>
                        <th scope="col" class="thCenter">จำนวน</th>
                        <th scope="col" class="thCenter">รวม(บาท)</th>
                    </tr>
                    </thead>
                    <tbody id="detailBody">
                    @for($i = 0; $i < $orderDetails->count() ; $i++)
                        <tr>
                            <th scope="row">{{ $i+1 }}</th>
                            <td><img src="/storage/{{ $orderDetails[$i]->product->img }}" alt="{{ $orderDetails[$i]->product->product_code }}" class="productImg"></td>
                            <td>{{ $orderDetails[$i]->product->product_code }}</td>
                            <td>{{ $orderDetails[$i]->product->product_name }}</td>
                            <td>{{ $orderDetails[$i]->orderdetail_price }}</td>
                            <td>{{ $orderDetails[$i]->orderdetail_quantity }}</td>
                            <td id="product{{ $orderDetails[$i]->id }}" class="amountPrice">{{ $orderDetails[$i]->product->product_price }}</td>
                        </tr>
                    @endfor
                    <tr>
                        <th colspan="6" style="text-align: left">รวม</th>
                        <th id="amountPrice" style="text-align: center">{{ $amount }} บาท</th>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        async function orderOnClick(tr, orderDetails) {
            let trSelected = document.getElementsByClassName("orderSelected")[0];
            trSelected.classList.remove("orderSelected");
            tr.classList.add("orderSelected");

            let detailBody = document.getElementById("detailBody");

            let new_tbody = document.createElement('tbody');
            new_tbody.id = "detailBody";
            detailBody.parentNode.replaceChild(new_tbody, detailBody);

            let amountAll = 0;
            for (let i=0; i<orderDetails.length; i++) {
                await fetch(
                    '/product/' + orderDetails[i].product_id,
                    {
                        method: 'GET',
                        headers: {},
                    }
                ).then(function (response) {
                    response.json().then(function (result) {
                        console.log("insert " + i)
                        let product = result.product;

                        let row = new_tbody.insertRow(i)
                        let num = row.insertCell(0);
                        let img = row.insertCell(1);
                        let pc = row.insertCell(2);
                        let name = row.insertCell(3);
                        let price = row.insertCell(4);
                        let qty = row.insertCell(5);
                        let amount = row.insertCell(6);

                        num.innerHTML = '<th scope="row">' + (i+1) + '</th>';
                        img.innerHTML = '<td><img src="/storage/' + product.img +'" alt="' + product.product_code + '" class="productImg"></td>\n';
                        pc.innerHTML = '<td>' + product.product_code + '</td>';
                        name.innerHTML = '<td>' + product.product_name + '</td>';
                        price.innerHTML = '<td>' + orderDetails[i].orderdetail_price + '</td>';
                        qty.innerHTML = '<td>' + orderDetails[i].orderdetail_quantity + '</td>';
                        amount.innerHTML = '<td id="product' + orderDetails[i].id + '" class="amountPrice">' +
                            product.product_price * orderDetails[i].orderdetail_quantity + '</td>';

                        amountAll += product.product_price * orderDetails[i].orderdetail_quantity;
                    }).then( function () {
                        if (i === orderDetails.length-1) {
                            console.log(orderDetails.length)
                            let row = new_tbody.insertRow(orderDetails.length);
                            let allText = row.insertCell(0);
                            let amountCell = row.insertCell(1);

                            allText.innerHTML = '<th colspan="6" style="text-align: left">รวม</th>';
                            amountCell.innerHTML = '<th id="amountPrice" style="text-align: center">' + amountAll + '</th>'
                        }
                    })
                });
            }
        }
    </script>
@endsection
