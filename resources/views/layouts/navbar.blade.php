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
                @auth()
                @if(Auth::user()->role == 'Admin')
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link">
                        สินค้า
                    </a>
                </li>
                @endif
                @if(Auth::user()->role == 'Customer')
                <li class="nav-item">
                     <a href="{{ route('product.products') }}" class="nav-link">
                          สินค้าภายในร้าน
                     </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="orderLink">
                        ประวัติการสั่งซื้อ
                    </a>
                </li>
                @endif


                @if(Auth::user()->role == 'Admin')
                <li class="nav-item">
                    <a href="{{ route('order.adminOrder') }}" class="nav-link">
                        การสั่งซื้อสินค้าทั้งหมด
                    </a>
                </li>
                @endif

                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @auth()
                    @if(Auth::user()->role == 'Admin')
                        <li class="nav-item">
                            <form action="{{ route('order-detail.search') }}" method="POST">
                                @method('POST')
                                @csrf
                            <button type="submit" class="nav-link">
                                รายงานยอดขาย
                            </button>

                            </form>
                        </li>
                    @endif

                    @if(Auth::user()->role=='Customer')
                    <li class="nav-item">
                        <a href="#" class="nav-link" id="basketLink">
                            <i class="fa fa-shopping-basket"></i>
                            <span class="badge badge-pill badge-danger" id="basketQty" style="margin-left: -10px"></span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->role=='Customer')
                    <li class="nav-item" >
                        <a href="{{route('user.index')}}" class="nav-link">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->role=='Admin')
{{--                            <li class="nav-item" >--}}
{{--                                <a href="" class="nav-link">--}}
{{--                                    <i class="fas fa-user"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item" >--}}
{{--                                <a href="" class="nav-link">--}}
{{--                                    {{ Auth::user()->name }}--}}
{{--                                </a>--}}
{{--                            </li>--}}

                    @endif

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
<script>
    import Button from "@/Jetstream/Button";
    export default {
        components: {Button}
    }
</script>
