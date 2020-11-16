@extends('layouts.app')

@section('content')

    <div class="container">
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">image</th>
                <th scope="col">product code</th>
                <th scope="col">name</th>
                <th scope="col">price</th>
                <th scope="col">quantity</th>
                <th scope="col">weight</th>
                <th scope="col">detail</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td></td>
                    <td>{{ $product->product_code }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_price }}</td>
                    <td>{{ $product->product_quantity }}</td>
                    <td>{{ $product->product_weight }}</td>
                    <td>{{ $product->product_detail }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
