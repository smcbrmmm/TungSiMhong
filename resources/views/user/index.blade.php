@extends('layouts.app')

@section('style')

@endsection

@section('content')

    <div class="container">


        @if($user)
            <div> ชื่อ : {{ $user[0]->name }}</div>
            <div> เบอร์โทรศัพท์ : {{ $user[0]->tel }}</div>
            <div> อีเมลล์ : {{ $user[0]->email }}</div>
            @endif
        <a href="{{ route('user.edit' , [ 'user' => $user[0]->id]) }}"> <div> แก้ไขข้อมูลส่วนตัว </div></a>
        <br>
        <div> ที่อยู่ของคุณทั้งหมด </div>
        @foreach($addresses as $address)
        <div class="mb-2" style="border-width: 1px ; width: 20rem">
            <a href="{{ route('address.edit',['address' => $address->id]) }}">
            <div style="margin-left: 1rem">
                <i class="fas fa-map-marker"></i><span>  {{ $address->place_name }}</span>
            </div>
            </a>
            <div style="margin-left: 1rem">
                <span> ชื่อผู้รับสินค้า : {{ $address->receiver_name }}</span>
            </div>
        </div>
        @endforeach

            <a href=" {{ route('address.create') }}">
                <i class="fas fa-plus-square "></i> เพิ่มที่อยู่ใหม่
            </a>

    </div>

@endsection
