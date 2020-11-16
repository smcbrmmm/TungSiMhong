@extends('layouts.app')

@section('style')

@endsection

@section('content')

    <div class="container">
        <div>
            Address Detail
        </div>

        <a href="{{ route('address.create') }}" style="color: cornflowerblue">เพิ่มที่อยู่ใหม่</a>

        @foreach($addresses as $address)

            <div>
                <h1> {{ $address->place_name }}</h1>
            </div>

        @endforeach


    </div>

@endsection
