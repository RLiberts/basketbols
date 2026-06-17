<x-layout>
    <x-slot name="title">{{ $team->name }}</x-slot>
    <div class="row">
        <div class="col-md-4">
            @if($team->logo)
                <img src="{{ asset('storage/' . $team->logo) }}" class="img-fluid mb-3">
            @endif
        </div>
        <div class="col-md-8">
            <h1>{{ $team->name }}</h1>
            <p><strong>Pilsēta:</strong> {{ $team->city ?? 'Nav norādīta' }}</p>
            <p><strong>Menedžeris:</strong> {{ $team->manager->name ?? 'Nav menedžera' }}</p>
            <h3 class="mt-4">Spēlētāji</h3>
            @if($team->players->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th>Vārds</th>
                            <th>Uzvārds</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($team->players as $player)
                            <tr>
                                <td>{{ $player->first_name }}</td>
                                <td>{{ $player->last_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Nav spēlētāju.</p>
            @endif
            <a href="{{ route('teams.index') }}" class="btn btn-secondary">Atpakaļ</a>
            @can('update', $team)
                <a href="{{ route('teams.edit', $team) }}" class="btn btn-warning">Rediģēt</a>
            @endcan
            @can('delete', $team)
                <form method="POST" action="{{ route('teams.destroy', $team) }}" class="d-inline"
                    onsubmit="return confirm('Vai tiešām dzēst šo komandu?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Dzēst</button>
                </form>
            @endcan
        </div>
    </div>
</x-layout>