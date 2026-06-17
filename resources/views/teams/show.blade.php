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
            <p><strong>{{ __('messages.city') }}:</strong> {{ $team->city ?? __('messages.not_specified') }}</p>
            <p><strong>{{ __('messages.manager') }}:</strong> {{ $team->manager->name ?? __('messages.no_manager') }}</p>
            <h3 class="mt-4">{{ __('messages.players') }}</h3>
            @if($team->players->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('messages.first_name') }}</th>
                            <th>{{ __('messages.last_name') }}</th>
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
                <p>{{ __('messages.no_players') }}</p>
            @endif
            <a href="{{ route('teams.index') }}" class="btn btn-secondary">{{ __('messages.back') }}</a>
            @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->id === $team->manager_id))
                <a href="{{ route('teams.edit', $team) }}" class="btn btn-warning">{{ __('messages.edit') }}</a>
            @endif
            @if(auth()->check() && auth()->user()->isAdmin())
                <form method="POST" action="{{ route('teams.destroy', $team) }}" class="d-inline"
                    onsubmit="return confirm('Vai tiešām dzēst šo komandu?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('messages.delete') }}</button>
                </form>
            @endif
        </div>
    </div>
</x-layout>