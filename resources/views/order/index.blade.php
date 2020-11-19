@extends('layouts.app')

@section('style')
    <style>
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

        <div class="row">
            <div class="col">
                <div style="font-size: 24px">
                    ประวัติการสั่งซื้อสินค้า
                </div>
            </div>
            <div class="col text-right" style="font-size: 24px">
                สถานะ :
                @if($orders[0]->order_status == "รอจัดส่งสินค้า" || $orders[0]->order_status == "กำลังตรวจสอบการชำระเงิน")
                    <span id="detailStatus" style="color: blue"> {{ $orders[0]->order_status }}</span>
                @elseif($orders[0]->order_status == "รอรับสินค้า" || $orders[0]->order_status == "สำเร็จ")
                    <span id="detailStatus" style="color: darkgreen"> {{ $orders[0]->order_status }}</span>
                @else
                    <span id="detailStatus" style="color: indianred"> {{ $orders[0]->order_status }}</span>
                @endif
{{--                <div id="trackingNum" >1234</div>--}}
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-7">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">รหัสสั่งซื้อ</th>
                        <th scope="col">วัน/เวลาในการสั่ง</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col">การชำระเงิน</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($orders)
                    @foreach($orders as $order)
                        @if($order == $orders[0])
                            <tr class="orderSelected trOder" onclick="orderOnClick(this, {{ $order }}, {{ $order->orderDetails }})">
                        @else
                            <tr class="trOder" onclick="orderOnClick(this, {{ $order }}, {{ $order->orderDetails }})">
                        @endif
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->order_datetime }}</td>
                                <td>{{ $order->order_status }}</td>

                                @if($order->order_status=='รอการชำระเงิน' || $order->order_status=='กรุณาตรวจสอบการชำระเงิน' )
                                <td>
                                    <a href="{{ route('payment.createPayment',['id'=>$order->id]) }}">
                                        <span class="btn btn-success" >แจ้งหลักฐาน </span>
                                    </a>
                                </td>
                                @else
                                    <td> - </td>
                                @endif
                            </tr>
                    @endforeach
                    @endisset
                    </tbody>
                </table>

            </div>
            <div class="col-5">
                <table class="table table-hover" id="detailTable">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="thCenter">#</th>
                        <th scope="col" class="thCenter">รหัสสินค้า</th>
                        <th scope="col" class="thCenter">ชื่อสินค้า</th>
                        <th scope="col" class="thCenter">จำนวน</th>
                        <th scope="col" class="thCenter">ราคา(บาท)</th>
                    </tr>
                    </thead>
                    <tbody id="detailBody">
                    @isset($orderDetails)
                    @for($i = 0; $i < $orderDetails->count() ; $i++)
                        <tr data-toggle="modal" data-target="#orderDetail{{ $orderDetails[$i]->id }}">
                            <th scope="row">{{ $i+1 }}</th>
                            <td>{{ $orderDetails[$i]->product->product_code }}</td>
                            <td>{{ $orderDetails[$i]->product->product_name }}</td>
                            <td>{{ $orderDetails[$i]->orderdetail_quantity }}</td>
                            <td>{{ $orderDetails[$i]->orderdetail_price * $orderDetails[$i]->orderdetail_quantity }}</td>
                        </tr>
                    @endfor
                    <tr>
                        <th colspan="4" style="text-align: left">ราคาสินค้าทั้งหมด</th>
                        <th style="text-align: center">{{ $amountPrice }}</th>
                    </tr>
                    <tr>
                        <th colspan="4" style="text-align: left">ค่าจัดส่ง</th>
                        <th style="text-align: center">{{ $deliFee }}</th>
                    </tr>
                    <tr>
                        <th colspan="4" style="text-align: left">รวม</th>
                        <th style="text-align: center">{{ $amountPrice + $deliFee }}</th>
                    </tr>
                    @endisset
                    </tbody>
                </table>

            </div>
        </div>

        <!-- Modal -->
        <div id="modalsProduct">
            @foreach($orderDetails as $orderDetail)
            <div class="modal fade" id="orderDetail{{ $orderDetail->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >{{ $orderDetail->product->product_code }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-auto">
                        <img src="/storage/{{ $orderDetail->product->img }}" alt="" width="200px">
                    </div>
                </div>
            </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
            })
        })
    </script>
    <script>
         function orderOnClick(tr, order, orderDetails) {
            let trSelected = document.getElementsByClassName("orderSelected")[0];
             if (tr === trSelected) {
                return;
             }

             trSelected.classList.remove("orderSelected");
            tr.classList.add("orderSelected");

             let detailBody = document.getElementById("detailBody");
            detailBody.style.textAlign = "center";

            let new_tbody = document.createElement('tbody');
            new_tbody.id = "detailBody";
            detailBody.parentNode.replaceChild(new_tbody, detailBody);

             let modals = document.getElementById('modalsProduct');
             modals.innerHTML = "";

             let detailStatus = document.getElementById("detailStatus");
             detailStatus.innerHTML = order.order_status;
             if (order.order_status == "รอจัดส่งสินค้า" || order.order_status == "กำลังตรวจสอบการชำระเงิน") {
                 detailStatus.style.color = 'blue';
             } else if (order.order_status == "รอรับสินค้า" || order.order_status == "สำเร็จ") {
                 detailStatus.style.color = 'darkgreen';
             } else {
                 detailStatus.style.color = 'indianred';
             }

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
                        row.setAttribute("data-toggle","modal");
                        row.setAttribute("data-target","#orderDetail" + orderDetails[i].id)

                        let num = row.insertCell(0);
                        let pc = row.insertCell(1);
                        let name = row.insertCell(2);
                        let qty = row.insertCell(3);
                        let amount = row.insertCell(4);

                        num.innerHTML = '<th scope="row"><b>' + (i+1) + '</b></th>';
                        pc.innerHTML = '<td>' + product.product_code + '</td>';
                        name.innerHTML = '<td>' + product.product_name + '</td>';
                        qty.innerHTML = '<td>' + orderDetails[i].orderdetail_quantity + '</td>';
                        amount.innerHTML = '<td>' + orderDetails[i].orderdetail_price * orderDetails[i].orderdetail_quantity + '</td>';

                        amountPrice += orderDetails[i].orderdetail_price * orderDetails[i].orderdetail_quantity;
                        amountWeight += product.product_weight * orderDetails[i].orderdetail_quantity

                        modals.innerHTML +=
                            '<div class="modal fade" id="orderDetail' + orderDetails[i].id + '" tabindex="-1" role="dialog" aria-hidden="true">\n' +
                            '<div class="modal-dialog" role="document">\n' +
                            '   <div class="modal-content">\n' +
                            '       <div class="modal-header">\n' +
                            '           <h5 class="modal-title" >' + product.product_code + '</h5>\n' +
                            '               <button type="button" class="close" data-dismiss="modal" aria-label="Close">\n' +
                            '                   <span aria-hidden="true">&times;</span>\n' +
                            '               </button>\n' +
                            '       </div>\n' +
                            '       <div class="modal-body mx-auto">\n' +
                            '           <img src="/storage/' +  product.img + '" alt="" width="200px">\n' +
                            '       </div>\n' +
                            '   </div>\n' +
                            '</div>\n' +
                            '</div>'
                    }).then( function () {
                        if (i === orderDetails.length-1) {
                            let deliFee = (30 + Math.ceil(amountWeight/1000)*15);

                            let row = new_tbody.insertRow(orderDetails.length);
                            let amountText = row.insertCell(0);
                            let amountCell = row.insertCell(1);
                            let colspan = 4;
                            amountText.innerHTML = '<th><b>ราคาสินค้าทั้งหมด</b></th>';
                            amountText.setAttribute('colspan', colspan);
                            amountText.style.textAlign = "left";
                            amountCell.innerHTML = '<th><b>' + amountPrice + '</b></th>'
                            amountCell.style.textAlign = "center";

                            row = new_tbody.insertRow(orderDetails.length + 1);
                            amountText = row.insertCell(0);
                            amountCell = row.insertCell(1);
                            amountText.innerHTML = '<th><b>ค่าจัดส่ง</b></th>';
                            amountText.setAttribute('colspan', colspan);
                            amountText.style.textAlign = "left";
                            amountCell.innerHTML = '<th><b>' + deliFee + '</b></th>'
                            amountCell.style.textAlign = "center";

                            row = new_tbody.insertRow(orderDetails.length + 2);
                            amountText = row.insertCell(0);
                            amountCell = row.insertCell(1);
                            amountText.innerHTML = '<th><b>รวม</b></th>';
                            amountText.setAttribute('colspan', colspan);
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
