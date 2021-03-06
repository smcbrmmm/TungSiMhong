@extends('layouts.app')

@section('style')
    <style>
        .productImg {
            object-fit: cover;
            width: 100px;
            height: 100px;
            max-width: 100px;
        }
        .thCenter {
            text-align: center;
        }
        td {
            text-align: center;
        }
        .priceNumber {
            padding-left: 30px;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <table class="table table-hover">
                    <caption>List of product in basket</caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="thCenter">#</th>
                        <th scope="col" class="thCenter">รูปภาพสินค้า</th>
                        <th scope="col" class="thCenter">รหัสสินค้า</th>
                        <th scope="col" class="thCenter">ชื่อสินค้า</th>
                        <th scope="col" class="thCenter">จำนวน</th>
                        <th scope="col" class="text-right">รวม(บาท)</th>
                    </tr>
                    </thead>
                    <tbody id="basketBody">
                    @for($i = 0; $i < $orderDetails->count() ; $i++)
                        <tr>
                            <th scope="row" class="rowNum text-center">{{ $i+1 }}</th>
                            <td><img src="/storage/{{ $orderDetails[$i]->product->img }}" alt="{{ $orderDetails[$i]->product->product_code }}" class="productImg mx-auto"></td>
                            <td >
                                <div>
                                    {{ $orderDetails[$i]->product->product_code }}
                                </div>
                                <button class="btn btn-danger text-right" style="margin-top: 20px" onclick="deleteDetail( {{ $orderDetails[$i]->id }}, this )"> นำสินค้าออก </button>
                            </td>
                            <td style="text-align: left">{{ $orderDetails[$i]->product->product_name }}</td>
                            <td>
                                <input style="min-width: 65px" onchange="inputOnChange(this, {{ $orderDetails[$i] }}, {{ $orderDetails[$i]->product }})" class="inputQty text-right" type="number" id="{{ $orderDetails[$i]->product->id . "qty" }}"
                                       min="1" max="{{ $orderDetails[$i]->product->product_quantity }}" value="{{ $orderDetails[$i]->orderdetail_quantity }}">
                            </td>
                            <td>
                                <div id="product{{ $orderDetails[$i]->id }}" class="amountPrice priceNumber text-right">
                                    {{ $orderDetails[$i]->orderdetail_price * $orderDetails[$i]->orderdetail_quantity }}
                                </div>
                            </td>
                        </tr>
                    @endfor
                    <tr>
                        <th colspan="5" style="text-align: left">ราคาสินค้าทั้งหมด</th>
                        <th id="amountPrice" style="text-align: center" class="priceNumber text-right">{{ $amountPrice }}</th>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align: left">VAT 7%</th>
                        <th id="vatPrice" style="text-align: center" class="priceNumber text-right">{{ round($amountPrice*0.07) }}</th>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align: left">ค่าจัดส่ง</th>
                        <th id="deliFee" style="text-align: center" class="priceNumber text-right">{{ $deliFee }}</th>
                    </tr>
                    <tr>
                        <th colspan="5" style="text-align: left">รวม</th>
                        <th id="amountAll" style="text-align: center" class="priceNumber text-right">{{ $amountPrice + $deliFee + round($amountPrice*0.07) }}</th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th colspan="2">
                            <div class="row align-middle">
                                <div class="col text-left">
                                    ที่อยู่ในการจัดส่ง
                                </div>
                                <div class="col text-right">
                                    <a class="btn btn-secondary" href="{{ route('address.create') }}">เพิ่มที่อยู่ใหม่</a>
                                </div>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <form action="{{ route('order.submit', ['id' => $orderId]) }}" class="form" method="POST" >
                        @csrf
                        @method("PUT")
                        <tr>
                            <th class="align-middle">
                                ชื่อสถานที่
                            </th>
                            <td class="form-group">
                                <select class="form-control " name="userAddress" id="userAddress" onchange="addressSelect(this, {{ $addresses }})" required>
                                    <option disabled selected value> -- เลือกที่อยู่ของคุณ -- </option>
                                    @if($addresses->count() == 0)
                                    @else
                                        @for ($i = 0; $i < $addresses->count(); $i++)
                                            <option value="{{ $addresses[$i]->id }}">{{ $addresses[$i]->place_name }}</option>
                                        @endfor
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th class="align-middle">
                                <label for="receiver_name">ชื่อผู้รับสินค้า :</label>
                            </th>
                            <td>
                                <input disabled type="text" class="form-control" id="receiver_name" required
                                       name="receiver_name" value="{{ old('receiver_name') }}"
                                       aria-describedby="receiver_nameHelp">
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th class="align-middle">
                                <label for="receiver_tel">เบอร์ผู้รับสินค้า :</label>
                            </th>
                            <td>
                                <input disabled type="text" class="form-control" id="receiver_tel" required
                                       name="receiver_tel" value="{{ old('receiver_tel') }}"
                                       aria-describedby="receiver_telHelp">
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th class="align-middle">
                                <label for="house_no">บ้านเลขที่ :</label>
                            </th>
                            <td>
                                <input disabled type="text" class="form-control" id="house_no" required
                                       name="house_no" value="{{ old('house_no') }}"
                                       aria-describedby="house_noHelp">
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th class="align-top">
                                <label for="address">ที่อยู่ :</label>
                            </th>
                            <td>
                                <textarea type="text" class="form-control" id="address" name="address" aria-describedby="addressHelp" required
                                          rows="3" disabled style="overflow:hidden;">
                                    {{ old('address') }}
                                    </textarea>
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th class="align-middle">
                                <label for="province">จังหวัด :</label>
                            </th>
                            <td>
                                <input disabled type="text" class="form-control" id="province" required
                                       name="province" value="{{ old('province') }}"
                                       aria-describedby="provinceHelp">
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th class="align-middle">
                                <label for="postal">รหัสไปรษณีย์ :</label>
                            </th>
                            <td>
                                <input disabled type="text" class="form-control" id="postal" required
                                       name="postal" value="{{ old('postal') }}"
                                       aria-describedby="postalHelp">
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th colspan="2" style="text-align: center">
                                @if($orderDetails->count()>0)
                                    <button type="submit" class="btn btn-success">
                                        ยืนยันคำสั่งซื้อ
                                    </button>
                                @endif
                            </th>
                        </tr>
                    </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

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

    var amountWeight = parseInt({{ $amountWeight }});
    console.log(amountWeight);


    function inputOnChange(input, orderDetail, product) {
        if (parseInt(input.value) > product.product_quantity) {
            alert("จำนวนสินค้าในคลังไม่พอ");
            input.value = product.product_quantity;
        } else if (parseInt(input.value) <= 0) {
            alert("จำนวนสินค้าไม่ถูกต้อง");
            input.value = 1;
        }

        $.ajax({
            url: "/order_detail/" + orderDetail.id,
            type:"PUT",
            data:{
                _token: "{{ csrf_token() }}",
                qty: input.value
            },
            success:function(response){
                console.log(response)

                amountWeight -= response.oldQty * product.product_weight;
                amountWeight += input.value * product.product_weight;

                let amountTag = document.getElementById("product" + orderDetail.id);
                amountTag.innerHTML = product.product_price * parseInt(input.value);
                amountTag.innerHTML = numberWithCommas(amountTag.innerText);

                let amountPrice = 0;
                let amounts = document.getElementsByClassName("amountPrice");
                for (let i=0; i<amounts.length; i++) {
                    amountPrice += parseInt(amounts[i].innerHTML.replace(',',''));
                }
                document.getElementById("amountPrice").innerHTML = amountPrice;

                let vatPrice = document.getElementById("vatPrice");
                let vat = Math.round(amountPrice*0.07)
                vatPrice.innerHTML = vat;

                let deliFee = 30 + Math.ceil(amountWeight/1000)*15;
                document.getElementById("deliFee").innerHTML = deliFee
                document.getElementById("amountAll").innerHTML = deliFee + amountPrice + vat;
                setAllPriceCommas();

            }
        });
    }

    function deleteDetail(id, btn) {
        $.ajax({
            url: "/order_detail/" + id,
            type:"DELETE",
            data:{
                _token: "{{ csrf_token() }}",
            },
            success:function(response){
                let basketBody = document.getElementById("basketBody");
                basketBody.deleteRow(btn.parentElement.parentElement.rowIndex-1)

                let rows = document.getElementsByClassName("rowNum");
                let i = 1
                for(row of rows) {
                    row.innerHTML = i++;
                }

                let orderDetail = response.orderDetail;
                let product = response.product;
                amountWeight -= orderDetail.orderdetail_quantity * product.product_weight

                let amountPrice = 0;
                let amounts = document.getElementsByClassName("amountPrice");
                for (let i=0; i<amounts.length; i++) {
                    amountPrice += parseInt(amounts[i].innerHTML);
                }
                document.getElementById("amountPrice").innerHTML = amountPrice;

                let deliFee = 30 + Math.ceil(amountWeight/1000)*15;
                document.getElementById("deliFee").innerHTML = deliFee
                document.getElementById("amountAll").innerHTML = deliFee + amountPrice;

                let basketQty = $("#basketQty");

                $.ajax({
                    url: "/order/basket",
                    type:"GET",
                    success:function(response){
                        if (response == 0) {
                            basketQty.text("")
                            window.location.href = "{{ route('home.index') }}";
                        }
                        if (response > 0) {
                            basketQty.text(response)
                        }
                    }
                });
            }
        });
    }

    function addressSelect(select, addresses) {
        let receiver_name = document.getElementById("receiver_name");
        let receiver_tel = document.getElementById("receiver_tel");
        let house_no = document.getElementById("house_no");
        let address = document.getElementById("address");
        let province = document.getElementById("province");
        let postal = document.getElementById("postal");

        for (ad of addresses)  {
            if (ad.id == select.value) {
                receiver_name.value = ad.receiver_name
                receiver_tel.value = ad.receiver_tel
                house_no.value = ad.house_no
                address.value = ad.address
                province.value = ad.province
                postal.value = ad.postal
            }
        }
    }
</script>
