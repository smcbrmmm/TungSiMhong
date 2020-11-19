@extends('layouts.app')

@section('style')

@endsection

@section('content')

    <div class="container">
        <div style="font-size: 26px" class="mb-4">
            แก้ไขข้อมูลส่วนตัว
        </div>

        <form action="{{ route('user.update',['user'=>$user->id]) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="form-group">
            <label for="name">ชื่อ-นามสกุล <i style="color: indianred" class="fas fa-star-of-life"></i></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                   name="name" value="{{ old('name', $user->name) }}"
                   aria-describedby="nameHelp">
            <small id="nameHelp" class="form-text text-muted">
                ชื่อ-นามสกุล จำเป็น
            </small>
            @error('name')
            <div class="alert alert-danger"> ชื่อและนามสกุลต้องยาวอย่างน้อย 5 ตัวอักษร</div>
            @enderror
        </div>

            <div class="form-group">
                <label for="tel">เบอร์โทรศัพท์ <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="text" class="form-control @error('tel') is-invalid @enderror" id="tel"
                       name="tel" value="{{ old('tel', $user->tel) }}"
                       aria-describedby="telHelp" placeholder="ตัวอย่าง : 099-999-9999">
                <small id="telHelp" class="form-text text-muted">
                    เบอร์โทรศัพท์ จำเป็น
                </small>
                @error('tel')
                <div class="alert alert-danger"> เบอร์โทรศัพท์ไม่ถูกต้อง </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">อีเมลล์ <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                       name="email" value="{{ old('email', $user->email) }}"
                       aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">
                    อีเมลล์ จำเป็น
                </small>
                @error('email')
                <div class="alert alert-danger">โปรดกรอกข้อมูลอีเมลล์ให้ถูกต้อง</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="accept_password">ยืนยันรหัสผ่าน <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                <input type="password" class="form-control @error('accept_password') is-invalid @enderror " id="accept_password"
                       name="accept_password"
                       aria-describedby="accpet_passwordHelp">
                <small id="emailHelp" class="form-text text-muted">
                    ยืนยันรหัสผ่าน จำเป็น
                </small>
                @error('accept_password')
                <div class="alert alert-danger">โปรดใส่รหัสผ่านยืนยัน</div>
                @enderror
            </div>


            <div>
            <a id="more" href="#" onclick="$('.details').slideToggle(function(){$('#more').html($('.details').is(':visible')?'ไม่อยากเปลี่ยนรหัสผ่านแล้ว':'เปลี่ยนรหัสผ่าน');});
            $('#new_password').val('') ; $('#confirm_password').val('')">
                เปลี่ยนรหัสผ่าน</a>
            </div>
            <div class="details" style="display:none">

                <div class="form-group">
                    <label for="new_password">รหัสผ่านใหม่ <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password"
                           name="new_password"
                           aria-describedby="new_passwordHelp">
                </div>

                @error('new_password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="confirm_password" @error('confirm_password') is-invalid @enderror>ยืนยันรหัสผ่านใหม่ <i style="color: indianred" class="fas fa-star-of-life"></i></label>
                    <input type="password" class="form-control " id="confirm_password"
                           name="confirm_password"
                           aria-describedby="confirm_passwordHelp">
                </div>


                @error('confirm_password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>


    </div>


@endsection
