@extends('layouts.app')

@section('style')

@endsection

@section('content')

    <div class="container">
        <div> แก้ไขข้อมูลส่วนตัว </div>

        <form action="{{ route('user.update',['user'=>$user->id]) }}" method="POST">
        @method('PUT')
        @csrf

            <div class="form-group">
                <label for="profile_photo_path">ไฟล์รูปภาพของคุณ</label>
                <input type="file" class="form-control-file" id="profile_photo_path" name="profile_photo_path"
                    >
            </div>


        <div class="form-group">
            <label for="name">ชื่อ-นามสกุล</label>
            <input type="text" class="form-control" id="name"
                   name="name" value="{{ old('name', $user->name) }}"
                   aria-describedby="nameHelp">
            <small id="nameHelp" class="form-text text-muted">
                ชื่อ-นามสกุล is required
            </small>
        </div>

            <div class="form-group">
                <label for="tel">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control " id="tel"
                       name="tel" value="{{ old('tel', $user->tel) }}"
                       aria-describedby="telHelp">
                <small id="telHelp" class="form-text text-muted">
                    เบอร์โทรศัพท์ is required
                </small>
            </div>

            <div class="form-group">
                <label for="email">อีเมลล์</label>
                <input type="text" class="form-control " id="email"
                       name="email" value="{{ old('email', $user->email) }}"
                       aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">
                    อีเมลล์ is required
                </small>
            </div>

            <div class="form-group">
                <label for="password">พาสเวิร์ดใหม่</label>
                <input type="password" class="form-control " id="password"
                       name="password"
                       aria-describedby="passwordHelp">
            </div>

            <div class="form-group">
                <label for="accpet_password">ยืนยันพาสเวิร์ดใหม่</label>
                <input type="accpet_password" class="form-control " id="accpet_password"
                       name="accpet_password"
                       aria-describedby="accpet_passwordHelp">
            </div>

        <button type="submit" class="btn btn-primary">แก้ไข</button>
        </form>


    </div>


@endsection
