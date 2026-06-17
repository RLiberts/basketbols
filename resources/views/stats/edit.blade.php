<x-layout>
    <x-slot name="title">Labot statistiku</x-slot>
    <h1 class="mb-4">Labot statistiku</h1>
    <p><strong>Spēlētājs:</strong> {{ $stat->player->first_name }} {{ $stat->player->last_name }}</p>
    <p><strong>Spēle:</strong> {{ $stat->game->team1->name }} vs {{ $stat->game->team2->name }}</p>
    <form method="POST" action="{{ route('stats.update', $stat) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-2 mb-3">
                <label class="form-label">Punkti</label>
                <input type="number" name="points" class="form-control"
                    value="{{ old('points', $stat->points) }}" min="0">
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Atlēkušās bumbas</label>
                <input type="number" name="rebounds" class="form-control"
                    value="{{ old('rebounds', $stat->rebounds) }}" min="0">
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Piespēles</label>
                <input type="number" name="assists" class="form-control"
                    value="{{ old('assists', $stat->assists) }}" min="0">
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Piezīmes</label>
                <input type="number" name="fouls" class="form-control"
                    value="{{ old('fouls', $stat->fouls) }}" min="0">
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Minūtes</label>
                <input type="number" name="minutes" class="form-control"
                    value="{{ old('minutes', $stat->minutes) }}" min="0">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Saglabāt</button>
        <a href="{{ route('games.show', $stat->game) }}" class="btn btn-secondary">Atcelt</a>
    </form>
</x-layout>