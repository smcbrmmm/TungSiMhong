@extends('layouts.app')

@section('content')

    <div class="container container-page">

        เพิ่มสินค้า

        <form action="" class="form" method="POST" >
            @csrf

{{--            <div class="form-group">--}}
{{--                <label for="place_name">ตั้งชื่อสถานที่</label>--}}
{{--                <input type="text" class="form-control" id="place_name"--}}
{{--                       name="place_name" value="{{ old('place_name') }}"--}}
{{--                       aria-describedby="place_nameHelp">--}}
{{--                <small id="place_nameHelp" class="form-text text-muted">--}}
{{--                    ชื่อสถานที่ is required .--}}
{{--                </small>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="receiver_name">ชื่อผู้รับสินค้า</label>--}}
{{--                <input type="text" class="form-control" id="title"--}}
{{--                       name="receiver_name" value="{{ old('receiver_name') }}"--}}
{{--                       aria-describedby="receiver_nameHelp">--}}
{{--                <small id="receiver_nameHelp" class="form-text text-muted">--}}
{{--                    ชื่อผู้รับสินค้า is required .--}}
{{--                </small>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="house_no">บ้านเลขที่</label>--}}
{{--                <input type="text" class="form-control" id="house_no"--}}
{{--                       name="house_no" value="{{ old('house_no') }}"--}}
{{--                       aria-describedby="house_noHelp">--}}
{{--                <small id="house_noHelp" class="form-text text-muted">--}}
{{--                    บ้านเลขที่ is required .--}}
{{--                </small>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="address">ที่อยู่</label>--}}
{{--                <input type="text" class="form-control" id="address"--}}
{{--                       name="address" value="{{ old('address') }}"--}}
{{--                       aria-describedby="addressHelp">--}}
{{--                <small id="addressHelp" class="form-text text-muted">--}}
{{--                    ที่อยู่ is required .--}}
{{--                </small>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="province">จังหวัด</label>--}}
{{--                <input type="text" class="form-control" id="province"--}}
{{--                       name="province" value="{{ old('province') }}"--}}
{{--                       aria-describedby="provinceHelp">--}}
{{--                <small id="provinceHelp" class="form-text text-muted">--}}
{{--                    จังหวัด is required .--}}
{{--                </small>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="postal">รหัสไปรษณีย์</label>--}}
{{--                <input type="text" class="form-control" id="postal"--}}
{{--                       name="postal" value="{{ old('postal') }}"--}}
{{--                       aria-describedby="postalHelp">--}}
{{--                <small id="postalHelp" class="form-text text-muted">--}}
{{--                    รหัสไปรษณีย์ is required .--}}
{{--                </small>--}}
{{--            </div>--}}

            <button type="submit" class="btn btn-primary">เพิ่มสินค้า</button>

        </form>

    </div>


@endsection
