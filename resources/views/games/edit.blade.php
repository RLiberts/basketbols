<x-layout>
    <x-slot name="title">{{ __('messages.edit_game') }}</x-slot>
    <h1 class="mb-4">{{ __('messages.edit_game') }}</h1>
    <form method="POST" action="{{ route('games.update', $game) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">{{ __('messages.team1') }}</label>
            <select name="team1_id" class="form-select">
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ $game->team1_id == $team->id ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
            @error('team1_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.team2') }}</label>
            <select name="team2_id" class="form-select">
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ $game->team2_id == $team->id ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
            @error('team2_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.arena') }}</label>
            <select name="arena_id" class="form-select">
                @foreach($arenas as $arena)
                    <option value="{{ $arena->id }}" {{ $game->arena_id == $arena->id ? 'selected' : '' }}>
                        {{ $arena->name }}
                    </option>
                @endforeach
            </select>
            @error('arena_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.date_time') }}</label>
            <input type="datetime-local" name="date" class="form-control"
                value="{{ old('date', \Carbon\Carbon::parse($game->date)->format('Y-m-d\TH:i')) }}">
            @error('date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.description') }}</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $game->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
        <a href="{{ route('games.show', $game) }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
    </form>
</x-layout>