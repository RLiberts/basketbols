<x-layout>
    <x-slot name="title">{{ __('messages.games') }}</x-slot>
    <h1 class="mb-4">{{ __('messages.games') }}</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('games.create') }}" class="btn btn-primary mb-3">{{ __('messages.add_game') }}</a>
    @endif
    <form method="GET" action="{{ route('games.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-3">
                <select name="team" class="form-select">
                    <option value="">{{ __('messages.choose_team') }}</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ request('team') == $team->id ? 'selected' : '' }}>
                            {{ $team->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="arena" class="form-select">
                    <option value="">{{ __('messages.choose_arena') }}</option>
                    @foreach($arenas as $arena)
                        <option value="{{ $arena->id }}" {{ request('arena') == $arena->id ? 'selected' : '' }}>
                            {{ $arena->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="date_from" class="form-control"
                    value="{{ request('date_from') }}" placeholder="{{ __('messages.date_from') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="date_to" class="form-control"
                    value="{{ request('date_to') }}" placeholder="{{ __('messages.date_to') }}">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">{{ __('messages.filter') }}</button>
            </div>
            <div class="col-md-1">
                <a href="{{ route('games.index') }}" class="btn btn-secondary w-100">{{ __('messages.reset') }}</a>
            </div>
        </div>
    </form>
    @if($games->count())
        <div class="row">
            @foreach($games as $game)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title">
                                {{ $game->team1->name }} vs {{ $game->team2->name }}
                            </h2>
                            <p class="text-muted">
                                {{ \Carbon\Carbon::parse($game->date)->format('d.m.Y H:i') }}
                            </p>
                            <p>
                                {{ $game->team1->name }} 
                                {{ $game->stats->whereIn('player_id', $game->team1->players->pluck('id'))->sum('points') }}
                                -
                                {{ $game->stats->whereIn('player_id', $game->team2->players->pluck('id'))->sum('points') }}
                                {{ $game->team2->name }}
                            </p>
                            <p>{{ $game->arena->name }}</p>
                            <a href="{{ route('games.show', $game) }}" class="btn btn-primary">
                                {{ __('messages.view_details') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">{{ __('messages.no_games') }}</div>
    @endif
</x-layout>