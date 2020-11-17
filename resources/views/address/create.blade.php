@extends('layouts.app')

@section('content')

    <div class="container container-page">


    <form action="{{ route('address.store') }}" class="form" method="POST" >
        @csrf

        <div class="form-group">
            <label for="place_name">ตั้งชื่อสถานที่</label>
            <input type="text" class="form-control" id="place_name"
                   name="place_name" value="{{ old('place_name') }}"
                   aria-describedby="place_nameHelp">
            <small id="place_nameHelp" class="form-text text-muted">
                ชื่อสถานที่ is required .
            </small>
        </div>

        <div class="form-group">
            <label for="receiver_name">ชื่อผู้รับสินค้า</label>
            <input type="text" class="form-control" id="receiver_name"
                   name="receiver_name" value="{{ old('receiver_name') }}"
                   aria-describedby="receiver_nameHelp">
            <small id="receiver_nameHelp" class="form-text text-muted">
                ชื่อผู้รับสินค้า is required .
            </small>
        </div>

        <div class="form-group">
            <label for="receiver_tel">เบอร์โทรศัพท์ผู้รับสินค้า</label>
            <input type="text" class="form-control" id="receiver_tel"
                   name="receiver_tel" value="{{ old('receiver_tel') }}"
                   aria-describedby="receiver_telHelp">
            <small id="receiver_telHelp" class="form-text text-muted">
                เบอร์โทรศัพท์ผู้รับสินค้า is required .
            </small>
        </div>

        <div class="form-group">
            <label for="house_no">บ้านเลขที่</label>
            <input type="text" class="form-control" id="house_no"
                   name="house_no" value="{{ old('house_no') }}"
                   aria-describedby="house_noHelp">
            <small id="house_noHelp" class="form-text text-muted">
                บ้านเลขที่ is required .
            </small>
        </div>

        <div class="form-group">
            <label for="address">ที่อยู่</label>
            <input type="text" class="form-control" id="address"
                   name="address" value="{{ old('address') }}"
                   aria-describedby="addressHelp">
            <small id="addressHelp" class="form-text text-muted">
                ที่อยู่ is required .
            </small>
        </div>

        <div class="form-group">
            <label for="province">จังหวัด</label>
            <br>
            <select name="province" id="province">
                <option disabled  selected value> -- เลือกจังหวัดที่อยู่ --</option>
                <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                <option value="กระบี่">กระบี่</option>
                <option value="กาญจนบุรี">กาญจนบุรี</option>
                <option value="กาฬสินธุ์">กาฬสินธุ์</option>
                <option value="กำแพงเพชร">กำแพงเพชร</option>
                <option value="ขอนแก่น">ขอนแก่น</option>
                <option value="จันทบุรี">จันทบุรี</option>
                <option value="ฉะเชิงเทรา">ฉะเชิงเทรา</option>
                <option value="ชลบุรี">ชลบุรี</option>
                <option value="ชัยนาท">ชัยนาท</option>
                <option value="ชัยภูมิ">ชัยภูมิ</option>
                <option value="ชุมพร">ชุมพร</option>
                <option value="เชียงราย">เชียงราย</option>
                <option value="เชียงใหม่">เชียงใหม่</option>
                <option value="ตรัง">ตรัง</option>
                <option value="ตราด">ตราด</option>
                <option value="ตาก">ตาก</option>
                <option value="นครนายก">นครนายก</option>
                <option value="นครปฐม">นครปฐม</option>
                <option value="นครพนม">นครพนม</option>
                <option value="นครราชสีมา">นครราชสีมา</option>
                <option value="นครศรีธรรมราช">นครศรีธรรมราช</option>
                <option value="นครสวรรค์">นครสวรรค์</option>
                <option value="นนทบุรี">นนทบุรี</option>
                <option value="นราธิวาส">นราธิวาส</option>
                <option value="น่าน">น่าน</option>
                <option value="หนองคาย">หนองคาย</option>
                <option value="หนองบัวลำภู">หนองบัวลำภู</option>
                <option value="บุรีรัมย์">บุรีรัมย์</option>
                <option value="บึงกาฬ">บึงกาฬ</option>
                <option value="ปทุมธานี">ปทุมธานี</option>
                <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์</option>
                <option value="ปราจีนบุรี">ปราจีนบุรี</option>
                <option value="ปัตตานี">ปัตตานี</option>
                <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา</option>
                <option value="พังงา">พังงา</option>
                <option value="พัทลุง">พัทลุง</option>
                <option value="พิจิตร">พิจิตร</option>
                <option value="พิษณุโลก">พิษณุโลก</option>
                <option value="เพชรบุรี">เพชรบุรี</option>
                <option value="เพชรบูรณ์">เพชรบูรณ์</option>
                <option value="แพร่">แพร่</option>
                <option value="พะเยา">พะเยา</option>
                <option value="ภูเก็ต">ภูเก็ต</option>
                <option value="มหาสารคาม">มหาสารคาม</option>
                <option value="แม่ฮ่องสอน">แม่ฮ่องสอน</option>
                <option value="มุกดาหาร">มุกดาหาร</option>
                <option value="ยะลา">ยะลา</option>
                <option value="ยโสธร">ยโสธร</option>
                <option value="ร้อยเอ็ด">ร้อยเอ็ด</option>
                <option value="ระนอง">ระนอง</option>
                <option value="ระยอง">ระยอง</option>
                <option value="ราชบุรี">ราชบุรี</option>
                <option value="ลพบุรี">ลพบุรี</option>
                <option value="ลำปาง">ลำปาง</option>
                <option value="ลำพูน">ลำพูน</option>
                <option value="เลย">เลย</option>
                <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                <option value="สกลนคร">สกลนคร</option>
                <option value="สงขลา">สงขลา</option>
                <option value="สตูล">สตูล</option>
                <option value="สมุทรปราการ">สมุทรปราการ</option>
                <option value="สมุทรสงคราม">สมุทรสงคราม</option>
                <option value="สมุทรสาคร">สมุทรสาคร</option>
                <option value="สระแก้ว">สระแก้ว</option>
                <option value="สระบุรี">สระบุรี</option>
                <option value="สิงห์บุรี">สิงห์บุรี</option>
                <option value="สุโขทัย">สุโขทัย</option>
                <option value="สุพรรณบุรี">สุพรรณบุรี</option>
                <option value="สุราษฎร์ธานี">สุราษฎร์ธานี</option>
                <option value="สุรินทร์">สุรินทร์</option>
                <option value="อ่างทอง">อ่างทอง</option>
                <option value="อุดรธานี">อุดรธานี</option>
                <option value="อุทัยธานี">อุทัยธานี</option>
                <option value="อุตรดิตถ์">อุตรดิตถ์</option>
                <option value="อุบลราชธานี">อุบลราชธานี</option>
                <option value="อำนาจเจริญ">อำนาจเจริญ</option>

            </select>
            <small id="provinceHelp" class="form-text text-muted">
                จังหวัด is required .
            </small>
        </div>



{{--        <div class="form-group">--}}
{{--            <label for="province">จังหวัด</label>--}}
{{--            <input type="text" class="form-control" id="province"--}}
{{--                   name="province" value="{{ old('province') }}"--}}
{{--                   aria-describedby="provinceHelp">--}}
{{--            <small id="provinceHelp" class="form-text text-muted">--}}
{{--                จังหวัด is required .--}}
{{--            </small>--}}
{{--        </div>--}}

        <div class="form-group">
            <label for="postal">รหัสไปรษณีย์</label>
            <input type="text" class="form-control" id="postal"
                   name="postal" value="{{ old('postal') }}"
                   aria-describedby="postalHelp">
            <small id="postalHelp" class="form-text text-muted">
                รหัสไปรษณีย์ is required .
            </small>
        </div>

        <button type="submit" class="btn btn-primary">บันทึกที่อยู่</button>

    </form>

    </div>


@endsection
