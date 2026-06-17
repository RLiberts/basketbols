<x-layout>
    <x-slot name="title">{{ $game->team1->name }} vs {{ $game->team2->name }}</x-slot>
    <h1>{{ $game->team1->name }} vs {{ $game->team2->name }}</h1>
    <p><strong>{{ __('messages.date') }}:</strong> {{ \Carbon\Carbon::parse($game->date)->format('d.m.Y H:i') }}</p>
    <p><strong>{{ __('messages.score') }}:</strong>
    {{ $game->team1->name }} 
    {{ $game->stats->whereIn('player_id', $game->team1->players->pluck('id'))->sum('points') }}
    -
    {{ $game->stats->whereIn('player_id', $game->team2->players->pluck('id'))->sum('points') }}
    {{ $game->team2->name }}
    </p>
    <p><strong>{{ __('messages.location') }}:</strong> {{ $game->arena->name }}, {{ $game->arena->address }}</p>
    <div id="map" style="height: 300px; width: 100%;" class="mb-3 rounded"></div>
    <script>
        var map = L.map('map').setView([{{ $game->arena->lat }}, {{ $game->arena->lng }}], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        L.marker([{{ $game->arena->lat }}, {{ $game->arena->lng }}])
            .addTo(map)
            .bindPopup('<b>{{ $game->arena->name }}</b><br>{{ $game->arena->address }}')
            .openPopup();
    </script>
    <p><strong>{{ __('messages.description') }}:</strong> {{ $game->description ?? __('messages.no_description') }}</p>
    <a href="{{ route('games.index') }}" class="btn btn-secondary">{{ __('messages.back') }}</a>
    @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('games.edit', $game) }}" class="btn btn-warning">{{ __('messages.edit') }}</a>
        <form method="POST" action="{{ route('games.destroy', $game) }}" class="d-inline"
            onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">{{ __('messages.delete') }}</button>
        </form>
    @endif

    <h2 class="mt-4">{{ __('messages.statistics') }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>{{ __('messages.player') }}</th>
                <th>{{ __('messages.team') }}</th>
                <th>{{ __('messages.points') }}</th>
                <th>{{ __('messages.rebounds') }}</th>
                <th>{{ __('messages.assists') }}</th>
                <th>{{ __('messages.fouls') }}</th>
                <th>{{ __('messages.minutes') }}</th>
                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSecretary()))
                    <th>{{ __('messages.actions') }}</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($game->stats as $stat)
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
                            <a href="{{ route('stats.edit', $stat) }}" class="btn btn-sm btn-warning">{{ __('messages.edit') }}</a>
                            @if(auth()->user()->isAdmin())
                                <form method="POST" action="{{ route('stats.destroy', $stat) }}" class="d-inline"
                                    onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">{{ __('messages.delete') }}</button>
                                </form>
                            @endif
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">{{ __('messages.no_statistics') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSecretary()))
        @if(!\Carbon\Carbon::parse($game->date)->isFuture())
            <h3 class="mt-4">{{ __('messages.add_statistics') }}</h3>
            <form method="POST" action="{{ route('stats.store', $game) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.player') }}</label>
                    <select name="player_id" class="form-select">
                        <option value="">{{ __('messages.choose_player') }}</option>
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
                        <label class="form-label">{{ __('messages.points') }}</label>
                        <input type="number" name="points" class="form-control" value="0" min="0">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">{{ __('messages.rebounds') }}</label>
                        <input type="number" name="rebounds" class="form-control" value="0" min="0">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">{{ __('messages.assists') }}</label>
                        <input type="number" name="assists" class="form-control" value="0" min="0">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">{{ __('messages.fouls') }}</label>
                        <input type="number" name="fouls" class="form-control" value="0" min="0">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">{{ __('messages.minutes') }}</label>
                        <input type="number" name="minutes" class="form-control" value="0" min="0">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('messages.add_statistics') }}</button>
            </form>
        @else
            <div class="alert alert-info mt-4">{{ __('messages.game_not_started') }}</div>
        @endif
    @endif
</x-layout>