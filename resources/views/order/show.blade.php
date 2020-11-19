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
                    วันที่สั่งสินค้า :  <span> {{ $order->order_datetime }}</span>
                </div>
                <div style="font-size: 20px" class="mb-2">
                    สถานะสินค้า :
                    @if($order->order_status == "รอจัดส่งสินค้า")
                        <span style="color: blue"> {{ $order->order_status }}</span>
                    @else
                        <span style="color: indianred"> {{ $order->order_status }}</span>
                    @endif
                </div>
            </div>
            <div class="col" style="text-align: right">
                @if($payments->count() == 0)
                    <div style="font-size: 30px; color: indianred">ยังไม่มีการชำระเงิน</div>
                @elseif($payments->count() == 1)
                    <div style="font-size: 24px ">ชำระเงินแล้ว</div>
                    <div> {{ $payments[0]->payment_amount }} บาท </div>
                @else
                    <div style="font-size: 24px">
                        <span style="color: darkgreen">
                            ชำระเงินแล้ว :
                        </span>
                        @for($i = 0, $amountPayment = 0; $i<$payments->count(); $amountPayment += $payments[$i]->payment_amount, $i++)
                            <span><a href="#" data-toggle="modal" data-target="#payment{{ $payments[$i]->id }}">{{ $payments[$i]->payment_amount }}</a></span>
                            @if($i != $payments->count() - 1)
                                +
                            @endif
                        @endfor
                        = {{ $amountPayment }} บาท
                    </div>
                @endif

                @if($payments->count() != 0)
                    @if($order->order_status == "รอจัดส่งสินค้า" || $order->order_status == "รอรับสินค้า" || $order->order_status == "สำเร็จ")
                        <div style="font-size: 30px; margin-top: 15px">
                            <span style="color: darkgreen">
                                การชำระเงินเสร็จสิ้น
                            </span>
                        </div>
                    @else
                        <div style="margin-top: 15px">
                            <form action="{{ route('order.update', ['order' => $order->id]) }}" class="form" method="POST" enctype="multipart/form-data" style="float: right; margin-left: 20px">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-primary mb-2"> การชำระเงินถูกต้อง </button>
                            </form>

                            <form action="{{ route('order.unAcceptPayment', ['id' => $order->id]) }}" class="form" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-danger"> การชำระเงินไม่ถูกต้อง </button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>

        </div>
        @if($order->order_status=='รอรับสินค้า')
            <div style="font-size: 20px  " class="mb-2">
                เลขส่งสินค้า :  <span style="color: indianred"> {{ $order->shipment_information->tracking_no }}</span>
            </div>
        @endif
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
                            <label for="tracking_no">เพิ่มหมายเลขการจัดส่งสินค้า <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                            <input type="text" class="form-control" id="tracking_no"
                                   name="tracking_no"
                                   aria-describedby="trackingHelp">
                            <small id="trackingHelp" class="form-text text-muted">
                                หมายเลขการจัดส่ง is required .
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="send_time">วันและเวลาในการจัดส่ง <i style="color: indianred" class="fas fa-star-of-life"></i></label>
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


            </div>
            <div class="col-9">
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
                                <td>{{ $orderDetails[$i]->orderdetail_price * $orderDetails[$i]->orderdetail_quantity }}</td>
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
        <hr>
        <br>
        <div class="row">

            @foreach($payments as $payment)
            <!-- Modal -->
            <div class="modal fade" id="payment{{ $payment->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >{{ $payment->payment_datetime }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-auto">
                            <img src="/storage/{{ $payment->img_slip }}" alt="">
                        </div>
                        <div class="modal-footer">
                            {{ $payment->payment_amount }} บาท
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
@endsection
