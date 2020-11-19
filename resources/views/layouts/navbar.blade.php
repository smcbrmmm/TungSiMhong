<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="font-family: 'Mitr', sans-serif;">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}">
            <i class="fa fa-home"></i> TungSiMhong
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link">
                        สินค้า
                    </a>
                </li>
                @auth()
                <li class="nav-item">
                    <a href="{{ route('order.index') }}" class="nav-link">
                        ประวัติการสั่งซื้อ
                    </a>
                </li>
                @endauth
                <li class="nav-item">
                    <a href="{{ route('payment.index') }}" class="nav-link">
                        การชำระเงิน
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('payment.index') }}" class="nav-link">
                        เพิ่มเลขจัดส่งสินค้า
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('order.adminOrder') }}" class="nav-link">
                        การสั่งซื้อสินค้าทั้งหมด
                    </a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @auth()
                    <li class="nav-item">
                        <a href="{{ route('order.basket') }}" class="nav-link">
                            <i class="fa fa-shopping-basket"></i>
                            <span class="badge badge-pill badge-danger" id="basketQty"></span>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a href="{{route('user.index')}}" class="nav-link">
                                <i class="fas fa-user"></i>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a href="{{route('user.index')}}" class="nav-link">
                            {{ Auth::user()->name }}
                        </a>
                    </li>

                    <li>
                    <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary" style="background-color: white ; color: indianred ; border-color: white ; margin-top: 2px" ;
                        >Log out</button>
                    </form>
                    </li>

                @endauth


                @guest()
                <!-- Authentication Links -->
                <li class="nav-item">
                    <a href="{{ url('login') }}" class="nav-link">Login </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('register') }}" class="nav-link">Register</a>
                </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>
