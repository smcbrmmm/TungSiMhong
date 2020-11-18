@extends('layouts.app')

@section('style')
    <style>
        .productImg {
            object-fit: cover;
            width: 100px;
            height: 100px;
            max-width: 100px;
        }
        th {
            text-align: right;
        }
        .thCenter {
            text-align: center;
        }
        td {
            text-align: center;
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
                        <th scope="col" class="thCenter">image</th>
                        <th scope="col" class="thCenter">product code</th>
                        <th scope="col" class="thCenter">name</th>
                        <th scope="col" class="thCenter">ราคาต่อชิ้น</th>
                        <th scope="col" class="thCenter">จำนวน</th>
                        <th scope="col" class="thCenter">รวม(บาท)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < $orderDetails->count() ; $i++)
                        <tr>
                            <th scope="row">{{ $i+1 }}</th>
                            <td><img src="/storage/{{ $orderDetails[$i]->product->img }}" alt="{{ $orderDetails[$i]->product->product_code }}" class="productImg"></td>
                            <td>{{ $orderDetails[$i]->product->product_code }}</td>
                            <td>{{ $orderDetails[$i]->product->product_name }}</td>
                            <td>{{ $orderDetails[$i]->orderdetail_price }}</td>
                            <td>
                                <input onchange="inputOnChange(this, {{ $orderDetails[$i]->id }}, {{ $orderDetails[$i]->product }})" class="inputQty" type="number" id="{{ $orderDetails[$i]->product->id . "qty" }}"
                                       min="1" max="{{ $orderDetails[$i]->product->product_quantity }}" value="{{ $orderDetails[$i]->orderdetail_quantity }}">
                            </td>
                            <td id="product{{ $orderDetails[$i]->id }}" class="amountPrice">{{ $orderDetails[$i]->product->product_price * $orderDetails[$i]->orderdetail_quantity }}</td>
                        </tr>
                    @endfor
                    <tr>
                        <th colspan="6" style="text-align: left">รวม</th>
                        <th id="amountPrice" style="text-align: center">{{ $amount }}</th>
                    </tr>
                    </tbody>
                </table>


            </div>
            <div class="col-4">
                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th class="align-middle">ที่อยู่ในการจัดส่ง</th>
                        <th style="text-align: right">
                            <a class="btn btn-secondary" href="{{ route('address.create') }}">เพิ่มที่อยู่ใหม่</a>
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
                                <select class="form-control " name="userAddress" id="userAddress" onchange="addressSelect(this, {{ $addresses }})">
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
                                <input disabled type="text" class="form-control" id="receiver_name"
                                       name="receiver_name" value="{{ old('receiver_name') }}"
                                       aria-describedby="receiver_nameHelp">
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th class="align-middle">
                                <label for="receiver_tel">เบอร์ผู้รับสินค้า :</label>
                            </th>
                            <td>
                                <input disabled type="text" class="form-control" id="receiver_tel"
                                       name="receiver_tel" value="{{ old('receiver_tel') }}"
                                       aria-describedby="receiver_telHelp">
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th class="align-middle">
                                <label for="house_no">บ้านเลขที่ :</label>
                            </th>
                            <td>
                                <input disabled type="text" class="form-control" id="house_no"
                                       name="house_no" value="{{ old('house_no') }}"
                                       aria-describedby="house_noHelp">
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th class="align-top">
                                <label for="address">ที่อยู่ :</label>
                            </th>
                            <td>
                                <textarea type="text" class="form-control" id="address" name="address" aria-describedby="addressHelp"
                                          rows="2" disabled >
                                    {{ old('address') }}
                                    </textarea>
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th class="align-middle">
                                <label for="province">จังหวัด :</label>
                            </th>
                            <td>
                                <input disabled type="text" class="form-control" id="province"
                                       name="province" value="{{ old('province') }}"
                                       aria-describedby="provinceHelp">
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th class="align-middle">
                                <label for="postal">รหัสไปรษณีย์ :</label>
                            </th>
                            <td>
                                <input disabled type="text" class="form-control" id="postal"
                                       name="postal" value="{{ old('postal') }}"
                                       aria-describedby="postalHelp">
                            </td>
                        </tr>
                        <tr class="form-group">
                            <th colspan="2" style="text-align: center">
                                <button type="submit" class="btn btn-success">
                                    ยืนยันคำสั่งซื้อ
                                </button>
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

    function inputOnChange(input, id, product) {
        if (parseInt(input.value) > product.product_quantity) {
            alert("invalid qty.");
            input.value = 1;
            return ;
        }

        $.ajax({
            url: "/order_detail/" + id,
            type:"PUT",
            data:{
                _token: "{{ csrf_token() }}",
                qty: input.value
            },
            success:function(response){
                console.log(response)

                let amountTag = document.getElementById("product" + id);
                amountTag.innerHTML = product.product_price * parseInt(input.value);

                let amountPrice = 0;
                let amounts = document.getElementsByClassName("amountPrice");
                for (let i=0; i<amounts.length; i++) {
                    amountPrice += parseInt(amounts[i].innerHTML);
                }
                document.getElementById("amountPrice").innerHTML = amountPrice;
            }
        });
    }
</script>
