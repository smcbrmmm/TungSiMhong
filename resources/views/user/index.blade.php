@extends('layouts.app')

@section('style')

@endsection

@section('content')

    <div class="container">

        <div style="font-size: 30px">
            ข้อมูลส่วนตัวของคุณ
        </div>

        <div >
        @if($user)
            <div style="font-size: 18px"> ชื่อ-นามสกุล : {{ $user[0]->name }}</div>
            <div style="font-size: 18px"> เบอร์โทรศัพท์ : {{ $user[0]->tel }}</div>
            <div style="font-size: 18px"> อีเมลล์ : {{ $user[0]->email }}</div>
        @endif
        <div class="mt-2">
            <a href="{{ route('user.edit' , [ 'user' => $user[0]->id]) }}">
                <span class="btn btn-primary">แก้ไขข้อมูลส่วนตัว</span>
            </a>
        </div>
        <br>
        <div style="font-size: 20px"> ที่อยู่ของคุณทั้งหมด </div>
        <div class="row" >
        @foreach($addresses as $address)
            <div class="col-mb-4 ml-3 mb-2 " style="border-width: 1px ; width: 23rem">
                <a href="{{ route('address.edit',['address' => $address->id]) }}">
                    <div style="margin-left: 1rem">
                        <i class="fas fa-map-marker" style="color: indianred"></i><span>  {{ $address->place_name }}</span>
                    </div>
                </a>
                <div style="margin-left: 1rem">
                    <span> ชื่อผู้รับสินค้า : {{ $address->receiver_name }}</span>
                </div>
                <div style="margin-left: 1rem">
                    <span> เบอร์โทรศัพท์ผู้รับสินค้า : {{ $address->receiver_tel }}</span>
                </div>
                <div style="margin-left: 1rem"> ที่อยู่ผู้รับสินค้า : {{ $address->house_no }} {{ $address->address }} {{ $address->province }} {{ $address->postal }}</div>
            </div>
        @endforeach
            </div>

            <a href=" {{ route('address.create') }}">
                <i class="fas fa-plus-square "></i> เพิ่มที่อยู่ใหม่
            </a>

        </div>

    </div>

@endsection
