<x-layout>
    <x-slot name="title">{{ $game->team1->name }} vs {{ $game->team2->name }}</x-slot>

    <h1>{{ $game->team1->name }} vs {{ $game->team2->name }}</h1>
    <p><strong>Datums:</strong> {{ \Carbon\Carbon::parse($game->date)->format('d.m.Y H:i') }}</p>
    <p><strong>Vieta:</strong> {{ $game->arena->name }}, {{ $game->arena->address }}</p>
    <p><strong>Apraksts:</strong> {{ $game->description ?? 'Nav apraksta' }}</p>

    <a href="{{ route('games.index') }}" class="btn btn-secondary">Atpakaļ</a>

    @can('update', $game)
        <a href="{{ route('games.edit', $game) }}" class="btn btn-warning">Rediģēt</a>
    @endcan

    @can('delete', $game)
        <form method="POST" action="{{ route('games.destroy', $game) }}" class="d-inline"
            onsubmit="return confirm('Vai tiešām dzēst šo spēli?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Dzēst</button>
        </form>
    @endcan
</x-layout>