<x-layout>
    <x-slot name="title">{{ $player->first_name }} {{ $player->last_name }}</x-slot>
    <div class="row">
        <div class="col-md-9">
            <h1>{{ $player->first_name }} {{ $player->last_name }}</h1>
            <p><strong>{{ __('messages.team') }}:</strong>
                <a href="{{ route('teams.show', $player->team) }}">{{ $player->team->name }}</a>
            </p>
            <a href="{{ route('teams.show', $player->team) }}" class="btn btn-secondary">
                {{ __('messages.back') }}
            </a>
            @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->id === $player->team->manager_id))
                <a href="{{ route('players.edit', $player) }}" class="btn btn-warning">
                    {{ __('messages.edit') }}
                </a>
                <form method="POST" action="{{ route('players.destroy', $player) }}" class="d-inline"
                    onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('messages.delete') }}</button>
                </form>
            @endif
        </div>
    </div>
</x-layout>