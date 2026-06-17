<x-layout>
    <x-slot name="title">{{ __('messages.create_game') }}</x-slot>
    <h1 class="mb-4">{{ __('messages.add_game') }}</h1>
    <form method="POST" action="{{ route('games.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">{{ __('messages.team1') }}</label>
            <select name="team1_id" class="form-select">
                <option value="">{{ __('messages.choose_team') }}</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
            @error('team1_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.team2') }}</label>
            <select name="team2_id" class="form-select">
                <option value="">{{ __('messages.choose_team') }}</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
            @error('team2_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.arena') }}</label>
            <select name="arena_id" class="form-select">
                <option value="">{{ __('messages.choose_arena') }}</option>
                @foreach($arenas as $arena)
                    <option value="{{ $arena->id }}">{{ $arena->name }}</option>
                @endforeach
            </select>
            @error('arena_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.date_time') }}</label>
            <input type="datetime-local" name="date" class="form-control" value="{{ old('date') }}">
            @error('date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.description') }}</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
        <a href="{{ route('games.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
    </form>
</x-layout>