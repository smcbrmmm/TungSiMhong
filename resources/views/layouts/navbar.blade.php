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
                    <a href="{{ url('/') }}" class="nav-link">Nav </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('order_detail.index')}}" class="nav-link">Kart </a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @auth()
                    <li class="nav-item">
                        <img src="storage/{{Auth::user()->profile_photo_path}}" style="max-width: 50px ; max-height: 50px" class="rounded" alt="">
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link" style="color: black">
                            {{ Auth::user()->name }}
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
