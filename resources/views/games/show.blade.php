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
    <h2 class="mt-4">Statistika</h2>
    @if($game->stats->count())
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Spēlētājs</th>
                    <th>Komanda</th>
                    <th>Punkti</th>
                    <th>Atlēkušās bumbas</th>
                    <th>Piespēles</th>
                    <th>Piezīmes</th>
                    <th>Minūtes</th>
                    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSecretary()))
                        <th>Darbības</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($game->stats as $stat)
                    <tr>
                        <td>{{ $stat->player->first_name }} {{ $stat->player->last_name }}</td>
                        <td>{{ $stat->player->team->name }}</td>
                        <td>{{ $stat->points }}</td>
                        <td>{{ $stat->rebounds }}</td>
                        <td>{{ $stat->assists }}</td>
                        <td>{{ $stat->fouls }}</td>
                        <td>{{ $stat->minutes }}</td>
                        @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSecretary()))
                            <td>
                                <a href="{{ route('stats.edit', $stat) }}" class="btn btn-sm btn-warning">Labot</a>
                                @if(auth()->user()->isAdmin())
                                    <form method="POST" action="{{ route('stats.destroy', $stat) }}" class="d-inline"
                                        onsubmit="return confirm('Dzēst statistiku?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Dzēst</button>
                                    </form>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info mt-3">Nav statistikas.</div>
    @endif
    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSecretary()))
        <h3 class="mt-4">Pievienot statistiku</h3>
        <form method="POST" action="{{ route('stats.store', $game) }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Spēlētājs</label>
                <select name="player_id" class="form-select">
                    <option value="">Izvēlies spēlētāju</option>
                    <optgroup label="{{ $game->team1->name }}">
                        @foreach($game->team1->players as $player)
                            <option value="{{ $player->id }}">
                                {{ $player->first_name }} {{ $player->last_name }}
                            </option>
                        @endforeach
                    </optgroup>
                    <optgroup label="{{ $game->team2->name }}">
                        @foreach($game->team2->players as $player)
                            <option value="{{ $player->id }}">
                                {{ $player->first_name }} {{ $player->last_name }}
                            </option>
                        @endforeach
                    </optgroup>
                </select>
                @error('player_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="row">
                <div class="col-md-2 mb-3">
                    <label class="form-label">Punkti</label>
                    <input type="number" name="points" class="form-control" value="0" min="0">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Atlēkušās bumbas</label>
                    <input type="number" name="rebounds" class="form-control" value="0" min="0">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Piespēles</label>
                    <input type="number" name="assists" class="form-control" value="0" min="0">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Piezīmes</label>
                    <input type="number" name="fouls" class="form-control" value="0" min="0">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Minūtes</label>
                    <input type="number" name="minutes" class="form-control" value="0" min="0">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Pievienot statistiku</button>
        </form>
    @endif
</x-layout>