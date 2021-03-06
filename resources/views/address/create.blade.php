@extends('layouts.app')

@section('content')

    <div class="container container-page">


    <form action="{{ route('address.store') }}" class="form" method="POST" >
        @csrf

        <div class="form-group">
            <label for="place_name">ตั้งชื่อสถานที่ <i style="color: indianred" class="fas fa-star-of-life"></i></label>
            <input type="text" class="form-control @error('place_name') is-invalid @enderror" id="place_name"
                   name="place_name" value="{{ old('place_name') }}" placeholder="ตัวอย่าง : บ้านแม่"
                   aria-describedby="place_nameHelp">
            <small id="place_nameHelp" class="form-text text-muted">
                ชื่อสถานที่ จำเป็น
            </small>
            @error('place_name')
            <div class="alert alert-danger">ไม่ได้ใส่ชื่อสถานที่หรือชื่อสถานที่ไม่ถูกต้อง</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="receiver_name">ชื่อผู้รับสินค้า <i style="color: indianred" class="fas fa-star-of-life"></i></label>
            <input type="text" class="form-control @error('receiver_name') is-invalid @enderror" id="receiver_name"
                   name="receiver_name" value="{{ old('receiver_name') }}" placeholder="ตัวอย่าง : แม่"
                   aria-describedby="receiver_nameHelp">
            <small id="receiver_nameHelp" class="form-text text-muted">
                ชื่อผู้รับสินค้า จำเป็น
            </small>
            @error('receiver_name')
            <div class="alert alert-danger"> ไม่ได้ใส่ชื่อผู้รับสินค้าหรือชื่อผู้รับไม่ถูกต้อง</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="receiver_tel">เบอร์โทรศัพท์ผู้รับสินค้า <i style="color: indianred" class="fas fa-star-of-life"></i></label>
            <input type="text" class="form-control @error('receiver_tel') is-invalid @enderror" id="receiver_tel"
                   name="receiver_tel" value="{{ old('receiver_tel') }}" placeholder="ตัวอย่าง : 0955938259"
                   aria-describedby="receiver_telHelp">
            <small id="receiver_telHelp" class="form-text text-muted">
                เบอร์โทรศัพท์ผู้รับสินค้า จำเป็น
            </small>
            @error('receiver_tel')
            <div class="alert alert-danger"> ไม่ได้ใส่เบอร์โทรศัพท์หรือเบอร์โทรศัพท์ไม่ถูกต้อง</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="house_no">บ้านเลขที่ <i style="color: indianred" class="fas fa-star-of-life"></i></label>
            <input type="text" class="form-control @error('house_no') is-invalid @enderror" id="house_no"
                   name="house_no" value="{{ old('house_no') }}" placeholder="ตัวอย่าง : 2103/30"
                   aria-describedby="house_noHelp">
            <small id="house_noHelp" class="form-text text-muted">
                บ้านเลขที่ จำเป็น
            </small>
            @error('house_no')
            <div class="alert alert-danger"> ไม่ได้ใส่เลขที่บ้านหรือเลขที่บ้านไม่ถูกต้อง</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">ที่อยู่ <i style="color: indianred" class="fas fa-star-of-life"></i></label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                   name="address" value="{{ old('address') }}" placeholder="ตัวอย่าง : หอพักศุภกร ห้อง 3 ถนนพหลโยธิน เขตจตุจักร แขวงลาดยาว"
                   aria-describedby="addressHelp">
            <small id="addressHelp" class="form-text text-muted">
                ที่อยู่ จำเป็น
            </small>
            @error('address')
            <div class="alert alert-danger">ไม่ได้ใส่ที่อยู่หรือที่อยู่ไม่ถูกต้อง</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="province">จังหวัด <i style="color: indianred" class="fas fa-star-of-life"></i></label>
            <br>
            <select name="province" id="province" class="form-control @error('province') is-invalid @enderror">
                <option disabled  selected value> -- เลือกจังหวัดที่อยู่ --</option>
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
                จังหวัด จำเป็น
            </small>
            @error('province')
            <div class="alert alert-danger"> ไม่ได้เลือกจังหวัด</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="postal">รหัสไปรษณีย์ <i style="color: indianred" class="fas fa-star-of-life"></i></label>
            <input type="text" class="form-control @error('postal') is-invalid @enderror" id="postal"
                   name="postal" value="{{ old('postal') }}" placeholder="ตัวอย่าง : 10900"
                   aria-describedby="postalHelp">
            <small id="postalHelp" class="form-text text-muted">
                รหัสไปรษณีย์ จำเป็น
            </small>
            @error('postal')
            <div class="alert alert-danger"> ไม่ได้ใส่รหัสไปรษณีย์หรือรหัสไปรษณีย์ไม่ถูกต้อง</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">บันทึกที่อยู่</button>

    </form>

    </div>


@endsection
