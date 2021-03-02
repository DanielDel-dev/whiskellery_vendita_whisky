<nav class="navbar navbar-expand-md navbar-light nav shadow-sm">
    <div class="container">
        <a href="{{route('home')}}">
            <img class="logo" src="/img/logo1.png" alt="">
        </a>
        <a class="navbar-brand" href="{{ url('/') }}">
            Whiskellery
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown ml-lg-4">
                        <button class="shadow-none bg-transparent border-0 nav-link dropdown-toggle text-uppercase " type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Whiskey
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($categories as $category)
                                
                            <a class="dropdown-item text-first pl-2" href="{{route('post.category', $category)}}">{{$category->name}}</a>
                            @endforeach
                            <a class="dropdown-item text-first pl-2" href="{{route('post.index')}}">All products</a>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="nav-link text-uppercase ml-2" href="{{route('post.contact')}}">Contact</a>
                </li>
                <li>
                    <a class="nav-link text-uppercase ml-2" href="{{route('post.story')}}">Story</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <a class="nav-link mr-4 text-uppercase border-0" href="{{ route('post.create') }}"><i class="fas fa-wine-bottle"></i> Selling</a>
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-weight-bold text-uppercase" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-first" href="{{ route('admin') }}">
                                Your posts
                            </a>
                            <a class="dropdown-item text-first" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>