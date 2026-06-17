<x-layout>
    <x-slot name="title">{{ __('messages.edit_player_title') }}</x-slot>
    <h1 class="mb-4">{{ __('messages.edit_player_title') }}</h1>
    <p><strong>{{ __('messages.team') }}:</strong> {{ $player->team->name }}</p>
    <form method="POST" action="{{ route('players.update', $player) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">{{ __('messages.first_name') }}</label>
            <input type="text" name="first_name" class="form-control"
                value="{{ old('first_name', $player->first_name) }}">
            @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.last_name') }}</label>
            <input type="text" name="last_name" class="form-control"
                value="{{ old('last_name', $player->last_name) }}">
            @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
        <a href="{{ route('players.show', $player) }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
    </form>
</x-layout>