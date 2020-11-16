<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
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
                        Product
                    </a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @auth()
                    <li class="nav-item">
                        <a href="{{ route('order.show', ['order' => 1]) }}" class="nav-link">
                            <i class="fa fa-shopping-basket"></i>
                            @if(!empty($basketQty))
                                <span class="badge badge-pill badge-danger">{{ $basketQty }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('user.index')}}">
                            <img src="storage/{{Auth::user()->profile_photo_path}}" style="max-width: 40px ; max-height: 40px ; margin-top: 1rem" class="rounded" alt="">
                        </a>
                    </li>
                @endauth


                @guest()
                <!-- Authentication Links -->
                <li class="nav-item">
                    <a href="{{ url('login') }}" class="nav-link">Login </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('register') }}" class="nav-link">Sign in </a>
                </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>
