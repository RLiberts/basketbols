<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Basketbola turnīrs</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ route('games.index') }}">Spēles</a>
            <a class="nav-link" href="#">Komandas</a>
            <a class="nav-link" href="#">Kopvērtējums</a>

            @auth
                <a class="nav-link" href="{{ route('dashboard') }}">
                    {{ auth()->user()->name }} ({{ auth()->user()->role }})
                </a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">Izrakstīties</button>
                </form>
            @endauth

            @guest
                <a class="nav-link" href="{{ route('login') }}">Pieteikties</a>
                <a class="nav-link" href="{{ route('register') }}">Reģistrēties</a>
            @endguest
        </div>
    </div>
</nav>