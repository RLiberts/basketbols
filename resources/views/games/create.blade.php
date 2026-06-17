<x-layout>
    <x-slot name="title">Pievienot spēli</x-slot>

    <h1 class="mb-4">Pievienot spēli</h1>

    <form method="POST" action="{{ route('games.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Komanda 1</label>
            <select name="team1_id" class="form-select">
                <option value="">Izvēlies komandu</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
            @error('team1_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Komanda 2</label>
            <select name="team2_id" class="form-select">
                <option value="">Izvēlies komandu</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
            @error('team2_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Arēna</label>
            <select name="arena_id" class="form-select">
                <option value="">Izvēlies arēnu</option>
                @foreach($arenas as $arena)
                    <option value="{{ $arena->id }}">{{ $arena->name }}</option>
                @endforeach
            </select>
            @error('arena_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Datums un laiks</label>
            <input type="datetime-local" name="date" class="form-control" value="{{ old('date') }}">
            @error('date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Apraksts</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Saglabāt</button>
        <a href="{{ route('games.index') }}" class="btn btn-secondary">Atcelt</a>
    </form>
</x-layout>