@extends('layouts.app')

@section('style')
    <style>
        .address {
            border-color: #718096;
            border-width: 1px;
            margin-bottom: 1rem;
        }
    </style>

@endsection

@section('content')

    <div class="container">
        <div style="font-size: 24px ">
            รหัสการสั่งซื้อ :  {{ $order->order_code }}
        </div>
        <div style="font-size: 20px  " class="mb-2">
            สถานะสินค้า :  <span style="color: indianred"> {{ $order->order_status }}</span>
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
                {{ $order->orderDetails[0] }}
            </div>

        </div>




    </div>


@endsection

@section('script')

@endsection
