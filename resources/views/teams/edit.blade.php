<x-layout>
    <x-slot name="title">Rediģēt komandu</x-slot>
    <h1 class="mb-4">Rediģēt komandu</h1>
    <form method="POST" action="{{ route('teams.update', $team) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nosaukums</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $team->name) }}">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Pilsēta</label>
            <input type="text" name="city" class="form-control" value="{{ old('city', $team->city) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Menedžeris</label>
            <select name="manager_id" class="form-select">
                <option value="">Nav menedžera</option>
                @foreach($managers as $manager)
                    <option value="{{ $manager->id }}"
                        {{ $team->manager_id == $manager->id ? 'selected' : '' }}>
                        {{ $manager->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Logo</label>
            @if($team->logo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $team->logo) }}" style="max-height: 80px;">
                </div>
            @endif
            <input type="file" name="logo" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Saglabāt</button>
        <a href="{{ route('teams.show', $team) }}" class="btn btn-secondary">Atcelt</a>
    </form>
</x-layout>