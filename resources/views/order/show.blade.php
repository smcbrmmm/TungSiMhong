@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($orderDetails as $orderDetail)
            <div>{{ $orderDetail }}b</div>
        @endforeach
    </div>
@endsection
