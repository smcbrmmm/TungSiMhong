@extends('layouts.app')

@section('style')
    <style>
        td, th {
            text-align: center;
        }
        .orderSelected {
            background-color: #99aabc;
        }
        tbody {
            cursor: pointer;
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
            <div class="col text-right align-bottom">
                @isset($orders[0])
                    <b id="orderNum">Order #{{ $orders[0]->order_code }}</b>
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#paymentModal" id="paymentBtn"> ประวัติการชำระเงิน </button>
                @endisset
            </div>
            <div class="col-5 text-right" style="font-size: 24px">
                @isset($orders[0])
                    สถานะ :
                @if($orders[0]->order_status == "รอจัดส่งสินค้า" || $orders[0]->order_status == "กำลังตรวจสอบการชำระเงิน")
                    <span id="detailStatus" style="color: blue"> {{ $orders[0]->order_status }}</span>
                @elseif($orders[0]->order_status == "รอรับสินค้า" || $orders[0]->order_status == "สำเร็จ")
                    <span id="detailStatus" style="color: darkgreen"> {{ $orders[0]->order_status }}</span>
                @else
                    <span id="detailStatus" style="color: red"> {{ $orders[0]->order_status }}</span>
                @endif
                @endisset

                <div>
                    <div id="detailTrack" style="font-size: 18px;">
                        @if($orders[0]->order_status == "รอรับสินค้า" || $orders[0]->order_status == "สำเร็จ")
                            Tracking No.{{ $orders[0]->shipment_information->tracking_no }}
                        @endif
                    </div>
                </div>
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
                        <th scope="col">จัดการ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($orders)
                    @foreach($orders as $order)
                        @if($order == $orders[0])
                            <tr class="orderSelected trOder"
                                onclick="orderOnClick(this, {{ $order }}, {{ $order->orderDetails }}, {{ $order->payment_informations }}, {{ $order->shipment_information }})">
                        @else
                            <tr class="trOder" onclick="orderOnClick(this, {{ $order }}, {{ $order->orderDetails }}, {{ $order->payment_informations }}, {{ $order->shipment_information }})">
                        @endif
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->order_datetime }}</td>
                                @if($order->order_status == 'สำเร็จ' || $order->order_status == 'รอรับสินค้า')
                                    <td style="color: darkgreen">{{ $order->order_status }}</td>
                                @elseif($order->order_status == 'ยกเลิก' || $order->order_status == 'รอการชำระเงิน' || $order->order_status == 'กรุณาตรวจสอบการชำระเงิน')
                                    <td style="color: red">{{ $order->order_status }}</td>
                                @else
                                    <td style="color: blue">{{ $order->order_status }}</td>
                                @endif

                                @if($order->order_status=='รอการชำระเงิน' || $order->order_status=='กรุณาตรวจสอบการชำระเงิน' )
                                <td>

                                    <a href="{{ route('payment.createPayment',['id'=>$order->id]) }}">
                                        <span class="btn btn-primary" >แจ้งหลักฐาน </span>
                                    </a>
                                </td>

                                @elseif($order->order_status == 'รอรับสินค้า')
                                    <td>
                                        <a href="#" class="btn btn-success"
                                           data-toggle="modal" data-target="#sureSuccess">
                                            ได้รับสินค้าแล้ว
                                        </a>
                                    </td>
                                    <div class="modal fade" id="sureSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <p>ท่านได้รับสินค้าเรียบร้อยแล้วใช่หรือไม่ ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                                    <form action="{{ route('order.successSubmit', ['id' => $order->id]) }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">ยืนยัน</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                    @if($orders[0]->order_status == 'รอการชำระเงิน' || $orders[0]->order_status == 'กรุณาตรวจสอบการชำระเงิน')
                        <tr>
                            <th colspan="5" style="text-align: center">
                                <button class="btn btn-danger" data-toggle="modal" data-target="#sureCancel{{ $orders[0]->id }}">
                                    ยกเลิกคำสั่งซื้อ
                                </button>
                            </th>
                        </tr>
                    @endif
                    @endisset
                    </tbody>
                </table>

            </div>
        </div>

        <!-- Modal -->
        <div id="modalsCancel">
            @foreach($orders as $order)
                <div class="modal fade" id="sureCancel{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p>ท่านต้องการยกเลิกคำสั่งซื้อนี้ใช่หรือไม่ ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                <a href="{{ route('order.cancel', ['id' => $order->id]) }}" class="btn btn-danger">ยืนยัน</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="modalsProduct">
            @isset($orderDetails)
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
                        <img src="/storage{{ $orderDetail->product->img }}" alt="" width="200px">
                    </div>
                </div>
            </div>
            </div>
            @endforeach
            @endisset
        </div>

        <div id="modalsPayment">
            @isset($orders[0])
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" ><b id="orderCodeModal">Order #{{ $orders[0]->order_code }}</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-auto" id="modalBodyPayment">
                        @foreach($orders[0]->payment_informations as $payment)
                            <div class="card mb-5" style="width: 18rem;">
                                <img class="card-img-top" src="/storage{{ $payment->img_slip }}" alt="">
                                <div class="card-body text-right">
                                    <h5 class="card-title">{{ $payment->payment_datetime }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
            @endisset
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
         function orderOnClick(tr, order, orderDetails, payments, shipment) {
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

             document.getElementById('orderNum').innerHTML = 'Order #' + order.order_code;
             document.getElementById('orderCodeModal').innerHTML = 'Order #' + order.order_code;
             let modals = document.getElementById('modalsProduct');
             modals.innerHTML = "";
             let modalsPayment = document.getElementById('modalBodyPayment');
             modalsPayment.innerHTML = "";
             if (payments.length > 0) {
                 for(payment of payments) {
                     modalsPayment.innerHTML +=
                         '<div class="card mb-5" style="width: 18rem;">\n' +
                         '  <img class="card-img-top" src="/storage' + payment.img_slip + '" alt="">\n' +
                         '  <div class="card-body text-right">\n' +
                         '      <h5 class="card-title">' + payment.payment_datetime + '</h5>\n' +
                         '  </div>\n' +
                         '</div>'
                 }
             } else {
                 modalsPayment.innerHTML += '<div>ยังไม่มีประวัติการชำระเงิน</div>'
             }

             let detailStatus = document.getElementById("detailStatus");
             let detailTrack = document.getElementById("detailTrack");
             detailTrack.innerHTML = "";
             detailStatus.innerHTML = order.order_status;
             if (order.order_status == "รอจัดส่งสินค้า" || order.order_status == "กำลังตรวจสอบการชำระเงิน") {
                 detailStatus.style.color = 'blue';
             } else if (order.order_status == "รอรับสินค้า" || order.order_status == "สำเร็จ") {
                 detailStatus.style.color = 'darkgreen';
                 detailTrack.innerHTML = "Tracking No." + shipment.tracking_no;
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
                            '           <img src="/storage' +  product.img + '" alt="" width="200px">\n' +
                            '       </div>\n' +
                            '   </div>\n' +
                            '</div>\n' +
                            '</div>'
                    }).then( function () {
                        if (i === orderDetails.length-1) {
                            createFooter(order, orderDetails, amountWeight, amountPrice)
                        }
                    })
                });
            }
        }

        function createFooter(order, orderDetails, amountWeight, amountPrice) {
            let new_tbody = document.getElementById('detailBody');
            let deliFee = (30 + Math.ceil(amountWeight/1000)*15);

            let row = new_tbody.insertRow(orderDetails.length);
            let amountText = row.insertCell(0);
            let amountCell = row.insertCell(1);
            let colspan = 4;
            amountText.innerHTML = '<b>ราคาสินค้าทั้งหมด</b>';
            amountText.setAttribute('colspan', colspan);
            amountText.style.textAlign = "left";
            amountCell.innerHTML = '<b>' + amountPrice + '</b>'
            amountCell.style.textAlign = "center";

            row = new_tbody.insertRow(orderDetails.length + 1);
            amountText = row.insertCell(0);
            amountCell = row.insertCell(1);
            amountText.innerHTML = '<b>ค่าจัดส่ง</b>';
            amountText.setAttribute('colspan', colspan);
            amountText.style.textAlign = "left";
            amountCell.innerHTML = '<b>' + deliFee + '</b>'
            amountCell.style.textAlign = "center";

            row = new_tbody.insertRow(orderDetails.length + 2);
            amountText = row.insertCell(0);
            amountCell = row.insertCell(1);
            amountText.innerHTML = '<b>รวม</b>';
            amountText.setAttribute('colspan', colspan);
            amountText.style.textAlign = "left";
            amountCell.innerHTML = '<b>' + (amountPrice + deliFee) + '</b>'
            amountCell.style.textAlign = "center";

            createCancel(order, orderDetails);
        }

        function createCancel(order, orderDetails) {
            if (order.order_status == 'รอการชำระเงิน' || order.order_status == 'กรุณาตรวจสอบการชำระเงิน') {
                let new_tbody = document.getElementById('detailBody');
                let cancelRow = new_tbody.insertRow(orderDetails.length+3);
                let cancelBtn = cancelRow.insertCell(0);
                cancelBtn.setAttribute('colspan', '5')
                cancelBtn.innerHTML = '' +
                    '<button class="btn btn-danger" data-toggle="modal" data-target="#sureCancel' + order.id + '">\n' +
                    '   ยกเลิกคำสั่งซื้อ\n' +
                    '</button>';
            }
        }

    </script>
@endsection
