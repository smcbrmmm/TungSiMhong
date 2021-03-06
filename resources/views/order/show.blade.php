@extends('layouts.app')

@section('style')
    <style>
        .address {
            border-color: #718096;
            border-width: 1px;
            margin-bottom: 1rem;
        }
        .productImg {
            object-fit: cover;
            width: 100px;
            height: 100px;
            max-width: 100px;
        }
        td, th {
            text-align: center;
        }
    </style>

@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <div style="font-size: 24px">
                    รหัสการสั่งซื้อ :  {{ $order->order_code }}
                </div>
                <div style="font-size: 20px">
                    วันที่สั่งสินค้า :
                    <span>{{ \Carbon\Carbon::parse($order->order_datetime)->format('d/m/Y')}}</span>
                    <span>{{ \Carbon\Carbon::parse($order->order_datetime)->format('h:i A')}}</span>
                </div>
                <div style="font-size: 20px" class="mb-2">
                    สถานะสินค้า :
                    @if($order->order_status == "รอจัดส่งสินค้า")
                        <span style="color: blue"> {{ $order->order_status }}</span>
                    @else
                        <span style="color: red"> {{ $order->order_status }}</span>
                    @endif
                </div>
            </div>
            <div class="col" style="text-align: right">
                @if($payments->count() == 0)
                    <div style="font-size: 30px; color: red">ยังไม่มีการชำระเงิน</div>
                @elseif($payments->count() == 1)
                    <div style="font-size: 24px ">
                        <span style="color: darkgreen">
                            ชำระเงินแล้ว :
                        </span>
                        <span><a href="#" data-toggle="modal" data-target="#payment{{ $payments[0]->id }}" class="priceNumber">{{ $payments[0]->payment_amount }}</a></span> บาท
                    </div>
                @else
                    <div style="font-size: 24px">
                        <span style="color: darkgreen">
                            ชำระเงินแล้ว :
                        </span>
                        @for($i = 0, $amountPayment = 0; $i<$payments->count(); $amountPayment += $payments[$i]->payment_amount, $i++)
                            <span><a href="#" data-toggle="modal" data-target="#payment{{ $payments[$i]->id }}" class="priceNumber">{{ $payments[$i]->payment_amount }}</a></span>
                            @if($i != $payments->count() - 1)
                                +
                            @endif
                        @endfor
                        = <span class="priceNumber">{{ $amountPayment }}</span> บาท
                    </div>
                @endif

                @if($payments->count() != 0)
                    @if($order->order_status == "รอจัดส่งสินค้า" || $order->order_status == "รอรับสินค้า" || $order->order_status == "สำเร็จ")
                        <div style="font-size: 30px; ">
                            <span style="color: darkgreen">
                                การชำระเงินเสร็จสิ้น
                            </span>
                        </div>
                    @else
                        <div style="margin-top: 15px">

                            <a class="btn btn-primary mb-2" data-toggle="modal" data-target="#sureCorrect"> การชำระเงินถูกต้อง </a>
                            @if ($amountPayment < $amountPrice + $deliFee)
                            <div class="modal fade" id="sureCorrect" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body text-center" style="color: red">
                                            ยอดเงินที่ชำระไม่ตรงกับยอดสั่งซื้อ
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ตกลง</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="modal fade" id="sureCorrect" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body text-center" >
                                            <p>ยืนยันการชำระเงิน <span style="color: darkgreen">ถูกต้อง</span></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                            <form action="{{ route('order.update', ['order' => $order->id]) }}" class="form" method="POST" enctype="multipart/form-data" style="float: right; margin-left: 20px">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" value="รอจัดส่งสินค้า" name="status">
                                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <a class="btn btn-danger mb-2" data-toggle="modal" data-target="#sureIncorrect"> การชำระเงินไม่ถูกต้อง </a>
                            <div class="modal fade" id="sureIncorrect" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body text-center" >
                                            <p>ยืนยันการชำระเงิน <span style="color: red">ไม่ถูกต้อง</span></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                            <form action="{{ route('order.unAcceptPayment', ['id' => $order->id]) }}" class="form" method="POST" enctype="multipart/form-data" style="float: right; margin-left: 20px">
                                                @method('PUT')
                                                @csrf
                                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

        </div>
        <div class="row">
            <div class="col-3">
                <div class="address">
                    <div class="text-center">
                        ข้อมูลของผู้รับสินค้า
                    </div>
                    <div style="margin-left: 1rem">
                        ชื่อสถานที่ : {{ $order->address->place_name }}
                    </div>
                    <div style="margin-left: 1rem">
                        ชื่อผู้รับสินค้า : {{ $order->address->receiver_name }}
                    </div>
                    <div style="margin-left: 1rem">
                        เบอร์โทรศัพท์ : {{ $order->address->receiver_tel }}
                    </div>
                    <div style="margin-left: 1rem">
                        ที่อยู่ : {{ $order->address->house_no }} {{ $order->address->address }}
                    </div>
                    <div style="margin-left: 1rem">
                        จังหวัด : {{ $order->address->province }} {{$order->address->postal}}
                    </div>
                </div>

                @if($order->order_status == 'รอจัดส่งสินค้า')
                <div>
                    <form action="{{route('shipment.update',['shipment'=>$order->id])}}" class="form" method="POST" >
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="tracking_no">เพิ่มหมายเลขการจัดส่งสินค้า <i style="color: red" class="fas fa-star-of-life"></i></label>
                            <input type="text" class="form-control" id="tracking_no"
                                   name="tracking_no"
                                   aria-describedby="trackingHelp">
                            <small id="trackingHelp" class="form-text text-muted">
                                หมายเลขการจัดส่ง is required .
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="shipment_company">ช่องทางการส่งสินค้า <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                            <br>
                            <select name="shipment_company" id="shipment_company">
                                <option disabled value=""> -- กรุณาเลือกช่องทางการส่งสินค้า -- </option>
                                <option value="ThailandPost">ThailandPost</option>
                                <option value="Kerry Express">Kerry Express</option>
                                <option value="Flash Express">Flash Express</option>


                            </select>
                            <small id="shipment_companyHelp" class="form-text text-muted">
                                ช่องทางการส่งสินค้า จำเป็น
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="send_time">วันและเวลาในการจัดส่ง <i style="color: red" class="fas fa-star-of-life"></i></label>
                            <input type="datetime-local" class="form-control" id="send_time"
                                   name="send_time" required
                                   aria-describedby="send_timetimeHelp">
                            <small id="send_timetimeHelp" class="form-text text-muted">
                                วันและเวลาในการจัดส่ง is required .
                            </small>
                        </div>

                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </form>
                </div>
                @endif

                @if($order->order_status=='รอรับสินค้า')
                    <div style="font-size: 20px  " class="mb-2">
                        เลขส่งสินค้า :  <span style="color: red"> {{ $order->shipment_information->tracking_no }}</span>
                    </div>
                    <div style="font-size: 20px  " class="mb-2">
                        บริษัทขนส่ง :  <span style="color: red"> {{ $order->shipment_information->shipment_company }}</span>
                    </div>
                @endif


            </div>
            <div class="col-9">
                <table class="table" id="detailTable">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="thCenter">#</th>
                        <th scope="col" class="thCenter">รูปภาพสินค้า</th>
                        <th scope="col" class="thCenter">รหัสสินค้า</th>
                        <th scope="col" class="thCenter">ชื่อสินค้า</th>
                        <th scope="col" class="text-right">ราคา</th>
                        <th scope="col" class="text-right">จำนวน</th>
                        <th scope="col" class="text-right">รวม(บาท)</th>
                    </tr>
                    </thead>
                    <tbody id="detailBody">
                    @isset($orderDetails)
                        @for($i = 0; $i < $orderDetails->count() ; $i++)
                            <tr>
                                <th scope="row">{{ $i+1 }}</th>
                                <td><img src="/storage/{{ $orderDetails[$i]->product->img }}" alt="{{ $orderDetails[$i]->product->product_code }}" class="productImg mx-auto"></td>
                                <td>{{ $orderDetails[$i]->product->product_code }}</td>
                                <td class="text-left">{{ $orderDetails[$i]->product->product_name }}</td>
                                <td class="text-right priceNumber">{{ $orderDetails[$i]->orderdetail_price }}</td>
                                <td class="text-right priceNumber">{{ $orderDetails[$i]->orderdetail_quantity }}</td>
                                <td class="text-right priceNumber">{{ $orderDetails[$i]->orderdetail_price * $orderDetails[$i]->orderdetail_quantity }}</td>
                            </tr>
                        @endfor
                        <tr>
                            <th colspan="6" style="text-align: left">ราคาสินค้าทั้งหมด</th>
                            <th style="text-align: center" class="text-right priceNumber">{{ $amountPrice }}</th>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align: left">VAT 7%</th>
                            <th style="text-align: center" class="text-right priceNumber">{{ round($amountPrice*0.07) }}</th>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align: left">ค่าจัดส่ง</th>
                            <th style="text-align: center" class="text-right priceNumber">{{ $deliFee }}</th>
                        </tr>
                        <tr>
                            <th colspan="6" style="text-align: left">รวม</th>
                            <th style="text-align: center" class="text-right priceNumber">{{ $amountPrice + $deliFee + round($amountPrice*0.07) }}</th>
                        </tr>
                    @endisset
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <br>
        <div class="row">

            @foreach($payments as $payment)
            <!-- Modal -->
            <div class="modal fade" id="payment{{ $payment->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >
                                <span>{{ \Carbon\Carbon::parse($payment->payment_datetime)->format('d/m/Y')}}</span>
                                <span>{{ \Carbon\Carbon::parse($payment->payment_datetime)->format('h:i A')}}</span>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-auto">
                            <img src="/storage/{{ $payment->img_slip }}" alt="" style="max-width: 450px">
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('payment.update', ['payment' => $payment->id]) }}" class="form col" method="POST" enctype="multipart/form-data" style="float: right; margin-left: 20px">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-3 text-right">
                                        แก้ไขราคา :
                                    </div>
                                    <div class="col-4 text-right">
                                        <input class="form-control" type="number" value="{{ $payment->payment_amount }}" width="100px" name="amount" min="0" max="50000">
                                    </div>
                                    <div class="col-5">
                                        <button class="btn btn-success" type="submit">ยืนยันการแก้ไข</button>
                                    </div>
                                </div>
                            </form>
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
        $(document).ready(function () {
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
            })
        })
    </script>
@endsection
