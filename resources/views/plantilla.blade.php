<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<style>
    li a{
        color: white;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #6cc475;">
        <a class="navbar-brand" href="#" style="color:white"><b>FARMACIA HGM</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('client.index')}}" style="color:white">Client</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/Treballador') }}" style="color:white">Treballador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{url('/Proveidor/get')}}" style="color:white">Proveidor</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('/Producte') }}" style="color:white">Producte</a>
                </li>
                @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" style="color:white">{{ __('Login') }}</a>
                    </li>
                @endif
        
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}" style="color:white">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown" >
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" style="color:white"
                        aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
        
                    <div class="dropdown-menu dropdown-menu-end" style="background-color: #a5e6ac;" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" 
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
    </nav>








    </div>

    <div class="container">
        @yield('content')
    </div>


</body>
