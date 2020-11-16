@extends('layouts.app')

@section('style')

@endsection

@section('content')

    <div class="container">

        Edit Address Information

        <form action="{{ route('address.update',['address' => $address->id ]) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="place_name">ชื่อสถานที่</label>
                <input type="text" class="form-control" id="place_name"
                       name="place_name" value="{{ old('place_name' ,$address->place_name) }}"
                       aria-describedby="place_nameHelp">
                <small id="place_nameHelp" class="form-text text-muted">
                    ชื่อสถานที่ is required
                </small>
            </div>

            <div class="form-group">
                <label for="receiver_name">ชื่อผู้รับสินค้า</label>
                <input type="text" class="form-control" id="place_name"
                       name="receiver_name" value="{{ old('receiver_name' ,$address->receiver_name) }}"
                       aria-describedby="receiver_nameHelp">
                <small id="receiver_nameHelp" class="form-text text-muted">
                    ชื่อผู้รับสินค้า is required
                </small>
            </div>

            <div class="form-group">
                <label for="house_no">เลขที่บ้าน</label>
                <input type="text" class="form-control " id="house_no"
                       name="house_no" value="{{old('house_no', $address->house_no) }}"
                       aria-describedby="house_noHelp">
                <small id="house_noHelp" class="form-text text-muted">
                    เลขที่บ้าน is required
                </small>
            </div>

            <div class="form-group">
                <label for="address">ที่อยู่</label>
                <input type="text" class="form-control " id="email"
                       name="address" value="{{old('address', $address->Address) }}"
                       aria-describedby="addressHelp">
                <small id="addressHelp" class="form-text text-muted">
                    ที่อยู่ is required
                </small>
            </div>

            <div class="form-group">
                <label for="province">จังหวัด</label>
                <input type="text" class="form-control " id="province"
                       name="province" value="{{old('province', $address->province) }}"
                       aria-describedby="provinceHelp">
            </div>

            <div class="form-group">
                <label for="postal">รหัสไปรษณีย์</label>
                <input type="text" class="form-control " id="postal"
                       name="postal" value="{{old('postal', $address->postal) }}"
                       aria-describedby="provinceHelp">
            </div>



            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </form>

    </div>


@endsection
