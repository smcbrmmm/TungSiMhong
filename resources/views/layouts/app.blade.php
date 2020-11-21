<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TungSiMhong</title>

    <link rel="stylesheet" href="{{ asset('css/all.css') }}">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/56e49317d8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('style')

</head>
<body>
<div id="app">
    @include('layouts.navbar')

    <main class="py-4 " style="font-family: 'Mitr', sans-serif;">
        @yield('content')
    </main>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content text-center">
                <div class="modal-body text-center" style="color: indianred">
                    <p id="error"></p>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('script')
<script>
    $(document).ready(function(){

        @auth()
            let basketQty = $("#basketQty");

            $.ajax({
                url: "/order/basket",
                type:"GET",
                success:function(response){
                    if (response > 0) {
                        basketQty.text(response)
                    }
                }
            });

            $('#basketLink').click(function () {
                $.ajax({
                    url: "/order/basket",
                    type:"GET",
                    success:function(response){
                        if (response > 0) {
                            window.location.href = "{{ route('order.basket') }}";
                        } else {
                            $("#error").html("<b>ไม่มีสินค้าในตะกร้า</b>");
                            $('#myModal').modal("show");
                        }
                    }
                });
            })

            $('#orderLink').click(function () {
                $.ajax({
                    url: "/order/count",
                    type:"GET",
                    success:function(response){
                        console.log(response)
                        if (response > 0) {
                            window.location.href = "{{ route('order.index') }}";
                        } else {
                            $("#error").html("<b>คุณยังไม่มีประวัติการสั่งซื้อ</b>");
                            $('#myModal').modal("show");
                        }
                    }
                });
            })
        @endauth
    });
</script>
</body>
</html>
