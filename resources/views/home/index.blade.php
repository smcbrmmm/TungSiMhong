@extends('layouts.app')

@section('content')

    <div class="container">

        @if(Auth::user())
        <a href=" {{ route('user.edit' , [ 'user' => Auth::user()->id] ) }}"> แก้ไขข้อมูลส่วนตัว </a>
        @endif
        <a href="{{ route('address.create') }}"> <div class="btn btn-primary"> click </div> </a>

    </div>


@endsection
