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

        <div style="font-size: 24px">
            ประวัติการสั่งซื้อสินค้า ADMIN
        </div>
        <br>

        <div class="row">
            <div class="col-8">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">รหัสการสั่งซื้อ</th>
                        <th scope="col">วันและเวลาในการสั่ง</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col">Tracking</th>

                    </tr>
                    </thead>
                    <tbody>
                    @isset($orders)
                        @foreach($orders as $order)
                            @if($order == $orders[0])
                                <tr class="orderSelected trOder" onclick="orderOnClick(this, {{ $order->orderDetails }})">
                            @else
                                <tr class="trOder" onclick="orderOnClick(this, {{ $order->orderDetails }})">
                                    @endif
                                    <td>{{ $order->order_code }}</td>
                                    <td>{{ $order->order_datetime }}</td>
                                    <td>{{ $order->order_status }}</td>
                                    @if($order->order_status != 'รอรับสินค้า')
                                        <td> - </td>
                                    @else
                                        <td> 123456 </td>
                                    @endif
                                </tr>
                                @endforeach
                            @endisset
                    </tbody>
                </table>

            </div>
            <div class="col-4">
                <table class="table" id="detailTable">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="thCenter">#</th>
                        <th scope="col" class="thCenter">รูปภาพสินค้า</th>
                        <th scope="col" class="thCenter">รหัสสินค้า</th>
                        <th scope="col" class="thCenter">ชื่อสินค้า</th>
                        <th scope="col" class="thCenter">ราคา</th>
                        <th scope="col" class="thCenter">จำนวน</th>
                        <th scope="col" class="thCenter">รวม(บาท)</th>
                    </tr>
                    </thead>
                    <tbody id="detailBody">
                    @isset($orderDetails)
                        @for($i = 0; $i < $orderDetails->count() ; $i++)
                            <tr>
                                <th scope="row">{{ $i+1 }}</th>
                                <td><img src="/storage/{{ $orderDetails[$i]->product->img }}" alt="{{ $orderDetails[$i]->product->product_code }}" class="productImg"></td>
                                <td>{{ $orderDetails[$i]->product->product_code }}</td>
                                <td>{{ $orderDetails[$i]->product->product_name }}</td>
                                <td>{{ $orderDetails[$i]->orderdetail_price }}</td>
                                <td>{{ $orderDetails[$i]->orderdetail_quantity }}</td>
                                <td>{{ $orderDetails[$i]->product->product_price }}</td>
                            </tr>
                        @endfor
                        <tr>
                            <th colspan="6" style="text-align: left">ราคาสินค้าทั้งหมด</th>
                            <th style="text-align: center">{{ $amountPrice }}</th>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align: left">ค่าจัดส่ง</th>
                            <th style="text-align: center">{{ $deliFee }}</th>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align: left">รวม</th>
                            <th style="text-align: center">{{ $amountPrice + $deliFee }}</th>
                        </tr>
                    @endisset
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function orderOnClick(tr, orderDetails) {
            let trSelected = document.getElementsByClassName("orderSelected")[0];
            trSelected.classList.remove("orderSelected");
            tr.classList.add("orderSelected");

            let detailBody = document.getElementById("detailBody");
            detailBody.style.textAlign = "center";

            let new_tbody = document.createElement('tbody');
            new_tbody.id = "detailBody";
            detailBody.parentNode.replaceChild(new_tbody, detailBody);

            let amountPrice = 0;
            let amountWeight = 0;
            for (let i=0; i<orderDetails.length; i++) {
                fetch(
                    '/product/' + orderDetails[i].product_id,
                    {
                        method: 'GET',
                        headers: {},
                    }
                ).then(function (response) {
                    response.json().then(function (result) {
                        console.log(result)
                        let product = result.product;

                        let row = new_tbody.insertRow(i)
                        let num = row.insertCell(0);
                        let img = row.insertCell(1);
                        let pc = row.insertCell(2);
                        let name = row.insertCell(3);
                        let price = row.insertCell(4);
                        let qty = row.insertCell(5);
                        let amount = row.insertCell(6);

                        num.innerHTML = '<th scope="row"><b>' + (i+1) + '</b></th>';
                        img.innerHTML = '<td><img src="/storage/' + product.img +'" alt="' + product.product_code + '" class="productImg"></td>';
                        pc.innerHTML = '<td>' + product.product_code + '</td>';
                        name.innerHTML = '<td>' + product.product_name + '</td>';
                        price.innerHTML = '<td>' + orderDetails[i].orderdetail_price + '</td>';
                        qty.innerHTML = '<td>' + orderDetails[i].orderdetail_quantity + '</td>';
                        amount.innerHTML = '<td>' + product.product_price * orderDetails[i].orderdetail_quantity + '</td>';

                        amountPrice += product.product_price * orderDetails[i].orderdetail_quantity;
                        amountWeight += product.product_weight * orderDetails[i].orderdetail_quantity
                    }).then( function () {
                        if (i === orderDetails.length-1) {
                            let deliFee = (30 + Math.ceil(amountWeight/1000)*15);

                            let row = new_tbody.insertRow(orderDetails.length);
                            let amountText = row.insertCell(0);
                            let amountCell = row.insertCell(1);
                            amountText.innerHTML = '<th><b>ราคาสินค้าทั้งหมด</b></th>';
                            amountText.setAttribute('colspan', '6');
                            amountText.style.textAlign = "left";
                            amountCell.innerHTML = '<th><b>' + amountPrice + '</b></th>'
                            amountCell.style.textAlign = "center";

                            row = new_tbody.insertRow(orderDetails.length + 1);
                            amountText = row.insertCell(0);
                            amountCell = row.insertCell(1);
                            amountText.innerHTML = '<th><b>ค่าจัดส่ง</b></th>';
                            amountText.setAttribute('colspan', '6');
                            amountText.style.textAlign = "left";
                            amountCell.innerHTML = '<th><b>' + deliFee + '</b></th>'
                            amountCell.style.textAlign = "center";

                            row = new_tbody.insertRow(orderDetails.length + 2);
                            amountText = row.insertCell(0);
                            amountCell = row.insertCell(1);
                            amountText.innerHTML = '<th><b>รวม</b></th>';
                            amountText.setAttribute('colspan', '6');
                            amountText.style.textAlign = "left";
                            amountCell.innerHTML = '<th><b>' + (amountPrice + deliFee) + '</b></th>'
                            amountCell.style.textAlign = "center";
                        }
                    })
                });
            }
        }
    </script>
@endsection
