<x-layout>
    <x-slot name="title">{{ __('messages.games_title') }}</x-slot>
    <h1 class="mb-4">{{ __('messages.games_title') }}</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('games.create') }}" class="btn btn-primary mb-3">{{ __('messages.add_game') }}</a>
    @endif
    @if($games->count())
        <div class="row">
            @foreach($games as $game)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $game->team1->name }} vs {{ $game->team2->name }}
                            </h5>
                            <p class="text-muted">
                                {{ \Carbon\Carbon::parse($game->date)->format('d.m.Y H:i') }}
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