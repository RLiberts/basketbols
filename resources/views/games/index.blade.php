<x-layout>
    <x-slot name="title">Spēļu kalendārs</x-slot>
    <h1 class="mb-4">Spēļu kalendārs</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('games.create') }}" class="btn btn-primary mb-3">Pievienot spēli</a>
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
                                Skatīt detaļas
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Nav nevienas spēles.</div>
    @endif
</x-layout>