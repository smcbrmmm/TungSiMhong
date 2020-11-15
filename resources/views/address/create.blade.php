@extends('layouts.app')

@section('content')

    <div class="container">

        <h1> Create </h1>
        <div class="btn btn-primary"> Click for add address </div>



    <form action="{{ route('address.store') }}" class="form" method="POST" >
        @csrf


        <button type="submit" class="btn btn-primary">CREATE</button>

    </form>

    </div>


@endsection
