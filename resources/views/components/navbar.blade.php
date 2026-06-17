<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">{{ __('messages.tournament') }}</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ route('games.index') }}">{{ __('messages.games') }}</a>
            <a class="nav-link" href="{{ route('teams.index') }}">{{ __('messages.teams') }}</a>
            <a class="nav-link" href="{{ route('standings.index') }}">{{ __('messages.standings') }}</a>
            <div class="navbar-nav ms-2">
                <a class="nav-link {{ app()->getLocale() === 'lv' ? 'fw-bold' : '' }}"
                href="{{ route('lang.switch', 'lv') }}">LV</a>
                <a class="nav-link {{ app()->getLocale() === 'en' ? 'fw-bold' : '' }}"
                href="{{ route('lang.switch', 'en') }}">EN</a>
            </div>
            @auth
                @if(auth()->user()->isAdmin())
                    <a class="nav-link" href="{{ route('admin.users.index') }}">{{ __('messages.admin') }}</a>
                @endif
                <a class="nav-link" href="{{ route('dashboard') }}">
                    {{ auth()->user()->name }} ({{ auth()->user()->role }})
                </a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">{{ __('messages.logout') }}</button>
                </form>
            @endauth

            @guest
                <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                <a class="nav-link" href="{{ route('register') }}">{{ __('messages.register') }}</a>
            @endguest
        </div>
    </div>
</nav>