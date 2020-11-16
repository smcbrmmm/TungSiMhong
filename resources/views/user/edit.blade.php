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
            <label for="name">ชื่อ-นามสกุล</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                   name="name" value="{{ old('name', $user->name) }}"
                   aria-describedby="nameHelp">
            <small id="nameHelp" class="form-text text-muted">
                ชื่อ-นามสกุล is required
            </small>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

            <div class="form-group">
                <label for="tel">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control @error('tel') is-invalid @enderror" id="tel"
                       name="tel" value="{{ old('tel', $user->tel) }}"
                       aria-describedby="telHelp" placeholder="ตัวอย่าง : 099-999-9999">
                <small id="telHelp" class="form-text text-muted">
                    เบอร์โทรศัพท์ is required
                </small>
                @error('tel')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">อีเมลล์</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                       name="email" value="{{ old('email', $user->email) }}"
                       aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">
                    อีเมลล์ is required
                </small>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="accept_password">ยืนยันพาสเวิร์ด</label>
                <input type="password" class="form-control " id="accept_password"
                       name="accept_password"
                       aria-describedby="accpet_passwordHelp">
            </div>

{{--            <div class="form-group">--}}
{{--                <label for="password">พาสเวิร์ดใหม่</label>--}}
{{--                <input type="password" class="form-control " id="password"--}}
{{--                       name="password"--}}
{{--                       aria-describedby="passwordHelp">--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="password">ยืนยันพาสเวิร์ดใหม่</label>--}}
{{--                <input type="password" class="form-control " id="password"--}}
{{--                       name="password"--}}
{{--                       aria-describedby="passwordHelp">--}}
{{--            </div>--}}


        <button type="submit" class="btn btn-primary">แก้ไข</button>
        </form>


    </div>


@endsection
